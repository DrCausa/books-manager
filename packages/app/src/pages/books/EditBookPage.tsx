import { useParams, useNavigate } from "react-router-dom";
import { useState, useEffect } from "react";

const EditBookPage = () => {
  const { id } = useParams<{ id: string }>();
  const navigate = useNavigate();

  // Mock data de autores y géneros
  const authors = ["Gabriel García Márquez", "George Orwell", "Isabel Allende"];
  const genres = ["Realismo mágico", "Novela", "Ciencia ficción", "Fantasía"];

  // Estados
  const [title, setTitle] = useState("");
  const [author, setAuthor] = useState(authors[0]);
  const [genre, setGenre] = useState(genres[0]);

  useEffect(() => {
    const mockBooks: Record<
      string,
      { title: string; author: string; genre: string }
    > = {
      "1": {
        title: "Cien años de soledad",
        author: "Gabriel García Márquez",
        genre: "Realismo mágico",
      },
      "2": {
        title: "1984",
        author: "George Orwell",
        genre: "Ciencia ficción",
      },
    };

    if (id && mockBooks[id]) {
      setTitle(mockBooks[id].title);
      setAuthor(mockBooks[id].author);
      setGenre(mockBooks[id].genre);
    }
  }, [id]);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    alert(`Libro actualizado (mock): ${title} — ${author} — Género: ${genre}`);
    navigate("/books");
  };

  return (
    <div className="p-6 max-w-md mx-auto">
      <h2 className="text-2xl font-bold text-gray-800 mb-4">
        ✏️ Editar libro #{id}
      </h2>
      <form onSubmit={handleSubmit} className="space-y-4">
        <input
          type="text"
          placeholder="Título"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
          className="w-full p-2 border rounded"
          required
        />

        {/* Dropdown Autores */}
        <select
          value={author}
          onChange={(e) => setAuthor(e.target.value)}
          className="w-full p-2 border rounded"
        >
          {authors.map((a) => (
            <option key={a} value={a}>
              {a}
            </option>
          ))}
        </select>

        {/* Dropdown Géneros */}
        <select
          value={genre}
          onChange={(e) => setGenre(e.target.value)}
          className="w-full p-2 border rounded"
        >
          {genres.map((g) => (
            <option key={g} value={g}>
              {g}
            </option>
          ))}
        </select>

        <div className="flex gap-2">
          <button
            type="submit"
            className="bg-indigo-600 text-white px-4 py-2 rounded"
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

