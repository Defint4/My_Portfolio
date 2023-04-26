import React from 'react';
import './Profile.css';
import CV from '../../assets/Profile/CV-Guiot-Matthieu.pdf';

function Profile() {
  return (
    <div className='profile'>
      <h1>Mon CV</h1>
      <div className='pdf-container'>
        <iframe
          src={CV}
          title="CV"
          width="100%"
          height="650px"
          style={{ border: 'none' }}
        ></iframe>
      </div>
      <a href={CV} download="Matthieu_Guiot_CV.pdf" className="download-btn">Télécharger mon CV</a>
    </div>
  );
}

export default Profile;