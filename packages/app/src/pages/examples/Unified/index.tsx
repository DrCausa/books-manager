import { Link, useParams } from "react-router-dom";
import Card from "@components/common/Card";
import Button from "@components/common/Button";
import { usePageTitle } from "@hooks/usePageTitle";
//import styles from "./Unified.module.css";

const Unified = () => {
  usePageTitle();

  const { value } = useParams<{ value?: string }>();

  return (
    <Card className="w-[18rem] mx-auto text-center my-8">
      <h1 className="text-4xl font-bold">Unified Page</h1>
      <p className="mt-4 text-lg">
        value:{" "}
        {value ? (
          <strong>{value}</strong>
        ) : (
          <code className="text-red-800">
            <small>(empty)</small>
          </code>
        )}
      </p>
      <Link to={"/"}>
        <Button className="mt-4">Go back Home</Button>
      </Link>
    </Card>
  );
};

export default Unified;
