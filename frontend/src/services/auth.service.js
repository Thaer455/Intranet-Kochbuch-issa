import axios from 'axios';

const API_URL = import.meta.env.VITE_API_URL;

const apiClient = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json'
  }
});

/**
 * Registriert einen neuen Nutzer mit E-Mail, Passwort und Namen.
 * @param {string} email - Die E-Mail-Adresse des Nutzers.
 * @param {string} password - Das Passwort des Nutzers.
 * @param {string} name - Der Anzeigename des Nutzers.
 * @returns {Promise<Object>} Antwortdaten des Servers bei erfolgreicher Registrierung.
 * @throws Fehler, wenn die Registrierung fehlschlägt.
 */
export const register = async (email, password, name) => {
  try {
    const response = await apiClient.post('/api/auth/register', { email, password, name });
    return response.data;
  } catch (error) {
    console.error('Registrierung fehlgeschlagen:', error.response?.data || error.message);
    throw error;
  }
};

/**
 * Meldet einen Nutzer mit E-Mail und Passwort an.
 * @param {string} email - Die E-Mail-Adresse des Nutzers.
 * @param {string} password - Das Passwort des Nutzers.
 * @returns {Promise<Object>} Antwortdaten des Servers bei erfolgreichem Login.
 * @throws Fehler, wenn die Anmeldung fehlschlägt.
 */
export const login = async (email, password) => {
  try {
    const response = await apiClient.post('/api/auth/login', { email, password });
    return response.data;
  } catch (error) {
    console.error('Login fehlgeschlagen:', error.response?.data || error.message);
    throw error;
  }
};

/**
 * Speichert Token und Nutzerdaten lokal im Browser.
 * @param {string} token - Das Authentifizierungs-Token.
 * @param {Object} user - Das Nutzerobjekt mit Nutzerdaten.
 */
export const storeUserData = (token, user) => {
  localStorage.setItem('token', token);
  localStorage.setItem('user', JSON.stringify(user));
  localStorage.setItem('userId', user.id); // ✅ User-ID separat speichern
};

/**
 * Entfernt Token und Nutzerdaten aus dem lokalen Speicher.
 */
export const removeToken = () => {
  localStorage.removeItem('token');
  localStorage.removeItem('user');
  localStorage.removeItem('userId');
};

/**
 * Ruft das aktuell gespeicherte Token ab.
 * @returns {string|null} Das gespeicherte Token oder null, falls kein Token vorhanden ist.
 */
export const getToken = () => localStorage.getItem('token');

/**
 * Prüft, ob ein Nutzer eingeloggt ist (ob ein Token vorhanden ist).
 * @returns {boolean} true, wenn ein Token vorhanden ist, sonst false.
 */
export const isLoggedIn = () => !!getToken();

/**
 * Ruft den aktuell angemeldeten Nutzer aus dem lokalen Speicher ab.
 * @returns {Object|null} Das Nutzerobjekt oder null, falls kein Nutzer gespeichert ist.
 */
export const getCurrentUser = () => {
  const user = localStorage.getItem('user');
  return user ? JSON.parse(user) : null;
};

/**
 * Ruft die aktuelle Nutzer-ID aus dem lokalen Speicher ab.
 * @returns {number|null} Die Nutzer-ID als Zahl oder null, falls keine ID gespeichert ist.
 */
export const getCurrentUserId = () => {
  const id = localStorage.getItem('userId');
  return id ? parseInt(id) : null;
};
