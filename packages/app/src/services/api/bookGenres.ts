import { api } from ".";
import { type BookGenre } from "./types";

export const getBookGenres = async (book_id: string): Promise<BookGenre[]> => {
  const { data } = await api.get(`/books/${book_id}/genres`);
  return data;
};
