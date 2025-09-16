import { Link } from "react-router-dom";
import Card from "@components/common/Card";
import Button from "@components/common/Button";
import { usePageTitle } from "@hooks/usePageTitle";
//import styles from "./StaticExample.module.css";

const Example = () => {
  usePageTitle();

  return (
    <Card className="w-[18rem] mx-auto text-center my-8">
      <h1 className="text-4xl font-bold">Static Example Page</h1>
      <Link to={"/"}>
        <Button className="mt-4">Go back Home</Button>
      </Link>
    </Card>
  );
};

export default Example;
