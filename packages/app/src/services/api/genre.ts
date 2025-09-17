import { api } from ".";
import { type Genre } from "./types";

export const getGenres = async (): Promise<Genre[]> => {
  const { data } = await api.get("/genres");
  return data;
};

export const getGenreById = async (id: string): Promise<Genre[]> => {
  const { data } = await api.get(`/genres/${id}`);
  return data;
};

export const createGenre = async (
  genre: Omit<Genre, "id">
): Promise<Genre[]> => {
  const { data } = await api.post("/genres", genre);
  return data;
};

export const updateGenre = async (
  id: string,
  genre: Partial<Genre>
): Promise<Genre[]> => {
  const { data } = await api.put(`/genres/${id}`, genre);
  return data;
};

export const deleteGenre = async (id: string) => {
  await api.delete(`/genres/${id}`);
};
