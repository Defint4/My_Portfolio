import React from 'react';
import './Home.css';
import './SkillCard.css';
import html from '../../assets/Skills/html.png';
import css from '../../assets/Skills/css.png';
import js from '../../assets/Skills/js.png';
import react from '../../assets/Skills/react.png';
import node from '../../assets/Skills/node.png';
import php from '../../assets/Skills/php.png';
import mysql from '../../assets/Skills/mysql.png';
import reseau from '../../assets/Skills/reseau.png';
import python from '../../assets/Skills/python.png';
import c from '../../assets/Skills/C.png';


const skillsData = [
  { name: 'HTML', image: html },
  { name: 'CSS', image: css },
  { name: 'JavaScript', image: js },
  { name: 'React', image: react },
  { name: 'Node', image: node },
  { name: 'PHP', image: php },
  { name: 'MySQL', image: mysql },
  { name: 'Réseau', image: reseau },
  { name: 'Python', image: python },
  { name: 'C', image: c },
  
];

function SkillCard({ skill, image }) {
  return (
    <div className="skill-card">
      <img src={image} alt={skill} className="skill-icon" />
      <h3>{skill}</h3>
    </div>
  );
}

function Home() {
  return (
    <div className='home'>
      <div className='top'>
        <h1>Matthieu Guiot</h1>
      </div>
      <p className="about-me">
        Salut ! Je suis un étudiant passionné et déterminé en Bachelor de développement, option Cybersécurité,
        qui a troqué les plages paradisiaques de la Nouvelle-Calédonie pour les salles de classe de l'école Guardia à Lyon.
        Ayant obtenu mon Bac Scientifique sous les cocotiers, je me suis lancé dans l'aventure du développement informatique 
        pour transformer mes rêves en réalité. 
        <br></br><br></br>
        Avec une curiosité insatiable et une soif d'apprentissage, j'explore divers aspects de l'informatique et du développement. 
        Mon esprit créatif et ma vision des choses me permettent de me démarquer, car je suis convaincu qu'il ne faut pas seulement rêver,
        mais aussi réaliser ses rêves. Plus on attend, moins on a de chances de les réaliser, alors je m'efforce de toujours terminer les 
        projets que j'ai commencés et de ne jamais abandonner.
        <br></br><br></br>
        En dehors de l'univers numérique, je suis un passionné de bricolage et de création manuelle.
        Qui sait, peut-être qu'un jour je trouverai un moyen de fusionner ces deux mondes pour créer quelque chose d'encore
        plus extraordinaire ?
        <br></br><br></br>
        Mais ne vous y trompez pas, je suis bien plus qu'un simple étudiant. Je suis aussi quelqu'un d'ouvert et extraverti, 
        qui se fait facilement des amis. En travaillant avec moi, vous découvrirez non seulement un développeur talentueux, 
        mais aussi un véritable allié prêt à relever tous les défis.
        <br></br><br></br>
        Quant à ma plus grande faiblesse... je vous laisse le soin de la découvrir vous-même. Après tout,
        nous avons tous un petit mystère à résoudre, n'est-ce pas ?
      </p>
      <div className='top-skills'>
        <h2>Mes Compétences</h2>
      </div>
      <div className='skills'>
        {skillsData.map(({ name, image }, index) => (
          <SkillCard key={index} skill={name} image={image} />
        ))}
      </div>
    </div>
  );
}

export default Home;