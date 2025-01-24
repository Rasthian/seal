# Technical Test Backend Engineer Internship - SEAL

## Brief Task

You have just been accepted as an intern backend developer at a technology company developing a **Task Management Application** for project teams. This application aims to help team members organize and monitor their tasks more efficiently.

---

## Task Description

### 1. API for Users
**Function:** Manage user data.

#### Operations:
- **POST**: Create a new user.
- **GET**: Retrieve user information.
- **PUT**: Update user details.
- **DELETE**: Remove a user.

#### Database Requirements:
The user database must include a field for the avatar/photo profile.

---

### 2. API for Tasks
**Function:** Manage task data.

#### Operations:
- **POST**: Create a new task.
- **GET**: Retrieve task information.
- **PUT**: Update task details.
- **DELETE**: Remove a task.

---

### 3. API for Projects
**Function:** Manage project data.

#### Operations:
- **POST**: Create a new project.
- **GET**: Retrieve project information.
- **PUT**: Update project details.
- **DELETE**: Remove a project.

---

### 4. Authentication and Authorization
Implement a simple authentication system using **JWT (JSON Web Token)** to ensure that only registered users can access the API.

#### Requirements:
- Add middleware to validate the authentication token before processing requests.

---

### 5. Data Relationships
- Each project can have multiple tasks.
- Each task must be associated with one user responsible for it.

---
