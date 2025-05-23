// src/pages/Profile/Profile.jsx
import React from 'react';

export default function Profile() {
  return (
    <div className="container mx-auto p-6">
      <div className="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 className="text-2xl font-bold text-gray-800 mb-4">Mein Profil</h1>
        
        <div className="mb-6">
          <p className="text-gray-700">
            Hier kannst du deine Profilinformationen einsehen und bearbeiten.
          </p>
        </div>

        <div className="space-y-4">
          <div>
            <label className="block text-sm font-medium text-gray-500">Benutzername</label>
            <p className="mt-1 text-gray-800">Max.Mustermann</p>
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-500">E-Mail-Adresse</label>
            <p className="mt-1 text-gray-800">max@example.com</p>
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-500">Mitglied seit</label>
            <p className="mt-1 text-gray-800">1. Januar 2025</p>
          </div>
        </div>

        <div className="mt-6">
          <button className="bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded transition">
            Profil bearbeiten
          </button>
        </div>
      </div>
    </div>
  );
}