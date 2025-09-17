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

export interface BookAuthor {
  book_id: string;
  author_id: string;
}

export interface BookGenre {
  book_id: string;
  genre_id: string;
}
