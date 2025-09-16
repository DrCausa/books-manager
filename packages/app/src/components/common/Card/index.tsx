import { type ReactNode } from "react";
//import styles from "./Card.module.css";

type CardProps = {
  children?: ReactNode;
  className?: string;
};

const Card = ({ children, className }: CardProps) => {
  const baseClassName = "border p-4 rounded-lg";

  return (
    <div className={`${baseClassName} ${className}`.trim()}>{children}</div>
  );
};

export default Card;
