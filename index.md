Here’s a simplified version of the project setup guide:

Project Setup Guide

This guide helps you get the frontend (website) and backend (API) up and running locally in a monorepo project.

Prerequisites

Make sure you have the following installed:
• Docker & Docker Compose
• Node.js & Yarn

Backend Setup (API)

1. Copy Environment Configuration

In the backend folder, copy the .env.example to .env:

cp .env.example .env

2. Install Dependencies

Install the necessary PHP dependencies using Docker and Sail:

./vendor/bin/sail up -d

This will start the Docker containers for the backend, including the database.

3. Set Up Email Provider

If using MailTrap, add the following to your .env file:

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="${APP_NAME}"

4. Run Queues and Schedules

Start the queue and schedule workers:

./vendor/bin/sail artisan queue:work
./vendor/bin/sail artisan schedule:work

5. Create Elasticsearch Index:

./vendor/bin/sail artisan elastic:create-index

6.Run Migrations & Seed Data

Run migrations and seed data to set up your database:

./vendor/bin/sail artisan migrate --seed

Frontend Setup (Website)

1. Copy Environment Configuration

In the frontend folder (website), copy the .env.example to .env:

cd website
cp .env.example .env

2. Update API URL

In the website/.env file, set the API_URL to the backend’s URL (usually http://localhost:80 if using Sail):

API_URL=http://localhost:80

3. Install Frontend Dependencies

Install necessary JavaScript dependencies:

yarn install

4. Start the Development Server

Start the frontend development server:

yarn dev

The frontend will be available at http://localhost:9000.

Application Workflow

Once both the frontend and backend are running, follow these steps:

1. Register a New User
   • Click on Sign In button on right top sign up.
2. Send OTP
   • Check your email (MailTrap or your provider) for the OTP.
   • Enter the OTP on the frontend to log in.
3. Create a New Post
   • After logging in, click the “Write” button.
   • Add the post title and content, then submit it.
4. Read Posts
   • Go to the Read Post section to see all blog posts.
   • Click on a post title to view it in detail.
   • You can also add comments to the post.

Troubleshooting
• API or Frontend Not Working: Ensure Docker is running (docker-compose up).
• Email Delivery Issues: Double-check the email provider settings in the .env file.
• Frontend Issues: Check the browser’s console and network tab for errors.
• Backend Issues: Use docker logs or Laravel logs for troubleshooting.

Conclusion

By following these steps, you’ll have the frontend and backend set up and running locally. You’ll be able to:
• Register users,
• Create and view posts,
• Manage blog posts and comments.

This guide is now streamlined to make it easier to follow the setup process. Let me know if you need further
clarifications!