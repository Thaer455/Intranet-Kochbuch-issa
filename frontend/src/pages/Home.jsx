// src/pages/Home/Home.jsx
import React from 'react';

/**
 * Startseite des Intranet-Kochbuchs.
 * Zeigt eine Begrüßung und das Logo.
 *
 * @component
 * @returns {JSX.Element} Die Home-Komponente mit Begrüßung und Logo
 */
export default function Home() {
  return (
    <div className="container mx-auto p-6">
      <div className="text-center mb-8">
        <h1 className="text-3xl font-bold text-gray-800">Willkommen im Intranet-Kochbuch</h1>
        <p className="mt-4 text-lg text-gray-600">
          Hier findest du alle Rezepte der Auszubildenden – einfach, lecker und von uns für euch.
        </p>
      </div>

      <div className="flex justify-center">
        <img 
          src="/logo.svg" 
          alt="Intranet-Kochbuch Logo" 
          className="w-40 h-40 object-contain"
        />
      </div>
    </div>
  );
}
