import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { BetaBanner } from '../components/greenwebproject';

// Port of resources/views/ukvi/select-identity.blade.php.
// Choosing a document routes client-side to the matching entry form — this
// mirrors UKVIController@handleIdentitySelection, which only issued a redirect.

const options = [
    { id: 'passport', label: 'Passport', path: '/id-question/passport' },
    { id: 'national_id', label: 'National identity card', path: '/id-question/national-id' },
    { id: 'biometric', label: 'Biometric residence card or permit', path: '/id-question/biometric' },
    { id: 'ukvi_number', label: 'I use a UKVI customer number', path: '/id-question/customer-number' },
];

export default function SelectIdentity() {
    const navigate = useNavigate();
    const [selected, setSelected] = useState('passport');

    useEffect(() => {
        document.title = 'Which identity document do you use to sign in to your UKVI account? - GOV.UK';
    }, []);

    const handleSubmit = (event) => {
        event.preventDefault();
        const choice = options.find((option) => option.id === selected);
        if (choice) navigate(choice.path);
    };

    return (
        <div className="max-w-2xl px-4 sm:px-0 mx-auto">
            <BetaBanner />

            <p className="text-[19px] text-greenwebproject-grey mb-1">Sign in</p>

            <h1 className="text-[32px] md:text-[40px] font-bold text-greenwebproject-black mb-5 leading-[1.09]">
                Which identity document do you use to sign in to your UKVI account?
            </h1>

            <p className="text-[19px] text-greenwebproject-black mb-6 leading-[1.4]">
                This is usually the document you used when you created your account. If you have added a new document to your account, use the most recent document to sign in.
            </p>

            <form onSubmit={handleSubmit} className="mb-6">
                {options.slice(0, 3).map((option) => (
                    <div key={option.id} className="greenwebproject-radio">
                        <input
                            type="radio"
                            id={option.id}
                            name="identity_document"
                            value={option.id}
                            checked={selected === option.id}
                            onChange={() => setSelected(option.id)}
                        />
                        <label htmlFor={option.id}>{option.label}</label>
                    </div>
                ))}

                <p className="text-[19px] text-greenwebproject-black my-2">or</p>

                <div className="greenwebproject-radio">
                    <input
                        type="radio"
                        id="ukvi_number"
                        name="identity_document"
                        value="ukvi_number"
                        checked={selected === 'ukvi_number'}
                        onChange={() => setSelected('ukvi_number')}
                    />
                    <label htmlFor="ukvi_number">I use a UKVI customer number</label>
                </div>

                <button
                    type="submit"
                    className="inline-block bg-greenwebproject-green text-white font-bold text-[19px] px-5 py-[10px] mt-4 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] no-underline leading-[1.2]"
                >
                    Continue
                </button>
            </form>

            <p className="text-[19px] mt-2">
                <a href="#" className="text-greenwebproject-blue underline hover:text-greenwebproject-dark-blue">
                    I do not know which identity document I use to sign in
                </a>
            </p>
        </div>
    );
}
