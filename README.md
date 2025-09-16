# 📚 Books Manager

A monorepo project to manage a list of books, with a React frontend and a PHP (Slim Framework) backend.

Includes support for authors, genres, and relationships between books, authors, and genres.

## ⚛️ Frontend

Vite + React + TypeScript

## 🐘 Backend

Slim Framework (PHP)

---

## ⚙️ Prerequisites

Make sure you have the following installed:

| Tool     | Minimum Version |
| :------- | :-------------- |
| Node.js  | ≥ 20            |
| pnpm     | ≥ 9             |
| PHP      | ≥ 8.2           |
| Composer | ≥ 2.7           |
| MySQL    | ≥ 8             |

---

## 🛠️ Initial Setup

### 1️⃣ Install dependencies

For both frontend and backend:

```bash
pnpm install
pnpm api:install
```

### 2️⃣ Database

Create a MySQL database, for example `books_manager_db`.

Run the SQL to create all the necessary tables:

```sql
packages/api/books_manager_db.sql
```

If you want test data, run the PHP seeder:

```bash
php packages/api/seeds.php DatabaseSeeder
```

### 3️⃣ Environment file

If you don't want to use the default values from `config/definitions.php`, create a `.env` file in `packages/api/`:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=books_manager_db
DB_USER=root
DB_PASS=
```

---

## 🚀 Development

### Frontend

Start the development server:

```bash
pnpm dev:app
```

URL: http://localhost:5173

### Backend

Run the PHP server:

```bash
pnpm api:serve
```

URL: http://localhost:8000

During development, you can run the frontend and backend separately. Configure a Vite proxy to redirect `/api` calls to the backend.

---

## 🏗️ Production Build

Build both packages:

```bash
pnpm build
```

- **Frontend**: `packages/app/dist`
- **Backend**: `packages/api/public`

Preview the frontend build:

```bash
pnpm preview
```

---

## 📁 Project Structure

```
books-manager/
├── packages/
│   ├── api/
│   │   ├── .env
│   │   ├── composer.json
│   │   └── package.json
│   └── app/
│       └── package.json
├── package.json
├── pnpm-workspace.yaml
└── README.md
```

---

## 🌐 API Routes

### Books

| Method | Endpoint                   | Description                       |
| :----- | :------------------------- | :-------------------------------- |
| GET    | `/books`                   | List all books                    |
| POST   | `/books`                   | Create a book                     |
| GET    | `/books/{id}`              | Get book by ID                    |
| PATCH  | `/books/{id}`              | Update book by ID                 |
| DELETE | `/books/{id}`              | Delete book by ID                 |
| GET    | `/books/{id}/authors`      | List authors of a book            |
| GET    | `/books/{id}/genres`       | List genres of a book             |
| GET    | `/books/{book_id}`         | Get book by book_id               |
| PATCH  | `/books/{book_id}`         | Update book by book_id            |
| DELETE | `/books/{book_id}`         | Delete book by book_id            |
| GET    | `/books/{book_id}/authors` | List authors of a book by book_id |
| GET    | `/books/{book_id}/genres`  | List genres of a book by book_id  |

### Authors

| Method | Endpoint                     | Description                          |
| :----- | :--------------------------- | :----------------------------------- |
| GET    | `/authors`                   | List authors                         |
| POST   | `/authors`                   | Create an author                     |
| GET    | `/authors/{id}`              | Get author by ID                     |
| PATCH  | `/authors/{id}`              | Update author by ID                  |
| DELETE | `/authors/{id}`              | Delete author by ID                  |
| GET    | `/authors/{id}/books`        | List books by an author              |
| GET    | `/authors/{author_id}`       | Get author by author_id              |
| PATCH  | `/authors/{author_id}`       | Update author by author_id           |
| DELETE | `/authors/{author_id}`       | Delete author by author_id           |
| GET    | `/authors/{author_id}/books` | List books by an author by author_id |

### Genres

| Method | Endpoint                   | Description                       |
| :----- | :------------------------- | :-------------------------------- |
| GET    | `/genres`                  | List genres                       |
| POST   | `/genres`                  | Create a genre                    |
| GET    | `/genres/{id}`             | Get genre by ID                   |
| PATCH  | `/genres/{id}`             | Update genre by ID                |
| DELETE | `/genres/{id}`             | Delete genre by ID                |
| GET    | `/genres/{id}/books`       | List books of a genre             |
| GET    | `/genres/{genre_id}`       | Get genre by genre_id             |
| PATCH  | `/genres/{genre_id}`       | Update genre by genre_id          |
| DELETE | `/genres/{genre_id}`       | Delete genre by genre_id          |
| GET    | `/genres/{genre_id}/books` | List books of a genre by genre_id |

Note: Endpoints allow nesting, for example `/books/1/authors` or `/authors/2/books`.

---

## 🧹 Utilities

| Command            | Description                                 |
| :----------------- | :------------------------------------------ |
| `pnpm lint`        | Runs ESLint on all packages                 |
| `pnpm clean`       | Deletes build folders (`dist` and `vendor`) |
| `pnpm api:install` | Runs `composer install` in `packages/api`   |
| `pnpm api:serve`   | Starts the backend with PHP server          |
| `pnpm dev`         | Starts frontend and backend in parallel     |
| `pnpm build`       | Builds frontend and backend for production  |

---

## 💡 Tips

- Run the frontend and backend separately in development.
- Configure a Vite dev proxy to redirect `/api` to the backend.
- For production, serve `dist/` from a web server and the API on another domain/sub-path using Nginx/Apache.
- Run the seeder if you want test data for testing:

```bash
php packages/api/seeds.php DatabaseSeeder
```

- The `.env` file is only necessary if you don't want to use the default values in `definitions.php`.

---

## 📌 Notes

- 🧪 Project designed for local development and learning.
- 🖥️ Easy to deploy on shared hosting or a VPS.
- Compatible with complex relationships between books, authors, and genres.
