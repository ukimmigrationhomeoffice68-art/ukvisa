<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SMTP Settings — GOV.UK VISA CO Admin</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'greenwebproject-blue':       '#1d70b8',
            'greenwebproject-dark-blue':  '#003078',
            'greenwebproject-black':      '#0b0c0c',
            'greenwebproject-green':      '#00703c',
            'greenwebproject-grey':       '#505a5f',
            'greenwebproject-mid-grey':   '#b1b4b6',
            'greenwebproject-light-grey': '#f3f2f1',
            'greenwebproject-red':        '#d4351c',
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
    <a href="/" class="text-white no-underline inline-block leading-none font-bold text-2xl">GOV.UK</a>
    <div class="flex items-center gap-4 text-sm text-white/80">
      <a href="{{ route('admin.dashboard') }}" class="text-white/80 hover:text-white">Dashboard</a>
      <a href="{{ route('admin.users') }}" class="text-white/80 hover:text-white">Users</a>
      <a href="{{ route('admin.settings') }}" class="text-white hover:text-white underline">Settings</a>
      <form method="POST" action="{{ route('admin.logout') }}" class="inline m-0">
        @csrf
        <button type="submit" class="text-white/80 hover:text-white underline bg-transparent border-0 cursor-pointer text-sm p-0">Sign out</button>
      </form>
    </div>
  </div>
</header>

