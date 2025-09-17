import { getGenres } from "@/services/api/genre";
import type { Genre } from "@/services/api/types";
import { useEffect, useState } from "react";

const GenresPage = () => {
  const [genres, setGenres] = useState<Genre[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchAuthors = async () => {
      try {
        setLoading(true);
        const result = await getGenres();
        setGenres(result);
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
      <h2 className="text-3xl font-bold text-gray-800 mb-6">🎭 Géneros</h2>
      <div className="flex flex-wrap gap-4">
        {genres.map((genre) => (
          <span
            key={genre.id}
            className="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded-full shadow hover:scale-105 transition"
          >
            {genre.name}
          </span>
        ))}
      </div>
    </div>
  );
};

export default GenresPage;
