# NUM Smart Faculty Site
### A Final Year Thesis Project

This repository contains the source code for my final year thesis project, a comprehensive web platform developed for the **Faculty of Information Technology at the National University of Management (NUM)**.

---

## 📖 Project Overview & Purpose

As a requirement for the completion of my Bachelor's Degree, this project aims to design and implement a modern, all-in-one digital solution to enhance the student and faculty experience at the NUM IT Faculty.

The primary goal is to centralize information and services, creating a single, reliable hub for academic details, student schedules, university resources, and instant support through an intelligent AI assistant. This platform addresses the need for a more integrated and accessible digital environment for both prospective and current students.

---

## ✨ Key Features

This platform is built on four core components:

#### 1. Public-Facing Website
* **Dynamic Homepage:** A professional landing page with the latest news and updates.
* **Academic Program Showcase:** A detailed view of all available degrees (CS, IT, BIT), including curricula and tuition fees, managed directly from a database.
* **Faculty & Events Portals:** Pages to introduce the university's esteemed professors and showcase upcoming university events.
* **Fully Responsive Design:** Ensures a seamless experience on desktops, tablets, and mobile phones.

#### 2. Secure Student Dashboard
* **Secure Authentication:** A robust login system for registered students.
* **Personalized Class Schedule:** Each student can view their unique, dynamically generated class timetable.
* **Profile Management:** Allows students to manage their personal information securely.
* **Digital Library:** A portal to access university-provided books and learning resources.

#### 3. Administrative Backend
* **Role-Based Access Control:** A secure backend accessible only to authorized administrators.
* **Full Content Management System (CMS):**
    * Manage **Academic Programs**, **Course Schedules**, and **University Events**.
    * **User Management:** Admins can review, approve, and manage student accounts.
    * Upload and manage **Digital Library Books** and resources.

#### 4. NUM-Bot (AI Assistant) 🤖
* **Powered by Google's Gemini AI:** Provides intelligent and context-aware responses to user queries.
* **Bilingual Support:** Understands and communicates fluently in both **English** and **Khmer (ខ្មែរ)**.
* **Real-time Database Integration:** Fetches live information, such as program lists and fees, to ensure answers are always current.
* **Advanced Intent Recognition:** Accurately distinguishes between complex questions about university roles (e.g., Rector vs. Dean vs. Head of Department).

---

## 🛠️ Technology Stack

* **Backend Framework:** Laravel 11 (PHP 8.2)
* **Frontend:** Blade Templates, Tailwind CSS, JavaScript
* **Database:** MySQL
* **AI Integration:** Google Gemini API
* **Development Environment:** Laravel Sail (Docker)

---

## 🔬 Instructions for Local Testing & Evaluation

To allow for local testing and evaluation of this project, please follow these setup instructions:

1.  **Clone the Repository:**
    ```bash
    git clone [https://github.com/rethsaraknorin/numthesis.git]
    cd numthesis
    ```

2.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```

3.  **Configure Environment:**
    * Create a `.env` file by copying `.env.example`.
    * Update your Database credentials (`DB_*` variables).
    * Add your `GEMINI_API_KEY`.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Run Database Migrations & Seeding:**
    * This command creates the database schema and populates it with initial data.
    ```bash
    php artisan migrate --seed
    ```

5.  **Install JavaScript Dependencies & Build:**
    ```bash
    npm install
    npm run dev
    ```

6.  **Serve the Application:**
    ```bash
    php artisan serve
    ```
    The application will be accessible at `http://127.0.0.1:8000`.

---