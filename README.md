# Project Name

This is a Laravel project that simulates a health record management system.


## Getting Started
Follow these instructions to get the project up and running on your local machine.

### Prerequisites

- [PHP](https://www.php.net/manual/en/install.php)
- [Composer](https://getcomposer.org/download/)
- [MySQL](https://dev.mysql.com/doc/mysql-installation-excerpt/5.7/en/)
- [Node.js](https://nodejs.org/en/download/)
- [npm](https://www.npmjs.com/get-npm)

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/project-name.git
   ```
2. Navigate to the project directory
	
	`cd ./medbook-med-dev-backend`

3.Install JavaScript dependencies:

	`npm install`

4. Create a copy of the .env.example file and name it .env:
	`cp .env.example .env`

5. Generate the application key: 

	`php artisan key:generate`

6.Set up your database configuration in the .env file:

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=your_database_name
	DB_USERNAME=your_database_user
	DB_PASSWORD=your_database_password

7. Run the database migrations:
	`php artisan migrate`
	
8.Seed the database

	`php artisan db:seed`

9. Start the development server:

		`php artisan serve`

10. Access the application in your postman at http://localhost:8000/patient


