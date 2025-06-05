import React, { useEffect, useState } from 'react';

/**
 * Profil-Komponente zum Anzeigen und Bearbeiten der Benutzerdaten.
 *
 * Lädt Profildaten vom Server, zeigt sie an und ermöglicht das Bearbeiten und Speichern.
 *
 * @returns {JSX.Element} Profil-Ansicht mit Bearbeitungsfunktion
 */
export default function Profile() {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [editMode, setEditMode] = useState(false);
  const [formData, setFormData] = useState({ name: '', email: '' });

  // Lädt die Profildaten beim ersten Rendern der Komponente
  useEffect(() => {
    const fetchProfile = async () => {
      const token = localStorage.getItem('token');

      try {
        const response = await fetch(`${import.meta.env.VITE_API_URL}/controllers/user/profile.php`, {
          method: 'GET',
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
          }
        });

        if (!response.ok) {
          throw new Error('Fehler bei der Anfrage');
        }

        const data = await response.json();
        setUser(data.user);
        setFormData({ name: data.user.name, email: data.user.email });

      } catch (err) {
        console.error('Profil konnte nicht geladen werden:', err.message);
        setError('Fehler beim Laden des Profils.');
      } finally {
        setLoading(false);
      }
    };

    fetchProfile();
  }, []);

  /**
   * Aktualisiert die Formulardaten beim Ändern eines Eingabefelds.
   *
   * @param {React.ChangeEvent<HTMLInputElement>} e - Change Event des Eingabefeldes
   */
  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  /**
   * Speichert die bearbeiteten Profildaten auf dem Server.
   */
  const handleSave = async () => {
    const token = localStorage.getItem('token');
    try {
      const response = await fetch(`${import.meta.env.VITE_API_URL}/controllers/user/profile.php`, {
        method: 'PUT',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
      });

      if (!response.ok) {
        throw new Error('Fehler beim Aktualisieren');
      }

      const data = await response.json();
      setUser(data.user);
      setEditMode(false);
    } catch (err) {
      console.error('Profil konnte nicht gespeichert werden:', err.message);
      setError('Fehler beim Speichern.');
    }
  };

  if (loading) return <p>Lade Profildaten...</p>;
  if (error) return <div className="text-red-500">{error}</div>;

  return (
    <div className="container mx-auto p-6">
      <div className="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 className="text-2xl font-bold text-gray-800 mb-4">Mein Profil</h1>

        <div className="space-y-4">
          <div>
            <label className="block text-sm font-medium text-gray-500">Benutzername</label>
            {editMode ? (
              <input
                type="text"
                name="name"
                value={formData.name}
                onChange={handleChange}
                className="mt-1 block w-full border rounded p-2"
              />
            ) : (
              <p className="mt-1 text-gray-800">{user.name}</p>
            )}
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-500">E-Mail-Adresse</label>
            {editMode ? (
              <input
                type="email"
                name="email"
                value={formData.email}
                onChange={handleChange}
                className="mt-1 block w-full border rounded p-2"
              />
            ) : (
              <p className="mt-1 text-gray-800">{user.email}</p>
            )}
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-500">Mitglied seit</label>
            <p className="mt-1 text-gray-800">
              {new Date(user.created_at).toLocaleDateString('de-DE', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
              })}
            </p>
          </div>
        </div>

        <div className="mt-6 space-x-4">
          {editMode ? (
            <>
              <button
                onClick={handleSave}
                className="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition"
              >
                Speichern
              </button>
              <button
                onClick={() => setEditMode(false)}
                className="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-4 rounded transition"
              >
                Abbrechen
              </button>
            </>
          ) : (
            <button
              onClick={() => setEditMode(true)}
              className="bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded transition"
            >
              Profil bearbeiten
            </button>
          )}
        </div>
      </div>
    </div>
  );
}
