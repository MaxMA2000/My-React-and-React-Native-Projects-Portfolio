import { useSelector, useDispatch } from "react-redux";

import { counterActions } from "../store/counter";

import classes from "./Counter.module.css";

const Counter = () => {
  const dispatch = useDispatch();
  const counter = useSelector((state) => state.counter.counter);
  const show = useSelector((state) => state.counter.showCounter);

  // Handler functions: click to add / minus counter value
  const incrementHandler = (event) => {dispatch(counterActions.increment())};
  const increaseHandler = (event) => {dispatch(counterActions.increase(20))};
  const decrementHandler = (event) => {dispatch(counterActions.decrement())};

  // Handler function: click to toggle the counter to show
  const toggleCounterHandler = (event) => {
    dispatch(counterActions.toggleCounter());
  };

  return (
    <main className={classes.counter}>
      <h1>Redux Counter</h1>
      {show && (
        <div>
          <div className={classes.value}>{counter}</div>
          <div className={classes.value}>-- COUNTER VALUE HERE --</div>
          <div>
            <button className={classes.three_button} onClick={incrementHandler}>Increment</button>
            <button className={classes.three_button} onClick={increaseHandler}>Increase by 20</button>
            <button className={classes.three_button} onClick={decrementHandler}>Decrement</button>
          </div>
        </div>
      )}
      <button className={classes.button} onClick={toggleCounterHandler}>
        Toggle Counter
      </button>
    </main>
  );
};

export default Counter;
