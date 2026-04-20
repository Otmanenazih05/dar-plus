# dar-plus

### The Structured Real Estate Media Platform

**Dar+** forces sellers to provide complete, professional property listings by following category-specific photo and description blueprints — no more blurry photos and missing details.

[![Made with React](https://img.shields.io/badge/Frontend-React_+_Vite-61DAFB?style=flat-square&logo=react)](https://react.dev)
[![Made with Laravel](https://img.shields.io/badge/Backend-Laravel_11-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![Database](https://img.shields.io/badge/Database-MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)
[![Styled with Tailwind](https://img.shields.io/badge/Styling-Tailwind_CSS-06B6D4?style=flat-square&logo=tailwindcss)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)

> 🎓 **Internship Project** — Développement Digital, 2ème Année | CMC Beni Mellal | Stage Avril 2026

[Live Demo](#) · [Report an Issue](../../issues) · [API Docs](#api-documentation)

</div>

---

## 📌 Table of Contents

- [The Problem](#-the-problem)
- [The Solution](#-the-solution)
- [Core Concept: Blueprints](#-core-concept-blueprints)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Architecture](#-project-architecture)
- [Database Schema](#-database-schema)
- [Getting Started](#-getting-started)
- [API Documentation](#-api-documentation)
- [Folder Structure](#-folder-structure)
- [Screenshots](#-screenshots)
- [Roadmap](#-roadmap)
- [Author](#-author)

---

## 🔴 The Problem

In Morocco's real estate market, most property listings are posted on platforms like **Facebook**, **Avito**, or **YouTube** by individuals with no professional guidance. The result:

- 📷 Low-quality, random photos that miss key areas (kitchen, bathroom plumbing, ceiling, etc.)
- 📝 Vague descriptions with no standard format ("3 rooms, good price, call me")
- 📐 Missing critical details: surface area in m², floor level, orientation, building age
- 🏗️ No differentiation between property types — an apartment listing looks the same as a land plot
- ❌ Buyers waste time contacting sellers only to discover the property doesn't match their expectations

This creates a **trust problem** and an **efficiency problem** for both sides of the market.

---

## ✅ The Solution

**Dar+** is a web application that solves these problems through a structured, blueprint-driven listing system. Think of it as **Instagram meets a real estate checklist** — social media UX backed by professional data standards.

Instead of a blank form, sellers are guided through a **category-specific blueprint** — a predefined template that tells them exactly:
- Which photos to take (and from which angle)
- Which videos are required
- Which description fields to fill in

A listing cannot be published until the blueprint is at least **80% complete**.

---

## 🧩 Core Concept: Blueprints

The **Blueprint System** is the heart of Dar+. Each property category (Apartment, Villa, Land, Commercial Space, etc.) has its own blueprint that defines mandatory and optional media/info slots.

### Example: Apartment Blueprint

| Slot | Type | Required | Description |
|---|---|---|---|
| `exterior_front` | Photo | ✅ Yes | Front view of the building |
| `living_room` | Photo | ✅ Yes | Wide-angle living room shot |
| `kitchen` | Photo | ✅ Yes | Kitchen with clear view of fixtures |
| `bathroom` | Photo | ✅ Yes | Bathroom plumbing visible |
| `bedroom_1` | Photo | ✅ Yes | Main bedroom |
| `bedroom_n` | Photo | ⬜ Optional | Additional bedrooms |
| `balcony` | Photo | ⬜ Optional | If applicable |
| `walkthrough_tour` | Video | ✅ Yes | 1–3 min walkthrough of all rooms |
| `neighborhood` | Video | ⬜ Optional | Street / surrounding area |
| `surface_area` | Number (m²) | ✅ Yes | Total area |
| `floor_number` | Number | ✅ Yes | Which floor (0 = ground) |
| `total_floors` | Number | ✅ Yes | Total floors in the building |
| `building_age` | Number (years) | ✅ Yes | Age of the building |
| `orientation` | Select | ✅ Yes | N / S / E / W / NE / etc. |
| `heating_type` | Select | ⬜ Optional | None / Central / Gas / Electric |
| `description` | Text | ✅ Yes | Free text, min 100 characters |

Each blueprint is stored in the database and is fully manageable by admins — new categories and field types can be added without touching the codebase.

---

## ✨ Features

### For Sellers
- 🔐 **Account & profile** — Register, create a public seller profile with bio and contact info
- 📋 **Blueprint-guided listing creation** — Step-by-step form driven by the property's category blueprint
- 📊 **Completion meter** — Visual progress bar showing how complete the listing is before publishing
- 📸 **Multi-file media upload** — Upload photos and videos per slot, with preview
- ✏️ **Listing management** — Edit, republish, or mark a property as Sold
- 💬 **Messaging** — Receive inquiries from potential buyers directly in the app

### For Buyers
- 🗺️ **Explorer feed** — Scroll through listings in a TikTok/Instagram-style feed
- 🔍 **Search & filters** — Filter by category, city, price range, surface area, number of rooms
- 🏷️ **Completeness badge** — See at a glance if a listing is "Fully Documented ✅" or "Incomplete ⚠️"
- 💾 **Save favorites** — Bookmark listings to review later
- 💬 **Message sellers** — Open a conversation from any listing page
- 📤 **WhatsApp share** — One-click deep-link share to WhatsApp

### Core System
- 🗂️ **Category & Blueprint management** — Admin panel to create/edit categories and their blueprints
- 🔒 **JWT Authentication** — Secure, stateless auth via Laravel Sanctum
- 📱 **Fully responsive** — Mobile-first design, works on all screen sizes

---

## 🛠 Tech Stack

### Frontend
| Technology | Purpose |
|---|---|
| [React 18](https://react.dev) + [Vite](https://vitejs.dev) | SPA framework + build tool |
| [React Router v6](https://reactrouter.com) | Client-side routing |
| [Tailwind CSS v3](https://tailwindcss.com) | Utility-first styling |
| [Redux Toolkit](https://redux-toolkit.js.org) | Global state management |
| [Axios](https://axios-http.com) | HTTP client for API calls |
| [Lucide React](https://lucide.dev) | Icon library |

### Backend
| Technology | Purpose |
|---|---|
| [Laravel 11](https://laravel.com) | REST API framework |
| [Laravel Sanctum](https://laravel.com/docs/sanctum) | API token authentication |
| [Laravel Eloquent ORM](https://laravel.com/docs/eloquent) | Database abstraction |
| [Intervention Image](https://image.intervention.io) | Server-side image processing |

### Database & Infrastructure
| Technology | Purpose |
|---|---|
| [MySQL 8](https://mysql.com) | Relational database |
| [Cloudinary](https://cloudinary.com) | Media (images/videos) storage & CDN |
| [Vercel](https://vercel.com) | Frontend deployment |
| [Railway](https://railway.app) | Backend + DB deployment |

### Development Tools
| Tool | Purpose |
|---|---|
| [Git](https://git-scm.com) + GitHub | Version control |
| [Postman](https://postman.com) | API testing |
| [Figma](https://figma.com) | UI/UX design & wireframes |
| [VS Code](https://code.visualstudio.com) | Code editor |

---

## 🏗 Project Architecture
Dar+ follows a decoupled architecture:

┌─────────────────────┐ ┌──────────────────────┐
│ React SPA │ HTTP │ Laravel REST API │
│ (Vite + Router) │◄───────►│ (JSON responses) │
│ Vercel │ │ Railway │
└─────────────────────┘ └──────────┬───────────┘
│ Eloquent ORM
┌──────────▼───────────┐
│ MySQL Database │
│ Railway │
└──────────────────────┘
│
┌──────────▼───────────┐
│ Cloudinary CDN │
│ Images / Videos │
└──────────────────────┘


The frontend consumes the Laravel API exclusively via REST endpoints. No server-side rendering — all routing and rendering is handled client-side by React.

---

## 🗄 Database Schema

### Core Tables
users
├── id, name, email, password
├── role (seller | buyer | admin)
├── bio, phone, avatar_url
└── timestamps

categories
├── id, name, slug
├── description, icon
└── timestamps

blueprints
├── id, category_id (FK)
├── name, version
└── timestamps

blueprint_fields
├── id, blueprint_id (FK)
├── field_key, field_label
├── field_type (photo | video | text | number | select)
├── is_required, options (JSON for select)
└── sort_order

properties
├── id, user_id (FK), category_id (FK)
├── title, description, price
├── city, address, latitude, longitude
├── status (draft | published | sold)
├── completion_score (0–100)
└── timestamps

property_media
├── id, property_id (FK), blueprint_field_id (FK)
├── media_type (photo | video)
├── file_url, thumbnail_url
└── timestamps

property_fields
├── id, property_id (FK), blueprint_field_id (FK)
└── value (text)

conversations
├── id, property_id (FK)
├── buyer_id (FK), seller_id (FK)
└── timestamps

messages
├── id, conversation_id (FK), sender_id (FK)
├── body
└── timestamps

favorites
├── id, user_id (FK), property_id (FK)
└── created_at


---

## 🚀 Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js 20+
- MySQL 8+
- Git

### 1. Clone the repository

```bash
git clone https://github.com/Otmanenazih05/dar-plus.git
cd dar-plus
```

### 2. Backend Setup (Laravel)

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
```

Configure your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dar-plus
DB_USERNAME=root
DB_PASSWORD=your_password

CLOUDINARY_URL=cloudinary://your_key:your_secret@your_cloud_name
```

Run migrations and seed the database:

```bash
php artisan migrate
php artisan db:seed   # Seeds categories, blueprints, and a demo admin user
php artisan serve     # Starts at http://localhost:8000
```

### 3. Frontend Setup (React)

```bash
cd frontend
npm install
cp .env.example .env
```

Configure your `.env` file:

```env
VITE_API_BASE_URL=http://localhost:8000/api
```

Start the development server:

```bash
npm run dev   # Starts at http://localhost:5173
```

### 4. Default Credentials (Seeded)

| Role | Email | Password |
|---|---|---|
| Admin | [EMAIL_ADDRESS] | password |
| Demo Seller | [EMAIL_ADDRESS] | password |
| Demo Buyer | [EMAIL_ADDRESS] | password |

---

## 📡 API Documentation

Base URL: `http://localhost:8000/api`

All protected routes require the header:
Authorization: Bearer <token>

### Authentication
| Method | Endpoint | Auth | Description |
|---|---|---|---|
| POST | `/auth/register` | ❌ | Register a new user |
| POST | `/auth/login` | ❌ | Login, returns token |
| POST | `/auth/logout` | ✅ | Invalidate token |
| GET | `/auth/me` | ✅ | Get current user |

### Categories & Blueprints
| Method | Endpoint | Auth | Description |
|---|---|---|---|
| GET | `/categories` | ❌ | List all categories |
| GET | `/categories/{slug}/blueprint` | ❌ | Get the blueprint for a category |

### Properties
| Method | Endpoint | Auth | Description |
|---|---|---|---|
| GET | `/properties` | ❌ | List published properties (filterable) |
| GET | `/properties/{id}` | ❌ | Get single property detail |
| POST | `/properties` | ✅ Seller | Create a new property draft |
| PUT | `/properties/{id}` | ✅ Owner | Update property data |
| DELETE | `/properties/{id}` | ✅ Owner | Delete a property |
| POST | `/properties/{id}/publish` | ✅ Owner | Publish (if completion ≥ 80%) |
| POST | `/properties/{id}/media` | ✅ Owner | Upload media for a blueprint slot |

### Messaging
| Method | Endpoint | Auth | Description |
|---|---|---|---|
| GET | `/conversations` | ✅ | List user's conversations |
| POST | `/conversations` | ✅ Buyer | Start a conversation about a property |
| GET | `/conversations/{id}/messages` | ✅ | Get messages in a conversation |
| POST | `/conversations/{id}/messages` | ✅ | Send a message |

### Users & Profiles
| Method | Endpoint | Auth | Description |
|---|---|---|---|
| GET | `/users/{id}` | ❌ | Public seller profile + listings |
| PUT | `/profile` | ✅ | Update current user's profile |
| GET | `/profile/favorites` | ✅ | Get saved listings |
| POST | `/properties/{id}/favorite` | ✅ | Toggle favorite on a listing |

---

## 📁 Folder Structure
dar-plus/
│
├── backend/ # Laravel 11 REST API
│ ├── app/
│ │ ├── Http/Controllers/ # API Controllers
│ │ │ ├── AuthController.php
│ │ │ ├── PropertyController.php
│ │ │ ├── BlueprintController.php
│ │ │ └── MessageController.php
│ │ ├── Models/ # Eloquent Models
│ │ │ ├── User.php
│ │ │ ├── Property.php
│ │ │ ├── Blueprint.php
│ │ │ └── Message.php
│ │ └── Services/
│ │ └── CompletionScoreService.php # Blueprint completion logic
│ ├── database/
│ │ ├── migrations/
│ │ └── seeders/
│ └── routes/
│ └── api.php
│
├── frontend/ # React + Vite SPA
│ ├── src/
│ │ ├── components/ # Reusable UI components
│ │ │ ├── PropertyCard/
│ │ │ ├── BlueprintForm/ # The guided upload form
│ │ │ ├── CompletionMeter/
│ │ │ └── MessageThread/
│ │ ├── pages/ # Route-level pages
│ │ │ ├── Landing.jsx
│ │ │ ├── Explorer.jsx
│ │ │ ├── PropertyDetail.jsx
│ │ │ ├── PostProperty.jsx # Blueprint-guided creation
│ │ │ ├── Profile.jsx
│ │ │ ├── Search.jsx
│ │ │ └── Messages.jsx
│ │ ├── store/ # Redux Toolkit slices
│ │ │ ├── authSlice.js
│ │ │ └── propertySlice.js
│ │ ├── hooks/ # Custom React hooks
│ │ │ ├── useBlueprint.js
│ │ │ └── useAuth.js
│ │ ├── services/ # Axios API calls
│ │ │ └── api.js
│ │ └── App.jsx
│ └── package.json
│
└── README.md