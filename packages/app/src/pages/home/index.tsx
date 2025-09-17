import { Link } from "react-router-dom";

const HomePage = () => {
  const sections = [
    {
      id: 1,
      title: "📚 Libros",
      description: "Gestiona todos los libros de la biblioteca.",
      path: "/books",
      color: "from-indigo-500 to-indigo-700",
    },
    {
      id: 2,
      title: "👤 Autores",
      description: "Explora y administra los autores registrados.",
      path: "/authors",
      color: "from-green-500 to-green-700",
    },
    {
      id: 3,
      title: "🎭 Géneros",
      description: "Organiza los géneros literarios por categorías.",
      path: "/genres",
      color: "from-pink-500 to-pink-700",
    },
  ];

  return (
    <div className="p-10 text-center">
      {/* Título principal */}
      <h1 className="text-4xl font-extrabold text-gray-800 mb-6">
        Bienvenido al <span className="text-indigo-600">Gestor de Libros</span> 📖
      </h1>

      <p className="text-gray-600 max-w-2xl mx-auto mb-10">
        Administra tus libros, autores y géneros de manera sencilla y moderna.  
        Usa el panel de abajo para navegar fácilmente por el sistema.
      </p>

      {/* Tarjetas de navegación */}
      <div className="grid gap-8 md:grid-cols-3 max-w-5xl mx-auto">
        {sections.map((section) => (
          <div
            key={section.id}
            className={`rounded-2xl shadow-lg p-6 text-white bg-gradient-to-r ${section.color} cursor-pointer transform transition duration-300 hover:scale-105 hover:shadow-2xl`}
          >
            <h2 className="text-2xl font-bold mb-2">{section.title}</h2>
            <p className="mb-4">{section.description}</p>
            <Link
              to={section.path}
              className="inline-block bg-white text-gray-800 px-4 py-2 rounded-lg font-semibold shadow hover:bg-gray-100 transition"
            >
              Ir →
            </Link>
          </div>
        ))}
      </div>
    </div>
  );
};

export default HomePage;


