import React, { useEffect } from 'react';
import { Link } from 'react-router-dom';
import { BetaBanner } from '../components/greenwebproject';

// Port of resources/views/ukvi/record-not-found.blade.php.

export default function RecordNotFound() {
    useEffect(() => {
        document.title = 'Record not found - GOV.UK';
    }, []);

    return (
        <div className="max-w-2xl px-4 sm:px-0 mx-auto">
            <BetaBanner />

            <div className="border-l-4 border-greenwebproject-red bg-greenwebproject-light-grey px-4 py-3 mb-8">
                <h1 className="text-[32px] font-bold text-greenwebproject-red mb-2">Record not found</h1>
                <p className="text-[16px] text-greenwebproject-black m-0">
                    We could not find a record matching the information you provided.
                </p>
            </div>

            <div className="mb-8">
                <p className="text-[16px] text-greenwebproject-black mb-4">Please check that you have entered:</p>
                <ul className="list-disc pl-7 mb-6 space-y-2">
                    <li className="text-[16px] text-greenwebproject-black">the correct identity document number</li>
                    <li className="text-[16px] text-greenwebproject-black">the correct date of birth as shown on your document</li>
                </ul>
            </div>

            <div className="mb-8">
                <Link
                    to="/id-question"
                    className="inline-block bg-greenwebproject-green text-white font-bold text-[16px] px-6 py-3 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] no-underline leading-[1.5]"
                >
                    Try again
                </Link>
            </div>

            <div className="mt-8 pt-8 border-t border-greenwebproject-mid-grey">
                <h2 className="text-[20px] font-bold text-greenwebproject-black mb-4">Get help</h2>
                <p className="text-[16px] text-greenwebproject-black mb-4">
                    If you continue to have problems, you can{' '}
                    <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">
                        contact UK Visas and Immigration
                    </a>{' '}
                    for support.
                </p>
            </div>
        </div>
    );
}
