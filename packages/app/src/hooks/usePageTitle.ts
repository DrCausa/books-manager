import { useEffect } from "react";
import { useLocation, useParams, matchPath } from "react-router-dom";

export const usePageTitle = () => {
  const location = useLocation();
  const params = useParams();

  let title = "BooksManager";

  if (location.pathname === "/") {
    title = "Home";
  } else if (matchPath("/example/:value", location.pathname)) {
    title = params.value ? `Example - ${params.value}` : "Example";
  } else if (matchPath("/example", location.pathname)) {
    title = "Example";
  } else if (matchPath("/unified/:value", location.pathname)) {
    title = params.value ? `Unified - ${params.value}` : "Unified";
  } else if (matchPath("/unified", location.pathname)) {
    title = "Unified";
  } else {
    title = "404 - Page Not Found";
  }

  const fullTitle = `${title} | BooksManager`;

  useEffect(() => {
    document.title = fullTitle;
  }, [fullTitle]);
};
