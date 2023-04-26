import React, { useState } from 'react';
import './Contact.css';
import emailjs from 'emailjs-com';
import { init } from 'emailjs-com';
import { useForm } from 'react-hook-form';

init('KEY');

function Contact() {
  const [sent, setSent] = useState(false);
  const [loading, setLoading] = useState(false);
  const { register, handleSubmit, reset, formState: { errors } } = useForm();

  function sendEmail(data) {
    setLoading(true);

    const from_name = data.name;
    const from_email = data.email;
    const message = data.message;

    const formData = new FormData();

    formData.append('name', from_name);
    formData.append('email', from_email);
    formData.append('message', message);

    const emailPromise = emailjs.send('service_cu3mkyg', 'template_oms2t0v', {
      to_name: 'Guiot Matthieu',
      from_name: from_name,
      from_email: from_email,
      message: message
    }, 'KEY');

    const sqlPromise = fetch('/apiContact.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => {
        if (!response.ok) {
          throw new Error(response.statusText);
        }
        return response.text();
      })
      .catch(error => {
        console.error(error);
        throw new Error("Une erreur s'est produite, veuillez réessayer.");
      });

    Promise.all([emailPromise, sqlPromise])
      .then(([emailResult, sqlResult]) => {
        console.log('EmailJS result:', emailResult.text);
        console.log('SQL result:', sqlResult);
        sendAutoReply(from_name, from_email, message);
        setSent(true);
        setLoading(false);
      })
      .catch(error => {
        console.error(error);
        alert(error.message);
        setLoading(false);
      });

    reset();
  }

  function sendAutoReply(from_name, from_email, message) {
    emailjs.send('SERVICE', 'TEMPLATE', {
      from_name: from_name,
      to_name: from_name,
      to_email: from_email,
      message: message
    }, 'KEY')
      .then((result) => {
        console.log('Auto-reply sent:', result.text);
      }, (error) => {
        console.log('Auto-reply error:', error.text);
      });
  }

  return (
    <div className="contact-form">
      <h1 className='title'>Formulaire de contact</h1>
      <form onSubmit={handleSubmit(sendEmail)} method="POST">
        <input {...register('name', { required: true })} type='text' name='name' placeholder='Nom*' />
        {errors.name && <span className='error'>Ce champ est requis.</span>}
        <input {...register('email', { required: true, pattern: /^\S+@\S+$/i })} type='email' name='email' placeholder='Email*' />
        {errors.email && <span className='error'>Email invalide.</span>}
        <textarea {...register('message', { required: true })} name='message' placeholder='Message*' />
        {errors.message && <span className='error'>Ce champ est requis.</span>}
        <button type='submit'>Envoyer</button>
        {loading &&
          <div className="overlay">
            <div className="loader"></div>
          </div>
        }
        {sent && <p className='sent-message'>Message envoyé avec succès !</p>}
      </form>
    </div>
  );
}

export default Contact;
