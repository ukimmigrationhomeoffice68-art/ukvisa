@extends('layouts.greenwebproject')

@section('title', 'Enter the security code - GOV.UK')

@section('content')
<div class="max-w-2xl px-4 sm:px-0 mx-auto">
  {{-- Beta Banner --}}
  <div class="bg-greenwebproject-light-grey border-b-4 border-greenwebproject-blue px-4 py-3 mb-8">
    <p class="m-0 text-base text-greenwebproject-black">
      <strong class="text-greenwebproject-blue font-bold">Beta</strong>
      This is a new service &ndash; your <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">feedback</a> will help us to improve it.
    </p>
  </div>

  {{-- Back Link --}}
  <a href="{{ route('ukvi.security-code') }}" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue text-[16px] mb-6 inline-block">
    &larr; Back
  </a>

  {{-- Success / error banners --}}
  @if(session('status'))
    <div class="border-l-4 border-greenwebproject-green bg-greenwebproject-light-grey px-4 py-3 mb-6">
      <p class="text-[16px] text-greenwebproject-black m-0">{{ session('status') }}</p>
    </div>
  @endif
  @if(session('mail_error'))
    <div class="border-l-4 border-greenwebproject-red bg-greenwebproject-light-grey px-4 py-3 mb-6">
      <p class="text-[16px] text-greenwebproject-red m-0">{{ session('mail_error') }}</p>
    </div>
  @endif

  <p class="text-[16px] text-greenwebproject-grey mb-2">Sign in</p>

  <h1 class="text-[32px] md:text-[40px] font-bold text-greenwebproject-black mb-6 leading-[1.2]">
    Enter the security code
  </h1>

  <p class="text-[16px] text-greenwebproject-grey mb-6 leading-[1.6]">
    We have sent a 6-digit security code to your {{ session('delivery_method') === 'sms' ? 'phone' : 'email address' }}. Enter it below to continue. The code expires in 10 minutes.
  </p>

  {{-- Validation errors --}}
  @if($errors->any())
    <div class="border-l-4 border-greenwebproject-red bg-greenwebproject-light-grey px-4 py-3 mb-6">
      <p class="text-[16px] text-greenwebproject-red m-0 font-bold">{{ $errors->first('otp') }}</p>
    </div>
  @endif

  {{-- Form --}}
  <form method="POST" action="{{ route('ukvi.otp.verify') }}" class="mb-6">
    @csrf
    <div class="mb-6">
      <label for="otp" class="block text-[16px] font-bold text-greenwebproject-black mb-2">Security code</label>
      <input
        type="text"
        id="otp"
        name="otp"
        inputmode="numeric"
        maxlength="6"
        autocomplete="one-time-code"
        class="w-48 border-2 border-greenwebproject-mid-grey px-4 py-3 text-[20px] tracking-[0.3em] focus:outline-none focus:border-greenwebproject-blue focus:ring-4 focus:ring-greenwebproject-yellow @if($errors->any()) border-greenwebproject-red @endif"
        required
      >
    </div>

    <button type="submit" class="inline-block bg-greenwebproject-green text-white font-bold text-[16px] px-6 py-3 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] no-underline leading-[1.5]">
      Continue
    </button>
  </form>

  {{-- Resend --}}
  <div class="mt-6 pt-6 border-t border-greenwebproject-mid-grey">
    <form method="POST" action="{{ route('ukvi.otp.resend') }}" class="m-0">
      @csrf
      <p class="text-[16px] text-greenwebproject-black m-0">
        Not received your code?
        <button type="submit" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue bg-transparent border-0 cursor-pointer p-0 text-[16px]">Send it again</button>
      </p>
    </form>
  </div>
</div>
@endsection
