# Dockerized Portfolio Web Application  
**CEC 383 – Web Applications Final Project**

## Overview  

This project is a full-stack web application consisting of a **Dockerized backend server** connected to a **frontend portfolio interface**. The application demonstrates RESTful communication between client and server, responsive UI design using Bootstrap, and structured team-based development through sprint check-ins.

The project was completed in collaboration with Cody Schafer, with sprint check-ins held every other week to review progress, resolve blockers, and plan upcoming tasks.

---

## Project Architecture  

The application follows a standard full-stack architecture:

Frontend (Portfolio UI)  
⬇ REST API Requests  
Backend Server (Docker Container)  

### Backend  
- Runs inside a Docker container  
- Exposes RESTful API endpoints  
- Handles HTTP requests from the frontend  
- Processes and returns JSON responses  
- Implements structured server-side error handling  

Containerizing the backend ensures:
- Consistent development environments  
- Simplified setup and deployment  
- Reproducible builds across systems  

---

### Frontend  

The frontend is a basic portfolio-style web interface that communicates with the backend via REST API calls.

#### Technologies Used
- **JavaScript** – Handles API requests, dynamic rendering, and client-side logic  
- **Bootstrap** – Provides responsive layout and clean UI components  

Bootstrap enabled:
- Grid-based responsive layouts  
- Consistent spacing and styling  
- Prebuilt UI components for faster development  

JavaScript was used for:
- Making asynchronous REST API calls  
- Handling JSON responses  
- Updating the DOM dynamically  
- Managing client-side error handling  

---

## REST API Integration  

The frontend and backend communicate using REST principles:

- Use of HTTP methods (e.g., GET, POST where applicable)  
- JSON-formatted request and response bodies  
- Route-based endpoint structure  

The frontend sends asynchronous requests to backend endpoints and dynamically renders the returned data. Proper separation of concerns was maintained between UI logic and server-side processing.

---

## Error Handling  

Error handling was implemented on both sides of the application.

### Backend
- Validates incoming requests  
- Returns appropriate HTTP status codes  
- Sends structured JSON error responses  

### Frontend
- Catches failed API requests  
- Prevents UI crashes  
- Displays user-facing feedback when errors occur  

This approach improved application stability and debugging efficiency during development.

---

## Development Process  

This project was developed using a structured sprint approach.

- Sprint check-ins every week  
- Task planning and milestone setting  
- Integration testing between frontend and backend  
- Iterative refinement and bug resolution  

Working in sprints reinforced collaboration, accountability, and incremental progress, simulating a real-world agile workflow.

---

## Key Concepts Demonstrated  

- Docker containerization  
- Backend server setup and configuration  
- REST API design and integration  
- JavaScript-based asynchronous communication  
- Responsive UI development with Bootstrap  
- Client-side and server-side error handling  
- Sprint-based collaborative development  

---

## Learning Outcomes  

Through this project, I strengthened my understanding of:

- How full-stack applications are structured  
- How frontend and backend systems communicate  
- The value of containerization for consistent environments  
- The importance of clean API design  
- Building responsive and user-friendly interfaces  
- Working collaboratively through structured sprint cycles  

This project represents practical, hands-on experience building and integrating a containerized backend with a responsive frontend using modern web development practices.

---

## Project Status  

Completed as part of CEC 383 – Web Applications.  
Development has concluded, but the project serves as a strong demonstration of full-stack architecture, Docker usage, REST API integration, and team-based workflow.
