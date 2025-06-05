import React, { useState, useEffect } from 'react';
import './App.css';
import './index.css';
import { BrowserRouter, Routes, Route, Link } from 'react-router-dom';
import { Navbar, Container, Nav } from 'react-bootstrap';


/**
 * Hauptkomponente der Anwendung mit Routing und Navigation.
 *
 * Verwaltet den Anmeldestatus und den Benutzernamen im State.
 * Prüft beim Laden, ob ein Token im localStorage vorhanden ist, um den Login-Status zu setzen.
 * Stellt eine Navigationsleiste bereit, die sich dynamisch an den Login-Status anpasst.
 * Definiert die Routen für alle Seiten der Anwendung.
 * Schützt bestimmte Routen (z.B. Profil, Rezept erstellen/bearbeiten) vor unbefugtem Zugriff durch ProtectedRoute-Komponente.
 * Ermöglicht Logout durch Entfernen des Tokens und Weiterleitung zur Login-Seite.
 *
 * @component
 * @returns {JSX.Element} Die komplette App mit Navigation, Routen und Footer
 */


import Home from './pages/Home';
import Login from './pages/Login';
import Register from './pages/Register';
import RecipeList from './pages/Recipes/RecipeList';
import RecipeDetail from './pages/Recipes/RecipeDetail';
import CreateRecipe from './pages/Recipes/CreateRecipe';
import Profile from './pages/Profile';
import EditRecipe from './pages/Recipes/EditRecipe';

// Komponenten
import ProtectedRoute from './components/ProtectedRoute';

export default function App() {
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [username, setUsername] = useState('');

  useEffect(() => {
    // Beim Laden prüfen, ob Token im localStorage ist
    const token = localStorage.getItem('token');
    setIsLoggedIn(!!token);
  }, []);

  const logout = () => {
    localStorage.removeItem('token');
    setIsLoggedIn(false);
    setUsername('');
    window.location.href = '/login'; // Weiterleitung nach Logout
  };

  return (
    <BrowserRouter
      future={{
        v7_startTransition: true,
        v7_relativeSplatPath: true
      }}
    >
      <>
        {/* Navigation */}
        <Navbar expand="lg" className="bg-body-tertiary fixed-top">
          <Container>
            <Navbar.Brand as={Link} to="/">Azubi-Kochbuch</Navbar.Brand>
            <Navbar.Collapse id="basic-navbar-nav">
              <Nav className="me-auto flex gap-6">
                <Nav.Link as={Link} to="/">Home</Nav.Link>
                <Nav.Link as={Link} to="/recipes">Rezepte</Nav.Link>

                {!isLoggedIn && (
                  <>
                    <Nav.Link as={Link} to="/register">Registrieren</Nav.Link>
                    <Nav.Link as={Link} to="/login">Login</Nav.Link>
                  </>
                )}

{isLoggedIn && (
  <>
    <Nav.Link as={Link} to="/profile">Profil</Nav.Link>
    <Nav.Link as={Link} to="/create-recipe">Rezept erstellen</Nav.Link>
    <Nav.Link href="#" onClick={logout}>Logout</Nav.Link>
  </>
)}

              </Nav>
            </Navbar.Collapse>
          </Container>
        </Navbar>

        {/* Hauptinhalt */}
        <main style={{ marginTop: '80px' }} className="container py-4">
          <Routes>
            <Route path="/" element={<Home />} />
            <Route 
              path="/login" 
              element={<Login setIsLoggedIn={setIsLoggedIn} setUsername={setUsername} />} 
            />
            <Route path="/register" element={<Register />} />
            <Route path="/recipes" element={<RecipeList />} />
            <Route path="/recipes/:id" element={<RecipeDetail />} />
            <Route 
              path="/create-recipe" 
              element={
                <ProtectedRoute isLoggedIn={isLoggedIn}>
                  <CreateRecipe />
                </ProtectedRoute>
              } 
            />
            <Route 
              path="/profile" 
              element={
                <ProtectedRoute isLoggedIn={isLoggedIn}>
                  <Profile />
                </ProtectedRoute>
              } 
            />
              <Route
    path="/edit-recipe/:id"
    element={
      <ProtectedRoute isLoggedIn={isLoggedIn}>
        <EditRecipe />
      </ProtectedRoute>
    }
  />
            <Route path="*" element={
              <div className="text-center py-10">
                <h2>Seite nicht gefunden</h2>
                <p>Die gewünschte Seite existiert nicht.</p>
              </div>
            } />
          </Routes>
        </main>

        {/* Footer */}
        <footer className="bg-light py-4 text-center mt-5 border-top">
          <small>© 2025 Intranet-Kochbuch · Alle Rechte vorbehalten</small>
        </footer>
      </>
    </BrowserRouter>
  );
}
