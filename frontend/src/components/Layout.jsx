// src/components/Layout.jsx
import { Outlet } from 'react-router-dom';

export default function Layout() {
  return (
    <div>
      {/* Header oder Navigation */}
      <header>
        <h1>Mein Kochbuch</h1>
      </header>

      {/* Hauptinhalt der aktuellen Route */}
      <main>
        <Outlet />
      </main>

      {/* Footer */}
      <footer>
        <p>© 2025 Intranet-Kochbuch</p>
      </footer>
    </div>
  );
}