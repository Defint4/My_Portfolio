import React from 'react';
import './Footer.css';

function Footer() {
  return (
    <footer className='footer'>
      <div className='line'></div>
      <div className='footer-content'>
        <p>&copy; {new Date().getFullYear()} - Matthieu Guiot - Tous droits réservés.</p>
      </div>
    </footer>
  );
}

export default Footer;