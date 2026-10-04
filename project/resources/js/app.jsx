import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';

import Layout from './Layout';
import Home from './pages/Home';
import SelectIdentity from './pages/SelectIdentity';
import DocumentEntry from './pages/DocumentEntry';
import DateOfBirth from './pages/DateOfBirth';
import RecordNotFound from './pages/RecordNotFound';
import SecurityCode from './pages/SecurityCode';
import Otp from './pages/Otp';
import Evisa from './pages/Evisa';

// Admin Components
import AdminLogin from './admin/AdminLogin';
import AdminDashboard from './admin/AdminDashboard';
import AdminUserForm from './admin/AdminUserForm';
import AdminSettings from './admin/AdminSettings';

function App() {
    return (
        <BrowserRouter>
            <Routes>
                {/* Admin Portal Routes (Self-contained Layout) */}
                <Route path="/admin/login" element={<AdminLogin />} />
                <Route path="/admin" element={<AdminDashboard />} />
                <Route path="/admin/dashboard" element={<AdminDashboard />} />
                <Route path="/admin/users" element={<AdminDashboard />} />
                <Route path="/admin/users/create" element={<AdminUserForm mode="create" />} />
                <Route path="/admin/users/edit/:id" element={<AdminUserForm mode="edit" />} />
                <Route path="/admin/settings" element={<AdminSettings />} />

                {/* Public eVisa Portal Routes (Wrapped in standard GOV.UK Layout) */}
                <Route
                    path="/*"
                    element={
                        <Layout>
                            <Routes>
                                <Route path="/" element={<Home />} />
                                <Route path="/id-question" element={<SelectIdentity />} />
                                <Route path="/id-question/passport" element={<DocumentEntry documentType="passport" />} />
                                <Route path="/id-question/national-id" element={<DocumentEntry documentType="national_id" />} />
                                <Route path="/id-question/biometric" element={<DocumentEntry documentType="biometric" />} />
                                <Route path="/id-question/customer-number" element={<DocumentEntry documentType="customer_number" />} />
                                <Route path="/id-question/date-of-birth" element={<DateOfBirth />} />
                                <Route path="/id-question/record-not-found" element={<RecordNotFound />} />
                                <Route path="/id-question/security-code" element={<SecurityCode />} />
                                <Route path="/id-question/security-code/verify" element={<Otp />} />
                                <Route path="/status" element={<Evisa />} />
                                <Route path="*" element={<Navigate to="/" replace />} />
                            </Routes>
                        </Layout>
                    }
                />
            </Routes>
        </BrowserRouter>
    );
}

createRoot(document.getElementById('app')).render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
);
