import { createBrowserRouter } from "react-router-dom";
import App from "@/App";
import HomePage from "@pages/home";
import ExampleStatic from "@pages/examples/StaticExample";
import ExampleDynamic from "@pages/examples/DynamicExample";
import Unified from "@pages/examples/Unified";
import NotFoundPage from "@/pages/not-found";

const router = createBrowserRouter([
  {
    path: "/",
    element: <App />,
    children: [
      {
        index: true,
        element: <HomePage />,
      },
      {
        path: "example",
        element: <ExampleStatic />,
      },
      {
        path: "example/:value",
        element: <ExampleDynamic />,
      },
      {
        path: "unified",
        element: <Unified />,
      },
      {
        path: "unified/:value",
        element: <Unified />,
      },
    ],
  },
  {
    path: "*",
    element: <NotFoundPage />,
  },
]);

export default router;
