import React from 'react';
import { Link } from 'react-router-dom';

// Small reusable GOV.UK building blocks shared across the wizard pages.
// These mirror the markup that was repeated across the original Blade views.

export function BetaBanner() {
    return (
        <div className="bg-greenwebproject-light-grey border-b-4 border-greenwebproject-blue px-4 py-3 mb-8">
            <p className="m-0 text-base text-greenwebproject-black">
                <strong className="text-greenwebproject-blue font-bold">Beta</strong> This is a new service &ndash; your{' '}
                <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">
                    feedback
                </a>{' '}
                will help us to improve it.
            </p>
        </div>
    );
}

// Back link. `to` is a router path (relative to the SPA basename).
export function BackLink({ to, size = 19, arrow = 'svg' }) {
    return (
        <Link
            to={to}
            className={`text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue text-[${size}px] mb-6 inline-block`}
        >
            {arrow === 'svg' ? (
                <>
                    <svg className="inline-block w-4 h-4 mr-1 -mt-1" fill="currentColor" viewBox="0 0 12 12">
                        <path d="M7.773 10.667 3.106 6l4.667-4.667 1.227 1.227L5.56 6l3.44 3.44z" />
                    </svg>
                    Back
                </>
            ) : (
                <>&larr; Back</>
            )}
        </Link>
    );
}

// Green GOV.UK primary button (works as a submit button or plain button).
export function PrimaryButton({ children, className = '', size = 16, ...props }) {
    const pad = size >= 19 ? 'px-5 py-[10px]' : 'px-6 py-3';
    return (
        <button
            {...props}
            className={`inline-block bg-greenwebproject-green text-white font-bold text-[${size}px] ${pad} shadow-[0_2px_0_#002d18] hover:bg-[#005a30] disabled:opacity-70 no-underline leading-[1.2] ${className}`}
        >
            {children}
        </button>
    );
}

// Red-bordered error banner used for validation/API errors.
export function ErrorBanner({ message, bold = false }) {
    if (!message) return null;
    return (
        <div className="border-l-4 border-greenwebproject-red bg-greenwebproject-light-grey px-4 py-3 mb-6">
            <p className={`text-[16px] text-greenwebproject-red m-0 ${bold ? 'font-bold' : ''}`}>{message}</p>
        </div>
    );
}

// Green-bordered status/success banner.
export function StatusBanner({ message }) {
    if (!message) return null;
    return (
        <div className="border-l-4 border-greenwebproject-green bg-greenwebproject-light-grey px-4 py-3 mb-6">
            <p className="text-[16px] text-greenwebproject-black m-0">{message}</p>
        </div>
    );
}

// Full-page loading state so async pages don't flash empty chrome.
export function Loading() {
    return <p className="text-[19px] text-greenwebproject-grey">Loading&hellip;</p>;
}
