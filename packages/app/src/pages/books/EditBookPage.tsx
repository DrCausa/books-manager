import { useParams, useNavigate } from "react-router-dom";
import { useState, useEffect } from "react";
import { getBookById, updateBook } from "@/services/api/books";
import { addBookAuthor, getBookAuthors } from "@/services/api/bookAuthors";
import { addBookGenre, getBookGenres } from "@/services/api/bookGenres";
import { getAuthorById, getAuthors } from "@/services/api/author";
import { getGenreById, getGenres } from "@/services/api/genre";
import type { Author, Genre } from "@/services/api/types";

const EditBookPage = () => {
  const { id } = useParams<{ id: string }>();
  const navigate = useNavigate();

  const [title, setTitle] = useState("");
  const [authorIds, setAuthorIds] = useState<string[]>([]);
  const [genreIds, setGenreIds] = useState<string[]>([]);
  const [authors, setAuthors] = useState<Author[]>([]);
  const [genres, setGenres] = useState<Genre[]>([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const [authorsData, genresData] = await Promise.all([
          getAuthors(),
          getGenres(),
        ]);
        setAuthors(authorsData);
        setGenres(genresData);
      } catch (error) {
        console.error("Error al cargar autores o géneros", error);
      }
    };
    fetchData();
  }, []);

  useEffect(() => {
    if (!id) return;
    const fetchBookData = async () => {
      try {
        const book = await getBookById(id);
        setTitle(book.title);

        const bookAuthors = await getBookAuthors(id);
        const authorsFull = await Promise.all(
          bookAuthors.map((ba) => getAuthorById(ba.author_id))
        );
        setAuthorIds(authorsFull.map((a) => a.id));

        const bookGenres = await getBookGenres(id);
        const genresFull = await Promise.all(
          bookGenres.map((bg) => getGenreById(bg.genre_id))
        );
        setGenreIds(genresFull.map((g) => g.id));
      } catch (err) {
        console.error(err);
      }
    };
    fetchBookData();
  }, [id]);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!title || authorIds.length === 0 || genreIds.length === 0) {
      alert("Por favor completa todos los campos.");
      return;
    }

    try {
      console.log(id);

      if (id) {
        await updateBook(id, {
          title,
          publication_date: new Date().toISOString(),
        });

        await Promise.all(authorIds.map((aId) => addBookAuthor(id, aId)));
        await Promise.all(genreIds.map((gId) => addBookGenre(id, gId)));

        alert("Libro actualizado exitosamente");
        navigate("/books");
      }
    } catch (error) {
      console.error(error);
      alert("Error al actualizar el libro");
    }
  };

  return (
    <div className="p-6 max-w-md mx-auto">
      <h2 className="text-2xl font-bold text-gray-800 mb-4">
        ✏️ Editar libro #{id}
      </h2>

      <form onSubmit={handleSubmit} className="flex flex-col gap-4">
        <input
          type="text"
          placeholder="Título"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
          className="w-full p-2 border rounded"
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

        <div className="flex gap-2">
          <button
            type="submit"
            className="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition"
          >
            Guardar cambios
          </button>
          <button
            type="button"
            onClick={() => navigate("/books")}
            className="px-4 py-2 border rounded"
          >
            Cancelar
          </button>
        </div>
      </form>
    </div>
  );
};

export default EditBookPage;
