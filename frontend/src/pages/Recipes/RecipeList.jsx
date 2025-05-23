// src/pages/Recipes/RecipeList.jsx
import React from 'react';
import RecipeCard from '../../components/RecipeCard';

export default function RecipeList() {
  // Dummy-Rezeptdaten – später durch API-Daten ersetzen
  const recipes = [
    {
      id: 1,
      title: "Pasta Carbonara",
      image: "/images/carbonara.jpg", // Achte darauf, dass das Bild im /public/images-Ordner liegt
      time: 20,
      difficulty: "Mittel"
    },
    {
      id: 2,
      title: "Vegetarische Lasagne",
      image: "/images/lasagne.jpg ",
      time: 45,
      difficulty: "Mittel"
    },
    {
      id: 3,
      title: "Schnelle Tomatensuppe",
      image: "https://picsum.photos/id/260/600/400 ",
      time: 30,
      difficulty: "Leicht"
    }
  ];

  return (
    <div className="container mx-auto p-6">
      <h1 className="text-3xl font-bold mb-8">Alle Rezepte</h1>

      {recipes.length === 0 ? (
        <p className="text-gray-600">Keine Rezepte gefunden.</p>
      ) : (
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {recipes.map(recipe => (
            <RecipeCard key={recipe.id} recipe={recipe} />
          ))}
        </div>
      )}
    </div>
  );
}