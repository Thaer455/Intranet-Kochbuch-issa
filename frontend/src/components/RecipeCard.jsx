// src/components/RecipeCard.jsx
import { Link } from 'react-router-dom';

export default function RecipeCard({ recipe }) {
  return (
    <Link 
      to={`/recipes/${recipe.id}`} 
      className="group block rounded-lg overflow-hidden shadow-md hover:shadow-lg transition"
    >
      <div className="relative pb-[60%] bg-gray-200">
        <img 
          src={recipe.image || '/images/placeholder.jpg'} 
          alt={recipe.title}
          className="absolute h-full w-full object-cover"
        />
        {/* Kategorie Label */}
        {recipe.category && (
          <span className="absolute top-2 left-2 bg-amber-500 text-white text-xs px-2 py-1 rounded">
            {recipe.category}
          </span>
        )}
      </div>
      <div className="p-4">
        <h3 className="text-xl font-semibold group-hover:text-amber-600 transition">
          {recipe.title}
        </h3>
        <div className="flex justify-between mt-2 text-sm text-gray-600">
          <span>⏱️ {recipe.time} Min</span>
          <span>⚡ {recipe.difficulty}</span>
        </div>

        {/* Favoriten-Stern */}
        <div className="mt-3 flex justify-end">
          <button 
            type="button" 
            className="bg-white rounded-full p-1 shadow-sm"
            onClick={(e) => {
              e.preventDefault(); // Verhindert Navigation beim Klicken
              // Später: Funktion zum Hinzufügen/Entfernen aus Favoriten
            }}
          >
            <svg 
              className="w-5 h-5 text-amber-500" 
              fill="currentColor" 
              viewBox="0 0 20 20"
            >
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
          </button>
        </div>
      </div>
    </Link>
  );
}