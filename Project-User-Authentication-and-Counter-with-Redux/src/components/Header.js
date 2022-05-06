import { useDispatch, useSelector } from 'react-redux';
import { authActions } from '../store/auth';

import classes from './Header.module.css';

const Header = () => {
  const dispatch = useDispatch();
  const showLogout = useSelector(state => state.auth.isAuthenticated);
  
  const logoutHandler = (event) => {
    dispatch(authActions.logout());
  };

  return (
    <header className={classes.header}>
      <h1>Auth with Redux</h1>
      <nav>
        <ul>
          <li>
            <a href='/'>My Products</a>
          </li>
          <li>
            <a href='/'>My Sales</a>
          </li>
          <li>
            {showLogout && <button onClick={logoutHandler}>Logout</button>}
          </li>
        </ul>
      </nav>
    </header>
  );
};

export default Header;
