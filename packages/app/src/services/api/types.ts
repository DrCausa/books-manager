export interface Book {
  id: string;
  title: string;
  publication_date: string;
}

export interface Author {
  id: string;
  name: string;
}

export interface Genre {
  id: string;
  name: string;
  color_hex: string;
}
