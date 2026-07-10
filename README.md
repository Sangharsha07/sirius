# Sirius - Student Mental Wellness Platform

Sirius is a Laravel-based web application designed to help students reflect on their well-being, track mood and stress, maintain a journal, set wellness goals, find support resources, and participate in a moderated peer-support community.

The project also integrates the Google Gemini API for two optional AI-assisted features:

- Mood reflection analysis, including estimated mood, stress, energy, likely trigger, confidence, and practical suggestions.
- Safety moderation for support-board posts and replies.

> Sirius is an educational wellness-support application. It does not provide medical diagnosis, treatment, or emergency services. AI output may be inaccurate and should not replace qualified support.

---

## Main Features

- User registration, login, logout, password reset, and profile management with Laravel Breeze
- Personalized dashboard showing recent stress, active goals, and latest mood
- Mood, stress, energy, trigger, date, and reflection tracking
- Gemini-powered mood reflection analysis
- Saved mood history with user ownership protection
- Private or publicly shared journal entries
- Wellness goal creation and completion tracking
- Student wellness resource library
- Support-board posts and replies with anonymous display names
- Post and reply upvoting/downvoting
- Local safety rules plus Gemini moderation
- Admin moderation queue for content marked for review
- Sirius automatic support-resource reply on approved support posts
- Dark mode on major application pages
- Responsive layouts for desktop and smaller screens
- About Us, Terms and Conditions, and Privacy Policy pages

---

## Technology Stack

### Backend

- PHP 8.3+
- Laravel 13
- Laravel Eloquent ORM
- Laravel validation, routing, middleware, and service classes

### Frontend

- Laravel Blade
- HTML
- Custom CSS
- JavaScript
- Tailwind CSS for Laravel Breeze components
- Alpine.js for Breeze interactions
- Vite for frontend asset bundling

### Database

- SQLite by default
- MySQL or PostgreSQL can be configured through `.env`

### Authentication

- Laravel Breeze

### AI Integration

- Google Gemini Generative Language API

### Testing

- Pest with the Laravel plugin
- Manual end-to-end browser testing

---

## Application Architecture

Sirius follows Laravel's Model-View-Controller structure:

```text
Browser
   |
Blade + HTML + CSS + JavaScript
   |
routes/web.php
   |
Controllers
   |
Models / Service Classes
   |                 |
SQLite Database     Google Gemini API
   |                 |
   +-------- Laravel Response --------+
                    |
             Blade View or JSON
```

Important project locations:

```text
app/Http/Controllers/     Request handling and application logic
app/Models/               Eloquent models
app/Services/             Gemini integrations
config/                   Laravel and third-party configuration
database/migrations/      Database schema
database/seeders/         Demo account seeding
resources/views/          Blade templates
resources/css/            Frontend styles
resources/js/             Frontend JavaScript
routes/web.php             Main web routes
routes/auth.php            Breeze authentication routes
public/images/             Sirius logo and favicon
```

---

# Installation and Setup

These instructions are written for a fresh local installation.

## 1. Prerequisites

Install:

- PHP 8.3 or newer
- Composer
- Node.js and npm
- PHP SQLite support (`pdo_sqlite`)
- Common Laravel PHP extensions, including DOM/XML and mbstring

Git is optional if the project is supplied as a ZIP file.

## 2. Open the Project Folder

Extract the project and open a terminal in the folder containing `artisan` and `composer.json`.

```bash
cd sirius
```

## 3. Install PHP Dependencies

```bash
composer install
```

## 4. Install Frontend Dependencies

```bash
npm install
```

Do not reuse a `node_modules` folder copied from another operating system. Install dependencies locally so native packages match the current computer.

## 5. Create the Environment File

macOS or Linux:

```bash
cp .env.example .env
```

Windows Command Prompt:

```bat
copy .env.example .env
```

## 6. Generate the Laravel Application Key

