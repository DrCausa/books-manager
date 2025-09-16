import type { ReactNode } from "react";
//import styles from "./Button.module.css";

type BUTTON_TYPE = "button" | "submit" | "reset";

type ButtonProps = {
  children?: ReactNode;
  value?: string;
  className?: string;
  onClick?: () => void;
  type?: BUTTON_TYPE;
};

const Button = ({
  children,
  value,
  onClick,
  className,
  type = "button",
}: ButtonProps) => {
  const baseClassName = "border px-3 py-2 rounded-full cursor-pointer w-full";

  return (
    <button
      type={type}
      className={`${baseClassName} ${className}`.trim()}
      onClick={onClick}
    >
      {children ?? value}
    </button>
  );
};

export default Button;
