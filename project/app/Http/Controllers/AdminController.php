<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'The email address or password is incorrect.']);
    }

    public function dashboard()
    {
        return view('admin.dashboard', ['user' => Auth::user()]);
    }

    public function settings()
    {
        return view('admin.settings', [
            'user' => Auth::user(),
            'settings' => Setting::allAsArray(),
        ]);
    }

    public function saveSettings(Request $request)
    {
        $validated = $request->validate([
            'mail_host' => ['nullable', 'string', 'max:255'],
            'mail_port' => ['nullable', 'numeric'],
            'mail_username' => ['nullable', 'string', 'max:255'],
            'mail_password' => ['nullable', 'string', 'max:255'],
            'mail_encryption' => ['nullable', 'in:tls,ssl,none'],
            'mail_from_address' => ['nullable', 'email', 'max:255'],
            'mail_from_name' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($validated as $key => $value) {
            // Don't overwrite the stored password with an empty value
            if ($key === 'mail_password' && ($value === null || $value === '')) {
                continue;
            }
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings')->with('success', 'SMTP settings saved successfully.');
    }

    public function sendTestEmail(Request $request)
    {
        $request->validate(['test_email' => ['required', 'email']]);

        try {
            Mail::raw('This is a test email from your GOV.UK VISA CO admin panel. Your SMTP settings are working.', function ($message) use ($request) {
                $message->to($request->input('test_email'))
                        ->subject('SMTP test email');
            });
            return redirect()->route('admin.settings')->with('success', 'Test email sent to ' . $request->input('test_email') . '.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.settings')->with('error', 'Failed to send test email: ' . $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users.index', ['users' => $users]);
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:100'],
            'valid_from' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date'],
            'national_insurance_number' => ['nullable', 'string', 'max:50'],
            'passport_number' => ['nullable', 'string', 'max:50'],
            'photo' => ['nullable', 'image', 'max:1024'],
            'code' => ['nullable', 'string', 'max:50'],
            'code_valid_until' => ['nullable', 'date'],
        ];

        // Check if columns exist before adding unique validation
        $hasNINColumn = \DB::getSchemaBuilder()->hasColumn('users', 'national_insurance_number');
        $hasCodeColumn = \DB::getSchemaBuilder()->hasColumn('users', 'code');
        $hasPassportColumn = \DB::getSchemaBuilder()->hasColumn('users', 'passport_number');

        if ($hasNINColumn && $request->filled('national_insurance_number')) {
            $rules['national_insurance_number'][] = 'unique:users,national_insurance_number';
        }

        if ($hasCodeColumn && $request->filled('code')) {
            $rules['code'][] = 'unique:users,code';
        }

        if ($hasPassportColumn && $request->filled('passport_number')) {
            $rules['passport_number'][] = 'unique:users,passport_number';
        }

        $validated = $request->validate($rules);
        $validated['password'] = Hash::make($validated['password']);

        // Only include fields that exist in the database table
        $schema = \DB::getSchemaBuilder();
        $allowedFields = ['name', 'email', 'password'];

        $optionalFields = [
            'phone_number', 'date_of_birth', 'nationality', 'status', 'valid_from',
            'valid_until', 'national_insurance_number', 'passport_number', 'photo_path', 'code', 'code_valid_until'
        ];

        foreach ($optionalFields as $field) {
            if ($schema->hasColumn('users', $field) && isset($validated[$field])) {
                $allowedFields[] = $field;
            }
        }

        $dataToCreate = array_intersect_key($validated, array_flip($allowedFields));

        if ($schema->hasColumn('users', 'photo_path')) {
            $photoPath = $this->storeUserPhoto($request);
            if ($photoPath) {
                $dataToCreate['photo_path'] = $photoPath;
            }
        }

        User::create($dataToCreate);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function runMigration(Request $request)
    {
        $token = $request->query('token');
        $expectedToken = hash('sha256', env('APP_KEY'));

        if ($token !== $expectedToken) {
            return response()->json(['error' => 'Invalid token'], 403);
        }

        try {
            \Artisan::call('migrate', ['--force' => true]);
            $output = \Artisan::output();

            return response()->json([
                'success' => true,
                'message' => 'Migration completed successfully',
                'output' => $output
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function checkMigration()
    {
        $hasDateOfBirth = \DB::getSchemaBuilder()->hasColumn('users', 'date_of_birth');
        $hasNationality = \DB::getSchemaBuilder()->hasColumn('users', 'nationality');
        $hasStatus = \DB::getSchemaBuilder()->hasColumn('users', 'status');
        $hasValidFrom = \DB::getSchemaBuilder()->hasColumn('users', 'valid_from');
        $hasValidUntil = \DB::getSchemaBuilder()->hasColumn('users', 'valid_until');
        $hasNIN = \DB::getSchemaBuilder()->hasColumn('users', 'national_insurance_number');
        $hasPhoto = \DB::getSchemaBuilder()->hasColumn('users', 'photo_path');
        $hasCode = \DB::getSchemaBuilder()->hasColumn('users', 'code');
        $hasCodeValidUntil = \DB::getSchemaBuilder()->hasColumn('users', 'code_valid_until');

        $allMigrated = $hasDateOfBirth && $hasNationality && $hasStatus && $hasValidFrom &&
                       $hasValidUntil && $hasNIN && $hasPhoto && $hasCode && $hasCodeValidUntil;

        return response()->json([
            'migrated' => $allMigrated,
            'columns' => [
                'date_of_birth' => $hasDateOfBirth,
                'nationality' => $hasNationality,
                'status' => $hasStatus,
                'valid_from' => $hasValidFrom,
                'valid_until' => $hasValidUntil,
                'national_insurance_number' => $hasNIN,
                'photo_path' => $hasPhoto,
                'code' => $hasCode,
                'code_valid_until' => $hasCodeValidUntil,
            ]
        ]);
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:100'],
            'valid_from' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date'],
            'national_insurance_number' => ['nullable', 'string', 'max:50'],
            'passport_number' => ['nullable', 'string', 'max:50'],
            'photo' => ['nullable', 'image', 'max:1024'],
            'code' => ['nullable', 'string', 'max:50'],
            'code_valid_until' => ['nullable', 'date'],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['string', 'min:8'];
        }

        // Check if columns exist before adding unique validation
        $hasNINColumn = \DB::getSchemaBuilder()->hasColumn('users', 'national_insurance_number');
        $hasCodeColumn = \DB::getSchemaBuilder()->hasColumn('users', 'code');
        $hasPassportColumn = \DB::getSchemaBuilder()->hasColumn('users', 'passport_number');

        if ($hasNINColumn && $request->filled('national_insurance_number')) {
            $rules['national_insurance_number'][] = 'unique:users,national_insurance_number,' . $id;
        }

        if ($hasCodeColumn && $request->filled('code')) {
            $rules['code'][] = 'unique:users,code,' . $id;
        }

        if ($hasPassportColumn && $request->filled('passport_number')) {
            $rules['passport_number'][] = 'unique:users,passport_number,' . $id;
        }

        $validated = $request->validate($rules);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $schema = \DB::getSchemaBuilder();
        $allowedFields = ['name', 'email'];

        if ($request->filled('password')) {
            $allowedFields[] = 'password';
        }

        $optionalFields = [
            'phone_number', 'date_of_birth', 'nationality', 'status', 'valid_from',
            'valid_until', 'national_insurance_number', 'passport_number', 'photo_path', 'code', 'code_valid_until'
        ];

        foreach ($optionalFields as $field) {
            if ($schema->hasColumn('users', $field) && isset($validated[$field])) {
                $allowedFields[] = $field;
            }
        }

        $dataToUpdate = array_intersect_key($validated, array_flip($allowedFields));

        if ($schema->hasColumn('users', 'photo_path')) {
            $photoPath = $this->storeUserPhoto($request);
            if ($photoPath) {
                $dataToUpdate['photo_path'] = $photoPath;
            }
        }

        $user->update($dataToUpdate);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    /**
     * Store a user photo on the public disk. Prefers the cropped image
     * (base64 from the Cropper.js field); falls back to a raw file upload.
     */
    private function storeUserPhoto(Request $request): ?string
    {
        $cropped = $request->input('photo_cropped');

        if (is_string($cropped) && preg_match('/^data:image\/(png|jpe?g);base64,/i', $cropped, $m)) {
            // On Vercel serverless, store base64 string directly in database for 100% permanent storage
            if (getenv('VERCEL') || isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
                return $cropped;
            }

            $binary = base64_decode(substr($cropped, strpos($cropped, ',') + 1), true);
            if ($binary !== false && strlen($binary) > 0) {
                $ext = stripos($m[1], 'png') === 0 ? 'png' : 'jpg';
                $path = 'photos/' . Str::uuid() . '.' . $ext;
                Storage::disk('public')->put($path, $binary);
                return $path;
            }
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            if (getenv('VERCEL') || isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
                $mime = $file->getMimeType() ?: 'image/jpeg';
                return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
            }
            return $file->store('photos', 'public');
        }

        return null;
    }

    /**
     * Serve a user's photo from the public disk (no storage symlink required).
     */
    public function userPhoto($id)
    {
        $user = User::findOrFail($id);

        if (empty($user->photo_path) || !Storage::disk('public')->exists($user->photo_path)) {
            abort(404);
        }

        $file = Storage::disk('public')->get($user->photo_path);
        $mime = Storage::disk('public')->mimeType($user->photo_path) ?: 'image/jpeg';

        return response($file, 200)->header('Content-Type', $mime);
    }
}
