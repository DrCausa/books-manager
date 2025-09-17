import { createBrowserRouter } from "react-router-dom";
import MainLayout from "@components/layout/MainLayout";

import HomePage from "@pages/home";
import BooksPage from "@pages/books";
import AddBookPage from "@/pages/books/AddBookPage";
import EditBookPage from "@pages/books/EditBookPage";
import AuthorsPage from "@pages/authors";
import GenresPage from "@pages/genres";
import NotFoundPage from "@pages/not-found";

const router = createBrowserRouter([
  {
    path: "/",
    element: (
      <MainLayout>
        <HomePage />
      </MainLayout>
    ),
  },
  {
    path: "/books",
    element: (
      <MainLayout>
        <BooksPage />
      </MainLayout>
    ),
  },
  {
    path: "/books/add",
    element: (
      <MainLayout>
        <AddBookPage />
      </MainLayout>
    ),
  },
  {
    path: "/books/:id/edit",
    element: (
      <MainLayout>
        <EditBookPage />
      </MainLayout>
    ),
  },
  {
    path: "/authors",
    element: (
      <MainLayout>
        <AuthorsPage />
      </MainLayout>
    ),
  },
  {
    path: "/genres",
    element: (
      <MainLayout>
        <GenresPage />
      </MainLayout>
    ),
  },
  {
    path: "*",
    element: (
      <MainLayout>
        <NotFoundPage />
      </MainLayout>
    ),
  },
]);

export default router;


