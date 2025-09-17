import { Link } from "react-router-dom";

const Header = () => {
  return (
    <header className="bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md">
      <nav className="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 className="text-xl font-bold tracking-wide">📚 Book Manager</h1>
        <div className="flex gap-6 text-lg">
          <Link to="/" className="hover:text-gray-200 transition">
            Inicio
          </Link>
          <Link to="/books" className="hover:text-gray-200 transition">
            Libros
          </Link>
          <Link to="/authors" className="hover:text-gray-200 transition">
            Autores
          </Link>
          <Link to="/genres" className="hover:text-gray-200 transition">
            Géneros
          </Link>
        </div>
      </nav>
    </header>
  );
};

export default Header;
