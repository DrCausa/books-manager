import { useNavigate } from "react-router-dom";
import { useState } from "react";
import Card from "@components/common/Card";
import Icon from "@components/common/Icon";
import Button from "@components/common/Button";
import { usePageTitle } from "@hooks/usePageTitle";
//import styles from "./HomePage.module.css";

function HomePage() {
  usePageTitle();

  const [valueA, setValueA] = useState("");
  const [valueB, setValueB] = useState("");
  const navigate = useNavigate();

  const handleGoExample = () => {
    if (valueA.trim() !== "") {
      navigate(`/example/${valueA}`);
    } else {
      navigate("/example");
    }
  };

  const handleGoUnified = () => {
    navigate(`/unified/${valueB}`);
  };

  const handleForce404 = () => {
    navigate("/unknown-page-here");
  };

  return (
    <Card className="mx-auto my-8 w-[24rem]">
      <h1 className="text-4xl text-center uppercase mb-4 font-semibold">
        Hello World
      </h1>
      <p className="text-lg mb-4 text-justify">
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iusto eveniet
        id libero doloremque perspiciatis quos pariatur nam debitis nesciunt
        quisquam, explicabo repellat distinctio illum suscipit veniam nobis,
        maiores quis sapiente?
      </p>
      <div className="flex items-center gap-4 my-4">
        <input
          type="text"
          name="value"
          id="value"
          value={valueA}
          className="border flex py-2 px-3 focus:outline-none rounded-lg"
          placeholder="eg. 123"
          onChange={(e) => setValueA(e.target.value)}
        />
        <Button
          className="border px-3 py-2 rounded-full cursor-pointer w-full"
          onClick={handleGoExample}
        >
          Go example
        </Button>
      </div>
      <div className="flex items-center gap-4 my-4">
        <input
          type="text"
          name="value"
          id="value"
          value={valueB}
          className="border flex py-2 px-3 focus:outline-none rounded-lg"
          placeholder="eg. 123"
          onChange={(e) => setValueB(e.target.value)}
        />
        <Button
          className="border px-3 py-2 rounded-full cursor-pointer w-full"
          onClick={handleGoUnified}
        >
          Go unified
        </Button>
      </div>
      <div className="flex items-center gap-4 my-4">
        <Button
          className="border px-3 py-2 rounded-full cursor-pointer w-full"
          onClick={handleForce404}
        >
          Force 404 error
        </Button>
      </div>
      <div className="flex w-min mx-auto">
        <Icon
          className="!text-6xl bg-black/25 m-2 rounded-full p-3 hover:bg-black/15 hover:text-gray-800"
          iconName="experiment"
          iconType="OUTLINED"
        />
        <Icon
          className="!text-6xl bg-black/25 m-2 rounded-full p-3 hover:bg-black/15 hover:text-gray-800"
          iconName="home"
          iconType="ROUNDED"
        />
        <Icon
          className="!text-6xl bg-black/25 m-2 rounded-full p-3 hover:bg-black/15 hover:text-gray-800"
          iconName="engineering"
          iconType="SHARP"
        />
      </div>
      <div className="flex w-min mx-auto">
        <Icon
          className="!text-6xl bg-black/25 m-2 rounded-full p-3 hover:bg-black/15 hover:text-gray-800"
          iconName="experiment"
          iconType="OUTLINED"
          isFilled={true}
        />
        <Icon
          className="!text-6xl bg-black/25 m-2 rounded-full p-3 hover:bg-black/15 hover:text-gray-800"
          iconName="home"
          iconType="ROUNDED"
          isFilled={true}
        />
        <Icon
          className="!text-6xl bg-black/25 m-2 rounded-full p-3 hover:bg-black/15 hover:text-gray-800"
          iconName="engineering"
          iconType="SHARP"
          isFilled={true}
        />
      </div>
    </Card>
  );
}

export default HomePage;
