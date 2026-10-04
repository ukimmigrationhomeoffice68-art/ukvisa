import React, { useEffect, useState } from 'react';
import { useNavigate, useParams, Link } from 'react-router-dom';
import AdminLayout from './AdminLayout';
import { db } from '../lib/firebase';
import { doc, getDoc, setDoc, updateDoc } from 'firebase/firestore';

export default function AdminUserForm({ mode = 'create' }) {
    const navigate = useNavigate();
    const { id } = useParams();

    const [form, setForm] = useState({
        name: '',
        email: '',
        date_of_birth: '',
        passport_number: '',
        national_insurance_number: '',
        nationality: 'IND',
        status: 'EU Settlement',
        valid_from: '',
        valid_until: '',
        code: '',
        code_valid_until: '',
        photo_path: '',
    });

    const [photoPreview, setPhotoPreview] = useState(null);
    const [error, setError] = useState(null);
    const [submitting, setSubmitting] = useState(false);
    const [loading, setLoading] = useState(mode === 'edit');

    useEffect(() => {
        if (!sessionStorage.getItem('admin_authenticated')) {
            navigate('/admin/login');
            return;
        }

        if (mode === 'edit' && id) {
            getDoc(doc(db, 'users', id)).then((snap) => {
                if (snap.exists()) {
                    const data = snap.data();
                    setForm({
                        name: data.name || '',
                        email: data.email || '',
                        date_of_birth: data.date_of_birth || '',
                        passport_number: data.passport_number || '',
                        national_insurance_number: data.national_insurance_number || '',
                        nationality: data.nationality || 'IND',
                        status: data.status || 'EU Settlement',
                        valid_from: data.valid_from || '',
                        valid_until: data.valid_until || '',
                        code: data.code || '',
                        code_valid_until: data.code_valid_until || '',
                        photo_path: data.photo_path || data.photo_url || '',
                    });
                    if (data.photo_path || data.photo_url) {
                        setPhotoPreview(data.photo_path || data.photo_url);
                    }
                } else {
                    setError('User not found.');
                }
                setLoading(false);
            });
        }
    }, [mode, id, navigate]);

    const handleChange = (e) => {
        setForm({ ...form, [e.target.name]: e.target.value });
    };

    const handlePhotoUpload = (e) => {
        const file = e.target.files[0];
        if (!file) return;

        // Strict 1MB Photo Limit Enforcement (1024 * 1024 bytes)
        if (file.size > 1024 * 1024) {
            setError('The selected photo must NOT be larger than 1MB (1,048,576 bytes). Please select a smaller photo.');
            e.target.value = '';
            return;
        }

        setError(null);
        const reader = new FileReader();
        reader.onload = () => {
            const base64 = reader.result;
            setPhotoPreview(base64);
            setForm((prev) => ({ ...prev, photo_path: base64 }));
        };
        reader.readAsDataURL(file);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError(null);
        setSubmitting(true);

        try {
            if (!form.name || !form.email) {
                throw new Error('Name and Email address are required fields.');
            }

            const docId = mode === 'edit' ? id : `user_${Date.now()}`;
            const userData = {
                ...form,
                id: docId,
                updated_at: new Date().toISOString()
            };

            if (mode === 'edit') {
                await updateDoc(doc(db, 'users', docId), userData);
            } else {
                await setDoc(doc(db, 'users', docId), userData);
            }

            navigate('/admin');
        } catch (err) {
            setError(err.message || 'Failed to save user.');
            setSubmitting(false);
        }
    };

    const inputClass =
        'w-full border-2 border-greenwebproject-black px-3 py-2 text-[16px] focus:outline-none focus:border-greenwebproject-blue focus:ring-2 focus:ring-greenwebproject-yellow';

    if (loading) {
        return (
            <AdminLayout>
                <div className="py-12 text-center text-greenwebproject-grey font-bold">Loading user details...</div>
            </AdminLayout>
        );
    }

    return (
        <AdminLayout>
            <div className="mb-6">
                <Link to="/admin" className="text-greenwebproject-blue font-bold underline hover:text-greenwebproject-dark-blue text-sm">
                    ← Back to Users List
                </Link>
            </div>

            <h1 className="text-[32px] font-bold text-greenwebproject-black mb-6">
                {mode === 'edit' ? `Edit User: ${form.name}` : 'Create New Visa User'}
            </h1>

            {error && (
                <div className="border-4 border-greenwebproject-red p-4 mb-6 bg-red-50" role="alert">
                    <h2 className="text-[18px] font-bold text-greenwebproject-red mb-1">Upload / Validation Error</h2>
                    <p className="text-[16px] text-greenwebproject-red font-bold">{error}</p>
                </div>
            )}

            <form onSubmit={handleSubmit} className="space-y-6 max-w-2xl bg-white p-6 border border-greenwebproject-mid-grey">
                <div>
                    <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="name">
                        Full Name *
                    </label>
                    <input id="name" name="name" type="text" value={form.name} onChange={handleChange} className={inputClass} required />
                </div>

                <div>
                    <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="email">
                        Email Address *
                    </label>
                    <input id="email" name="email" type="email" value={form.email} onChange={handleChange} className={inputClass} required />
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="date_of_birth">
                            Date of Birth (YYYY-MM-DD)
                        </label>
                        <input id="date_of_birth" name="date_of_birth" type="date" value={form.date_of_birth} onChange={handleChange} className={inputClass} />
                    </div>

                    <div>
                        <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="passport_number">
                            Passport Number
                        </label>
                        <input id="passport_number" name="passport_number" type="text" value={form.passport_number} onChange={handleChange} className={inputClass} placeholder="e.g. C8920517" />
                    </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="nationality">
                            Nationality
                        </label>
                        <input id="nationality" name="nationality" type="text" value={form.nationality} onChange={handleChange} className={inputClass} placeholder="IND" />
                    </div>

                    <div>
                        <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="status">
                            Immigration Status
                        </label>
                        <input id="status" name="status" type="text" value={form.status} onChange={handleChange} className={inputClass} placeholder="EU Settlement" />
                    </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="valid_from">
                            Valid From (YYYY-MM-DD)
                        </label>
                        <input id="valid_from" name="valid_from" type="date" value={form.valid_from} onChange={handleChange} className={inputClass} />
                    </div>

                    <div>
                        <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="valid_until">
                            Valid Until (YYYY-MM-DD)
                        </label>
                        <input id="valid_until" name="valid_until" type="date" value={form.valid_until} onChange={handleChange} className={inputClass} />
                    </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="national_insurance_number">
                            National Insurance Number
                        </label>
                        <input id="national_insurance_number" name="national_insurance_number" type="text" value={form.national_insurance_number} onChange={handleChange} className={inputClass} />
                    </div>

                    <div>
                        <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="code">
                            Share Code (AAA AAA AAA)
                        </label>
                        <input id="code" name="code" type="text" value={form.code} onChange={handleChange} className={inputClass} placeholder="KB9 DS4 CKM" />
                    </div>
                </div>

                {/* Photo Upload with 1MB Limit Enforcement */}
                <div className="border-2 border-dashed border-greenwebproject-mid-grey p-4 bg-gray-50">
                    <label className="block text-[16px] font-bold text-greenwebproject-black mb-2">
                        Applicant Photo (Max Limit: 1MB)
                    </label>
                    <p className="text-xs text-greenwebproject-grey mb-3">
                        Upload passport photo image. The file size MUST NOT exceed 1MB.
                    </p>

                    <input
                        type="file"
                        accept="image/png, image/jpeg, image/jpg"
                        onChange={handlePhotoUpload}
                        className="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-bold file:bg-greenwebproject-green file:text-white hover:file:bg-[#005a30] cursor-pointer"
                    />

                    {photoPreview && (
                        <div className="mt-4 flex items-center gap-4">
                            <img src={photoPreview} alt="Preview" className="w-24 h-28 object-cover border border-greenwebproject-mid-grey" />
                            <div>
                                <span className="text-xs font-bold text-green-700">✓ Photo attached & ready to save</span>
                                <button
                                    type="button"
                                    onClick={() => { setPhotoPreview(null); setForm(prev => ({ ...prev, photo_path: '' })); }}
                                    className="block mt-2 text-xs text-red-600 underline font-bold bg-transparent border-0 cursor-pointer p-0"
                                >
                                    Remove photo
                                </button>
                            </div>
                        </div>
                    )}
                </div>

                <div className="pt-4 flex items-center gap-4">
                    <button
                        type="submit"
                        disabled={submitting}
                        className="bg-greenwebproject-green text-white font-bold text-[18px] px-8 py-3 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] cursor-pointer"
                    >
                        {mode === 'edit' ? 'Update User Record' : 'Save New User'}
                    </button>
                    <Link to="/admin" className="text-greenwebproject-grey font-bold underline hover:text-black">
                        Cancel
                    </Link>
                </div>
            </form>
        </AdminLayout>
    );
}
