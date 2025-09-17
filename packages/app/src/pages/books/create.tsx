import { useState } from "react";

const mockAuthors = [
  { id: 1, name: "Gabriel García Márquez" },
  { id: 2, name: "George Orwell" },
];

const mockGenres = [
  { id: 1, name: "Realismo mágico" },
  { id: 2, name: "Distopía" },
  { id: 3, name: "Clásico" },
];

export default function BookCreate() {
  const [title, setTitle] = useState("");
  const [author, setAuthor] = useState("");
  const [genre, setGenre] = useState("");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    console.log({ title, author, genre });
    alert("Libro creado (mock)");
  };

  return (
    <div>
      <h2 className="text-2xl font-semibold mb-4">Crear Libro</h2>
      <form onSubmit={handleSubmit} className="space-y-4 max-w-md">
        <input
          type="text"
          placeholder="Título del libro"
          className="w-full border p-2 rounded"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
          required
        />

        <select
          className="w-full border p-2 rounded"
          value={author}
          onChange={(e) => setAuthor(e.target.value)}
          required
        >
          <option value="">Selecciona un autor</option>
          {mockAuthors.map((a) => (
            <option key={a.id} value={a.name}>
              {a.name}
            </option>
          ))}
        </select>

        <select
          className="w-full border p-2 rounded"
          value={genre}
          onChange={(e) => setGenre(e.target.value)}
          required
        >
          <option value="">Selecciona un género</option>
          {mockGenres.map((g) => (
            <option key={g.id} value={g.name}>
              {g.name}
            </option>
          ))}
        </select>

        <button type="submit" className="bg-green-600 text-white px-4 py-2 rounded">
          Guardar
        </button>
      </form>
    </div>
  );
}
