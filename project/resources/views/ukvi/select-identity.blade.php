@extends('layouts.greenwebproject')

@section('title', 'Which identity document do you use to sign in to your UKVI account? - GOV.UK')

@push('head')
<style>
  .greenwebproject-radio { position: relative; min-height: 40px; margin-bottom: 10px; padding: 8px 0 8px 52px; }
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

  {{-- Form Section --}}
  <p class="text-[19px] text-greenwebproject-grey mb-1">Sign in</p>

  <h1 class="text-[32px] md:text-[40px] font-bold text-greenwebproject-black mb-5 leading-[1.09]">
    Which identity document do you use to sign in to your UKVI account?
  </h1>

  <p class="text-[19px] text-greenwebproject-black mb-6 leading-[1.4]">
    This is usually the document you used when you created your account. If you have added a new document to your account, use the most recent document to sign in.
  </p>

  {{-- Form --}}
  <form method="POST" action="{{ route('ukvi.handle-identity') }}" class="mb-6">
    @csrf

    <div class="greenwebproject-radio">
      <input type="radio" id="passport" name="identity_document" value="passport" checked>
      <label for="passport">Passport</label>
    </div>

    <div class="greenwebproject-radio">
      <input type="radio" id="national_id" name="identity_document" value="national_id">
      <label for="national_id">National identity card</label>
    </div>

    <div class="greenwebproject-radio">
      <input type="radio" id="biometric" name="identity_document" value="biometric">
      <label for="biometric">Biometric residence card or permit</label>
    </div>

    <p class="text-[19px] text-greenwebproject-black my-2">or</p>

    <div class="greenwebproject-radio">
      <input type="radio" id="ukvi_number" name="identity_document" value="ukvi_number">
      <label for="ukvi_number">I use a UKVI customer number</label>
    </div>

    {{-- Continue Button --}}
    <button type="submit" class="inline-block bg-greenwebproject-green text-white font-bold text-[19px] px-5 py-[10px] mt-4 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] no-underline leading-[1.2]">
      Continue
    </button>
  </form>

  {{-- Help Link --}}
  <p class="text-[19px] mt-2">
    <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">I do not know which identity document I use to sign in</a>
  </p>
</div>
@endsection
