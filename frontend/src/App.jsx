import React, { useState } from 'react';
import './App.css';
import './index.css';
import { BrowserRouter, Routes, Route, Link } from 'react-router-dom';
import { Navbar, Container, Nav } from 'react-bootstrap';

// Seiten
import Home from './pages/Home';
import Login from './pages/Login';
import Register from './pages/Register';
import RecipeList from './pages/Recipes/RecipeList';
import RecipeDetail from './pages/Recipes/RecipeDetail';
import CreateRecipe from './pages/Recipes/CreateRecipe';
import Profile from './pages/Profile';

// Komponenten
import ProtectedRoute from './components/ProtectedRoute';

export default function App() {
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [username, setUsername] = useState('');

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
                <Nav.Link as={Link} to="/register">Registrieren</Nav.Link>
                <Nav.Link as={Link} to="/login">Login</Nav.Link>
                <Nav.Link as={Link} to="/profile">Profil</Nav.Link>
                <Nav.Link as={Link} to="/create-recipe">Rezept erstellen</Nav.Link>
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
