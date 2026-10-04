@extends('layouts.greenwebproject')

@section('title', 'eVisas: access and use your online immigration status - GOV.UK')

@section('breadcrumb')
<div class="bg-white border-b border-greenwebproject-mid-grey">
  <div class="max-w-[960px] mx-auto px-4 md:px-8 py-3">
    <nav aria-label="Breadcrumb">
      <ol class="flex flex-wrap items-center gap-y-1 list-none p-0 m-0 text-sm">
        <li class="flex items-center">
          <a href="#" class="text-greenwebproject-black underline hover:no-underline text-sm">Home</a>
          <span class="mx-2 text-greenwebproject-grey text-sm" aria-hidden="true">›</span>
        </li>
        <li class="flex items-center">
          <a href="#" class="text-greenwebproject-black underline hover:no-underline text-sm">Visas and immigration</a>
          <span class="mx-2 text-greenwebproject-grey text-sm" aria-hidden="true">›</span>
        </li>
        <li class="flex items-center">
          <a href="#" class="text-greenwebproject-black underline hover:no-underline text-sm">Managing your status and working in the UK</a>
          <span class="mx-2 text-greenwebproject-grey text-sm" aria-hidden="true">›</span>
        </li>
        <li class="text-greenwebproject-black text-sm">eVisas</li>
      </ol>
    </nav>
  </div>
</div>
@endsection

