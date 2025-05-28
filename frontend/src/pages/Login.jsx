// src/pages/Login/Login.jsx
import React, { useState } from 'react';
import axios from 'axios';

export default function Login({ setIsLoggedIn, setUsername }) {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleLogin = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post(`${import.meta.env.VITE_API_URL}/api/auth/login`, {
        email,
        password
      });

      if (response.data.success) {
        // Token + Benutzerdaten speichern
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('user', JSON.stringify(response.data.user));
        
        // Zustand aktualisieren
        setIsLoggedIn(true);
        setUsername(response.data.user.name || response.data.user.email);

        // Weiterleitung
        window.location.href = '/';
      }
    } catch (error) {
      console.error('Login fehlgeschlagen:', error.response?.data || error.message);
      alert('Anmeldung fehlgeschlagen. Überprüfe deine Anmeldedaten.');
    }
  };

  return (
    <div className="container mx-auto py-6">
      <h2 className="text-2xl font-bold mb-4">Anmelden</h2>
      <form onSubmit={handleLogin} className="max-w-md mx-auto">
        <div className="mb-4">
          <label className="block text-gray-700 mb-2" htmlFor="email">E-Mail</label>
          <input
            id="email"
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            placeholder="deine@email.de"
            required
            className="w-full p-2 border rounded"
          />
        </div>

        <div className="mb-4">
          <label className="block text-gray-700 mb-2" htmlFor="password">Passwort</label>
          <input
            id="password"
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            placeholder="••••••••"
            required
            className="w-full p-2 border rounded"
          />
        </div>

        <button
          type="submit"
          className="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition"
        >
          Anmelden
        </button>
      </form>
    </div>
  );
}