import React from 'react';
import { useParams } from 'react-router-dom';

export default function RecipeDetail() {
  const { id } = useParams(); // Holen der Rezept-ID aus der URL

  // Simuliere Rezeptdaten – später durch API-Daten ersetzen
  const recipe = {
    id: id,
    title: 'Leckere Nudelpfanne',
    ingredients: ['200g Nudeln', '1 Paprika', '1 Zwiebel', '2 Knoblauchzehen', 'Tomatenmark', 'Salz & Pfeffer'],
    instructions: '1. Nudeln kochen.\n2. Gemüse anbraten.\n3. Tomatenmark hinzufügen.\n4. Mit Salz & Pfeffer würzen.\n5. Alles zusammen servieren.',
    time: 30,
    difficulty: 'mittel',
    image: 'https://via.placeholder.com/600x400 ',
    author: 'Max Mustermann',
    createdAt: '2025-05-10'
  };

  return (
    <div className="container mx-auto p-6">
      {/* Rezept-Titel */}
      <h1 className="text-3xl font-bold text-gray-800 mb-2">{recipe.title}</h1>
      <p className="text-sm text-gray-600 mb-6">von {recipe.author} am {new Date(recipe.createdAt).toLocaleDateString('de-DE')}</p>

      {/* Bild */}
      <div className="mb-6 rounded-lg overflow-hidden shadow-md">
        <img 
          src={recipe.image} 
          alt={recipe.title}
          className="w-full h-auto object-cover"
        />
      </div>

      {/* Info-Zusammenfassung */}
      <div className="flex flex-wrap gap-4 mb-6 text-sm text-gray-700">
        <span className="bg-amber-100 text-amber-800 px-3 py-1 rounded-full">⏱️ {recipe.time} Min</span>
        <span className="bg-amber-100 text-amber-800 px-3 py-1 rounded-full">⚡ {recipe.difficulty}</span>
      </div>

      {/* Zutaten */}
      <div className="mb-6">
        <h2 className="text-xl font-semibold text-gray-700 mb-2">Zutaten</h2>
        <ul className="list-disc pl-5 space-y-1">
          {recipe.ingredients.map((ingredient, index) => (
            <li key={index} className="text-gray-800">{ingredient}</li>
          ))}
        </ul>
      </div>

      {/* Zubereitung */}
      <div className="mb-6">
        <h2 className="text-xl font-semibold text-gray-700 mb-2">Zubereitung</h2>
        <ol className="list-decimal pl-5 space-y-2 text-gray-800">
          {recipe.instructions.split('\n').map((step, index) => (
            <li key={index}>{step}</li>
          ))}
        </ol>
      </div>

      {/* Aktionen (später erweiterbar) */}
      <div className="flex gap-4 mt-8">
        <button className="bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded transition">
          Rezept bearbeiten
        </button>
        <button className="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded transition">
          Rezept löschen
        </button>
      </div>
    </div>
  );
}