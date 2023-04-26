import React from 'react';
import './game.css';

function Game() {
  return (
    <div>
      <h1 className='title'>Jeu en Python</h1>
      <iframe src='/Game.html' title="Jeu en Python" width="800" height="600"></iframe>
    </div>
  );
}

export default Game;
