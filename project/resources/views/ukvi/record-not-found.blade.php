@extends('layouts.greenwebproject')

@section('title', 'Record not found - GOV.UK')

@section('content')
<div class="max-w-2xl px-4 sm:px-0 mx-auto">
  {{-- Beta Banner --}}
  <div class="bg-greenwebproject-light-grey border-b-4 border-greenwebproject-blue px-4 py-3 mb-8">
    <p class="m-0 text-base text-greenwebproject-black">
      <strong class="text-greenwebproject-blue font-bold">Beta</strong>
      This is a new service - your <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">feedback</a> will help us to improve it.
    </p>
  </div>

  {{-- Error Section --}}
  <div class="border-l-4 border-greenwebproject-red bg-greenwebproject-light-grey px-4 py-3 mb-8">
    <h1 class="text-[32px] font-bold text-greenwebproject-red mb-2">Record not found</h1>
    <p class="text-[16px] text-greenwebproject-black m-0">
      We could not find a record matching the information you provided.
    </p>
  </div>

  {{-- Help Section --}}
  <div class="mb-8">
    <p class="text-[16px] text-greenwebproject-black mb-4">
      Please check that you have entered:
    </p>
    <ul class="list-disc pl-7 mb-6 space-y-2">
      <li class="text-[16px] text-greenwebproject-black">the correct identity document number</li>
      <li class="text-[16px] text-greenwebproject-black">the correct date of birth as shown on your document</li>
    </ul>
  </div>

  {{-- Try Again Button --}}
  <div class="mb-8">
    <a href="{{ route('ukvi.select-identity') }}" class="inline-block bg-greenwebproject-green text-white font-bold text-[16px] px-6 py-3 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] no-underline leading-[1.5]">
      Try again
    </a>
  </div>

  {{-- Contact Section --}}
  <div class="mt-8 pt-8 border-t border-greenwebproject-mid-grey">
    <h2 class="text-[20px] font-bold text-greenwebproject-black mb-4">Get help</h2>
    <p class="text-[16px] text-greenwebproject-black mb-4">
      If you continue to have problems, you can <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">contact UK Visas and Immigration</a> for support.
    </p>
  </div>
</div>
@endsection
