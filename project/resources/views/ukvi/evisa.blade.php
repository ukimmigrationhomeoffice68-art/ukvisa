@extends('layouts.greenwebproject')

@section('title', 'Your immigration status (eVisa) - GOV.UK')

@section('content')
<div class="max-w-3xl px-4 sm:px-0 mx-auto">
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

  <h1 class="text-[32px] md:text-[40px] font-bold text-greenwebproject-black mb-8 leading-[1.15]">
    Your immigration status (eVisa)
  </h1>

  <div class="flex flex-col md:flex-row md:gap-8">
    {{-- Details Table --}}
    <div class="md:flex-1 min-w-0">
      <dl class="m-0">
        <div class="flex flex-col sm:flex-row border-b border-greenwebproject-mid-grey py-3">
          <dt class="font-bold text-greenwebproject-black sm:w-2/5 sm:pr-4">Name</dt>
          <dd class="text-greenwebproject-black m-0">{{ $user->name }}</dd>
        </div>
        <div class="flex flex-col sm:flex-row border-b border-greenwebproject-mid-grey py-3">
          <dt class="font-bold text-greenwebproject-black sm:w-2/5 sm:pr-4">Date of birth</dt>
          <dd class="text-greenwebproject-black m-0">{{ $user->date_of_birth ? $user->date_of_birth->format('d/m/Y') : 'N/A' }}</dd>
        </div>
        <div class="flex flex-col sm:flex-row border-b border-greenwebproject-mid-grey py-3">
          <dt class="font-bold text-greenwebproject-black sm:w-2/5 sm:pr-4">Nationality</dt>
          <dd class="text-greenwebproject-black m-0">{{ $user->nationality ?? 'N/A' }}</dd>
        </div>
        <div class="flex flex-col sm:flex-row border-b border-greenwebproject-mid-grey py-3">
          <dt class="font-bold text-greenwebproject-black sm:w-2/5 sm:pr-4">Status</dt>
          <dd class="text-greenwebproject-black m-0">{{ $user->status ?? 'N/A' }}</dd>
        </div>
        <div class="flex flex-col sm:flex-row border-b border-greenwebproject-mid-grey py-3">
          <dt class="font-bold text-greenwebproject-black sm:w-2/5 sm:pr-4">Valid from</dt>
          <dd class="text-greenwebproject-black m-0">{{ $user->valid_from ? $user->valid_from->format('j F Y') : 'N/A' }}</dd>
        </div>
        <div class="flex flex-col sm:flex-row border-b border-greenwebproject-mid-grey py-3">
          <dt class="font-bold text-greenwebproject-black sm:w-2/5 sm:pr-4">Valid until</dt>
          <dd class="text-greenwebproject-black m-0">{{ $user->valid_until ? $user->valid_until->format('j F Y') : 'N/A' }}</dd>
        </div>
        <div class="flex flex-col sm:flex-row border-b border-greenwebproject-mid-grey py-3">
          <dt class="font-bold text-greenwebproject-black sm:w-2/5 sm:pr-4">National Insurance number</dt>
          <dd class="text-greenwebproject-black m-0">{{ $user->national_insurance_number ?? 'N/A' }}</dd>
        </div>
      </dl>
    </div>

    {{-- Photo --}}
    <div class="mt-6 md:mt-0 md:w-48 flex-shrink-0">
      @if($user->photo_path)
        <img id="evisa-photo" src="{{ route('ukvi.evisa.photo') }}" alt="Photo of {{ $user->name }}" class="w-full max-w-xs md:max-w-none border border-greenwebproject-mid-grey block">
      @endif
    </div>
  </div>

  {{-- Status note --}}
  <p class="text-[16px] text-greenwebproject-black mt-8 mb-8 leading-[1.5]">
    You can stay in the UK until you receive a decision on your application, even if this is after
    {{ $user->valid_until ? $user->valid_until->format('j F Y') : 'your expiry date' }}.
    This includes during any appeal or administrative review that was made in the UK within the required deadlines.
  </p>

  {{-- Prove your status --}}
  <h2 class="text-[24px] font-bold text-greenwebproject-black mb-4">Prove your status</h2>
  <p class="text-[16px] text-greenwebproject-black mb-6 leading-[1.5]">
    If you need to prove your immigration status to someone, you can do this online with a share code.
  </p>

  <a href="{{ route('ukvi.evisa.download') }}" class="inline-block bg-greenwebproject-green text-white font-bold text-[16px] px-6 py-3 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] no-underline leading-[1.5]">
    Get a share code
  </a>
</div>
@endsection
