import React, { useState, useEffect } from 'react';
import './Project.css';

const fetchProjects = async () => {
  const response = await fetch('/api.php');
  const data = await response.json();
  return data;
};

function ProjectCard({project, image, onClick }) {
  return (
    <div className="project-card" onClick={onClick}>
      <img src={image} alt={project} />
      <p>{project}</p>
    </div>
  );
}

function Projects() {
  const [projectsData, setProjectsData] = useState([]);
  const [selectedProject, setSelectedProject] = useState(null);
  const [showModal, setShowModal] = useState(false);

  useEffect(() => {
    (async () => {
      const projects = await fetchProjects();
      setProjectsData(projects);
    })();
  }, []);

  const handleProjectClick = (project) => {
    setSelectedProject(project);
    setShowModal(true);
  };

  const closeModal = () => {
    setShowModal(false);
  };

  return (
    <div>
      <h1 className="title">Mes projets</h1>
      <div className="projects">
        {projectsData.map(({ id, nom, description, image }, index) => (
          <ProjectCard
            key={id}
            project={nom}
            image={image}
            onClick={() => handleProjectClick({ nom, description, image })}
          />
        ))}
      </div>
      {showModal && (
        <div className="modal-background" onClick={closeModal}>
          <div className="modal-content" onClick={(e) => e.stopPropagation()}>
            <button className="modal-close" onClick={closeModal}>
              &times;
            </button>
            {selectedProject && (
              <>
                <h3>{selectedProject.nom}</h3>
                <hr />
                <p className="desc">{selectedProject.description}</p>
              </>
            )}
          </div>
        </div>
      )}
    </div>
  );
}

export default Projects;
