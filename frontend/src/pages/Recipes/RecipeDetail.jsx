import React, { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';

/**
 * Komponente zur Anzeige der Detailansicht eines Rezepts.
 * 
 * Lädt das Rezept sowie den Ersteller anhand der ID aus der URL.
 * Zeigt Rezeptinformationen, Zutaten und Zubereitung an.
 * Bietet dem Rezept-Ersteller die Möglichkeit, das Rezept zu bearbeiten oder zu löschen.
 */
export default function RecipeDetail() {
  const { id } = useParams();
  const navigate = useNavigate();
  const token = localStorage.getItem('token');

  const [creator, setCreator] = useState(null);
  const [recipe, setRecipe] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Aktuell eingeloggter Benutzer (userId aus localStorage)
  const storedUserId = localStorage.getItem('userId');
  const currentUserId = storedUserId ? parseInt(storedUserId, 10) : null;

  /**
   * Lädt das Rezept und den Ersteller vom Server.
   * Verwendet das gespeicherte Token zur Authentifizierung.
   * Parst Zutaten aus JSON-String, falls notwendig.
   */
  useEffect(() => {
    setLoading(true);
    setError(null);

    fetch(`${import.meta.env.VITE_API_URL}/controllers/recipe/read.php?id=${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    })
      .then(res => {
        if (!res.ok) throw new Error(`HTTP Fehler: ${res.status}`);
        return res.json();
      })
      .then(data => {
        if (data.error) throw new Error(data.error);

        if (data.ingredients && typeof data.ingredients === 'string') {
          try {
            data.ingredients = JSON.parse(data.ingredients);
          } catch {
            data.ingredients = [data.ingredients];
          }
        }

        setRecipe(data);
        setLoading(false);

        if (data.user_id) {
          return fetch(`${import.meta.env.VITE_API_URL}/controllers/user/get_user.php?id=${data.user_id}`, {
            headers: { Authorization: `Bearer ${token}` }
          });
        }
        return null;
      })
      .then(res => {
        if (res && res.ok) return res.json();
        return null;
      })
      .then(userData => {
        if (userData && !userData.error) setCreator(userData);
      })
      .catch(err => {
        setError(err.message);
        setLoading(false);
      });
  }, [id, token]);

  /**
   * Navigiert zur Bearbeitungsseite für das aktuelle Rezept.
   */
  const handleEdit = () => {
    if (recipe) {
      navigate(`/edit-recipe/${recipe.id}`);
    }
  };

  /**
   * Löscht das aktuelle Rezept nach Bestätigung.
   * Navigiert anschließend zurück zur Rezeptübersicht.
   */
  const handleDelete = () => {
    if (!window.confirm('Möchten Sie dieses Rezept wirklich löschen?')) return;

    fetch(`${import.meta.env.VITE_API_URL}/controllers/recipe/delete.php?id=${id}`, {
      method: 'DELETE',
      headers: { Authorization: `Bearer ${token}` }
    })
      .then(res => {
        if (!res.ok) {
          return res.json().then(data => {
            throw new Error(data.error || 'Löschen fehlgeschlagen');
          });
        }
        return res.json();
      })
      .then(data => {
        alert(data.message || 'Rezept erfolgreich gelöscht');
        navigate('/recipes');
      })
      .catch(err => alert('Fehler beim Löschen: ' + err.message));
  };

  if (loading) return <p>Lädt...</p>;
  if (error) return <p className="text-red-600">Fehler: {error}</p>;
  if (!recipe) return <p className="text-red-600">Rezept nicht gefunden.</p>;

  return (
    <div className="container mx-auto p-6">
      <h1 className="text-3xl font-bold text-gray-800 mb-2">{recipe.title}</h1>

      <p className="text-sm text-gray-600 mb-6">
        von Benutzer <strong>{creator?.name || `#${recipe.user_id}`}</strong> am {new Date(recipe.created_at).toLocaleDateString('de-DE')}
      </p>

      <div className="mb-6 rounded-lg overflow-hidden shadow-md">
        <img src={recipe.image || 'https://via.placeholder.com/600x400'} alt={recipe.title} className="w-full h-auto object-cover" />
      </div>

      <div className="flex flex-wrap gap-4 mb-6 text-sm text-gray-700">
        <span className="bg-amber-100 text-amber-800 px-3 py-1 rounded-full">⏱️ {recipe.time} Min</span>
        <span className="bg-amber-100 text-amber-800 px-3 py-1 rounded-full">⚡ {recipe.difficulty}</span>
      </div>

      <div className="mb-6">
        <h2 className="text-xl font-semibold text-gray-700 mb-2">Zutaten</h2>
        <ul className="list-disc pl-5 space-y-1">
          {Array.isArray(recipe.ingredients)
            ? recipe.ingredients.map((ingredient, index) => (
                <li key={index} className="text-gray-800">{ingredient}</li>
              ))
            : <li className="text-gray-800">{recipe.ingredients}</li>}
        </ul>
      </div>

      <div className="mb-6">
        <h2 className="text-xl font-semibold text-gray-700 mb-2">Zubereitung</h2>
        <ol className="list-decimal pl-5 space-y-2 text-gray-800">
          {recipe.instructions?.split('\n').map((step, index) => (
            <li key={index}>{step}</li>
          ))}
        </ol>
      </div>

      {recipe && currentUserId === Number(recipe.user_id) && (
        <div className="flex gap-4 mt-8">
          <button
            onClick={handleEdit}
            className="bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded transition"
          >
            Rezept bearbeiten
          </button>
          <button
            onClick={handleDelete}
            className="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded transition"
          >
            Rezept löschen
          </button>
        </div>
      )}
    </div>
  );
}
