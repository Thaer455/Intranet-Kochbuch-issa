// src/pages/Recipes/CreateRecipe.jsx
import React, { useState } from 'react';

export default function CreateRecipe() {
  const [title, setTitle] = useState('');
  const [ingredients, setIngredients] = useState('');
  const [instructions, setInstructions] = useState('');
  const [time, setTime] = useState(30);
  const [difficulty, setDifficulty] = useState('mittel');
  const [image, setImage] = useState('');
  const [error, setError] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();

    if (!title.trim()) {
      setError('Bitte gib einen Titel für dein Rezept ein.');
      return;
    }

    if (!ingredients.trim()) {
      setError('Bitte füge eine Zutatenliste hinzu.');
      return;
    }

    if (!instructions.trim()) {
      setError('Bitte beschreibe die Zubereitungsschritte.');
      return;
    }

    // Simuliere Rezept speichern
    const newRecipe = {
      id: Date.now(),
      title,
      ingredients: ingredients.split('\n'),
      instructions,
      time,
      difficulty,
      image: image || '/images/placeholder.jpg',
    };

    console.log('Neues Rezept:', newRecipe);

    // Später: API-Aufruf oder Speicherung in Context / Zustand

    alert('Rezept gespeichert!');
  };

  return (
    <div className="container mx-auto p-6 max-w-2xl">
      <h1 className="text-2xl font-bold mb-6">Neues Rezept erstellen</h1>

      {error && <p className="text-red-500 mb-4">{error}</p>}

      <form onSubmit={handleSubmit} className="space-y-6">
        {/* Titel */}
        <div>
          <label htmlFor="title" className="block text-gray-700 font-medium mb-1">
            Rezept-Titel *
          </label>
          <input
            id="title"
            type="text"
            value={title}
            onChange={(e) => setTitle(e.target.value)}
            placeholder="z.B. Leckere Nudelpfanne"
            className="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500"
            required
          />
        </div>

        {/* Zutaten */}
        <div>
          <label htmlFor="ingredients" className="block text-gray-700 font-medium mb-1">
            Zutaten (jeweils eine Zeile) *
          </label>
          <textarea
            id="ingredients"
            rows="5"
            value={ingredients}
            onChange={(e) => setIngredients(e.target.value)}
            placeholder="Zutat 1&#10;Zutat 2&#10;Zutat 3"
            className="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500"
            required
          ></textarea>
        </div>

        {/* Zubereitung */}
        <div>
          <label htmlFor="instructions" className="block text-gray-700 font-medium mb-1">
            Zubereitung *
          </label>
          <textarea
            id="instructions"
            rows="8"
            value={instructions}
            onChange={(e) => setInstructions(e.target.value)}
            placeholder="Schritt-für-Schritt-Anleitung..."
            className="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500"
            required
          ></textarea>
        </div>

        {/* Zubereitungszeit & Schwierigkeit */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label htmlFor="time" className="block text-gray-700 font-medium mb-1">
              Zubereitungszeit (Minuten)
            </label>
            <input
              id="time"
              type="number"
              min="5"
              max="300"
              step="5"
              value={time}
              onChange={(e) => setTime(parseInt(e.target.value))}
              className="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500"
            />
          </div>

          <div>
            <label htmlFor="difficulty" className="block text-gray-700 font-medium mb-1">
              Schwierigkeitsgrad
            </label>
            <select
              id="difficulty"
              value={difficulty}
              onChange={(e) => setDifficulty(e.target.value)}
              className="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500"
            >
              <option value="leicht">leicht</option>
              <option value="mittel">mittel</option>
              <option value="schwer">schwer</option>
            </select>
          </div>
        </div>

        {/* Bild URL */}
        <div>
          <label htmlFor="image" className="block text-gray-700 font-medium mb-1">
            Bild-URL (optional)
          </label>
          <input
            id="image"
            type="text"
            value={image}
            onChange={(e) => setImage(e.target.value)}
            placeholder="public/images/placeholder.jpg" 
            className="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500"
          />
        </div>

        {/* Submit Button */}
        <div className="pt-4">
          <button
            type="submit"
            className="bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-6 rounded transition"
          >
            Rezept veröffentlichen
          </button>
        </div>
      </form>
    </div>
  );
}