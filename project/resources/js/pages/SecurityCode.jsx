import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { api, ApiError } from '../lib/api';
import { BetaBanner, BackLink, ErrorBanner, Loading } from '../components/greenwebproject';

// Port of resources/views/ukvi/security-code.blade.php.
// The masked email/phone come from the API (server-side masking) so we never
// expose the full contact details to the client.

export default function SecurityCode() {
    const navigate = useNavigate();
    const [options, setOptions] = useState(null);
    const [selected, setSelected] = useState(null);
    const [error, setError] = useState(null);
    const [loadError, setLoadError] = useState(false);
    const [submitting, setSubmitting] = useState(false);

    useEffect(() => {
        document.title = 'How do you want to receive a security code? - GOV.UK';
        let active = true;
        api.get('/security-code')
            .then((data) => {
                if (!active) return;
                setOptions(data);
                setSelected(data.email ? 'email' : data.phone ? 'sms' : 'email');
            })
            .catch((err) => {
                if (!active) return;
                if (err instanceof ApiError && err.status === 409) {
                    navigate('/id-question/record-not-found');
                    return;
                }
                setLoadError(true);
            });
        return () => {
            active = false;
        };
    }, [navigate]);

    const handleSubmit = async (event) => {
        event.preventDefault();
        setError(null);
        setSubmitting(true);
        try {
            const result = await api.post('/security-code', { delivery_method: selected });
            navigate('/id-question/security-code/verify', {
                state: { status: result.status, deliveryMethod: result.delivery_method, isError: !result.ok },
            });
        } catch (err) {
            if (err instanceof ApiError && err.status === 409) {
                navigate('/id-question/record-not-found');
                return;
            }
            if (err instanceof ApiError && err.status === 502 && err.data?.status) {
                // Email failed to send — still move on and surface the message there.
                navigate('/id-question/security-code/verify', {
                    state: { status: err.data.status, deliveryMethod: 'email', isError: true },
                });
                return;
            }
            setError(err instanceof ApiError ? err.message : 'Something went wrong. Please try again.');
            setSubmitting(false);
        }
    };

    return (
        <div className="max-w-2xl px-4 sm:px-0 mx-auto">
            <BetaBanner />
            <BackLink to="/id-question/date-of-birth" size={19} />

            <p className="text-[19px] text-greenwebproject-grey mb-1">Sign in</p>

            <h1 className="text-[32px] md:text-[40px] font-bold text-greenwebproject-black mb-6 leading-[1.09]">
                How do you want to receive a security code?
            </h1>

            {loadError && <ErrorBanner message="We could not load your account. Please try again." bold />}
            <ErrorBanner message={error} bold />

            {!options && !loadError ? (
                <Loading />
            ) : (
                <form onSubmit={handleSubmit} className="mb-6">
                    {options?.email && (
                        <div className="greenwebproject-radio">
                            <input
                                type="radio"
                                id="email"
                                name="delivery_method"
                                value="email"
                                checked={selected === 'email'}
                                onChange={() => setSelected('email')}
                            />
                            <label htmlFor="email">
                                Send an email to <strong>{options.email}</strong>
                            </label>
                        </div>
                    )}

                    {options?.phone && (
                        <div className="greenwebproject-radio">
                            <input
                                type="radio"
                                id="sms"
                                name="delivery_method"
                                value="sms"
                                checked={selected === 'sms'}
                                onChange={() => setSelected('sms')}
                            />
                            <label htmlFor="sms">
                                Send a text message (SMS) to <strong>{options.phone}</strong>
                            </label>
                        </div>
                    )}

                    <button
                        type="submit"
                        disabled={submitting || !selected}
                        className="inline-block bg-greenwebproject-green text-white font-bold text-[19px] px-5 py-[10px] mt-4 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] disabled:opacity-70 no-underline leading-[1.2]"
                    >
                        Continue
                    </button>
                </form>
            )}

            <div className="mt-8 pt-6 border-t border-greenwebproject-mid-grey">
                <h2 className="text-[24px] font-bold text-greenwebproject-black mb-3">Problems signing in</h2>
                <p className="text-[19px] text-greenwebproject-black mb-2">
                    If you do not have access to the phone number and email address,{' '}
                    <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">
                        recover your account
                    </a>
                    .
                </p>
            </div>
        </div>
    );
}
