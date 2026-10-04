@extends('layouts.greenwebproject')

@section('title', 'What is your date of birth? - GOV.UK')

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
    What is your date of birth?
  </h1>

  <p class="text-[16px] text-greenwebproject-grey mb-6 leading-[1.6]">
    You should enter this as shown on your passport. For example, 31 3 1980.
  </p>

  {{-- Form --}}
  <form method="POST" action="{{ route('ukvi.date-of-birth.post') }}" class="mb-8">
    @csrf

    {{-- Date of Birth Fields --}}
    <div class="mb-6">
      <fieldset class="border-0 p-0 m-0">
        <legend class="block text-[16px] font-bold text-greenwebproject-black mb-4">Day &nbsp; Month &nbsp; Year</legend>

        <div class="flex flex-col sm:flex-row gap-4">
          {{-- Day --}}
          <div class="flex-shrink-0">
            <input
              type="text"
              inputmode="numeric"
              name="day"
              maxlength="2"
              class="w-20 border-2 border-greenwebproject-mid-grey px-3 py-3 text-[16px] focus:outline-none focus:border-greenwebproject-blue focus:ring-4 focus:ring-greenwebproject-yellow"
              placeholder="DD"
              required
            >
          </div>

          {{-- Month --}}
          <div class="flex-shrink-0">
            <input
              type="text"
              inputmode="numeric"
              name="month"
              maxlength="2"
              class="w-20 border-2 border-greenwebproject-mid-grey px-3 py-3 text-[16px] focus:outline-none focus:border-greenwebproject-blue focus:ring-4 focus:ring-greenwebproject-yellow"
              placeholder="MM"
              required
            >
          </div>

          {{-- Year --}}
          <div class="flex-shrink-0">
            <input
              type="text"
              inputmode="numeric"
              name="year"
              maxlength="4"
              class="w-24 border-2 border-greenwebproject-mid-grey px-3 py-3 text-[16px] focus:outline-none focus:border-greenwebproject-blue focus:ring-4 focus:ring-greenwebproject-yellow"
              placeholder="YYYY"
              required
            >
          </div>
        </div>
      </fieldset>
    </div>

    {{-- Continue Button --}}
    <button type="submit" class="inline-block bg-greenwebproject-green text-white font-bold text-[16px] px-6 py-3 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] no-underline leading-[1.5]">
      Continue
    </button>
  </form>

  {{-- Help Section --}}
  <div class="mt-8 pt-8 border-t-4 border-greenwebproject-mid-grey pl-6 relative before:content-[''] before:absolute before:left-0 before:top-8 before:bottom-0 before:w-1 before:bg-greenwebproject-mid-grey">
    <p class="text-[16px] text-greenwebproject-black">
      Need help? <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">Contact us</a>
    </p>
  </div>
</div>
@endsection
