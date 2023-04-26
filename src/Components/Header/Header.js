import React from 'react';
import './Header.css';
import logo from '../../assets/logo.png';
import { NavLink } from 'react-router-dom';

function Header() {
  return (
    <header className='header'>

      <div className="logo">
        <img src={logo} alt="logo" />
      </div>
      <nav className="navbar">

          <ul>
              <li><NavLink to="/" exact>Accueil</NavLink></li>
              <li><NavLink to="/Projects">Mes projets</NavLink></li>
              <li><NavLink to="/Profile">Mon CV</NavLink></li>
              <li><NavLink to="/Contact">Contact</NavLink></li>
              <li><NavLink to="/Games">Mini-Jeu</NavLink></li>
          </ul>
      </nav>

      <div className='line'></div>
    </header>
  );
}

export default Header;
