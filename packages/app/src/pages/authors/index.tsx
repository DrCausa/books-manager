import { getAuthors } from "@/services/api/author";
import { type Author } from "@/services/api/types";
import { useEffect, useState } from "react";

const AuthorsPage = () => {
  const [authors, setAuthors] = useState<Author[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchAuthors = async () => {
      try {
        setLoading(true);
        const result = await getAuthors();
        setAuthors(result);
      } catch (err: any) {
        setError(err.message || "Error");
      } finally {
        setLoading(false);
      }
    };

    fetchAuthors();
  }, []);

  if (loading) return <div>Loading...</div>;
  if (error) return <div>Error: {error}</div>;

  return (
    <div className="p-6">
      <h2 className="text-3xl font-bold text-gray-800 mb-6">✍️ Autores</h2>
      <ul className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        {authors.map((author) => (
          <li
            key={author.id}
            className="bg-white shadow p-4 rounded-lg text-center hover:shadow-lg transition"
          >
            {author.name}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default AuthorsPage;
