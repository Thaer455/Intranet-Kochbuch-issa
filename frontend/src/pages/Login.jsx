import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { login, storeUserData } from '../services/auth.service';

export default function Login({ setIsLoggedIn, setUsername }) {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();

    try {
      const data = await login(email, password);

      if (data.success) {
        // Token + Benutzerdaten speichern
        storeUserData(data.token, data.user);

        // Zustand aktualisieren
        setIsLoggedIn(true);
        setUsername(data.user.name || data.user.email);

        // Weiterleitung
        navigate('/');
      }
    } catch (err) {
      console.error('Anmeldung fehlgeschlagen:', err.response?.data || err.message);
      alert('Fehler bei der Anmeldung. Überprüfe deine Eingaben.');
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