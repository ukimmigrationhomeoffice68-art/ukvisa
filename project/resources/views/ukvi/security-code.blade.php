@extends('layouts.greenwebproject')

@section('title', 'How do you want to receive a security code? - GOV.UK')

@push('head')
<style>
  .greenwebproject-radio { position: relative; min-height: 40px; margin-bottom: 14px; padding: 8px 0 8px 52px; }
  .greenwebproject-radio input {
    position: absolute; left: 0; top: 0; width: 40px; height: 40px;
    margin: 0; opacity: 0; cursor: pointer; z-index: 1;
  }
  .greenwebproject-radio label { display: inline-block; font-size: 19px; line-height: 1.25; color: #0b0c0c; cursor: pointer; padding-top: 1px; }
  .greenwebproject-radio label::before {
    content: ""; position: absolute; left: 0; top: 0;
    width: 40px; height: 40px; border: 2px solid #0b0c0c;
    border-radius: 50%; background: #fff;
  }
  .greenwebproject-radio label::after {
    content: ""; position: absolute; left: 10px; top: 10px;
    width: 0; height: 0; border: 10px solid #0b0c0c;
    border-radius: 50%; opacity: 0;
  }
  .greenwebproject-radio input:checked + label::after { opacity: 1; }
  .greenwebproject-radio input:focus + label::before { box-shadow: 0 0 0 4px #ffdd00; }
</style>
@endpush

@section('content')
<div class="max-w-2xl px-4 sm:px-0 mx-auto">
  {{-- Beta Banner --}}
  <div class="bg-greenwebproject-light-grey border-b-4 border-greenwebproject-blue px-4 py-3 mb-8">
    <p class="m-0 text-base text-greenwebproject-black">
      <strong class="text-greenwebproject-blue font-bold">Beta</strong>
      This is a new service - your <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">feedback</a> will help us to improve it.
    </p>
  </div>

  {{-- Back Link --}}
  <a href="{{ route('ukvi.date-of-birth') }}" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue text-[19px] mb-6 inline-block">
    <svg class="inline-block w-4 h-4 mr-1 -mt-1" fill="currentColor" viewBox="0 0 12 12"><path d="M7.773 10.667 3.106 6l4.667-4.667 1.227 1.227L5.56 6l3.44 3.44z"/></svg>
    Back
  </a>

  {{-- Form Section --}}
  <p class="text-[19px] text-greenwebproject-grey mb-1">Sign in</p>

  <h1 class="text-[32px] md:text-[40px] font-bold text-greenwebproject-black mb-6 leading-[1.09]">
    How do you want to receive a security code?
  </h1>

  {{-- Form --}}
  <form method="POST" action="{{ route('ukvi.security-code.post') }}" class="mb-6">
    @csrf

    @php
      // Mask email: show first letter and domain
      $maskedEmail = '';
      if ($user->email && str_contains($user->email, '@')) {
        $emailParts = explode('@', $user->email);
        $emailLocal = $emailParts[0];
        $emailDomain = $emailParts[1];
        $maskedEmail = substr($emailLocal, 0, 1) . str_repeat('*', max(0, strlen($emailLocal) - 1)) . '@' . $emailDomain;
      }

      // Mask phone: show country code and last 3 digits
      $maskedPhone = '';
      $phone = str_replace([' ', '-', '(', ')'], '', $user->phone_number ?? '');
      if (strlen($phone) >= 5) {
        $maskedPhone = '+' . substr($phone, 0, 2) . str_repeat('*', max(0, strlen($phone) - 5)) . substr($phone, -3);
      } elseif (strlen($phone) > 0) {
        $maskedPhone = '+' . str_repeat('*', strlen($phone));
      }
    @endphp

    {{-- Email Option --}}
    @if($user->email)
      <div class="greenwebproject-radio">
        <input type="radio" id="email" name="delivery_method" value="email" checked>
        <label for="email">Send an email to <strong>{{ $maskedEmail }}</strong></label>
      </div>
    @endif

    {{-- SMS Option --}}
    @if($user->phone_number)
      <div class="greenwebproject-radio">
        <input type="radio" id="sms" name="delivery_method" value="sms">
        <label for="sms">Send a text message (SMS) to <strong>{{ $maskedPhone }}</strong></label>
      </div>
    @endif

    {{-- Continue Button --}}
    <button type="submit" class="inline-block bg-greenwebproject-green text-white font-bold text-[19px] px-5 py-[10px] mt-4 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] no-underline leading-[1.2]">
      Continue
    </button>
  </form>

  {{-- Problems Signing In Section --}}
  <div class="mt-8 pt-6 border-t border-greenwebproject-mid-grey">
    <h2 class="text-[24px] font-bold text-greenwebproject-black mb-3">Problems signing in</h2>
    <p class="text-[19px] text-greenwebproject-black mb-2">
      If you do not have access to the phone number and email address, <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">recover your account</a>.
    </p>
  </div>
</div>
@endsection
