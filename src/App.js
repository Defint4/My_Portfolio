import { BrowserRouter as Router, Routes, Route, useLocation } from 'react-router-dom';
import { CSSTransition, TransitionGroup } from 'react-transition-group';
import React from 'react';
import Header from './Components/Header/Header';
import Home from './pages/Home/Home';
import Projects from './pages/Projects/Projects';
import Contact from './pages/Contact/Contact';
import Profile from './pages/Profile/Profile';
import Game from './pages/Games/Game';
import Footer from './Components/Footer/Footer';
import './transitions.css';
import './App.css';

function App() {
  return (
    <Router>
      <div className="App">
        <div>
          <Header />
        </div>
        <div className="container">
          <AnimatedRoutes />
        </div>
        <div>
          <Footer />
        </div>
      </div>
    </Router>
  );
}

function AnimatedRoutes() {
  const location = useLocation();

  return (
    <TransitionGroup>
      <CSSTransition key={location.key} classNames="fade" timeout={500}>
        <Routes location={location}>
          <Route path="/" element={<Home />} />
          <Route path="/projects" element={<Projects />} />
          <Route path="/Profile" element={<Profile />} />
          <Route path="/contact" element={<Contact />} />
          <Route path="/games" element={<Game/>} />
        </Routes>
      </CSSTransition>
    </TransitionGroup>
  );
}

export default App;