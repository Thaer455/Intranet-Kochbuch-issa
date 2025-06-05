import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { register } from '../services/auth.service';


/**
 * Register-Komponente für die Benutzerregistrierung.
 *
 * Zeigt ein Formular an, in dem Benutzer ihren Benutzernamen, ihre E-Mail-Adresse,
 * ein Passwort und die Passwortbestätigung eingeben können.
 * 
 * Validiert das Passwort auf Mindestanforderungen (mind. 8 Zeichen, Großbuchstabe, Zahl, Sonderzeichen).
 * Prüft, ob die Passwörter übereinstimmen.
 * Sendet die Registrierungsdaten an den Server über die `register`-Funktion.
 * Navigiert nach erfolgreicher Registrierung zur Login-Seite.
 *
 * Fehler beim Validieren oder Registrieren werden dem Benutzer angezeigt.
 *
 * @component
 * @returns {JSX.Element} Registrierungsformular
 */



export default function Register() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [name, setName] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const validatePassword = (password) => {
    const hasUpperCase = /[A-Z]/.test(password);
    const hasNumber = /\d/.test(password);
    const hasSpecialChar = /[!@$%?]/.test(password);
    return password.length >= 8 && hasUpperCase && hasNumber && hasSpecialChar;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (!validatePassword(password)) {
      setError('Passwort muss mindestens 8 Zeichen enthalten, einen Großbuchstaben, eine Zahl und ein Sonderzeichen (!@$%?).');
      return;
    }

    if (password !== confirmPassword) {
      setError('Die Passwörter stimmen nicht überein.');
      return;
    }

    try {
      const res = await register(email, password, name || email.split('@')[0]);

      if (res.message === 'Erfolgreich registriert') {
        navigate('/login');
      }
    } catch (err) {
      console.error('Fehler beim Registrieren:', err.response?.data || err.message);
      setError('Fehler bei der Registrierung – prüfe deine Eingabe oder melde dich später erneut an.');
    }
  };

  return (
    <div className="container mx-auto p-6 max-w-md">
      <h2 className="text-2xl font-bold mb-4">Registrieren</h2>

      {error && <p className="text-red-500 mb-4">{error}</p>}

      <form onSubmit={handleSubmit} className="space-y-4">
                {/* Name */}
        <div>
          <label htmlFor="name" className="block text-gray-700 mb-1">Benutzername</label>
          <input
            id="name"
            type="text"
            value={name}
            onChange={(e) => setName(e.target.value)}
            required
            className="w-full px-4 py-2 border rounded focus:outline-none focus:ring-amber-500"
            placeholder="Max.Mustermann"
          />
          <small className="text-gray-500 mt-1 block">
            Dein Name wird angezeigt – z. B. „Max.Mustermann“
          </small>
        </div>
        
        {/* E-Mail */}
        <div>
          <label htmlFor="email" className="block text-gray-700 mb-1">E-Mail-Adresse</label>
          <input
            id="email"
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
            className="w-full px-4 py-2 border rounded focus:outline-none focus:ring-amber-500"
            placeholder="deine@email.de"
          />
        </div>



        {/* Passwort */}
        <div>
          <label htmlFor="password" className="block text-gray-700 mb-1">Passwort</label>
          <input
            id="password"
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
            className="w-full px-4 py-2 border rounded focus:outline-none focus:ring-amber-500"
            placeholder="••••••••"
          />
        </div>

        {/* Passwort bestätigen */}
        <div>
          <label htmlFor="confirmPassword" className="block text-gray-700 mb-1">Passwort bestätigen</label>
          <input
            id="confirmPassword"
            type="password"
            value={confirmPassword}
            onChange={(e) => setConfirmPassword(e.target.value)}
            required
            className="w-full px-4 py-2 border rounded focus:outline-none focus:ring-amber-500"
            placeholder="••••••••"
          />
        </div>

        {/* Submit Button */}
        <button
          type="submit"
          className="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded transition"
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