import { Link, NavLink } from 'react-router-dom';
import { useState } from 'react';

export default function Navbar() {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <header className="bg-white shadow-sm">
      <div className="container mx-auto px-4">
        <div className="flex justify-between items-center py-4">
          <Link to="/" className="text-2xl font-bold text-amber-600">
            Azubi-Kochbuch
          </Link>
          
          {/* Desktop Navigation */}
          <nav className="hidden md:flex space-x-6">
            <NavLink 
              to="/recipes" 
              className={({ isActive }) => 
                `hover:text-amber-600 transition ${isActive ? 'text-amber-600 font-medium' : 'text-gray-700'}`
              }
            >
              Rezepte
            </NavLink>
            <NavLink 
              to="/login" 
              className="bg-amber-600 text-white px-4 py-2 rounded-md hover:bg-amber-700 transition"
            >
              Login
            </NavLink>
          </nav>
          
          {/* Mobile Menu Button */}
          <button 
            className="md:hidden text-gray-700 focus:outline-none"
            onClick={() => setIsOpen(!isOpen)}
          >
            <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              {isOpen ? (
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
              ) : (
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
              )}
            </svg>
          </button>
        </div>
        
        {/* Mobile Navigation */}
        {isOpen && (
          <div className="md:hidden pb-4 space-y-2">
            <NavLink 
              to="/recipes" 
              className="block px-3 py-2 rounded hover:bg-gray-100"
              onClick={() => setIsOpen(false)}
            >
              Rezepte
            </NavLink>
            <NavLink 
              to="/login" 
              className="block bg-amber-600 text-white px-3 py-2 rounded text-center"
              onClick={() => setIsOpen(false)}
            >
              Login
            </NavLink>
          </div>
        )}
      </div>
    </header>
  );
}