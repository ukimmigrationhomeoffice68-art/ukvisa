import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { api, ApiError, downloadEvisaPdf } from '../lib/api';
import { BetaBanner, BackLink, ErrorBanner, Loading } from '../components/greenwebproject';

// Port of resources/views/ukvi/evisa.blade.php.
// The status payload is loaded from the API (which enforces the verified-OTP
// gate server-side). A 409 with a `redirect` bounces the user back into the
// wizard exactly as the original controller's redirects did.

function Row({ label, value }) {
    return (
        <div className="flex flex-col sm:flex-row border-b border-greenwebproject-mid-grey py-3">
            <dt className="font-bold text-greenwebproject-black sm:w-2/5 sm:pr-4">{label}</dt>
            <dd className="text-greenwebproject-black m-0">{value || 'N/A'}</dd>
        </div>
    );
}

export default function Evisa() {
    const navigate = useNavigate();
    const [data, setData] = useState(null);
    const [loadError, setLoadError] = useState(false);

    useEffect(() => {
        document.title = 'Your immigration status (eVisa) - GOV.UK';
        let active = true;
        api.get('/evisa')
            .then((payload) => {
                if (active) setData(payload);
            })
            .catch((err) => {
                if (!active) return;
                if (err instanceof ApiError && err.status === 409 && err.data?.redirect) {
                    navigate(
                        err.data.redirect === 'record-not-found'
                            ? '/id-question/record-not-found'
                            : '/id-question/security-code'
                    );
                    return;
                }
                setLoadError(true);
            });
        return () => {
            active = false;
        };
    }, [navigate]);

    return (
        <div className="max-w-3xl px-4 sm:px-0 mx-auto">
            <BetaBanner />
            <BackLink to="/id-question/security-code" size={16} arrow="text" />

            <h1 className="text-[32px] md:text-[40px] font-bold text-greenwebproject-black mb-8 leading-[1.15]">
                Your immigration status (eVisa)
            </h1>

            {loadError && (
                <ErrorBanner message="We could not load your immigration status. Please try again." bold />
            )}

            {!data && !loadError ? (
                <Loading />
            ) : data ? (
                <>
                    <div className="flex flex-col md:flex-row md:gap-8">
                        {/* Details table */}
                        <div className="md:flex-1 min-w-0">
                            <dl className="m-0">
                                <Row label="Name" value={data.name} />
                                <Row label="Date of birth" value={data.date_of_birth} />
                                <Row label="Nationality" value={data.nationality} />
                                <Row label="Status" value={data.status} />
                                <Row label="Valid from" value={data.valid_from} />
                                <Row label="Valid until" value={data.valid_until} />
                                <Row
                                    label="National Insurance number"
                                    value={data.national_insurance_number}
                                />
                            </dl>
                        </div>

                        {/* Photo */}
                        <div className="mt-6 md:mt-0 md:w-48 flex-shrink-0">
                            {data.has_photo && data.photo_data && (
                                <img
                                    id="evisa-photo"
                                    src={data.photo_data}
                                    alt={`Photo of ${data.name}`}
                                    className="w-full max-w-xs md:max-w-none border border-greenwebproject-mid-grey block"
                                />
                            )}
                        </div>
                    </div>

                    {/* Status note */}
                    <p className="text-[16px] text-greenwebproject-black mt-8 mb-8 leading-[1.5]">
                        You can stay in the UK until you receive a decision on your application, even if this is after{' '}
                        {data.valid_until || 'your expiry date'}. This includes during any appeal or administrative
                        review that was made in the UK within the required deadlines.
                    </p>

                    {/* Prove your status */}
                    <h2 className="text-[24px] font-bold text-greenwebproject-black mb-4">Prove your status</h2>
                    <p className="text-[16px] text-greenwebproject-black mb-6 leading-[1.5]">
                        If you need to prove your immigration status to someone, you can do this online with a share
                        code.
                    </p>

                    <button
                        type="button"
                        onClick={() => downloadEvisaPdf()}
                        className="inline-block bg-greenwebproject-green text-white font-bold text-[16px] px-6 py-3 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] border-0 cursor-pointer no-underline leading-[1.5]"
                    >
                        Get a share code
                    </button>
                </>
            ) : null}
        </div>
    );
}
