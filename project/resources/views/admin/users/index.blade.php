<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Users — GOV.UK VISA CO Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'greenwebproject-blue':       '#1d70b8',
            'greenwebproject-dark-blue':  '#003078',
            'greenwebproject-black':      '#0b0c0c',
            'greenwebproject-grey':       '#505a5f',
            'greenwebproject-mid-grey':   '#b1b4b6',
            'greenwebproject-light-grey': '#f3f2f1',
          }
        }
      }
    }
  </script>
  <style type="text/tailwindcss">
    @layer base {
      body { font-family: "GDS Transport", arial, sans-serif; color: #0b0c0c; }
    }
  </style>
</head>
<body class="bg-white">

<header class="bg-greenwebproject-blue border-b-[10px] border-greenwebproject-dark-blue">
  <div class="max-w-[960px] mx-auto px-4 md:px-8 py-[10px] border-b border-white/25 flex justify-between items-center">
    <a href="/" class="text-white no-underline inline-block leading-none">
      <svg xmlns="http://www.w3.org/2000/svg" focusable="false" role="img" viewBox="0 0 324 60" height="30" width="162" fill="white" class="block" aria-label="GOV.UK"><title>GOV.UK</title><g><circle cx="20" cy="17.6" r="3.7"/><circle cx="10.2" cy="23.5" r="3.7"/><circle cx="3.7" cy="33.2" r="3.7"/><circle cx="31.7" cy="30.6" r="3.7"/><circle cx="43.3" cy="17.6" r="3.7"/><circle cx="53.2" cy="23.5" r="3.7"/><circle cx="59.7" cy="33.2" r="3.7"/><circle cx="31.7" cy="30.6" r="3.7"/><path d="M33.1,9.8c.2-.1.3-.3.5-.5l4.6,2.4v-6.8l-4.6,1.5c-.1-.2-.3-.3-.5-.5l1.9-5.9h-6.7l1.9,5.9c-.2.1-.3.3-.5.5l-4.6-1.5v6.8l4.6-2.4c.1.2.3.3.5.5l-2.6,8c-.9,2.8,1.2,5.7,4.1,5.7h0c3,0,5.1-2.9,4.1-5.7l-2.6-8ZM37,37.9s-3.4,3.8-4.1,6.1c2.2,0,4.2-.5,6.4-2.8l-.7,8.5c-2-2.8-4.4-4.1-5.7-3.8.1,3.1.5,6.7,5.8,7.2,3.7.3,6.7-1.5,7-3.8.4-2.6-2-4.3-3.7-1.6-1.4-4.5,2.4-6.1,4.9-3.2-1.9-4.5-1.8-7.7,2.4-10.9,3,4,2.6,7.3-1.2,11.1,2.4-1.3,6.2,0,4,4.6-1.2-2.8-3.7-2.2-4.2.2-.3,1.7.7,3.7,3,4.2,1.9.3,4.7-.9,7-5.9-1.3,0-2.4.7-3.9,1.7l2.4-8c.6,2.3,1.4,3.7,2.2,4.5.6-1.6.5-2.8,0-5.3l5,1.8c-2.6,3.6-5.2,8.7-7.3,17.5-7.4-1.1-15.7-1.7-24.5-1.7h0c-8.8,0-17.1.6-24.5,1.7-2.1-8.9-4.7-13.9-7.3-17.5l5-1.8c-.5,2.5-.6,3.7,0,5.3.8-.8,1.6-2.3,2.2-4.5l2.4,8c-1.5-1-2.6-1.7-3.9-1.7,2.3,5,5.2,6.2,7,5.9,2.3-.4,3.3-2.4,3-4.2-.5-2.4-3-3.1-4.2-.2-2.2-4.6,1.6-6,4-4.6-3.7-3.7-4.2-7.1-1.2-11.1,4.2,3.2,4.3,6.4,2.4,10.9,2.5-2.8,6.3-1.3,4.9,3.2-1.8-2.7-4.1-1-3.7,1.6.3,2.3,3.3,4.1,7,3.8,5.4-.5,5.7-4.2,5.8-7.2-1.3-.2-3.7,1-5.7,3.8l-.7-8.5c2.2,2.3,4.2,2.7,6.4,2.8-.7-2.3-4.1-6.1-4.1-6.1h10.6,0Z"/></g><circle fill="#00ffe0" cx="226" cy="36" r="7.3"/><path d="M93.94 41.25c.4 1.81 1.2 3.21 2.21 4.62 1 1.4 2.21 2.41 3.61 3.21s3.21 1.2 5.22 1.2 3.61-.4 4.82-1c1.4-.6 2.41-1.4 3.21-2.41.8-1 1.4-2.01 1.61-3.01s.4-2.01.4-3.01v.14h-10.86v-7.02h20.07v24.08h-8.03v-5.56c-.6.8-1.38 1.61-2.19 2.41-.8.8-1.81 1.2-2.81 1.81-1 .4-2.21.8-3.41 1.2s-2.41.4-3.81.4a18.56 18.56 0 0 1-14.65-6.63c-1.6-2.01-3.01-4.41-3.81-7.02s-1.4-5.62-1.4-8.83.4-6.02 1.4-8.83a20.45 20.45 0 0 1 19.46-13.65c3.21 0 4.01.2 5.82.8 1.81.4 3.61 1.2 5.02 2.01 1.61.8 2.81 2.01 4.01 3.21s2.21 2.61 2.81 4.21l-7.63 4.41c-.4-1-1-1.81-1.61-2.61-.6-.8-1.4-1.4-2.21-2.01-.8-.6-1.81-1-2.81-1.4-1-.4-2.21-.4-3.61-.4-2.01 0-3.81.4-5.22 1.2-1.4.8-2.61 1.81-3.61 3.21s-1.61 2.81-2.21 4.62c-.4 1.81-.6 3.71-.6 5.42s.8 5.22.8 5.22Zm57.8-27.9c3.21 0 6.22.6 8.63 1.81 2.41 1.2 4.82 2.81 6.62 4.82S170.2 24.39 171 27s1.4 5.62 1.4 8.83-.4 6.02-1.4 8.83-2.41 5.02-4.01 7.02-4.01 3.61-6.62 4.82-5.42 1.81-8.63 1.81-6.22-.6-8.63-1.81-4.82-2.81-6.42-4.82-3.21-4.41-4.01-7.02-1.4-5.62-1.4-8.83.4-6.02 1.4-8.83 2.41-5.02 4.01-7.02 4.01-3.61 6.42-4.82 5.42-1.81 8.63-1.81Zm0 36.73c1.81 0 3.61-.4 5.02-1s2.61-1.81 3.61-3.01 1.81-2.81 2.21-4.41c.4-1.81.8-3.61.8-5.62 0-2.21-.2-4.21-.8-6.02s-1.2-3.21-2.21-4.62c-1-1.2-2.21-2.21-3.61-3.01s-3.21-1-5.02-1-3.61.4-5.02 1c-1.4.8-2.61 1.81-3.61 3.01s-1.81 2.81-2.21 4.62c-.4 1.81-.8 3.61-.8 5.62 0 2.41.2 4.21.8 6.02.4 1.81 1.2 3.21 2.21 4.41s2.21 2.21 3.61 3.01c1.4.8 3.21 1 5.02 1Zm36.32 7.96-12.24-44.15h9.83l8.43 32.77h.4l8.23-32.77h9.83L200.3 58.04h-12.24Zm74.14-7.96c2.18 0 3.51-.6 3.51-.6 1.2-.6 2.01-1 2.81-1.81s1.4-1.81 1.81-2.81a13 13 0 0 0 .8-4.01V13.9h8.63v28.15c0 2.41-.4 4.62-1.4 6.62-.8 2.01-2.21 3.61-3.61 5.02s-3.41 2.41-5.62 3.21-4.62 1.2-7.02 1.2-5.02-.4-7.02-1.2c-2.21-.8-4.01-1.81-5.62-3.21s-2.81-3.01-3.61-5.02-1.4-4.21-1.4-6.62V13.9h8.63v26.95c0 1.61.2 3.01.8 4.01.4 1.2 1.2 2.21 2.01 2.81.8.8 1.81 1.4 2.81 1.81 0 0 1.34.6 3.51.6Zm34.22-36.18v18.92l15.65-18.92h10.82l-15.03 17.32 16.03 26.83h-10.21l-11.44-20.21-5.62 6.22v13.99h-8.83V13.9"/></svg>
    </a>
    <div class="flex items-center gap-4 text-sm text-white/80">
      <a href="{{ route('admin.dashboard') }}" class="text-white/80 hover:text-white">Dashboard</a>
      <form method="POST" action="{{ route('admin.logout') }}" class="inline m-0">
        @csrf
        <button type="submit" class="text-white/80 hover:text-white underline bg-transparent border-0 cursor-pointer text-sm p-0">Sign out</button>
      </form>
    </div>
  </div>
</header>

<main id="main-content" class="bg-white py-10">
  <div class="max-w-[960px] mx-auto px-4 md:px-8">

    <h1 class="text-[32px] md:text-[48px] font-bold text-greenwebproject-black leading-[1.09] mb-8">Manage Users</h1>

    @if (session('success'))
      <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        {{ session('success') }}
      </div>
    @endif

    <div class="mb-6 flex justify-end">
      <a href="{{ route('admin.users.create') }}" class="bg-greenwebproject-blue hover:bg-greenwebproject-dark-blue text-white font-bold py-2 px-4 rounded">
        Add New User
      </a>
    </div>

    @if ($users->count())
      <div class="overflow-x-auto border border-greenwebproject-mid-grey">
        <table class="w-full border-collapse text-sm">
          <thead>
            <tr class="bg-greenwebproject-light-grey border-b border-greenwebproject-mid-grey">
              <th class="text-left px-3 py-2 font-bold text-greenwebproject-black">Name</th>
              <th class="text-left px-3 py-2 font-bold text-greenwebproject-black">Email</th>
              <th class="text-left px-3 py-2 font-bold text-greenwebproject-black">Phone</th>
              <th class="text-left px-3 py-2 font-bold text-greenwebproject-black">Status</th>
              <th class="text-left px-3 py-2 font-bold text-greenwebproject-black">Nationality</th>
              <th class="text-left px-3 py-2 font-bold text-greenwebproject-black">Passport</th>
              <th class="text-left px-3 py-2 font-bold text-greenwebproject-black">DOB</th>
              <th class="text-left px-3 py-2 font-bold text-greenwebproject-black">Email OTP</th>
              <th class="text-left px-3 py-2 font-bold text-greenwebproject-black">Code</th>
              <th class="text-left px-3 py-2 font-bold text-greenwebproject-black">Valid Until</th>
              <th class="text-left px-3 py-2 font-bold text-greenwebproject-black">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr class="border-b border-greenwebproject-mid-grey hover:bg-greenwebproject-light-grey">
                <td class="px-3 py-2">
                  <div class="flex items-center gap-2">
                    @if ($user->photo_path)
                      <img src="{{ route('admin.users.photo', $user->id) }}" alt="" class="w-8 h-10 object-cover rounded border border-greenwebproject-mid-grey shrink-0">
                    @endif
                    <span>{{ $user->name }}</span>
                  </div>
                </td>
                <td class="px-3 py-2">{{ $user->email }}</td>
                <td class="px-3 py-2">{{ $user->phone_number ?? '—' }}</td>
                <td class="px-3 py-2"><span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">{{ $user->status ?? '—' }}</span></td>
                <td class="px-3 py-2">{{ $user->nationality ?? '—' }}</td>
                <td class="px-3 py-2"><code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $user->passport_number ?? '—' }}</code></td>
                <td class="px-3 py-2">
                  @if ($user->date_of_birth)
                    {{ $user->date_of_birth->format('d/m/Y') }}
                  @else
                    —
                  @endif
                </td>
                <td class="px-3 py-2">
                  @if ($user->otp_code)
                    @php $otpExpired = $user->otp_expires_at && $user->otp_expires_at->isPast(); @endphp
                    <code class="px-2 py-1 rounded text-sm font-bold {{ $otpExpired ? 'bg-gray-100 text-greenwebproject-grey line-through' : 'bg-yellow-100 text-greenwebproject-black' }}">{{ $user->otp_code }}</code>
                    @if ($otpExpired)
                      <span class="block text-[10px] text-greenwebproject-grey mt-1">expired</span>
                    @else
                      <span class="block text-[10px] text-green-700 mt-1">active</span>
                    @endif
                  @else
                    —
                  @endif
                </td>
                <td class="px-3 py-2"><code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $user->code ?? '—' }}</code></td>
                <td class="px-3 py-2">
                  @if ($user->code_valid_until)
                    {{ $user->code_valid_until->format('d/m/Y') }}
                  @else
                    —
                  @endif
                </td>
                <td class="px-3 py-2">
                  <div class="flex gap-2">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-greenwebproject-blue hover:bg-greenwebproject-dark-blue text-white px-3 py-1 rounded text-xs font-bold">
                      Edit
                    </a>
                    <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-bold">
                        Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      @if ($users->hasPages())
        <div class="mt-6 flex justify-center">
          {{ $users->links() }}
        </div>
      @endif
    @else
      <div class="bg-greenwebproject-light-grey border-l-[5px] border-greenwebproject-blue p-6">
        <p class="text-[19px] text-greenwebproject-grey m-0">No users found. <a href="{{ route('admin.users.create') }}" class="text-greenwebproject-blue hover:underline">Create one</a>.</p>
      </div>
    @endif

  </div>
</main>

<footer class="bg-greenwebproject-light-grey border-t border-greenwebproject-mid-grey py-6">
  <div class="max-w-[960px] mx-auto px-4 md:px-8 flex justify-between items-center">
    <p class="text-sm text-greenwebproject-grey m-0">GOV.UK VISA CO Admin Portal</p>
    <p class="text-sm text-greenwebproject-grey m-0">© Crown copyright</p>
  </div>
</footer>

</body>
</html>
