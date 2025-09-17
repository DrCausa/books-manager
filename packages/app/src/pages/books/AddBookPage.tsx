import { useState } from "react";

const AddBookPage = () => {
  const [title, setTitle] = useState("");
  const [author, setAuthor] = useState("");
  const [genre, setGenre] = useState("");

  // Datos simulados
  const authors = ["Gabriel García Márquez", "George Orwell", "Isabel Allende"];
  const genres = ["Realismo mágico", "Ciencia ficción", "Novela"];

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!author || !genre) {
      alert("Por favor selecciona un autor y un género.");
      return;
    }
    alert(`Libro añadido: ${title} de ${author} (${genre})`);
    setTitle("");
    setAuthor("");
    setGenre("");
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-50">
      <div className="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 className="text-2xl font-bold mb-6 text-center">
          ➕ Añadir nuevo libro
        </h1>

        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
          {/* Título */}
          <input
            type="text"
            placeholder="Título del libro"
            value={title}
            onChange={(e) => setTitle(e.target.value)}
            className="border rounded p-2"
            required
          />

          {/* Autor */}
          <select
            value={author}
            onChange={(e) => setAuthor(e.target.value)}
            className="border rounded p-2"
            required
          >
            <option value="">Autor...</option>
            {authors.map((a, index) => (
              <option key={index} value={a}>
                {a}
              </option>
            ))}
          </select>

          {/* Género */}
          <select
            value={genre}
            onChange={(e) => setGenre(e.target.value)}
            className="border rounded p-2"
            required
          >
            <option value="">Género...</option>
            {genres.map((g, index) => (
              <option key={index} value={g}>
                {g}
              </option>
            ))}
          </select>

          {/* Botón */}
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



