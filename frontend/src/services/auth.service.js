import axios from 'axios';

const API_URL = import.meta.env.VITE_API_URL;

// Axios-Instanz mit Basis-URL erstellen
const apiClient = axios.create({
  baseURL: `${API_URL}`,
  headers: {
    'Content-Type': 'application/json'
  }
});

// Nutzer registrieren
export const register = async (email, password, name) => {
  try {
    const response = await apiClient.post('/api/auth/register', { email, password, name });
    return response.data;
  } catch (error) {
    console.error('Registrierung fehlgeschlagen:', error.response?.data || error.message);
    throw error;
  }
};

// Nutzer anmelden
export const login = async (email, password) => {
  try {
    const response = await apiClient.post('/api/auth/login', { email, password });
    return response.data;
  } catch (error) {
    console.error('Login fehlgeschlagen:', error.response?.data || error.message);
    throw error;
  }
};

// Token speichern
export const storeUserData = (token, user) => {
  localStorage.setItem('token', token);
  localStorage.setItem('user', JSON.stringify(user));
};

// Token löschen
export const removeToken = () => {
  localStorage.removeItem('token');
  localStorage.removeItem('user');
};

// Token prüfen
export const getToken = () => {
  return localStorage.getItem('token');
};

export const isLoggedIn = () => {
  return !!getToken();
};

export const getCurrentUser = () => {
  return JSON.parse(localStorage.getItem('user'));
};