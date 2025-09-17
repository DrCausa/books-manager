import { useState, useEffect } from "react";
import { createBook } from "@/services/api/books";
import { addBookAuthor } from "@/services/api/bookAuthors";
import { addBookGenre } from "@/services/api/bookGenres";
import { getAuthors } from "@/services/api/author";
import { getGenres } from "@/services/api/genre";
import type { Author, Genre } from "@/services/api/types";

const AddBookPage = () => {
  const [title, setTitle] = useState("");
  const [authorId, setAuthorId] = useState("");
  const [genreId, setGenreId] = useState("");
  const [authors, setAuthors] = useState<Author[]>([]);
  const [genres, setGenres] = useState<Genre[]>([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const authorsData = await getAuthors();
        setAuthors(authorsData);

        const genresData = await getGenres();
        setGenres(genresData);
      } catch (error) {
        console.error("Error al cargar autores o géneros", error);
      }
    };
    fetchData();
  }, []);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!title || !authorId || !genreId) {
      alert("Por favor completa todos los campos.");
      return;
    }

    try {
      const newBookArray = await createBook({
        title,
        publication_date: new Date().toISOString(),
      });
      const bookId = newBookArray[0].id;

      await addBookAuthor(bookId, authorId);
      await addBookGenre(bookId, genreId);

      setTitle("");
      setAuthorId("");
      setGenreId("");
      alert("Libro creado exitosamente");
    } catch (error) {
      console.error(error);
      alert("Error al crear el libro");
    }
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-50">
      <div className="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 className="text-2xl font-bold mb-6 text-center">
          ➕ Añadir nuevo libro
        </h1>

        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
          <input
            type="text"
            placeholder="Título del libro"
            value={title}
            onChange={(e) => setTitle(e.target.value)}
            className="border rounded p-2"
            required
          />

          <select
            value={authorId}
            onChange={(e) => setAuthorId(e.target.value)}
            className="border rounded p-2"
            required
          >
            <option value="">Selecciona un autor...</option>
            {authors.map((a) => (
              <option key={a.id} value={a.id}>
                {a.name}
              </option>
            ))}
          </select>

          <select
            value={genreId}
            onChange={(e) => setGenreId(e.target.value)}
            className="border rounded p-2"
            required
          >
            <option value="">Selecciona un género...</option>
            {genres.map((g) => (
              <option key={g.id} value={g.id}>
                {g.name}
              </option>
            ))}
          </select>

          <button
            type="submit"
            className="bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition"
          >
            Guardar libro
          </button>
        </form>
      </div>
    </div>
  );
};

export default AddBookPage;
