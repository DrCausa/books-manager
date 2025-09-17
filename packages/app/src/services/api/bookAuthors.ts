import { api } from ".";
import { type BookAuthor } from "./types";

export const getBookAuthors = async (
  book_id: string
): Promise<BookAuthor[]> => {
  const { data } = await api.get(`/books/${book_id}/authors`);
  return data;
};
