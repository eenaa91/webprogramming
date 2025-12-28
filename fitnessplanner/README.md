# Fitness Planner System – Single Page Application (SPA)

This is a Fitness and Workout Planner Web Application, designed as a Single Page Application (SPA).  
The project allows users to explore workout and meal plans, track their fitness progress, and maintain healthy habits.

---

## The project for milestone 1 consists of:

- Frontend: HTML, CSS, Bootstrap, JavaScript (SPA routing)  
- Database: MySQL (DBeaver)

---

## Project Structure

The project structure is composed of frontend and backend folders for better organization.

Frontend includes:
- HTML templates (views)
- JavaScript files for page logic and routing
- CSS for layout and responsiveness
- Assets (images, icons, ERD diagram)

Backend includes:
- `routes` – for future API endpoints  
- `services` – business logic  
- `dao` – data access layer

---

## Database Design (MySQL)

The database is designed using MySQL in DBeaver, with 5 main tables to support users, workout plans, nutrition tracking, and progress logging.

---

## Entity-Relationship Diagram (ERD)

The database is structured to ensure efficiency and clear relationships between users, their workouts, and nutrition plans.

Users – Stores user information, login data, and roles (admin/user).  
Workout Plans – Contains all workout programs with title, description, and difficulty level.  
Meal Plans – Includes nutrition plans with meal type, calorie count, and description.  
Progress – Logs user fitness progress (weight, date, and notes).  
User Plans – Connects users to multiple workout plans (many-to-many relationship).

---

## Relationships

- One user can have many progress logs.  
- One user can follow multiple workout plans.  
- Each workout plan can be assigned to multiple users.  
- One user can have one meal plan.

---

## ERD Diagram

The ERD diagram for this project is available in the `assets/` folder.

Authentication and Authorization

The application implements authentication and authorization using JSON Web Tokens (JWT).

Users can register and log in through the authentication API.

Passwords are securely hashed on the backend.

After successful login, a JWT token is generated and returned to the frontend.

The token is stored in the browser (localStorage) and sent with each protected API request.

Role-based authorization is implemented:

Admin users can perform full CRUD operations on all entities.

Regular users have restricted access (e.g. read-only access or limited actions).

Authentication and authorization logic is implemented using middleware on the backend.

Backend Architecture

The backend is implemented using the FlightPHP framework and follows a layered architecture:

DAO (Data Access Objects) – handle direct database queries using PDO.

Services – contain business logic and data validation.

Routes – define REST API endpoints and connect HTTP requests to services.

Middleware – handles authentication, authorization, and request validation.

REST API and CRUD Operations

The backend exposes a REST API that supports full CRUD operations using standard HTTP methods:

GET – retrieve data

POST – create new records

PUT/PATCH – update existing records

DELETE – remove records

AJAX requests are used on the frontend to communicate with the backend API.

API Documentation (Swagger / OpenAPI)

The API is documented using OpenAPI (Swagger) annotations.

Each API endpoint is documented with annotations for paths, parameters, and responses.

Swagger documentation is generated automatically by scanning the route files.

The documentation provides an overview of available endpoints and their usage.

Frontend MVC Structure

The frontend is implemented as a Single Page Application (SPA) and follows an MVC-style structure:

Views – HTML templates loaded dynamically using SPA routing.

Services – JavaScript files that handle API communication.

RestClient – central utility for sending AJAX requests (GET, POST, PUT, DELETE).

Utils – helper functions for authentication and role checks.

This structure ensures separation of concerns and easier maintenance.

Frontend Validation and Security

Basic frontend validation is implemented using:

HTML validation attributes (required, email type)

JavaScript checks before submitting forms

Backend validation is implemented inside service methods to ensure data integrity and security.

Deployment

The application is prepared for deployment.

The frontend can be deployed as a static application (e.g. GitHub Pages).

The backend is configured to run on a hosted environment with a MySQL database.

Database connection settings are managed through the configuration file.

Due to configuration and environment constraints, the project was tested locally using XAMPP.
