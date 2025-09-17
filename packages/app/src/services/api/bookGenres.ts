import { api } from ".";
import { type BookGenre } from "./types";

export const getBookGenres = async (book_id: string): Promise<BookGenre[]> => {
  const { data } = await api.get(`/books/${book_id}/genres`);
  return data;
};

export const addBookGenre = async (
  book_id: string,
  genre_id: string
): Promise<BookGenre> => {
  const { data } = await api.post(`/books/${book_id}/genres`, {
    book_id,
    genre_id,
  });
  return data;
};
