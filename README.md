# Vanna AI Full-Stack Web Application  
**CSE 383 – Final Project**

## Overview  

For our final project in CSE 383, we developed a responsive, full-stack web application from scratch that enables users to query structured databases using natural language. The system integrates modern AI and web technologies, with the Vanna API serving as the core intelligence behind the query engine.

The primary goal of the project was to design and implement a modern web application that translates plain English questions into precise SQL queries, retrieves structured data from a MySQL database, and presents the results dynamically to users.

The entire system was containerized using Docker and deployed on a personal OpenStack instance. While some live features are currently unavailable due to the OpenStack server being offline, the system itself was fully implemented and operational at the time of deployment.

---

## Project Objectives  

- Build a modern, responsive full-stack web application from scratch  
- Integrate AI-powered natural language querying using the Vanna API  
- Develop a PHP-based backend server for application logic  
- Containerize all services using Docker  
- Deploy and manage infrastructure through OpenStack  
- Log and track all user interactions  
- Ensure full end-to-end functionality across all components  

---

## Technology Stack  

### Frontend  

- **HTML & CSS** – Structure and styling  
- **JavaScript** – Client-side logic and dynamic rendering  
- **Bootstrap** – Responsive layout and modern UI components  
- **jQuery & AJAX** – Asynchronous communication with the backend  

We spent significant time planning and refining the user interface to ensure responsiveness, clarity, and smooth interaction across devices. Bootstrap’s grid system and component library enabled efficient layout development, while JavaScript and AJAX powered real-time updates without requiring full page reloads.

---

### Backend  

- **PHP** – Used to build the backend REST server  
- **Python** – Used within the Vanna backend integration  
- **Apache Web Server** – Hosted backend services  
- **SQLite** – Stored transaction history logs  
- **MySQL** – Queried via AI-generated SQL  

We implemented a PHP-based REST server responsible for:

- Processing frontend requests  
- Managing communication between services  
- Logging user queries and responses  
- Returning structured data to the client  

The backend was carefully designed to ensure reliable communication between the frontend interface, the logging system, and the Vanna-powered query engine.

---

## Vanna API Integration  

The central feature of the application is its integration with the Vanna API.

User workflow:

1. A user enters a natural language question through the web interface.
2. The request is sent to the backend via AJAX.
3. The backend communicates with the Vanna service.
4. Vanna converts the natural language input into SQL.
5. The database is queried.
6. Structured results are returned and rendered dynamically.
7. The interaction is logged into a SQLite database.

This architecture makes structured data querying accessible to users without requiring SQL knowledge.

---

## Docker & OpenStack Deployment  

All system components were containerized using Docker, including:

- Apache web server  
- PHP backend server  
- Vanna backend  

The containers were deployed and managed on a personal OpenStack instance. This provided hands-on experience with:

- Cloud-based infrastructure management  
- Containerized service orchestration  
- Environment configuration and networking  

Although the OpenStack server is currently offline, the full system was deployed and functioning during the final implementation phase.

---

## Application Structure  

The application consists of five main sections:

1. Landing page  
2. Team member page (Partner)  
3. Team member page (My contributions & learning reflection)  
4. AI-powered query interface  
5. Searchable transaction history log  

### Team Member & Reflection Pages  

These pages outline individual contributions, technical responsibilities, and key learning experiences throughout the project, including system design, backend implementation, deployment configuration, and frontend development.

---

## Interaction & Logging System  

All user queries are processed in real time and logged through the student-built PHP backend into a SQLite database. The history page allows users to search and review previous interactions, ensuring full traceability within the system.

This logging mechanism demonstrates structured data handling and backend persistence within a containerized environment.

---

## Development Timeline  

### Project Inception  
Initial research and planning of core system functionality and AI integration goals.

### Architecture Design  
Defined system structure, container layout, service communication, and database strategy.

### MVP Development  
Implemented core query functionality and established frontend-backend communication.

### Testing & Refinement  
Conducted integration testing, UI adjustments, backend debugging, and deployment verification.

### Final Implementation  
Deployed the fully integrated system on OpenStack with all planned features operational.

We also conducted sprint check-ins every other week to evaluate progress, divide responsibilities, and ensure milestone completion.

---

## Key Learning Outcomes  

- Building a full-stack web application from scratch  
- Designing and implementing a PHP-based backend server  
- Integrating AI-driven database querying systems  
- Managing containerized services with Docker  
- Deploying applications on OpenStack infrastructure  
- Implementing structured logging systems  
- Designing responsive and interactive user interfaces  
- Collaborating through structured sprint cycles  

---

## Project Status  

Development has concluded. Some live functionality is currently unavailable due to the OpenStack server being offline. The architecture, implementation, and integration of all components were completed and fully operational during deployment.

---

This project demonstrates the ability to combine artificial intelligence, backend engineering, cloud infrastructure, containerization, and modern web development into a cohesive, fully integrated system.