```bash
php artisan key:generate
```

## 7. Configure SQLite

Create an empty database file.

macOS or Linux:

```bash
touch database/database.sqlite
```

Windows PowerShell:

```powershell
New-Item database/database.sqlite -ItemType File
```

Make sure `.env` contains:

```env
APP_NAME=Sirius
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
```

## 8. Configure Gemini AI

Gemini is required only for AI mood analysis and AI-assisted support moderation. The rest of the application can run without it.

Add a valid key to `.env`:

```env
GEMINI_API_KEY=your_gemini_api_key_here
GEMINI_MODEL=gemini-2.5-flash-lite
```

The model is configurable. Use the model value supported by the project/API account.

Never commit or submit a real API key in `.env`.

## 9. Configure Admin Review Access

The support moderation queue uses an email allow-list.

To allow the seeded demo account to access the review page, use:

```env
ADMIN_EMAILS=test@example.com
```

Multiple administrator emails may be separated with commas:

```env
ADMIN_EMAILS=admin1@example.com,admin2@example.com
```

## 10. Create Tables and Seed the Demo Account

```bash
php artisan migrate --seed
```

This creates the database schema and the demo account.

### Demo Account

```text
Email: test@example.com
Password: Password
```

The password is case-sensitive.

## 11. Build Frontend Assets

```bash
npm run build
```

For active frontend development, use:

```bash
npm run dev
```

## 12. Clear Cached Configuration

```bash
php artisan optimize:clear
```

## 13. Start Sirius

Simple method:

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

Development method with Laravel, queue listener, logs, and Vite together:

```bash
composer run dev
```

Stop the running process with `Ctrl + C`.

---

# How to Use Sirius

## Register or Log In

1. Open the home page.
2. Select **Register** to create an account, or **Login** to use an existing account.
3. Authenticated users can access the dashboard, mood tracker, journal, goals, resources, support board, and profile.

## Dashboard

The dashboard displays:

- Latest mood indicator
- Average stress from recent mood entries
- Number of goals currently marked **In Progress**
- Quick links to the main Sirius tools

## Mood Tracker

1. Open **Mood**.
2. Select a mood.
3. Set stress and energy from 0 to 100.
4. Select a likely trigger and date.
5. Write an optional reflection.
6. Select **Analyze Reflection with Sirius AI** for an optional AI estimate.
7. Review the estimated mood, stress, energy, trigger, confidence, insight, and suggestions.
8. Select **Use this AI estimate** to copy the estimate into the form.
9. Review or edit the values.
10. Select **Save Mood**.

The AI result is not saved automatically. The user remains in control of the final values.

## Journal

1. Open **Journal**.
2. Enter a title and reflection.
3. Choose **Private** or **Share publicly**.
4. Save the journal entry.
5. Previous entries are displayed only for the signed-in user.

## Wellness Goals

1. Open **Goals**.
2. Enter a goal title, category, and target date.
3. Save the goal.
4. Change its status between **In Progress** and **Completed**.

## Resources

The resource library contains pages for:

- Counseling support
- Stress management
- Sleep support
- Emergency information

A floating **Need support?** widget provides quick access to support contacts and the full Resources page.

## Support Community

1. Open **Support**.
2. Create a post with a title, description, category, support type, and optional anonymous display name.
3. Sirius applies local rules and Gemini moderation.
4. Approved content is shown publicly.
5. Uncertain content is saved with `review` status and hidden until an administrator decides.
6. Blocked content is not published.
7. Students can add replies and vote on eligible posts and replies.
8. Users may delete only their own posts and replies.

### Moderation Statuses

```text
approved  Visible on the support board
review    Hidden until an administrator approves or rejects it
blocked   Not published
```

## Admin Moderation Queue

1. Sign in using an email listed in `ADMIN_EMAILS`.
2. Open:

```text
/support/review
```

3. Review pending posts and replies.
4. Approve or reject the content.

