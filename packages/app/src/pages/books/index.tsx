import { Link, useNavigate } from "react-router-dom";

const BooksPage = () => {
  const navigate = useNavigate();

  const books = [
    { id: 1, title: "Cien años de soledad", author: "Gabriel García Márquez" },
    { id: 2, title: "1984", author: "George Orwell" },
  ];

  const handleDelete = (id: number) => {
    alert(`Libro con ID ${id} eliminado (mock).`);
  };

  return (
    <div className="p-6">
      <div className="flex justify-between items-center mb-6">
        <h2 className="text-3xl font-bold text-gray-800">📖 Libros</h2>
        <Link
          to="/books/add"
          className="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition"
        >
          + Añadir libro
        </Link>
      </div>
      <div className="bg-white shadow rounded-lg overflow-hidden">
        <table className="min-w-full border-collapse">
          <thead className="bg-indigo-100">
            <tr>
              <th className="py-3 px-4 text-left text-gray-700">Título</th>
              <th className="py-3 px-4 text-left text-gray-700">Autor</th>
              <th className="py-3 px-4 text-center text-gray-700">Acciones</th>
            </tr>
          </thead>
          <tbody>
            {books.map((book, idx) => (
              <tr
                key={book.id}
                className={idx % 2 === 0 ? "bg-gray-50" : "bg-white"}
              >
                <td className="py-3 px-4">{book.title}</td>
                <td className="py-3 px-4">{book.author}</td>
                <td className="py-3 px-4 text-center flex justify-center gap-2">
                  <button
                    type="button"
                    onClick={() => navigate(`/books/${book.id}/edit`)}
                    className="bg-yellow-400 text-black px-3 py-1 rounded hover:bg-yellow-500"
                  >
                    Editar
                  </button>
                  <button
                    type="button"
                    onClick={() => handleDelete(book.id)}
                    className="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                  >
                    Eliminar
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default BooksPage;

