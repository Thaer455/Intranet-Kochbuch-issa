import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';

/**
 * Zeigt eine Liste aller Rezepte an.
 * Lädt die Rezepte vom Server und stellt sie als Kacheln dar.
 * Jedes Rezept kann zur Detailseite geöffnet werden.
 * 
 * @component
 * @returns {JSX.Element} Die Rezeptliste
 */
export default function RecipeList() {
  const [recipes, setRecipes] = useState([]);
  const [error, setError] = useState(null);
  const token = localStorage.getItem('token');

  useEffect(() => {
    // Lädt Rezepte vom Backend
    fetch(`${import.meta.env.VITE_API_URL}/controllers/recipe/read.php`)
      .then(res => res.json())
      .then(data => {
        if (Array.isArray(data)) {
          setRecipes(data);
        } else {
          console.error("Unerwartetes Ergebnis vom Server:", data);
          setRecipes([]); // optional
        }
      })
      .catch(err => {
        console.error("Fehler beim Laden der Rezepte:", err);
      });
  }, []);

  if (error) {
    // Zeigt Fehlermeldung im UI an
    return <p className="text-red-600">{error}</p>;
  }

  return (
    <div className="container mx-auto px-4 py-8">
      <h1 className="text-3xl font-bold text-center mb-8">Alle Rezepte</h1>

      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        {recipes.map((recipe) => (
          <Link
            to={`/recipes/${recipe.id}`}
            key={recipe.id}
            className="block rounded-lg shadow-md hover:shadow-lg transition duration-300 bg-white overflow-hidden"
          >
            <img
              src={recipe.image || 'https://via.placeholder.com/600x400'}
              alt={recipe.title}
              style={{ width: '300px', height: '200px', objectFit: 'cover' }}
              className="w-full h-48 object-cover"
            />
            <div className="p-4">
              <h2 className="text-xl font-semibold text-gray-800">{recipe.title}</h2>
              <p className="text-gray-600 text-sm mt-2">
                Dauer: {recipe.time} Minuten
              </p>
              <p className="text-gray-600 text-sm">Schwierigkeit: {recipe.difficulty}</p>
            </div>
          </Link>
        ))}
      </div>
    </div>
  );
}
