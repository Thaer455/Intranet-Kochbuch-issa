
## Intranet-Kochbuch-issa

Ein webbasiertes Intranet-Kochbuch für Auszubildende. Das Projekt besteht aus einem React-Frontend (Vite + React) und einem PHP-Backend als REST-API. Nutzer:innen können sich registrieren, anmelden, Rezepte erstellen, bearbeiten, ansehen und ihr Profil verwalten.

## 📁 Projektstruktur

```
Intranet-Kochbuch-issa/Intranet-Kochbuch-issa/
├── backend/
│   ├── config/
│   │   └── database.php                ← Datenbankverbindung
│   ├── controllers/
│   │   ├── auth/
│   │   │   ├── login.php               ← Login-Endpunkt
│   │   │   └── register.php            ← Registrierungs-Endpunkt
│   │   ├── recipe/
│   │   │   ├── create.php              ← Neues Rezept erstellen
│   │   │   ├── read.php                ← Alle Rezepte abrufen
│   │   │   ├── update.php              ← Rezept aktualisieren
│   │   │   ├── delete.php              ← Rezept löschen
│   │   │   └── upload.php              ← Bild hochladen
│   │   ├── user/
│   │   │   ├── get_user.php            ← Benutzerdaten abrufen
│   │   │   └── profile.php             ← Profil bearbeiten
│   ├── middleware/
│   │   └── auth_middleware.php         ← JWT-Token Prüfung
│   ├── models/
│   │   ├── Recipe.php                  ← Rezept-Datenmodell
│   │   └── User.php                    ← Benutzer-Datenmodell
│   ├── .gitignore
│   ├── .htaccess                       ← URL-Rewrite für /api/...
│   ├── composer.json                   ← PHP Abhängigkeiten
│   ├── composer.lock
│   └── index.php                       ← API-Router

├── frontend/
│   ├── public/
│   │   └── images/
│   │       ├── carbonara.jpg
│   │       ├── placeholder.jpg
│   │       ├── android-chrome-192x192.png
│   │       ├── android-chrome-512x512.png
│   │       ├── apple-touch-icon.png
│   │       ├── favicon-16x16.png
│   │       ├── favicon-32x32.png
│   │       ├── favicon.ico
│   │       └── site.webmanifest
│   │   └── about.txt
│   ├── src/
│   │   ├── components/
│   │   │   ├── Layout.jsx
│   │   │   ├── Navbar.jsx
│   │   │   ├── ProtectedRoute.jsx      ← Schützt Seiten vor nicht angemeldeten Benutzern
│   │   │   └── RecipeCard.jsx
│   │   ├── pages/
│   │   │   ├── Recipes/
│   │   │   │   ├── CreateRecipe.jsx
│   │   │   │   ├── EditRecipe.jsx
│   │   │   │   ├── RecipeDetail.jsx
│   │   │   │   └── RecipeList.jsx
│   │   │   ├── Home.jsx
│   │   │   ├── Login.jsx
│   │   │   ├── Profile.jsx
│   │   │   └── Register.jsx
│   │   ├── services/
│   │   │   ├── auth.service.js         ← Authentifizierungsdienst
│   │   │   └── recipe.service.js       ← Rezeptdienst
│   │   ├── App.css
│   │   ├── App.jsx
│   │   ├── index.css
│   │   └── main.jsx
│   ├── .env                            ← API-URL definieren
│   ├── .gitignore
│   ├── eslint.config.js
│   ├── index.html
│   ├── package.json
│   ├── package-lock.json
│   ├── vite.config.js
│   └── README.md
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
VITE_API_URL=http://fi1.mshome.net/Intranet-Kochbuch-issa/backend
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
