import React, { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';

/**
 * Komponente zum Bearbeiten eines Rezepts.
 * 
 * Lädt das Rezept anhand der ID aus der URL,
 * zeigt ein Formular zum Bearbeiten an und
 * speichert die Änderungen über eine API.
 */
export default function EditRecipe() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [recipe, setRecipe] = useState(null);
  const [error, setError] = useState('');

  /**
   * Lädt das Rezept vom Server, wenn die Komponente gemountet wird oder die ID sich ändert.
   * Verwendet das gespeicherte Token aus localStorage zur Authentifizierung.
   * Bei Erfolg wird das Rezept im State gespeichert,
   * Zutaten werden als mehrzeiliger String dargestellt.
   */
  useEffect(() => {
    const token = localStorage.getItem('token');

    fetch(`${import.meta.env.VITE_API_URL}/api/recipe/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    })
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          setError(data.error);
        } else {
          setRecipe({
            ...data,
            ingredients: Array.isArray(data.ingredients)
              ? data.ingredients.join('\n')  // neue Zeile statt Komma
              : data.ingredients
          });
        }
      });
  }, [id]);

  /**
   * Handler für das Absenden des Formulars.
   * Sendet die geänderten Rezeptdaten per PUT an die API.
   * Zutaten werden als Array erwartet, deshalb Umwandlung aus String.
   * Bei Erfolg wird zur Detailseite des Rezepts navigiert.
   */
  const handleSubmit = (e) => {
    e.preventDefault();
    const token = localStorage.getItem('token');

    fetch(`${import.meta.env.VITE_API_URL}/controllers/recipe/update.php?id=${id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({
        ...recipe,
        ingredients: recipe.ingredients
          .split('\n')              // jede Zeile = ein Eintrag
          .map(i => i.trim())       // trimmt Leerzeichen
          .filter(i => i.length > 0) // entfernt leere Zeilen
      })
    })
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          setError(data.error);
        } else {
          navigate(`/recipes/${id}`);
        }
      });
  };

  /**
   * Handler für Änderungen in den Formularfeldern.
   * Aktualisiert das Rezept im State entsprechend.
   */
  const handleChange = (e) => {
    setRecipe({
      ...recipe,
      [e.target.name]: e.target.value,
    });
  };

  if (!recipe) return <div>Lade Rezept...</div>;

  return (
    <div>
      <h2>Rezept bearbeiten</h2>
      {error && <p style={{ color: 'red' }}>{error}</p>}
      <form onSubmit={handleSubmit}>
        <div>
          <label>Titel:</label>
          <input name="title" value={recipe.title} onChange={handleChange} />
        </div>
        <div>
          <label>Zutaten (mit Kommas trennen):</label>
          <textarea
            name="ingredients"
            value={Array.isArray(recipe.ingredients) ? recipe.ingredients.join(', ') : recipe.ingredients}
            onChange={(e) =>
              setRecipe({ ...recipe, ingredients: e.target.value.split(',').map((i) => i.trim()) })
            }
          />
        </div>
        <div>
          <label>Anleitung:</label>
          <textarea name="instructions" value={recipe.instructions} onChange={handleChange} />
        </div>
        <button type="submit">Speichern</button>
      </form>
    </div>
  );
}
