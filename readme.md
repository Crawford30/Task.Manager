

# HOW TO RUN THE PROJECT

1. Clone the project from url into Server(I am using xampp)
2. cd to the project directory
3. Open the project in a terminal or command line
4. Run composer install to install the dependencies
5. Run npm install to install frontend libraries
6. Create a database in your phpAdmin
7. Run cp .env.example .env to copy the .env.example file
8. Enter the database name in the .env file and the password if set
9. Run php artisan config:clear to clear the config
10. Run php artisan key:generate to generate the encryption key
11. Run the php artisan migrate (to create the tables)
12. Run php artisan db:seed to create the seeder data(this has a user with email address: info@taskmanager.com and password: @root#123 or if you prefer, you can create an account as well)
13. Run php artisan server and another terminal run npm run watch to minify the css
14. Visit the url and register or login with the seeded account/user












