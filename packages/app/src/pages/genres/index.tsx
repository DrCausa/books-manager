const GenresPage = () => {
  const genres = ["Realismo mágico", "Novela", "Ciencia ficción", "Fantasía"];

  return (
    <div className="p-6">
      <h2 className="text-3xl font-bold text-gray-800 mb-6">🎭 Géneros</h2>
      <div className="flex flex-wrap gap-4">
        {genres.map((genre) => (
          <span
            key={genre}
            className="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded-full shadow hover:scale-105 transition"
          >
            {genre}
          </span>
        ))}
      </div>
    </div>
  );
};

export default GenresPage;
