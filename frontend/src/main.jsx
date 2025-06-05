import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';

/**
 * Einstiegspunkt der React-Anwendung.
 * 
 * Rendert die Hauptkomponente <App /> in das HTML-Element mit der ID "root".
 * Umfasst die Anwendung mit React.StrictMode für zusätzliche Prüfungen und Warnungen während der Entwicklung.
 */


const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);