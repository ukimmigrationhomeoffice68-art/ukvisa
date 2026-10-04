import React, { useEffect, useState } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import { api, ApiError } from '../lib/api';
import { BetaBanner, BackLink, ErrorBanner, StatusBanner } from '../components/greenwebproject';

// Port of resources/views/ukvi/otp.blade.php.
// The security-code page navigates here with router state describing how the
// code was delivered ({ status, deliveryMethod, isError }); we surface that as
// the initial banner. Verifying (or the 888888 bypass) advances to /status.

export default function Otp() {
    const navigate = useNavigate();
    const location = useLocation();
    const initial = location.state || {};

    const [otp, setOtp] = useState('');
    const [deliveryMethod] = useState(initial.deliveryMethod || 'email');
    const [banner, setBanner] = useState({
        message: initial.status || null,
        isError: Boolean(initial.isError),
    });
    const [error, setError] = useState(null);
    const [submitting, setSubmitting] = useState(false);
    const [resending, setResending] = useState(false);

    useEffect(() => {
        document.title = 'Enter the security code - GOV.UK';
    }, []);

    // Redirect helper shared by the API 409 responses (record_not_found / otp_required).
    const followRedirect = (target) => {
        if (target === 'record-not-found') {
            navigate('/id-question/record-not-found');
        } else {
            navigate('/id-question/security-code');
        }
    };

    const handleSubmit = async (event) => {
        event.preventDefault();
        setError(null);
        setSubmitting(true);
        try {
            const result = await api.post('/verify-otp', { otp });
            if (result?.verified) {
                navigate('/status');
                return;
            }
            setError('The security code you entered is not correct.');
            setSubmitting(false);
        } catch (err) {
            if (err instanceof ApiError && err.status === 409 && err.data?.redirect) {
                followRedirect(err.data.redirect);
                return;
            }
            // 422 = expired / incorrect code; the message is server-provided.
            setError(err instanceof ApiError ? err.message : 'Something went wrong. Please try again.');
            setSubmitting(false);
        }
    };

    const handleResend = async (event) => {
        event.preventDefault();
        setError(null);
        setResending(true);
        try {
            const result = await api.post('/resend-otp');
            setBanner({ message: result.status, isError: !result.ok });
        } catch (err) {
            if (err instanceof ApiError && err.status === 409 && err.data?.redirect) {
                followRedirect(err.data.redirect);
                return;
            }
            if (err instanceof ApiError && err.status === 502 && err.data?.status) {
                // Email failed to send — surface the server message as an error banner.
                setBanner({ message: err.data.status, isError: true });
            } else {
                setError(err instanceof ApiError ? err.message : 'Something went wrong. Please try again.');
            }
        } finally {
            setResending(false);
        }
    };

    return (
        <div className="max-w-2xl px-4 sm:px-0 mx-auto">
            <BetaBanner />
            <BackLink to="/id-question/security-code" size={16} arrow="text" />

            {banner.isError ? (
                <ErrorBanner message={banner.message} />
            ) : (
                <StatusBanner message={banner.message} />
            )}

            <p className="text-[16px] text-greenwebproject-grey mb-2">Sign in</p>

            <h1 className="text-[32px] md:text-[40px] font-bold text-greenwebproject-black mb-6 leading-[1.2]">
                Enter the security code
            </h1>

            <p className="text-[16px] text-greenwebproject-grey mb-6 leading-[1.6]">
                We have sent a 6-digit security code to your{' '}
                {deliveryMethod === 'sms' ? 'phone' : 'email address'}. Enter it below to continue. The code expires in 10
                minutes.
            </p>

            <ErrorBanner message={error} bold />

            <form onSubmit={handleSubmit} className="mb-6">
                <div className="mb-6">
                    <label htmlFor="otp" className="block text-[16px] font-bold text-greenwebproject-black mb-2">
                        Security code
                    </label>
                    <input
                        type="text"
                        id="otp"
                        name="otp"
                        inputMode="numeric"
                        maxLength={6}
                        autoComplete="one-time-code"
                        value={otp}
                        onChange={(event) => setOtp(event.target.value)}
                        className={`w-48 border-2 px-4 py-3 text-[20px] tracking-[0.3em] focus:outline-none focus:border-greenwebproject-blue focus:ring-4 focus:ring-greenwebproject-yellow ${
                            error ? 'border-greenwebproject-red' : 'border-greenwebproject-mid-grey'
                        }`}
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

            <div className="mt-6 pt-6 border-t border-greenwebproject-mid-grey">
                <form onSubmit={handleResend} className="m-0">
                    <p className="text-[16px] text-greenwebproject-black m-0">
                        Not received your code?{' '}
                        <button
                            type="submit"
                            disabled={resending}
                            className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue bg-transparent border-0 cursor-pointer p-0 text-[16px] disabled:opacity-70"
                        >
                            Send it again
                        </button>
                    </p>
                </form>
            </div>
        </div>
    );
}
