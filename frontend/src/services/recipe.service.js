import axios from 'axios';

const API_URL = import.meta.env.VITE_API_URL;

/**
 * Axios-Client für API-Aufrufe mit Basis-URL und JSON-Header.
 * @constant {AxiosInstance}
 */
export const apiClient = axios.create({
  baseURL: `${API_URL}`,
  headers: {
    'Content-Type': 'application/json'
  }
});

/**
 * Erstellt ein neues Rezept.
 * @param {Object} recipeData - Die Rezeptdaten (z.B. Titel, Zutaten, Zubereitung, Bild).
 * @returns {Promise<Object>} Antwortdaten des Servers mit dem gespeicherten Rezept.
 * @throws Fehler, wenn das Speichern des Rezepts fehlschlägt.
 */
export const createRecipe = async (recipeData) => {
  try {
    const response = await apiClient.post('/api/recipe', recipeData);
    return response.data;
  } catch (err) {
    console.error('Fehler beim Speichern:', err.response?.data || err.message);
    throw err;
  }
};

/**
 * Axios-Interceptor fügt automatisch den Authorization-Header mit JWT-Token zu allen Requests hinzu.
 */
apiClient.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
}, error => {
  return Promise.reject(error);
});
