import { Outlet } from "react-router-dom";
import MainLayout from "@components/layout/MainLayout";
import "@styles/App.css";

const App = () => {
  return (
    <MainLayout>
      <Outlet />
    </MainLayout>
  );
};

export default App;
