import classes from "./Card.module.css";

const Card = (props) => {
  return (
    <section
      className={` ${classes.card} ${props.ClassName ? props.ClassName : ""}`}
    >
      {props.children}
    </section>
  );
};

export default Card;