---

# Data Storage

Sirius uses SQLite by default.

The local database file is:

```text
database/database.sqlite
```

Core tables include:

| Table | Purpose |
|---|---|
| `users` | Accounts and authentication data |
| `mood_entries` | Mood, stress, energy, triggers, reflections, and AI estimate fields |
| `journals` | Private/public journal entries |
| `goals` | Wellness goals and completion status |
| `support_posts` | Support-board posts and moderation fields |
| `support_replies` | Replies and moderation fields |
| `support_post_votes` | Per-user post votes |
| `support_reply_votes` | Per-user reply votes |
| `sessions` | Database-backed sessions |
| `cache`, `cache_locks` | Laravel cache storage |
| `jobs`, `job_batches`, `failed_jobs` | Laravel queue infrastructure |

User-generated data is stored locally in the configured relational database. Gemini is called remotely over HTTPS for AI processing.

---

# Gemini Data Flow

## Mood Analysis

```text
Reflection text
      |
POST /mood/analyze
      |
MoodEntryController
      |
SiriusGeminiMoodService
      |
Google Gemini API
      |
Structured JSON result
      |
Sirius AI Insight card
      |
User reviews and optionally applies the estimate
```

## Support Moderation

```text
Post or reply text
      |
SupportBoardController
      |
Local safety rules
      |
SiriusGeminiModerationService
      |
approved / review / blocked
      |
Public board, admin queue, or blocked response
```

Passwords and authentication credentials are not sent to Gemini.

---

# Security Features

- Laravel password hashing
- Authentication middleware for protected routes
- CSRF protection on forms
- Server-side input validation
- Blade output escaping
- Eloquent ORM instead of manually concatenated SQL
- Ownership checks for mood entries, goals, support posts, and replies
- Email allow-list for the moderation queue
- API keys stored in `.env`
- User-specific queries for mood entries, journals, and goals

---

# Testing

## Automated Tests

The project includes Pest feature tests for:

- Registration
- Login and logout
- Email verification
- Password reset and confirmation
- Password updates
- Profile updates and deletion
- Dashboard values
- Journal creation
- Goal creation and user isolation
- Public policy pages

Run:

```bash
php artisan test
```

or:

```bash
composer test
```

The local PHP installation must include the DOM/XML extension for PHPUnit/Pest.

## Manual Testing Checklist

- Registration, login, logout
- Protected-route redirection
- Dashboard values
- Mood creation, display, and deletion
- Gemini mood analysis
- Applying and saving an AI estimate
- Journal creation and visibility choice
- Goal creation and status update
- Resources and support links
- Support post and reply creation
- Approved, review, and blocked moderation flows
- Post and reply voting
- Ownership restrictions
- Admin review access
- Dark mode
- Responsive layouts

---

# Known Limitations

- AI estimates can be inaccurate and are not diagnoses.
- Gemini features require an internet connection and valid API configuration.
- The current admin system uses an environment email allow-list rather than database roles and permissions.
- The support board is not real-time chat.
- SQLite is appropriate for this course project and local use, but a larger deployment would normally use a managed database such as MySQL or PostgreSQL.
- Voting currently uses GET routes even though voting changes data; POST/PATCH routes would be a more RESTful future improvement.
- The project has more automated coverage for authentication, dashboard, journal, and goals than for mood AI and support moderation.
- Public journal sharing and support moderation should be reviewed carefully before a production deployment.
- Additional accessibility and production security testing would be required before real-world use.

---

# Troubleshooting

## `Class "DOMDocument" not found`

Install or enable the PHP DOM/XML extension, then restart the terminal or PHP service.

## `could not find driver` for SQLite

Install or enable PHP's SQLite extensions:

```text
pdo_sqlite
sqlite3
```

## Vite/native binding error after copying `node_modules`

Delete the copied dependency folder and reinstall on the current operating system:

macOS or Linux:

