import axios from 'axios';

const API_URL = import.meta.env.VITE_API_URL;

export const apiClient = axios.create({
  baseURL: `${API_URL}`,
  headers: {
    'Content-Type': 'application/json'
  }
});
export const createRecipe = async (recipeData) => {
  try {
    const response = await apiClient.post('/api/recipes', recipeData);
    return response.data;
  } catch (err) {
    console.error('Fehler beim Speichern:', err.response?.data || err.message);
    throw err;
  }
};
// Interceptor: Token automatisch senden
apiClient.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
}, error => {
  return Promise.reject(error);
});