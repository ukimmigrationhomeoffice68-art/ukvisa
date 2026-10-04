import React, { useEffect } from 'react';
import { Link } from 'react-router-dom';

// Port of resources/views/home.blade.php — the eVisa guide landing page.

const contents = [
    { label: 'What an eVisa is', bold: false },
    { label: 'Set up a UKVI account to access your eVisa', bold: false },
    { label: 'Get an eVisa if you have settlement in the UK', bold: false },
    { label: 'View your eVisa and get a share code to prove your immigration status', bold: true },
    { label: 'Travel with your eVisa', bold: false },
    { label: 'Update your details in your UKVI account', bold: false },
    { label: 'Report an error with your eVisa', bold: false },
];

const relatedContent = [
    'Check if you need a UK visa',
    'Apply for a UK visa',
    'Biometric residence permits (BRP)',
    'UK Visas and Immigration: contact',
    'View and prove your immigration status (eVisa)',
];

const exploreTopic = ['Managing your status and working in the UK', 'Visas and immigration'];

export default function Home() {
    useEffect(() => {
        document.title = 'eVisas: access and use your online immigration status - GOV.UK';
    }, []);

    return (
        <>
            {/* Breadcrumb */}
            <div className="-mx-4 md:-mx-8 mb-8 bg-white border-b border-greenwebproject-mid-grey">
                <div className="px-4 md:px-8 py-3">
                    <nav aria-label="Breadcrumb">
                        <ol className="flex flex-wrap items-center gap-y-1 list-none p-0 m-0 text-sm">
                            {['Home', 'Visas and immigration', 'Managing your status and working in the UK'].map((crumb) => (
                                <li key={crumb} className="flex items-center">
                                    <a href="#" className="text-greenwebproject-black underline hover:no-underline text-sm">
                                        {crumb}
                                    </a>
                                    <span className="mx-2 text-greenwebproject-grey text-sm" aria-hidden="true">
                                        ›
                                    </span>
                                </li>
                            ))}
                            <li className="text-greenwebproject-black text-sm">eVisas</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div className="md:flex md:gap-10">
                {/* MAIN COLUMN */}
                <div className="md:w-2/3">
                    <h1 className="text-[32px] md:text-[48px] font-bold text-greenwebproject-black leading-[1.09] mb-8">
                        eVisas: access and use your online immigration status
                    </h1>

                    <p className="text-sm text-greenwebproject-grey mb-6 border-t border-greenwebproject-mid-grey pt-3">
                        From: <a href="#" className="text-greenwebproject-grey underline">Home Office</a>
                        <br />
                        Published 1 February 2023
                        <br />
                        Last updated 14 November 2024 &mdash; <a href="#" className="text-greenwebproject-grey underline">See all updates</a>
                    </p>

                    {/* CONTENTS */}
                    <nav aria-label="Pages in this guide" className="bg-greenwebproject-light-grey border border-greenwebproject-mid-grey px-4 pt-4 pb-2 mb-8">
                        <h2 className="text-base font-bold text-greenwebproject-black mb-3">Contents</h2>
                        <ol className="list-none p-0 m-0">
                            {contents.map((item) => (
                                <li
                                    key={item.label}
                                    className={`border-t border-greenwebproject-mid-grey py-[9px] flex items-start gap-2 text-base ${item.bold ? 'font-bold' : ''}`}
                                >
                                    <span className="text-greenwebproject-grey shrink-0 leading-6">—</span>
                                    <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue leading-6">
                                        {item.label}
                                    </a>
                                </li>
                            ))}
                        </ol>
                    </nav>

                    {/* ARTICLE CONTENT */}
                    <h2 className="text-[24px] md:text-[27px] font-bold text-greenwebproject-black border-b border-greenwebproject-mid-grey pb-3 mt-2 mb-5 leading-[1.11]">
                        View your eVisa and get a share code to prove your immigration status
                    </h2>

                    <p className="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
                        Your eVisa shows your identity and immigration status. This includes what rights you have in the UK, for example to work, rent or claim benefits.
                    </p>
                    <p className="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
                        You can get a share code to prove your immigration status to people such as employers or landlords when you travel.
                    </p>
                    <p className="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
                        You can use your UK Visas and Immigration (UKVI) account to:
                    </p>
                    <ul className="list-disc pl-7 mb-6 space-y-1">
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">view your eVisa — your online UK immigration status</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">get a share code to prove your immigration status to others, such as employers or landlords</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">update your personal details</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">see your immigration history</li>
                    </ul>
                    <p className="text-[19px] leading-[1.47] mb-6 text-greenwebproject-black">
                        You need to <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">create a UKVI account</a> if you do not have one. You can then link your eVisa to your account.
                    </p>

                    <Link
                        to="/id-question"
                        className="inline-block bg-greenwebproject-green text-white font-bold text-[19px] px-4 py-[9px] shadow-[0_2px_0_#002d18] hover:bg-[#005a30] no-underline mb-8 leading-[1.1]"
                    >
                        View your eVisa and get a share code
                    </Link>

                    <h2 className="text-[24px] md:text-[27px] font-bold text-greenwebproject-black border-b border-greenwebproject-mid-grey pb-3 mt-2 mb-5 leading-[1.11]">
                        Report an error with your eVisa
                    </h2>
                    <p className="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
                        You should check your eVisa details are correct. You can find your eVisa details by signing in to your UKVI account.
                    </p>
                    <p className="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
                        If your eVisa contains incorrect information — for example your name, nationality or conditions of stay — you should report the error.
                    </p>
                    <p className="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
                        You can <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">report an error with your eVisa</a> using the online form.
                    </p>
                    <p className="text-[19px] leading-[1.47] mb-4 text-greenwebproject-black">You'll need your:</p>
                    <ul className="list-disc pl-7 mb-6 space-y-1">
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">full name</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">date of birth</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">nationality</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">UKVI account email address</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">reference number — this can be your GWF, HO, UAN or other Home Office reference number</li>
                    </ul>

                    <h2 className="text-[24px] md:text-[27px] font-bold text-greenwebproject-black border-b border-greenwebproject-mid-grey pb-3 mt-2 mb-5 leading-[1.11]">
                        Update your details
                    </h2>
                    <p className="text-[19px] leading-[1.47] mb-4 text-greenwebproject-black">
                        You can update your personal details in your UKVI account, such as your:
                    </p>
                    <ul className="list-disc pl-7 mb-6 space-y-1">
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">travel document — for example passport number or expiry date</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">email address</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">phone number</li>
                    </ul>
                    <p className="text-[19px] leading-[1.47] mb-5 text-greenwebproject-black">
                        If you need to update your name, nationality or date of birth, you'll need to <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">contact UK Visas and Immigration</a>.
                    </p>

                    <h2 className="text-[24px] md:text-[27px] font-bold text-greenwebproject-black border-b border-greenwebproject-mid-grey pb-3 mt-2 mb-5 leading-[1.11]">
                        If you cannot view your eVisa
                    </h2>
                    <p className="text-[19px] leading-[1.47] mb-4 text-greenwebproject-black">If you cannot view your eVisa, it might be because:</p>
                    <ul className="list-disc pl-7 mb-6 space-y-1">
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">you do not have a UKVI account — you'll need to create one and link your eVisa</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">your eVisa has not been transferred to a UKVI account</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">there is a technical problem — try again later or contact UKVI</li>
                    </ul>

                    <h2 className="text-[24px] md:text-[27px] font-bold text-greenwebproject-black border-b border-greenwebproject-mid-grey pb-3 mt-2 mb-5 leading-[1.11]">
                        Get help with your eVisa
                    </h2>
                    <p className="text-[19px] leading-[1.47] mb-4 text-greenwebproject-black">You can get help with your eVisa or UKVI account from:</p>
                    <ul className="list-disc pl-7 mb-6 space-y-1">
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">the <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">UKVI contact centre</a> — by phone or webchat</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">a <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">legal representative</a> — a solicitor or immigration adviser</li>
                        <li className="text-[19px] leading-[1.47] text-greenwebproject-black">an <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">immigration advice organisation</a></li>
                    </ul>

                    {/* PREV / NEXT */}
                    <nav className="border-t border-greenwebproject-mid-grey pt-5 mt-8" aria-label="Guide navigation">
                        <ul className="flex justify-between list-none p-0 m-0 gap-4">
                            <li className="max-w-[220px]">
                                <a href="#" className="text-greenwebproject-blue no-underline hover:underline block">
                                    <span className="block font-bold text-[19px] leading-6">
                                        <svg className="inline-block w-4 h-4 mr-1 -mt-1" fill="currentColor" viewBox="0 0 12 12">
                                            <path d="M7.773 10.667 3.106 6l4.667-4.667 1.227 1.227L5.56 6l3.44 3.44z" />
                                        </svg>
                                        Previous
                                    </span>
                                    <span className="block text-base text-greenwebproject-grey mt-1">Overview</span>
                                </a>
                            </li>
                            <li className="max-w-[220px] text-right">
                                <a href="#" className="text-greenwebproject-blue no-underline hover:underline block">
                                    <span className="block font-bold text-[19px] leading-6">
                                        Next
                                        <svg className="inline-block w-4 h-4 ml-1 -mt-1" fill="currentColor" viewBox="0 0 12 12">
                                            <path d="M4.227 10.667 8.894 6 4.227 1.333 3 2.56 6.44 6 3 9.44z" />
                                        </svg>
                                    </span>
                                    <span className="block text-base text-greenwebproject-grey mt-1">Report an error with your eVisa</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <hr className="border-greenwebproject-mid-grey mt-10 mb-4" />
                    <p className="text-sm text-greenwebproject-grey">Published 1 February 2023</p>
                </div>

                {/* SIDEBAR */}
                <div className="md:w-1/3 mt-10 md:mt-0">
                    <aside>
                        <h2 className="text-[19px] font-bold text-greenwebproject-black border-t-[5px] border-greenwebproject-blue pt-4 mb-3">Related content</h2>
                        <nav aria-label="Related content">
                            <ul className="list-none p-0 m-0">
                                {relatedContent.map((label) => (
                                    <li key={label} className="border-t border-greenwebproject-mid-grey py-2">
                                        <a href="#" className="text-greenwebproject-blue text-base underline hover:text-greenwebproject-dark-blue">
                                            {label}
                                        </a>
                                    </li>
                                ))}
                            </ul>
                        </nav>

                        <h3 className="text-[16px] font-bold text-greenwebproject-grey mt-6 mb-2">Explore the topic</h3>
                        <nav aria-label="Explore the topic">
                            <ul className="list-none p-0 m-0">
                                {exploreTopic.map((label) => (
                                    <li key={label} className="border-t border-greenwebproject-mid-grey py-2">
                                        <a href="#" className="text-greenwebproject-blue text-base underline hover:text-greenwebproject-dark-blue">
                                            {label}
                                        </a>
                                    </li>
                                ))}
                            </ul>
                        </nav>
                    </aside>
                </div>
            </div>
        </>
    );
}