```bash
rm -rf node_modules
npm install
npm run build
```

Windows PowerShell:

```powershell
Remove-Item node_modules -Recurse -Force
npm install
npm run build
```

## Gemini key missing

Check `.env`:

```env
GEMINI_API_KEY=your_key_here
GEMINI_MODEL=gemini-2.5-flash-lite
```

Then run:

```bash
php artisan optimize:clear
```

## Admin receives 403 on `/support/review`

Make sure the logged-in email appears in `ADMIN_EMAILS`, then run:

```bash
php artisan optimize:clear
```

Log out and log in again.

---

# Code Attribution

## Laravel Framework

Used for routing, controllers, middleware, validation, Eloquent ORM, migrations, services, configuration, and application structure.

- https://laravel.com/docs

## Laravel Breeze

Used for authentication scaffolding, including registration, login, password workflows, profile management, Blade components, and authentication tests.

- https://laravel.com/docs/starter-kits

## Tailwind CSS and `@tailwindcss/forms`

Used by Laravel Breeze views and compiled frontend assets.

- https://tailwindcss.com

## Alpine.js

Used for interactive Breeze components such as dropdowns and modals.

- https://alpinejs.dev

## Vite and Laravel Vite Plugin

Used to bundle frontend CSS and JavaScript.

- https://vite.dev

## Pest

Used for automated feature and unit tests.

- https://pestphp.com

## Google Gemini API

Used through custom Laravel services for mood reflection analysis and support content moderation.

Project locations:

```text
app/Services/SiriusGeminiMoodService.php
app/Services/SiriusGeminiModerationService.php
app/Http/Controllers/MoodEntryController.php
app/Http/Controllers/SupportBoardController.php
resources/views/mood.blade.php
resources/views/support.blade.php
```

- https://ai.google.dev/gemini-api/docs

## AI-Assisted Development

AI development assistants, including ChatGPT and GitHub Copilot, were used for brainstorming, code explanations, debugging assistance, interface suggestions, and documentation support. The team reviewed, adapted, integrated, and tested the final implementation and accepts responsibility for understanding the submitted code.

## Sirius Logo and Favicon

The Sirius logo was created with generative design assistance and adapted for website branding and favicon use.

```text
public/images/siriuslogo.png
public/images/favicon.png
```

---

# Team Contributions

## Sangharsha Sapkota

- Scaffolded the initial Laravel project and route structure.
- Integrated Laravel Breeze authentication.
- Developed the mood-tracker backend and Gemini mood-analysis integration.
- Developed the support-board backend, moderation pipeline, and admin review workflow.
- Integrated Gemini service classes.
- Redesigned and refined the Home, Mood, and Support interfaces during final integration.
- Participated in debugging, testing, Git collaboration, and final integration.

## Dipson Subedi

- Developed the private/shared Journal feature, including controller, model, migration, and view.
- Developed the Wellness Goals feature, including controller, model, migration, view, and tests.
- Contributed to support-board data models and voting functionality.
- Refactored shared CSS and contributed to interface improvements.
- Investigated deployment options during development.
- Participated in debugging, testing, and Git collaboration.

## Ibrahim Sajid Janjua

- Developed the wellness Resources section and its counseling, stress, sleep, and emergency subpages.
- Implemented dark mode across major application pages.
- Added About Us, Terms and Conditions, and Privacy Policy pages.
- Coordinated frontend consistency and privacy-policy work.
- Contributed to documentation, code attribution, testing, and final submission organization.

All group members are responsible for reviewing, testing, and understanding the final submitted application.

---

# Project Information

```text
Project: Sirius - Student Mental Wellness Platform
Course: [ADD COURSE NAME]
Instructor: [ADD INSTRUCTOR NAME]
Institution: [ADD INSTITUTION NAME]
Submission Date: July 10, 2026
```

---

# License

This project was created for educational purposes as a university course project.