<main id="main-content" class="bg-white py-10">
  <div class="max-w-4xl mx-auto px-4 md:px-8">

    <h1 class="text-[32px] md:text-[48px] font-bold text-greenwebproject-black leading-[1.09] mb-8">SMTP / Email Settings</h1>

    @if(session('success'))
      <div class="border-l-4 border-greenwebproject-green bg-greenwebproject-light-grey px-4 py-3 mb-6">
        <p class="text-[16px] text-greenwebproject-black m-0">{{ session('success') }}</p>
      </div>
    @endif
    @if(session('error'))
      <div class="border-l-4 border-greenwebproject-red bg-greenwebproject-light-grey px-4 py-3 mb-6">
        <p class="text-[16px] text-greenwebproject-red m-0">{{ session('error') }}</p>
      </div>
    @endif

    <p class="text-[16px] text-greenwebproject-grey mb-6">
      These settings are used to send the one-time security code (OTP) to users by email. Common ports: 587 (TLS) or 465 (SSL).
    </p>

    <form method="POST" action="{{ route('admin.settings.save') }}" class="bg-greenwebproject-light-grey p-8 rounded mb-8">
      @csrf

      <div class="mb-6">
        <label for="mail_host" class="block text-[16px] font-bold text-greenwebproject-black mb-2">SMTP Host</label>
        <input type="text" id="mail_host" name="mail_host" value="{{ old('mail_host', $settings['mail_host'] ?? '') }}"
          placeholder="e.g. smtp.hostinger.com"
          class="w-full px-4 py-2 border-2 border-greenwebproject-mid-grey rounded focus:outline-none focus:border-greenwebproject-blue @error('mail_host') border-greenwebproject-red @enderror">
        @error('mail_host')<p class="text-greenwebproject-red text-[14px] mt-1">{{ $message }}</p>@enderror
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="mb-6">
          <label for="mail_port" class="block text-[16px] font-bold text-greenwebproject-black mb-2">SMTP Port</label>
          <input type="text" id="mail_port" name="mail_port" value="{{ old('mail_port', $settings['mail_port'] ?? '587') }}"
            placeholder="587"
            class="w-full px-4 py-2 border-2 border-greenwebproject-mid-grey rounded focus:outline-none focus:border-greenwebproject-blue @error('mail_port') border-greenwebproject-red @enderror">
          @error('mail_port')<p class="text-greenwebproject-red text-[14px] mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
          <label for="mail_encryption" class="block text-[16px] font-bold text-greenwebproject-black mb-2">Encryption</label>
          <select id="mail_encryption" name="mail_encryption"
            class="w-full px-4 py-2 border-2 border-greenwebproject-mid-grey rounded focus:outline-none focus:border-greenwebproject-blue bg-white">
            @php $enc = old('mail_encryption', $settings['mail_encryption'] ?? 'tls'); @endphp
            <option value="tls" {{ $enc === 'tls' ? 'selected' : '' }}>TLS</option>
            <option value="ssl" {{ $enc === 'ssl' ? 'selected' : '' }}>SSL</option>
            <option value="none" {{ $enc === 'none' ? 'selected' : '' }}>None</option>
          </select>
        </div>
      </div>

      <div class="mb-6">
        <label for="mail_username" class="block text-[16px] font-bold text-greenwebproject-black mb-2">SMTP Username</label>
        <input type="text" id="mail_username" name="mail_username" value="{{ old('mail_username', $settings['mail_username'] ?? '') }}"
          placeholder="e.g. no-reply@greenwebproject.com"
          class="w-full px-4 py-2 border-2 border-greenwebproject-mid-grey rounded focus:outline-none focus:border-greenwebproject-blue @error('mail_username') border-greenwebproject-red @enderror">
        @error('mail_username')<p class="text-greenwebproject-red text-[14px] mt-1">{{ $message }}</p>@enderror
      </div>

      <div class="mb-6">
        <label for="mail_password" class="block text-[16px] font-bold text-greenwebproject-black mb-2">SMTP Password</label>
        <input type="password" id="mail_password" name="mail_password" value=""
          placeholder="{{ !empty($settings['mail_password']) ? '•••••••• (leave blank to keep current)' : 'Enter password' }}"
          class="w-full px-4 py-2 border-2 border-greenwebproject-mid-grey rounded focus:outline-none focus:border-greenwebproject-blue @error('mail_password') border-greenwebproject-red @enderror">
        <p class="text-greenwebproject-grey text-[14px] mt-1">Leave blank to keep the current password.</p>
        @error('mail_password')<p class="text-greenwebproject-red text-[14px] mt-1">{{ $message }}</p>@enderror
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="mb-6">
          <label for="mail_from_address" class="block text-[16px] font-bold text-greenwebproject-black mb-2">From Address</label>
          <input type="email" id="mail_from_address" name="mail_from_address" value="{{ old('mail_from_address', $settings['mail_from_address'] ?? '') }}"
            placeholder="no-reply@greenwebproject.com"
            class="w-full px-4 py-2 border-2 border-greenwebproject-mid-grey rounded focus:outline-none focus:border-greenwebproject-blue @error('mail_from_address') border-greenwebproject-red @enderror">
          @error('mail_from_address')<p class="text-greenwebproject-red text-[14px] mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
          <label for="mail_from_name" class="block text-[16px] font-bold text-greenwebproject-black mb-2">From Name</label>
          <input type="text" id="mail_from_name" name="mail_from_name" value="{{ old('mail_from_name', $settings['mail_from_name'] ?? 'GOV.UK VISA CO') }}"
            placeholder="GOV.UK VISA CO"
            class="w-full px-4 py-2 border-2 border-greenwebproject-mid-grey rounded focus:outline-none focus:border-greenwebproject-blue">
        </div>
      </div>

      <button type="submit" class="inline-block bg-greenwebproject-green text-white font-bold text-[16px] px-6 py-3 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] leading-[1.5] border-0 cursor-pointer">
        Save settings
      </button>
    </form>

    {{-- Test email --}}
    <div class="bg-white border border-greenwebproject-mid-grey p-8 rounded">
      <h2 class="text-[24px] font-bold text-greenwebproject-black mb-4">Send a test email</h2>
      <p class="text-[16px] text-greenwebproject-grey mb-4">Verify your SMTP settings by sending a test email. Save your settings first.</p>
      <form method="POST" action="{{ route('admin.settings.test-email') }}" class="flex flex-wrap items-end gap-4">
        @csrf
        <div class="flex-1 min-w-[260px]">
          <label for="test_email" class="block text-[16px] font-bold text-greenwebproject-black mb-2">Test email address</label>
          <input type="email" id="test_email" name="test_email" value="{{ old('test_email') }}" required
            placeholder="you@example.com"
            class="w-full px-4 py-2 border-2 border-greenwebproject-mid-grey rounded focus:outline-none focus:border-greenwebproject-blue @error('test_email') border-greenwebproject-red @enderror">
          @error('test_email')<p class="text-greenwebproject-red text-[14px] mt-1">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="inline-block bg-greenwebproject-blue text-white font-bold text-[16px] px-6 py-3 hover:bg-greenwebproject-dark-blue leading-[1.5] border-0 cursor-pointer rounded">
          Send test
        </button>
      </form>
    </div>

  </div>
</main>

</body>
</html>
