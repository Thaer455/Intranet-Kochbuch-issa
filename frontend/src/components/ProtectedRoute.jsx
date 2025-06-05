import React from 'react';
import { Navigate } from 'react-router-dom';

/**
 * Schützt eine Route, indem überprüft wird, ob ein Auth-Token vorhanden ist.
 * Falls kein Token vorhanden ist, wird auf die Login-Seite umgeleitet.
 * 
 * @param {Object} props
 * @param {React.ReactNode} props.children - Die geschützten Komponenten, die gerendert werden sollen, wenn der Nutzer eingeloggt ist.
 * @returns {React.ReactNode} Die geschützten Kinder oder eine Weiterleitung zur Login-Seite.
 */
export default function ProtectedRoute({ children }) {
  const token = localStorage.getItem('token');

  if (!token) {
    return <Navigate to="/login" replace />;
  }

  return children;
}
