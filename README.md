
## Intranet-Kochbuch-issa

Ein webbasiertes Intranet-Kochbuch für Auszubildende. Das Projekt besteht aus einem React-Frontend (Vite + React) und einem PHP-Backend als REST-API. Nutzer:innen können sich registrieren, anmelden, Rezepte erstellen, bearbeiten, ansehen und ihr Profil verwalten.

## 📁 Projektstruktur

```
Intranet-Kochbuch-issa/
├── frontend/                  ← React-Frontend (Vite + React)
│   ├── public/
│   │   └── favicon.ico
│   ├── src/
│   │   ├── App.jsx
│   │   ├── main.jsx
│   │   ├── index.css
│   │   ├── app.css
│   │   ├── components/
│   │   │   ├── Layout.jsx
│   │   │   ├── Navbar.jsx
│   │   │   └── RecipeCard.jsx
│   │   ├── pages/
│   │   │   ├── Home/
│   │   │   │   └── Home.jsx
│   │   │   ├── Login/
│   │   │   │   └── Login.jsx
│   │   │   ├── Register/
│   │   │   │   └── Register.jsx
│   │   │   ├── Recipes/
│   │   │   │   ├── RecipeList.jsx
│   │   │   │   ├── RecipeDetail.jsx
│   │   │   │   └── CreateRecipe.jsx
│   │   │   └── Profile/
│   │   │       └── Profile.jsx
│   │   └── services/
│   │       ├── auth.service.js
│   │       └── recipe.service.js
│   ├── assets/
│   ├── .env
│   └── package.json
│
├── backend/                   ← PHP-Backend (REST API)
│   ├── config/
│   │   └── database.php        ← Datenbankverbindung
│   ├── controllers/
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   └── recipe/
│   │       ├── create.php
│   │       ├── read.php
│   │       ├── update.php
│   │       └── delete.php
│   ├── middleware/
│   │   └── auth_middleware.php  ← JWT-Token Prüfung
│   ├── models/
│   │   ├── User.php
│   │   └── Recipe.php
│   ├── vendor/
│   │   └── autoload.php         ← Composer Dependencies (Firebase JWT etc.)
│   ├── .htaccess                  ← URL-Rewrite für /api/...
│   ├── index.php                  ← API-Router
│   └── composer.json              ← PHP Abhängigkeiten
│
└── README.md
```

## ✨ Features

### Frontend
- React-basierte Single-Page Application (SPA) mit React Router v6
- Benutzerregistrierung und Login mit JWT-Authentifizierung
- Rezeptmanagement : Übersicht, Detailansicht, Erstellen und Bearbeiten von Rezepten
- Profilverwaltung mit Bearbeitungsmöglichkeit
- Geschützte Routen für angemeldete Benutzer (ProtectedRoute-Komponente)
- Responsive Navigation mit React Bootstrap
- State-Management mit React Hooks (useState, useEffect)

### Passwortregeln bei der Registrierung:
- Mindestens 8 Zeichen
- Mindestens ein Großbuchstabe
- Mindestens eine Zahl
- Mindestens ein Sonderzeichen (!@?$%)

### Backend
- REST API in PHP mit Endpunkten für Authentifizierung und Rezeptverwaltung
- JWT-Token-basierte Authentifizierung mit Middleware zum Schutz geschützter Routen
- CRUD-Operationen für Rezepte
- Datenbankanbindung (z.B. MySQL) über config/database.php
- Composer zur Verwaltung externer PHP-Bibliotheken (z.B. Firebase JWT)

## ⚙️ Installation & Setup

### Frontend

1. Wechseln Sie in das Frontend-Verzeichnis:
```bash
cd frontend
```
2. Installieren Sie die Abhängigkeiten:
```bash
npm install
```
3. Starten Sie den Entwicklungsserver:
```bash
npm run dev
```
Die App ist dann unter [http://fi1.mshome.net:5001/] erreichbar.

### Backend

1. Wechseln Sie in das Backend-Verzeichnis:
```bash
cd backend
```
2. Installieren Sie die Composer-Abhängigkeiten:
```bash
composer install
```
3. Starten Sie den PHP-Built-in-Server:
```bash
php -S localhost:8000
```
Die API-Endpunkte sind dann unter http://fi1.mshome.net/Intranet-Kochbuch-issa/backend/.. erreichbar.

### Alternativ:
Konfigurieren Sie einen Webserver wie Apache oder Nginx auf das `backend/`-Verzeichnis.

## 🌍 Umgebungsvariablen

### Frontend

In der `.env` Datei:
```env
VITE_API_URL=http://localhost:8000
```

### Backend

Datenbankzugangsdaten werden in `backend/config/database.php` hinterlegt.

## 🔒 Passwortregeln bei der Registrierung

- Mindestens 8 Zeichen lang
- Mindestens ein Großbuchstabe
- Mindestens eine Zahl
- Mindestens ein Sonderzeichen (!@?$%)

## 📄 Lizenz

Dieses Projekt steht unter der **MIT-Lizenz**.

## 📬 Kontakt

- ✉️ E-Mail: issathaer8@gmail.com  
- 📁 Projekt-Repository: [GitHub](https://github.com/Thaer455/Intranet-Kochbuch-issa.git)  

© 2025 Intranet-Kochbuch-issa · Alle Rechte vorbehalten
