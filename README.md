# Intranet-Kochbuch-issa

Ein webbasiertes Intranet-Kochbuch für Auszubildende. Das Projekt besteht aus einem React-Frontend (Vite + React) und einem PHP-Backend als REST-API. Nutzer können sich registrieren, anmelden, Rezepte erstellen, bearbeiten, ansehen und ihr Profil verwalten.

---

## Projektstruktur
Intranet-Kochbuch-issa/
├── frontend/ ← React-Frontend (Vite + React)
│ ├── public/
│ │ └── favicon.ico
│ ├── src/
│ │ ├── App.jsx
│ │ ├── main.jsx
│ │ ├── index.css
│ │ ├── app.css
│ │ ├── components/
│ │ │ ├── Layout.jsx
│ │ │ ├── Navbar.jsx
│ │ │ └── RecipeCard.jsx
│ │ ├── pages/
│ │ │ ├── Home/
│ │ │ │ └── Home.jsx
│ │ │ ├── Login/
│ │ │ │ └── Login.jsx
│ │ │ ├── Register/
│ │ │ │ └── Register.jsx
│ │ │ ├── Recipes/
│ │ │ │ ├── RecipeList.jsx
│ │ │ │ ├── RecipeDetail.jsx
│ │ │ │ └── CreateRecipe.jsx
│ │ │ └── Profile/
│ │ │ └── Profile.jsx
│ │ └── services/
│ │ ├── auth.service.js
│ │ └── recipe.service.js
│ ├── assets/
│ ├── .env
│ └── package.json
│
├── backend/ ← PHP-Backend (REST API)
│ ├── config/
│ │ └── database.php ← Datenbankverbindung
│ ├── controllers/
│ │ ├── auth/
│ │ │ ├── login.php
│ │ │ └── register.php
│ │ └── recipe/
│ │ ├── create.php
│ │ ├── read.php
│ │ ├── update.php
│ │ └── delete.php
│ ├── middleware/
│ │ └── auth_middleware.php ← JWT-Token Prüfung
│ ├── models/
│ │ ├── User.php
│ │ └── Recipe.php
│ ├── vendor/
│ │ └── autoload.php ← Composer Dependencies (Firebase JWT etc.)
│ ├── .htaccess ← URL-Rewrite für /api/...
│ ├── index.php ← API-Router
│ └── composer.json ← PHP Abhängigkeiten
│
└── README.md 


---

## Features

### Frontend

- React-basierte Single-Page Application (SPA) mit React Router v6
- Benutzerregistrierung und Login mit JWT-Authentifizierung
- Rezeptübersicht, Detailansicht, Erstellen und Bearbeiten von Rezepten
- Profilseite für Benutzer mit Bearbeitungsfunktion
- Geschützte Routen für angemeldete Benutzer (ProtectedRoute-Komponente)
- Responsive Navigation mit React Bootstrap
- State-Management mit React Hooks (`useState`, `useEffect`)
- Passwortregeln bei der Registrierung (mindestens 8 Zeichen, Großbuchstabe, Zahl, Sonderzeichen)

### Backend

- REST API in PHP mit Endpunkten für Authentifizierung und Rezeptverwaltung
- JWT-Token-basierte Authentifizierung und Middleware zum Schutz geschützter Routen
- CRUD-Operationen für Rezepte
- Datenbankanbindung (z.B. MySQL) über `config/database.php`
- Verwendung von Composer für externe PHP-Bibliotheken (z.B. Firebase JWT)

---

⚙️ Installation & Setup
Frontend
Navigate to the frontend directory:
bash


1
cd frontend
Install dependencies:
bash


1
npm install
Start the development server:
bash


1
npm run dev
The app will be available at http://localhost:5173 by default (Vite’s default port).

Backend
Navigate to the backend directory:
bash


1
cd backend
Install Composer dependencies (if not already done):
bash


1
composer install
Start the built-in PHP server:
bash


1
php -S localhost:8000
API endpoints are then accessible under http://localhost:8000/api/....

Alternatively, configure a web server like Apache or Nginx to point to the backend/ directory.

Environment Variables
Frontend
There is a .env file in the frontend that defines the API URL:

env


1
VITE_API_URL=http://localhost:8000
🔐 Make sure this variable is set correctly before building. 

Backend
Backend-specific configurations such as database credentials are defined in backend/config/database.php.

🔒 Password Requirements on Registration
During registration, passwords must meet the following criteria:

At least 8 characters long
At least one uppercase letter
At least one number
At least one special character (!@?$%)
📄 License
This project is licensed under the MIT License .

📬 Contact
For questions or suggestions:

📧 Email: deine.email@example.com
📁 Project repository: [Insert GitHub link here]

© 2025 Intranet-Kochbuch-issa · All rights reserved