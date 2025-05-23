// src/pages/Login/Login.jsx
import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

export default function Login() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const handleSubmit = (e) => {
    e.preventDefault();
    
    // Simuliere Login (später durch API ersetzen)
    if (email === 'test@example.com' && password === 'Pass123!') {
      // Simuliere Token-Speicherung
      localStorage.setItem('token', 'dummy-jwt-token');
      localStorage.setItem('userId', '1');
      
      // Weiterleitung zur Startseite
      navigate('/');
    } else {
      setError('E-Mail oder Passwort falsch.');
    }
  };

  return (
    <div className="container mx-auto p-6 max-w-md">
      <h2 className="text-2xl font-bold mb-4">Login</h2>
      
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

        <button
          type="submit"
          className="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded-md transition"
        >
          Anmelden
        </button>
      </form>

      <div className="mt-4 text-center">
        <p className="text-sm text-gray-600">
          Noch keinen Account?{' '}
          <a href="/register" className="text-amber-600 hover:underline">
            Registriere dich hier
          </a>
        </p>
      </div>
    </div>
  );
}