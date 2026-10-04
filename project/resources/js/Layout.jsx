import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';

// Port of resources/views/layouts/greenwebproject.blade.php — the GOV.UK page chrome
// (skip link, blue header with the GOV.UK logo, and the full footer).

// Delay after the header appears before the main body + footer load. Set to 0 to disable.
const BODY_DELAY_MS = 3000;

const footerServices = [
    'Benefits',
    'Births, death, marriages and care',
    'Business and self-employed',
    'Childcare and parenting',
    'Citizenship and living in the UK',
    'Crime, justice and the law',
    'Disabled people',
    'Driving and transport',
    'Education and learning',
    'Employing people',
    'Environment and countryside',
    'Housing and local services',
    'Money and tax',
    'Passports, travel and living abroad',
    'Visas and immigration',
    'Working, jobs and pensions',
];

const footerGovActivity = [
    'Departments',
    'News',
    'Guidance and regulation',
    'Research and statistics',
    'Policy papers and consultations',
    'Transparency',
    'How government works',
    'Get involved',
];

const footerMeta = [
    'Help',
    'Privacy',
    'Cookies',
    'Accessibility statement',
    'Contact',
    'Terms and conditions',
    'Rhestr o Wasanaethau Cymraeg',
    'Government Digital Service',
];

export default function Layout({ children }) {
    // Header shows first; the main body + footer are revealed after BODY_DELAY_MS.
    const [showBody, setShowBody] = useState(BODY_DELAY_MS <= 0);

    useEffect(() => {
        if (showBody) return;
        const timer = setTimeout(() => setShowBody(true), BODY_DELAY_MS);
        return () => clearTimeout(timer);
    }, [showBody]);

    return (
        <>
            {/* Skip link */}
            <a
                href="#main-content"
                className="absolute -top-full left-0 bg-[#ffdd00] text-[#0b0c0c] font-bold px-4 py-2 text-lg focus:top-0 z-50 no-underline"
            >
                Skip to main content
            </a>

            {/* HEADER */}
            <header className="bg-greenwebproject-blue border-b-[10px] border-greenwebproject-dark-blue">
                <div className="max-w-[960px] mx-auto px-4 md:px-8 py-[10px] border-b border-white/25">
                    <Link to="/" className="text-white hover:text-white no-underline inline-block leading-none">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            focusable="false"
                            role="img"
                            viewBox="0 0 324 60"
                            height="30"
                            width="162"
                            fill="white"
                            className="block"
                            aria-label="GOV.UK"
                        >
                            <title>GOV.UK</title>
                            <g>
                                <circle cx="20" cy="17.6" r="3.7" />
                                <circle cx="10.2" cy="23.5" r="3.7" />
                                <circle cx="3.7" cy="33.2" r="3.7" />
                                <circle cx="31.7" cy="30.6" r="3.7" />
                                <circle cx="43.3" cy="17.6" r="3.7" />
                                <circle cx="53.2" cy="23.5" r="3.7" />
                                <circle cx="59.7" cy="33.2" r="3.7" />
                                <circle cx="31.7" cy="30.6" r="3.7" />
                                <path d="M33.1,9.8c.2-.1.3-.3.5-.5l4.6,2.4v-6.8l-4.6,1.5c-.1-.2-.3-.3-.5-.5l1.9-5.9h-6.7l1.9,5.9c-.2.1-.3.3-.5.5l-4.6-1.5v6.8l4.6-2.4c.1.2.3.3.5.5l-2.6,8c-.9,2.8,1.2,5.7,4.1,5.7h0c3,0,5.1-2.9,4.1-5.7l-2.6-8ZM37,37.9s-3.4,3.8-4.1,6.1c2.2,0,4.2-.5,6.4-2.8l-.7,8.5c-2-2.8-4.4-4.1-5.7-3.8.1,3.1.5,6.7,5.8,7.2,3.7.3,6.7-1.5,7-3.8.4-2.6-2-4.3-3.7-1.6-1.4-4.5,2.4-6.1,4.9-3.2-1.9-4.5-1.8-7.7,2.4-10.9,3,4,2.6,7.3-1.2,11.1,2.4-1.3,6.2,0,4,4.6-1.2-2.8-3.7-2.2-4.2.2-.3,1.7.7,3.7,3,4.2,1.9.3,4.7-.9,7-5.9-1.3,0-2.4.7-3.9,1.7l2.4-8c.6,2.3,1.4,3.7,2.2,4.5.6-1.6.5-2.8,0-5.3l5,1.8c-2.6,3.6-5.2,8.7-7.3,17.5-7.4-1.1-15.7-1.7-24.5-1.7h0c-8.8,0-17.1.6-24.5,1.7-2.1-8.9-4.7-13.9-7.3-17.5l5-1.8c-.5,2.5-.6,3.7,0,5.3.8-.8,1.6-2.3,2.2-4.5l2.4,8c-1.5-1-2.6-1.7-3.9-1.7,2.3,5,5.2,6.2,7,5.9,2.3-.4,3.3-2.4,3-4.2-.5-2.4-3-3.1-4.2-.2-2.2-4.6,1.6-6,4-4.6-3.7-3.7-4.2-7.1-1.2-11.1,4.2,3.2,4.3,6.4,2.4,10.9,2.5-2.8,6.3-1.3,4.9,3.2-1.8-2.7-4.1-1-3.7,1.6.3,2.3,3.3,4.1,7,3.8,5.4-.5,5.7-4.2,5.8-7.2-1.3-.2-3.7,1-5.7,3.8l-.7-8.5c2.2,2.3,4.2,2.7,6.4,2.8-.7-2.3-4.1-6.1-4.1-6.1h10.6,0Z" />
                            </g>
                            <circle fill="#00ffe0" cx="226" cy="36" r="7.3" />
                            <path d="M93.94 41.25c.4 1.81 1.2 3.21 2.21 4.62 1 1.4 2.21 2.41 3.61 3.21s3.21 1.2 5.22 1.2 3.61-.4 4.82-1c1.4-.6 2.41-1.4 3.21-2.41.8-1 1.4-2.01 1.61-3.01s.4-2.01.4-3.01v.14h-10.86v-7.02h20.07v24.08h-8.03v-5.56c-.6.8-1.38 1.61-2.19 2.41-.8.8-1.81 1.2-2.81 1.81-1 .4-2.21.8-3.41 1.2s-2.41.4-3.81.4a18.56 18.56 0 0 1-14.65-6.63c-1.6-2.01-3.01-4.41-3.81-7.02s-1.4-5.62-1.4-8.83.4-6.02 1.4-8.83a20.45 20.45 0 0 1 19.46-13.65c3.21 0 4.01.2 5.82.8 1.81.4 3.61 1.2 5.02 2.01 1.61.8 2.81 2.01 4.01 3.21s2.21 2.61 2.81 4.21l-7.63 4.41c-.4-1-1-1.81-1.61-2.61-.6-.8-1.4-1.4-2.21-2.01-.8-.6-1.81-1-2.81-1.4-1-.4-2.21-.4-3.61-.4-2.01 0-3.81.4-5.22 1.2-1.4.8-2.61 1.81-3.61 3.21s-1.61 2.81-2.21 4.62c-.4 1.81-.6 3.71-.6 5.42s.8 5.22.8 5.22Zm57.8-27.9c3.21 0 6.22.6 8.63 1.81 2.41 1.2 4.82 2.81 6.62 4.82S170.2 24.39 171 27s1.4 5.62 1.4 8.83-.4 6.02-1.4 8.83-2.41 5.02-4.01 7.02-4.01 3.61-6.62 4.82-5.42 1.81-8.63 1.81-6.22-.6-8.63-1.81-4.82-2.81-6.42-4.82-3.21-4.41-4.01-7.02-1.4-5.62-1.4-8.83.4-6.02 1.4-8.83 2.41-5.02 4.01-7.02 4.01-3.61 6.42-4.82 5.42-1.81 8.63-1.81Zm0 36.73c1.81 0 3.61-.4 5.02-1s2.61-1.81 3.61-3.01 1.81-2.81 2.21-4.41c.4-1.81.8-3.61.8-5.62 0-2.21-.2-4.21-.8-6.02s-1.2-3.21-2.21-4.62c-1-1.2-2.21-2.21-3.61-3.01s-3.21-1-5.02-1-3.61.4-5.02 1c-1.4.8-2.61 1.81-3.61 3.01s-1.81 2.81-2.21 4.62c-.4 1.81-.8 3.61-.8 5.62 0 2.41.2 4.21.8 6.02.4 1.81 1.2 3.21 2.21 4.41s2.21 2.21 3.61 3.01c1.4.8 3.21 1 5.02 1Zm36.32 7.96-12.24-44.15h9.83l8.43 32.77h.4l8.23-32.77h9.83L200.3 58.04h-12.24Zm74.14-7.96c2.18 0 3.51-.6 3.51-.6 1.2-.6 2.01-1 2.81-1.81s1.4-1.81 1.81-2.81a13 13 0 0 0 .8-4.01V13.9h8.63v28.15c0 2.41-.4 4.62-1.4 6.62-.8 2.01-2.21 3.61-3.61 5.02s-3.41 2.41-5.62 3.21-4.62 1.2-7.02 1.2-5.02-.4-7.02-1.2c-2.21-.8-4.01-1.81-5.62-3.21s-2.81-3.01-3.61-5.02-1.4-4.21-1.4-6.62V13.9h8.63v26.95c0 1.61.2 3.01.8 4.01.4 1.2 1.2 2.21 2.01 2.81.8.8 1.81 1.4 2.81 1.81 0 0 1.34.6 3.51.6Zm34.22-36.18v18.92l15.65-18.92h10.82l-15.03 17.32 16.03 26.83h-10.21l-11.44-20.21-5.62 6.22v13.99h-8.83V13.9" />
                        </svg>
                    </Link>
                </div>
            </header>

            {showBody && (
              <>
              {/* MAIN */}
              <main id="main-content" className="bg-white py-8 md:py-10">
                <div className="max-w-[960px] mx-auto px-4 md:px-8">{children}</div>
              </main>

            {/* FOOTER */}
            <footer className="bg-greenwebproject-light-grey border-t-[1px] border-greenwebproject-mid-grey mt-0 py-10">
                <div className="max-w-[960px] mx-auto px-4 md:px-8">
                    <div className="mb-8">
                        <img src="/images/logo.png" alt="" className="h-14 w-auto mix-blend-multiply" />
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                        <div className="md:col-span-2">
                            <h2 className="text-base font-bold border-b border-greenwebproject-mid-grey pb-3 mb-4 text-greenwebproject-black">
                                Services and information
                            </h2>
                            <ul className="list-none p-0 m-0 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2">
                                {footerServices.map((label) => (
                                    <li key={label}>
                                        <a href="#" className="text-greenwebproject-black text-sm underline hover:no-underline">
                                            {label}
                                        </a>
                                    </li>
                                ))}
                            </ul>
                        </div>

                        <div className="md:col-span-1">
                            <h2 className="text-base font-bold border-b border-greenwebproject-mid-grey pb-3 mb-4 text-greenwebproject-black">
                                Government activity
                            </h2>
                            <ul className="list-none p-0 m-0 grid grid-cols-1 gap-y-2">
                                {footerGovActivity.map((label) => (
                                    <li key={label}>
                                        <a href="#" className="text-greenwebproject-black text-sm underline hover:no-underline">
                                            {label}
                                        </a>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    </div>

                    <hr className="border-greenwebproject-mid-grey mb-8" />

                    <div className="flex flex-col-reverse gap-8 md:flex-row md:items-end md:justify-between">
                        <div className="md:flex-1">
                            <ul className="list-none p-0 m-0 flex flex-wrap gap-x-4 gap-y-2 mb-5">
                                {footerMeta.map((label) => (
                                    <li key={label}>
                                        <a href="#" className="text-greenwebproject-black text-sm underline hover:no-underline">
                                            {label}
                                        </a>
                                    </li>
                                ))}
                            </ul>

                            <div className="flex items-start gap-3">
                                <span className="shrink-0 font-bold text-greenwebproject-black border-2 border-greenwebproject-black px-1 text-base leading-none py-[3px] tracking-tight">
                                    OGL
                                </span>
                                <p className="text-sm text-greenwebproject-grey m-0 leading-[1.5] max-w-[34rem]">
                                    All content is available under the{' '}
                                    <a href="#" className="text-greenwebproject-black underline hover:no-underline">
                                        Open Government Licence v3.0
                                    </a>
                                    , except where otherwise stated
                                </p>
                            </div>
                        </div>

                        <div className="flex flex-col items-center shrink-0">
                            <img src="/images/logo.png" alt="" className="h-[70px] w-auto mix-blend-multiply" />
                            <a href="#" className="text-greenwebproject-black text-sm underline hover:no-underline mt-1">
                                &copy; Crown copyright
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
              </>
            )}
        </>
    );
}
