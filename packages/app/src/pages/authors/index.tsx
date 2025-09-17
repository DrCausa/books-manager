const AuthorsPage = () => {
  const authors = ["Gabriel García Márquez", "Miguel de Cervantes", "Isabel Allende"];

  return (
    <div className="p-6">
      <h2 className="text-3xl font-bold text-gray-800 mb-6">✍️ Autores</h2>
      <ul className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        {authors.map((author) => (
          <li
            key={author}
            className="bg-white shadow p-4 rounded-lg text-center hover:shadow-lg transition"
          >
            {author}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default AuthorsPage;
