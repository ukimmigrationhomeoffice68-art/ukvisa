import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { api, ApiError } from '../lib/api';
import { BetaBanner, BackLink, ErrorBanner } from '../components/greenwebproject';

// Port of resources/views/ukvi/date-of-birth.blade.php.
// Looks the user up by date of birth (as the original controller did); an
// unmatched record routes to the "record not found" page.

export default function DateOfBirth() {
    const navigate = useNavigate();
    const [dob, setDob] = useState({ day: '', month: '', year: '' });
    const [error, setError] = useState(null);
    const [submitting, setSubmitting] = useState(false);

    useEffect(() => {
        document.title = 'What is your date of birth? - GOV.UK';
    }, []);

    const update = (field) => (event) => setDob({ ...dob, [field]: event.target.value });

    const handleSubmit = async (event) => {
        event.preventDefault();
        setError(null);
        setSubmitting(true);
        try {
            const result = await api.post('/date-of-birth', dob);
            if (result?.found) {
                navigate('/id-question/security-code');
            } else {
                navigate('/id-question/record-not-found');
            }
        } catch (err) {
            if (err instanceof ApiError && err.status === 404) {
                navigate('/id-question/record-not-found');
                return;
            }
            setError(err instanceof ApiError ? err.message : 'Something went wrong. Please try again.');
            setSubmitting(false);
        }
    };

    const inputClass =
        'border-2 border-greenwebproject-mid-grey px-3 py-3 text-[16px] focus:outline-none focus:border-greenwebproject-blue focus:ring-4 focus:ring-greenwebproject-yellow';

    return (
        <div className="max-w-2xl px-4 sm:px-0 mx-auto">
            <BetaBanner />
            <BackLink to="/id-question" size={16} />

            <p className="text-[16px] text-greenwebproject-grey mb-2">Sign in</p>

            <h1 className="text-[32px] md:text-[40px] font-bold text-greenwebproject-black mb-6 leading-[1.2]">
                What is your date of birth?
            </h1>

            <p className="text-[16px] text-greenwebproject-grey mb-6 leading-[1.6]">
                You should enter this as shown on your passport. For example, 31 3 1980.
            </p>

            <ErrorBanner message={error} bold />

            <form onSubmit={handleSubmit} className="mb-8">
                <div className="mb-6">
                    <fieldset className="border-0 p-0 m-0">
                        <legend className="block text-[16px] font-bold text-greenwebproject-black mb-4">Day &nbsp; Month &nbsp; Year</legend>
                        <div className="flex flex-col sm:flex-row gap-4">
                            <div className="flex-shrink-0">
                                <input type="text" inputMode="numeric" name="day" maxLength={2} value={dob.day} onChange={update('day')} className={`w-20 ${inputClass}`} placeholder="DD" required />
                            </div>
                            <div className="flex-shrink-0">
                                <input type="text" inputMode="numeric" name="month" maxLength={2} value={dob.month} onChange={update('month')} className={`w-20 ${inputClass}`} placeholder="MM" required />
                            </div>
                            <div className="flex-shrink-0">
                                <input type="text" inputMode="numeric" name="year" maxLength={4} value={dob.year} onChange={update('year')} className={`w-24 ${inputClass}`} placeholder="YYYY" required />
                            </div>
                        </div>
                    </fieldset>
                </div>

                <button
                    type="submit"
                    disabled={submitting}
                    className="inline-block bg-greenwebproject-green text-white font-bold text-[16px] px-6 py-3 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] disabled:opacity-70 no-underline leading-[1.5]"
                >
                    Continue
                </button>
            </form>

            <div className="mt-8 pt-8 border-t-4 border-greenwebproject-mid-grey pl-6 relative before:content-[''] before:absolute before:left-0 before:top-8 before:bottom-0 before:w-1 before:bg-greenwebproject-mid-grey">
                <p className="text-[16px] text-greenwebproject-black">
                    Need help? <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">Contact us</a>
                </p>
            </div>
        </div>
    );
}
