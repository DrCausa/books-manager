import { getAuthorById } from "@/services/api/author";
import { getBookAuthors } from "@/services/api/bookAuthors";
import { getBookGenres } from "@/services/api/bookGenres";
import { deleteBook, getBooks } from "@/services/api/books";
import { getGenreById } from "@/services/api/genre";
import { type Author, type Book, type Genre } from "@/services/api/types";
import { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";

interface DataState {
  book: Book;
  author: Author[];
  genre: Genre[];
}

const BooksPage = () => {
  const navigate = useNavigate();
  const [data, setData] = useState<DataState[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchInfo = async () => {
      try {
        const books = await getBooks();

        const allData: DataState[] = await Promise.all(
          books.map(async (book: Book) => {
            const bookAuthors = await getBookAuthors(book.id);
            const bookGenres = await getBookGenres(book.id);

            const authors: Author[] = await Promise.all(
              bookAuthors.map(async (ba) => {
                return await getAuthorById(ba.author_id);
              })
            );

            const genres: Genre[] = await Promise.all(
              bookGenres.map(async (bg) => {
                return await getGenreById(bg.genre_id);
              })
            );

            const newData: DataState = {
              book,
              author: authors,
              genre: genres,
            };

            return newData;
          })
        );

        setData(allData);
        setLoading(false);
      } catch (err) {
        setError("Error cargando los datos");
        setLoading(false);
      }
    };

    fetchInfo();
  }, []);

  if (loading)
    return (
      <div className="mx-auto flex flex-col text-center w-[min-content] my-[10rem]">
        <span className="material-symbols-outlined !text-8xl opacity-75 text-gray-800 animate-spin">
          cached
        </span>
        <span className="animate-pulse text-2xl text-gray-800">Loading...</span>
      </div>
    );
  if (error) return <div>Error: {error}</div>;

  const handleDelete = async (id: string) => {
    try {
      await deleteBook(id);
      setData((prevData) => prevData.filter((item) => item.book.id !== id));
    } catch (err) {
      console.error("Error eliminando el libro:", err);
    }
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
      <div className="bg-white shadow rounded-lg overflow-x-auto">
        <table className="min-w-full border-collapse">
          <thead className="bg-indigo-100">
            <tr>
              <th className="py-3 px-4 text-left text-gray-700">Title</th>
              <th className="py-3 px-4 text-left text-gray-700">Authors</th>
              <th className="py-3 px-4 text-left text-gray-700">Genres</th>
              <th className="py-3 px-4 text-center text-gray-700">Acciones</th>
            </tr>
          </thead>
          <tbody>
            {data.map((item, idx) => (
              <tr
                key={item.book.id}
                className={idx % 2 === 0 ? "bg-gray-50" : "bg-white"}
              >
                <td className="py-3 px-4">{item.book.title}</td>
                <td className="py-3 px-4">
                  {item.author.map((a) => a.name).join(", ")}
                </td>
                <td className="py-3 px-4 gap-2">
                  <div className="flex">
                    {item.genre.map((g) => (
                      <span
                        key={g.id}
                        className="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded-full shadow hover:scale-105 transition text-xs"
                      >
                        {g.name}
                      </span>
                    ))}
                  </div>
                </td>
                <td className="py-3 px-4 text-center flex justify-center gap-2">
                  <button
                    type="button"
                    onClick={() => navigate(`/books/${item.book.id}/edit`)}
                    className="bg-yellow-400 text-black px-3 py-1 rounded hover:bg-yellow-500"
                  >
                    Editar
                  </button>
                  <button
                    type="button"
                    onClick={() => handleDelete(item.book.id)}
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
