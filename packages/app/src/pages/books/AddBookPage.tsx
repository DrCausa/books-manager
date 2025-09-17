import { useState, useEffect } from "react";
import { createBook } from "@/services/api/books";
import { addBookAuthor } from "@/services/api/bookAuthors";
import { addBookGenre } from "@/services/api/bookGenres";
import { getAuthors } from "@/services/api/author";
import { getGenres } from "@/services/api/genre";
import type { Author, Genre } from "@/services/api/types";

const AddBookPage = () => {
  const [title, setTitle] = useState("");
  const [authorIds, setAuthorIds] = useState<string[]>([]);
  const [genreIds, setGenreIds] = useState<string[]>([]);
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
    if (!title || authorIds.length === 0 || genreIds.length === 0) {
      alert("Por favor completa todos los campos.");
      return;
    }

    try {
      const bookId = await createBook({
        title,
        publication_date: new Date().toISOString(),
      });

      await Promise.all(authorIds.map((id) => addBookAuthor(bookId, id)));
      await Promise.all(genreIds.map((id) => addBookGenre(bookId, id)));

      setTitle("");
      setAuthorIds([]);
      setGenreIds([]);
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
            multiple
            value={authorIds}
            onChange={(e) =>
              setAuthorIds(Array.from(e.target.selectedOptions, (o) => o.value))
            }
            className="border rounded p-2 h-32"
            required
          >
            {authors.map((a) => (
              <option key={a.id} value={a.id}>
                {a.name}
              </option>
            ))}
          </select>

          <select
            multiple
            value={genreIds}
            onChange={(e) =>
              setGenreIds(Array.from(e.target.selectedOptions, (o) => o.value))
            }
            className="border rounded p-2 h-32"
            required
          >
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