@section('content')
<div class="md:flex md:gap-10">

  {{-- MAIN COLUMN --}}
  <div class="md:w-2/3">

    <h1 class="text-[32px] md:text-[48px] font-bold text-greenwebproject-black leading-[1.09] mb-8">
      eVisas: access and use your online immigration status
    </h1>

    <p class="text-sm text-greenwebproject-grey mb-6 border-t border-greenwebproject-mid-grey pt-3">
      From: <a href="#" class="text-greenwebproject-grey underline">Home Office</a><br>
      Published 1 February 2023<br>
      Last updated 14 November 2024 &mdash; <a href="#" class="text-greenwebproject-grey underline">See all updates</a>
    </p>

    {{-- CONTENTS --}}
    <nav aria-label="Pages in this guide" class="bg-greenwebproject-light-grey border border-greenwebproject-mid-grey px-4 pt-4 pb-2 mb-8">
      <h2 class="text-base font-bold text-greenwebproject-black mb-3">Contents</h2>
      <ol class="list-none p-0 m-0">
        <li class="border-t border-greenwebproject-mid-grey py-[9px] flex items-start gap-2 text-base">
          <span class="text-greenwebproject-grey shrink-0 leading-6">—</span>
          <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue leading-6">What an eVisa is</a>
        </li>
        <li class="border-t border-greenwebproject-mid-grey py-[9px] flex items-start gap-2 text-base">
          <span class="text-greenwebproject-grey shrink-0 leading-6">—</span>
          <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue leading-6">Set up a UKVI account to access your eVisa</a>
        </li>
        <li class="border-t border-greenwebproject-mid-grey py-[9px] flex items-start gap-2 text-base">
          <span class="text-greenwebproject-grey shrink-0 leading-6">—</span>
          <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue leading-6">Get an eVisa if you have settlement in the UK</a>
        </li>
        <li class="border-t border-greenwebproject-mid-grey py-[9px] flex items-start gap-2 text-base font-bold">
          <span class="text-greenwebproject-grey shrink-0 leading-6">—</span>
          <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue leading-6">View your eVisa and get a share code to prove your immigration status</a>
        </li>
        <li class="border-t border-greenwebproject-mid-grey py-[9px] flex items-start gap-2 text-base">
          <span class="text-greenwebproject-grey shrink-0 leading-6">—</span>
          <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue leading-6">Travel with your eVisa</a>
        </li>
        <li class="border-t border-greenwebproject-mid-grey py-[9px] flex items-start gap-2 text-base">
          <span class="text-greenwebproject-grey shrink-0 leading-6">—</span>
          <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue leading-6">Update your details in your UKVI account</a>
        </li>
        <li class="border-t border-greenwebproject-mid-grey py-[9px] flex items-start gap-2 text-base">
          <span class="text-greenwebproject-grey shrink-0 leading-6">—</span>
          <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue leading-6">Report an error with your eVisa</a>
        </li>
      </ol>
    </nav>

    {{-- ARTICLE CONTENT --}}
    <h2 class="text-[24px] md:text-[27px] font-bold text-greenwebproject-black border-b border-greenwebproject-mid-grey pb-3 mt-2 mb-5 leading-[1.11]">
      View your eVisa and get a share code to prove your immigration status
    </h2>

    <p class="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
      Your eVisa shows your identity and immigration status. This includes what rights you have in the UK, for example to work, rent or claim benefits.
    </p>

    <p class="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
      You can get a share code to prove your immigration status to people such as employers or landlords when you travel.
    </p>

    <p class="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">You can use your UK Visas and Immigration (UKVI) account to:</p>

    <ul class="list-disc pl-7 mb-6 space-y-1">
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">view your eVisa — your online UK immigration status</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">get a share code to prove your immigration status to others, such as employers or landlords</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">update your personal details</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">see your immigration history</li>
    </ul>

    <p class="text-[19px] leading-[1.47] mb-6 text-greenwebproject-black">
      You need to <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">create a UKVI account</a> if you do not have one. You can then link your eVisa to your account.
    </p>

    <a href="{{ route('ukvi.select-identity') }}" class="inline-block bg-greenwebproject-green !text-white font-bold text-[19px] px-4 py-[9px] shadow-[0_2px_0_#002d18] hover:bg-[#005a30] no-underline mb-8 leading-[1.1]">
      View your eVisa and get a share code
    </a>

    <h2 class="text-[24px] md:text-[27px] font-bold text-greenwebproject-black border-b border-greenwebproject-mid-grey pb-3 mt-2 mb-5 leading-[1.11]">
      Report an error with your eVisa
    </h2>

    <p class="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
      You should check your eVisa details are correct. You can find your eVisa details by signing in to your UKVI account.
    </p>

    <p class="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
      If your eVisa contains incorrect information — for example your name, nationality or conditions of stay — you should report the error.
    </p>

    <p class="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
      You can <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">report an error with your eVisa</a> using the online form.
    </p>

    <p class="text-[19px] leading-[1.47] mb-4 text-greenwebproject-black">You'll need your:</p>
    <ul class="list-disc pl-7 mb-6 space-y-1">
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">full name</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">date of birth</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">nationality</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">UKVI account email address</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">reference number — this can be your GWF, HO, UAN or other Home Office reference number</li>
    </ul>

    <h2 class="text-[24px] md:text-[27px] font-bold text-greenwebproject-black border-b border-greenwebproject-mid-grey pb-3 mt-2 mb-5 leading-[1.11]">
      Update your details
    </h2>

    <p class="text-[19px] leading-[1.47] mb-4 text-greenwebproject-black">You can update your personal details in your UKVI account, such as your:</p>
    <ul class="list-disc pl-7 mb-6 space-y-1">
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">travel document — for example passport number or expiry date</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">email address</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">phone number</li>
    </ul>

    <p class="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
      If you need to update your name, nationality or date of birth, you'll need to <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">contact UK Visas and Immigration</a>.
    </p>

    <h2 class="text-[24px] md:text-[27px] font-bold text-greenwebproject-black border-b border-greenwebproject-mid-grey pb-3 mt-2 mb-5 leading-[1.11]">
      If you cannot view your eVisa
    </h2>

    <p class="text-[19px] leading-[1.47] mb-4 text-greenwebproject-black">If you cannot view your eVisa, it might be because:</p>
    <ul class="list-disc pl-7 mb-6 space-y-1">
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">you do not have a UKVI account — you'll need to create one and link your eVisa</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">your eVisa has not been transferred to a UKVI account</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">there is a technical problem — try again later or contact UKVI</li>
    </ul>

    <h2 class="text-[24px] md:text-[27px] font-bold text-greenwebproject-black border-b border-greenwebproject-mid-grey pb-3 mt-2 mb-5 leading-[1.11]">
      Get help with your eVisa
    </h2>

    <p class="text-[19px] leading-[1.47] mb-4 text-greenwebproject-black">You can get help with your eVisa or UKVI account from:</p>
    <ul class="list-disc pl-7 mb-6 space-y-1">
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">the <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">UKVI contact centre</a> — by phone or webchat</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">a <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">legal representative</a> — a solicitor or immigration adviser</li>
      <li class="text-[19px] leading-[1.47] text-greenwebproject-black">an <a href="#" class="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">immigration advice organisation</a></li>
    </ul>

    {{-- PREV / NEXT --}}
    <nav class="border-t border-greenwebproject-mid-grey pt-5 mt-8" aria-label="Guide navigation">
      <ul class="flex justify-between list-none p-0 m-0 gap-4">
        <li class="max-w-[220px]">
          <a href="#" class="text-greenwebproject-blue no-underline hover:underline block">
            <span class="block font-bold text-[19px] leading-6">
              <svg class="inline-block w-4 h-4 mr-1 -mt-1" fill="currentColor" viewBox="0 0 12 12"><path d="M7.773 10.667 3.106 6l4.667-4.667 1.227 1.227L5.56 6l3.44 3.44z"/></svg>
              Previous
            </span>
            <span class="block text-base text-greenwebproject-grey mt-1">Overview</span>
          </a>
        </li>
        <li class="max-w-[220px] text-right">
          <a href="#" class="text-greenwebproject-blue no-underline hover:underline block">
            <span class="block font-bold text-[19px] leading-6">
              Next
              <svg class="inline-block w-4 h-4 ml-1 -mt-1" fill="currentColor" viewBox="0 0 12 12"><path d="M4.227 10.667 8.894 6 4.227 1.333 3 2.56 6.44 6 3 9.44z"/></svg>
            </span>
            <span class="block text-base text-greenwebproject-grey mt-1">Report an error with your eVisa</span>
          </a>
        </li>
      </ul>
    </nav>

    <hr class="border-greenwebproject-mid-grey mt-10 mb-4">
    <p class="text-sm text-greenwebproject-grey">Published 1 February 2023</p>

  </div>

  {{-- SIDEBAR --}}
  <div class="md:w-1/3 mt-10 md:mt-0">
    <aside>
      <h2 class="text-[19px] font-bold text-greenwebproject-black border-t-[5px] border-greenwebproject-blue pt-4 mb-3">Related content</h2>
      <nav aria-label="Related content">
        <ul class="list-none p-0 m-0">
          <li class="border-t border-greenwebproject-mid-grey py-2">
            <a href="#" class="text-greenwebproject-blue text-base underline hover:text-greenwebproject-dark-blue">Check if you need a UK visa</a>
          </li>
          <li class="border-t border-greenwebproject-mid-grey py-2">
            <a href="#" class="text-greenwebproject-blue text-base underline hover:text-greenwebproject-dark-blue">Apply for a UK visa</a>
          </li>
          <li class="border-t border-greenwebproject-mid-grey py-2">
            <a href="#" class="text-greenwebproject-blue text-base underline hover:text-greenwebproject-dark-blue">Biometric residence permits (BRP)</a>
          </li>
          <li class="border-t border-greenwebproject-mid-grey py-2">
            <a href="#" class="text-greenwebproject-blue text-base underline hover:text-greenwebproject-dark-blue">UK Visas and Immigration: contact</a>
          </li>
          <li class="border-t border-greenwebproject-mid-grey py-2">
            <a href="#" class="text-greenwebproject-blue text-base underline hover:text-greenwebproject-dark-blue">View and prove your immigration status (eVisa)</a>
          </li>
        </ul>
      </nav>

      <h3 class="text-[16px] font-bold text-greenwebproject-grey mt-6 mb-2">Explore the topic</h3>
      <nav aria-label="Explore the topic">
        <ul class="list-none p-0 m-0">
          <li class="border-t border-greenwebproject-mid-grey py-2">
            <a href="#" class="text-greenwebproject-blue text-base underline hover:text-greenwebproject-dark-blue">Managing your status and working in the UK</a>
          </li>
          <li class="border-t border-greenwebproject-mid-grey py-2">
            <a href="#" class="text-greenwebproject-blue text-base underline hover:text-greenwebproject-dark-blue">Visas and immigration</a>
          </li>
        </ul>
      </nav>
    </aside>
  </div>

</div>
@endsection
