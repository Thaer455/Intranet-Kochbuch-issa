import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { login, storeUserData } from '../services/auth.service';

/**
 * Login-Komponente für die Benutzeranmeldung.
 *
 * @param {Object} props
 * @param {function} props.setIsLoggedIn - Funktion zum Setzen des Login-Status im Parent-Component.
 * @param {function} props.setUsername - Funktion zum Setzen des Benutzernamens im Parent-Component.
 * @returns {JSX.Element} Das Login-Formular
 */
export default function Login({ setIsLoggedIn, setUsername }) {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const navigate = useNavigate();

  /**
   * Behandelt das Abschicken des Login-Formulars.
   * Führt den Login durch, speichert Token und Benutzerdaten und navigiert zur Startseite.
   *
   * @param {React.FormEvent<HTMLFormElement>} e - Formular-Submit-Event
   */
  const handleLogin = async (e) => {
    e.preventDefault();

    try {
      const data = await login(email, password);

      if (data.success) {
        // Token + Benutzerdaten speichern
        storeUserData(data.token, data.user);

        // Zustand im Parent aktualisieren
        setIsLoggedIn(true);
        setUsername(data.user.name || data.user.email);

        // Zur Startseite weiterleiten
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
