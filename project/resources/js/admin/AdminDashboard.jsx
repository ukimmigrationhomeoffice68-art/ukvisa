import React, { useEffect, useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import AdminLayout from './AdminLayout';
import { db } from '../lib/firebase';
import { collection, getDocs, deleteDoc, doc, setDoc } from 'firebase/firestore';

export default function AdminDashboard() {
    const navigate = useNavigate();
    const [users, setUsers] = useState([]);
    const [loading, setLoading] = useState(true);
    const [search, setSearch] = useState('');
    const [message, setMessage] = useState(null);

    useEffect(() => {
        if (!sessionStorage.getItem('admin_authenticated')) {
            navigate('/admin/login');
            return;
        }
        fetchUsers();
    }, [navigate]);

    const fetchUsers = async () => {
        setLoading(true);
        try {
            const snap = await getDocs(collection(db, 'users'));
            const list = [];
            snap.forEach((d) => {
                list.push({ id: d.id, ...d.data() });
            });
            setUsers(list);
        } catch (err) {
            console.error('Error fetching users:', err);
        } finally {
            setLoading(false);
        }
    };

    const handleDelete = async (id, name) => {
        if (!window.confirm(`Are you sure you want to delete user "${name}"?`)) return;
        try {
            await deleteDoc(doc(db, 'users', id));
            setMessage(`User "${name}" deleted successfully.`);
            fetchUsers();
        } catch (err) {
            alert('Failed to delete user: ' + err.message);
        }
    };

    const handleSeedData = async () => {
        setLoading(true);
        try {
            const initialUsers = [
                {
                    id: "user_rudra",
                    name: "Rudra Jayantilal",
                    email: "rudrajayantilal9@gmail.com",
                    date_of_birth: "2007-01-27",
                    passport_number: "C8920517",
                    nationality: "IND",
                    status: "EU Settlement",
                    valid_from: "2026-07-31",
                    valid_until: "2026-12-30",
                    code: "KB9 DS4 CKM",
                    code_valid_until: "2026-12-30",
                    photo_path: ""
                },
                {
                    id: "user_an",
                    name: "An",
                    email: "heyanzarkhan@gmail.com",
                    date_of_birth: "1998-01-01",
                    passport_number: "R2575627",
                    nationality: "IND",
                    status: "EU Settlement",
                    valid_from: "2026-08-07",
                    valid_until: "2028-09-07",
                    national_insurance_number: "add",
                    code: "DKE 7YR ZNT",
                    code_valid_until: "2026-09-03"
                },
                {
                    id: "user_pawanjit",
                    name: "PAWANJIT SINGH",
                    email: "pp5024000@gmail.com",
                    date_of_birth: "1997-03-11",
                    passport_number: "Y9371843",
                    nationality: "IND",
                    status: "EU Settlement",
                    valid_from: "2026-07-31",
                    valid_until: "2026-12-30",
                    code: "MK4 KS3 LMN",
                    code_valid_until: "2026-12-30"
                },
                {
                    id: "user_vhora",
                    name: "Vhora Mohammedzakariya Yasinbhai",
                    email: "vahoraafjal2546@gmail.com",
                    date_of_birth: "1993-10-26",
                    passport_number: "AM981307",
                    nationality: "IND",
                    status: "EU Settlement",
                    valid_from: "2026-07-15",
                    valid_until: "2026-12-14",
                    code: "FN6 AM4 LMK",
                    code_valid_until: "2026-11-20"
                }
            ];

            for (const u of initialUsers) {
                await setDoc(doc(db, 'users', u.id), u, { merge: true });
            }

            setMessage('Database seeded successfully with initial users!');
            fetchUsers();
        } catch (err) {
            alert('Failed to seed database: ' + err.message);
        } finally {
            setLoading(false);
        }
    };

    const filteredUsers = users.filter((u) => {
        const queryStr = search.toLowerCase();
        return (
            (u.name && u.name.toLowerCase().includes(queryStr)) ||
            (u.email && u.email.toLowerCase().includes(queryStr)) ||
            (u.passport_number && u.passport_number.toLowerCase().includes(queryStr)) ||
            (u.date_of_birth && u.date_of_birth.includes(queryStr))
        );
    });

    return (
        <AdminLayout>
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <h1 className="text-[32px] font-bold text-greenwebproject-black">Users Management</h1>
                <div className="flex items-center gap-3">
                    <button
                        onClick={handleSeedData}
                        className="bg-greenwebproject-light-grey border border-greenwebproject-mid-grey text-greenwebproject-black font-bold text-[15px] px-4 py-2 hover:bg-[#e5e5e5] cursor-pointer"
                    >
                        ⚡ Seed Initial Users
                    </button>
                    <Link
                        to="/admin/users/create"
                        className="bg-greenwebproject-green text-white font-bold text-[15px] px-4 py-2 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] no-underline"
                    >
                        + Add New User
                    </Link>
                </div>
            </div>

            {message && (
                <div className="bg-[#d5e8d4] border border-[#82b366] text-[#274e13] px-4 py-3 mb-6 font-bold">
                    {message}
                </div>
            )}

            <div className="mb-6">
                <input
                    type="text"
                    placeholder="Search users by name, email, DOB, or passport number..."
                    value={search}
                    onChange={(e) => setSearch(e.target.value)}
                    className="w-full border-2 border-greenwebproject-mid-grey px-4 py-2 text-[16px] focus:outline-none focus:border-greenwebproject-blue"
                />
            </div>

            {loading ? (
                <div className="py-8 text-center text-greenwebproject-grey font-bold">Loading users from Firestore...</div>
            ) : filteredUsers.length === 0 ? (
                <div className="py-8 text-center border-2 border-dashed border-greenwebproject-mid-grey p-6">
                    <p className="text-[18px] text-greenwebproject-grey font-bold mb-4">No users found.</p>
                    <button
                        onClick={handleSeedData}
                        className="bg-greenwebproject-green text-white font-bold text-[16px] px-6 py-2 cursor-pointer"
                    >
                        Click here to seed sample users into Firestore
                    </button>
                </div>
            ) : (
                <div className="overflow-x-auto border border-greenwebproject-mid-grey">
                    <table className="w-full text-left border-collapse">
                        <thead>
                            <tr className="bg-greenwebproject-light-grey border-b border-greenwebproject-mid-grey">
                                <th className="p-3 text-[14px] font-bold text-greenwebproject-black">Photo</th>
                                <th className="p-3 text-[14px] font-bold text-greenwebproject-black">Name</th>
                                <th className="p-3 text-[14px] font-bold text-greenwebproject-black">Email</th>
                                <th className="p-3 text-[14px] font-bold text-greenwebproject-black">Date of Birth</th>
                                <th className="p-3 text-[14px] font-bold text-greenwebproject-black">Passport / Doc #</th>
                                <th className="p-3 text-[14px] font-bold text-greenwebproject-black">Status</th>
                                <th className="p-3 text-[14px] font-bold text-greenwebproject-black">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {filteredUsers.map((u) => (
                                <tr key={u.id} className="border-b border-greenwebproject-mid-grey hover:bg-gray-50">
                                    <td className="p-3">
                                        {u.photo_path || u.photo_url ? (
                                            <img
                                                src={u.photo_path || u.photo_url}
                                                alt={u.name}
                                                className="w-10 h-12 object-cover border border-greenwebproject-mid-grey"
                                            />
                                        ) : (
                                            <div className="w-10 h-12 bg-gray-200 border border-greenwebproject-mid-grey flex items-center justify-center text-xs text-gray-500">
                                                No pic
                                            </div>
                                        )}
                                    </td>
                                    <td className="p-3 text-[15px] font-bold text-greenwebproject-black">{u.name}</td>
                                    <td className="p-3 text-[14px] text-greenwebproject-grey">{u.email || 'N/A'}</td>
                                    <td className="p-3 text-[14px] text-greenwebproject-black font-semibold">{u.date_of_birth || 'N/A'}</td>
                                    <td className="p-3 text-[14px] text-greenwebproject-black">{u.passport_number || 'N/A'}</td>
                                    <td className="p-3 text-[14px]">
                                        <span className="bg-[#e7f2fa] text-[#1d70b8] font-bold px-2 py-1 text-xs">
                                            {u.status || 'EU Settlement'}
                                        </span>
                                    </td>
                                    <td className="p-3 text-[14px]">
                                        <div className="flex items-center gap-3">
                                            <Link
                                                to={`/admin/users/edit/${u.id}`}
                                                className="text-greenwebproject-blue font-bold underline hover:text-greenwebproject-dark-blue"
                                            >
                                                Edit
                                            </Link>
                                            <button
                                                onClick={() => handleDelete(u.id, u.name)}
                                                className="text-greenwebproject-red font-bold underline bg-transparent border-0 cursor-pointer p-0"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            )}
        </AdminLayout>
    );
}
