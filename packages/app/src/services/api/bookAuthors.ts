import { api } from ".";
import { type BookAuthor } from "./types";

export const getBookAuthors = async (
  book_id: string
): Promise<BookAuthor[]> => {
  const { data } = await api.get(`/books/${book_id}/authors`);
  return data;
};

export const addBookAuthor = async (
  book_id: string,
  author_id: string
): Promise<BookAuthor> => {
  const { data } = await api.post(`/books/${book_id}/authors`, {
    book_id,
    author_id,
  });
  return data;
};

export const deleteBookAuthors = async (book_id: string): Promise<void> => {
  await api.delete(`/books/${book_id}/authors`);
};
