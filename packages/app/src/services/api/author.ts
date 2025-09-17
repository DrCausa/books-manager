import { api } from ".";
import { type Author } from "./types";

export const getAuthors = async (): Promise<Author[]> => {
  const { data } = await api.get("/authors");
  return data;
};

export const getAuthorById = async (id: string): Promise<Author[]> => {
  const { data } = await api.get(`/authors/${id}`);
  return data;
};

export const createAuthor = async (
  author: Omit<Author, "id">
): Promise<Author[]> => {
  const { data } = await api.post("/authors", author);
  return data;
};

export const updateAuthor = async (
  id: string,
  author: Partial<Author>
): Promise<Author[]> => {
  const { data } = await api.put(`/authors/${id}`, author);
  return data;
};

export const deleteAuthor = async (id: string) => {
  await api.delete(`/authors/${id}`);
};
