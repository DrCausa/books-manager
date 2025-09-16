import { type ReactNode } from "react";
import Header from "@components/layout/Header/";
import Footer from "@components/layout/Footer/";
//import styles from "./MainLayout.module.css";

type MainLayoutProps = {
  children?: ReactNode;
};

const MainLayout = ({ children }: MainLayoutProps) => {
  return (
    <div>
      <Header />
      <main>{children}</main>
      <Footer />
    </div>
  );
};

export default MainLayout;
