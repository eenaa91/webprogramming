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

