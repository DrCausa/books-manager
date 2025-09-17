import { api } from ".";
import { type Book } from "./types";

export const getBooks = async (): Promise<Book[]> => {
  const { data } = await api.get("/books");
  return data;
};

export const getBookById = async (id: string): Promise<Book> => {
  const { data } = await api.get(`/books/${id}`);
  return data;
};

export const createBook = async (book: Omit<Book, "id">): Promise<string> => {
  const { data } = await api.post("/books", book);
  return data.id;
};

export const updateBook = async (
  id: string,
  book: Partial<Book>
): Promise<Book[]> => {
  const { data } = await api.put(`/books/${id}`, book);
  return data;
};

export const deleteBook = async (id: string) => {
  await api.delete(`/books/${id}`);
};
