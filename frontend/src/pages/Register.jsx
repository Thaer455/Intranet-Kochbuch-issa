// src/pages/Register/Register.jsx
import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

export default function Register() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const validatePassword = (password) => {
    const hasUpperCase = /[A-Z]/.test(password);
    const hasNumber = /\d/.test(password);
    const hasSpecialChar = /[!@$%?]/.test(password);
    return password.length >= 8 && hasUpperCase && hasNumber && hasSpecialChar;
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    if (!validatePassword(password)) {
      setError('Passwort muss mindestens 8 Zeichen enthalten, einen Großbuchstaben, eine Zahl und ein Sonderzeichen (!@$%?).');
      return;
    }

    if (password !== confirmPassword) {
      setError('Die Passwörter stimmen nicht überein.');
      return;
    }

    // Simuliere Registrierung – später durch API ersetzen
    console.log('Registriert:', { email });

    // Weiterleitung zur Login-Seite
    navigate('/login');
  };

  return (
    <div className="container mx-auto p-6 max-w-md">
      <h2 className="text-2xl font-bold mb-4">Registrieren</h2>

      {error && <p className="text-red-500 mb-4">{error}</p>}

      <form onSubmit={handleSubmit} className="space-y-4">
        <div>
          <label className="block text-gray-700 mb-1" htmlFor="email">
            E-Mail-Adresse
          </label>
          <input
            id="email"
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
            className="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500"
            placeholder="deine@email.de"
          />
        </div>

        <div>
          <label className="block text-gray-700 mb-1" htmlFor="password">
            Passwort
          </label>
          <input
            id="password"
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
            className="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500"
            placeholder="••••••••"
          />
        </div>

        <div>
          <label className="block text-gray-700 mb-1" htmlFor="confirmPassword">
            Passwort bestätigen
          </label>
          <input
            id="confirmPassword"
            type="password"
            value={confirmPassword}
            onChange={(e) => setConfirmPassword(e.target.value)}
            required
            className="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500"
            placeholder="••••••••"
          />
        </div>

        <button
          type="submit"
          className="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded-md transition"
        >
          Registrieren
        </button>
      </form>

      <div className="mt-4 text-center">
        <p className="text-sm text-gray-600">
          Hast du bereits einen Account?{' '}
          <a href="/login" className="text-amber-600 hover:underline">
            Melde dich hier an
          </a>
        </p>
      </div>
    </div>
  );
}