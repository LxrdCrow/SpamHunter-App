# 📬 SpamHunter Application

**SpamHunter** is a lightweight PHP-based logic game designed to train users in identifying **phishing emails**. It simulates spam scenarios and lets users test their judgment, providing an educational and interactive experience.

---

## 🚀 Features

- Generate realistic **phishing emails** using dynamic templates.
- Simulate sending and storing email attempts.
- Track user sessions and scores.
- Modular and extensible PHP architecture.
- Clean routing and controller logic with no external frameworks.
- Fully file-based log and data storage for simplicity.

---

## 🧰 Technologies Used

- **PHP 8.x**
- **MySQL** (for user/session data)
- **Composer** (autoloading and optional dependency management)
- **Carbon** (date/time management)
- **FakerPHP** *(optional, for generating realistic data)*

---

## 📁 Project Structure

```plaintext
/src
│
├── controllers/
│   ├── HomeController.php
│   ├── PhishingController.php
│   ├── ScoreController.php
│   ├── SessionController.php
│   └── UserController.php
│
├── db/
│   ├── database.php
│   └── migration.sql
│
├── helpers/
│   ├── ArrayHelper.php
│   ├── EmailTemplateHelper.php
│   ├── GameHelper.php
│   └── StringHelper.php
│
├── models/
│   ├── GameSession.php
│   ├── GameSessionScore.php
│   ├── Home.php
│   ├── PhishingEmail.php
│   ├── Response.php
│   └── User.php
│
├── routes/
│   └── web.php
│
├── services/
│   ├── GameLogicService.php
│   └── PhishingMailService.php
│
├── index.php
└── kernel.php
````

---

## 🧪 How to Use

### ✅ Requirements

* PHP 8.0+
* MySQL (optional, depending on implementation)
* Composer (for class autoloading)

### 📦 Setup Instructions

1. **Clone the repository**

   ```bash
   git clone https://github.com/your-user/spamhunter.git
   cd spamhunter
   ```

2. **Run database migration (if using MySQL)**
   Import the SQL dump located in `/db/migration.sql` into your MySQL server.

3. **(Optional) Install Composer dependencies**

   ```bash
   composer install
   ```

4. **Start PHP built-in server**

   ```bash
   php -S localhost:8000 -t src/
   ```

5. **Access the app**
   Navigate to `http://localhost:8000` in your browser.

---

## 🔐 Routes Overview

### `GET /`

Homepage (welcome + system info)

### `GET /users`

List all users
`GET /users/{id}` – Get a specific user

### `POST /users`

Create new user
`PUT /users/{id}` – Update a user
`DELETE /users/{id}` – Delete a user

### `GET /sessions`

List all game sessions
`GET /sessions/{id}` – Specific session
`POST /sessions` – Create
`PUT /sessions/{id}` – Update
`DELETE /sessions/{id}` – Delete

### `GET /scores`

List all session scores

### `GET /phishing-email`

Generate phishing email
`GET /phishing-email/all` – Get all saved phishing emails
`POST /phishing-email/send` – Simulate sending
`POST /phishing-email/save` – Save to storage
`DELETE /phishing-email/all` – Remove all stored emails

---

## 📝 Data Storage

* **Logs**: stored in `/log.txt`
* **Generated Emails**: saved as JSON in `/data/phishing_emails.json`

---

## 🔍 File Highlights

### `PhishingEmailService.php`

Handles the full logic of generating, saving, and simulating phishing emails.

### `GameLogicService.php`

Encapsulates gameplay logic, using helpers and managing game flow.

### `EmailTemplateHelper.php`

Provides customizable email templates with placeholders like `{{name}}`, `{{link}}`, `{{company}}`.

### `StringHelper.php`

Handles generation of dynamic content like names, fake domains, etc. (FakerPHP integration recommended!)

---

## 🧪 Testing

You can test all API endpoints using tools like:

* Postman
* Insomnia
* cURL
* A browser for `GET` requests

Example:

```bash
curl http://localhost:8000/phishing-email
```

---

## 🧭 Future Updates

Here are potential improvements and future additions:

* [ ] Refactor the routing system using a custom `Router` class
* [ ] Add `api.php` routes file to separate REST API from web routes
* [ ] Improve logging with levels (`INFO`, `WARNING`, `ERROR`)
* [ ] Add web UI using HTML + Tailwind or integrate with Laravel
* [ ] Store phishing templates in the database with categories/tags
* [ ] Add admin panel to review saved phishing attempts
* [ ] Implement real mail sending using SMTP (e.g., with PHPMailer)

---



## 🧠 Credits

Built by **Federico**, a passionate backend developer and infosec enthusiast.






