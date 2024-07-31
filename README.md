# Bridging FX - Task #292: Contact Us Form

**Overview**
This project showcases the implementation of a "Contact Us" form using Laravel, featuring both backend and frontend development aspects. It includes automated email notifications and an admin panel for managing submissions.

**Contact Us Form**
Design: Crafted with Bootstrap, the form captures Name, Email, Subject, and Message fields.
**Data Management:**
Submissions are saved in the database and trigger email notifications to both the user and admin.
**Email Notifications**
User Email: Sends a branded thank-you email to the user.
Admin Email: Alerts the admin of a new submission.
**Admin Panel**
Login: Secured with predefined credentials.
Submissions Listing: Displays form submissions in a jQuery Bootstrap DataTable.
CSV Export: Allows export of submission data to a CSV file.
Detailed View: View individual submissions and send feedback directly via email.
**Configuration**
**Environment Variables:**
Manage email settings (SMTP) and application theme color through environment variables.

## Installation & Setup

    **Clone the repository:**
        git clone https://github.com/shikhapathania4/bridgingfx.git
        cd bridgingfx

    **Install dependencies:**
        composer install
        npm install

    Set up environment:
        Copy the .env.example file to .env and update the environment variables (database credentials, mail settings, etc.).

    Generate application key:
        php artisan key:generate

    Run migrations:
        php artisan migrate

    Seed the database:
        php artisan db:seed

    Build frontend assets:
        npm run dev

    Start the server:
        php artisan serve

_Access the Contact Us form: Navigate to /contact-us._
Admin Panel Login: Access the admin panel at /admin using predefined credentials.

    Environment Configuration
        Mail Configuration:
        Set up mail configurations in the .env file:
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME=<your-username>
        MAIL_PASSWORD=<your-password>
        MAIL_ENCRYPTION=tls
        MAIL_FROM_ADDRESS="noreply@example.com"
        MAIL_FROM_NAME="${APP_NAME}"

    Admin Credentials:
        Update the admin credentials in the seeder file.

**For UI/UX please run these commands**  
 composer require laravel/ui
php artisan ui vue --auth
npm install && npm run dev
php artisan migrate
