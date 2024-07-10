
# BAS (Black Analysis Solution)
Black Analysis Solution (BAS) is a Laravel-based web application that provides a platform for users to upload their files to cloud storage and obtain data analysis services by the company for consulting purposes.

This project was developed as a training exercise at Focal X company, in collaboration with a team of backend and frontend developers.




## Features

- User Registration: Users can create an account to access the platform.
- User Authentication: Secure user authentication and session management.
- File Upload: Users can upload their files to the cloud storage.
- Data Analysis: The company provides data analysis services on the uploaded files.
- User Dashboard: Users can view and manage their uploaded files and analysis reports.
- Admin Panel: Admins have access to an admin panel to manage users and perform administrative tasks.

## Requirements
- PHP 7.4 or higher
- Laravel 8.x
- Composer (Dependency Manager)
- MySQL or any supported database management system
- Web server (e.g., Apache, Nginx)
## Installation

Install my-project with npm

```bash
  npm install my-project
  cd my-project
```
1. Clone the repository:

```bash
git clone https://github.com/batoul25/bas.git

```
2. Navigate to the project directory:

```bash
cd bas-black-analysis-solution
```
3. Install the dependencies:

```bash
composer install
```
4. Create a new .env file:

```bash
cp .env.example .env
```
5. Generate a new application key:

```bash
php artisan key:generate
```
6. Configure the database connection by updating the .env file with your database credentials.

7. Run the database migrations and seed the initial data:

```bash
php artisan migrate --seed
```
8. Start the development server:

```bash
php artisan serve
```
9. Access the application by visiting http://localhost:8000 in your web browser.

## Usage

1. Register a new user account on the application.
2. Log in to the user dashboard.
3. Upload files to the cloud storage.
4. Wait for the company to perform data analysis on the uploaded files.
5. View the analysis reports on the user dashboard.
6. Admins can access the admin panel to manage users and perform administrative tasks.


## Contributing

Contributions are welcome! If you encounter any bugs, have feature requests, or would like to make improvements, please open an issue or submit a pull request.


## License

This project is open-source and available under the [MIT](https://choosealicense.com/licenses/mit/) License.


## Contact
For any inquiries or support, please contact me at batouljdid25@gmail.com
## Authors

- [Batoul Jdid](https://github.com/batoul25)
- [Ebrahim Mohammad](https://github.com/ebrahim-mohammad)

## Acknowledgements

This project was developed by the team at Focal X company as a training exercise, with contributions from both backend and frontend developers.


## API Reference

#### Base URL
The base URL for all API endpoints is: http://localhost:8000/api

#### API Documentation

https://documenter.getpostman.com/view/29038500/2s9YyvC17L



