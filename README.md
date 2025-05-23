# CIIE La Ferrere

This project is a user and courses manager for the Training, Information, and Educational Research Center No. 201 "Julio R. Cao" of Gregorio de Laferrere in La Matanza. (CIIE 201)

## Features

- Administration of system users, teachers, and students
- Creation of courses and assignment of students and teachers
- Attendance system
- Grades record system
- Printing and emailing of certificates

## Installation

To run the system locally, simply run docker-compose

```
docker-compose up -d --build
```

Once the images are generated, all Symfony or Composer commands must be executed in the "php" image console.

When the image is generated for the first time, Doctrine migrations should be executed. You can check their status with

```
php bin/console doctrine:migrations:status
```

If they have not been executed or there are migrations available, you can force their execution with the command:

```
php bin/console doctrine:migrations:migrate
```

If you want to have users, courses and data for testing, you can generate them through doctrine fixtures (IMPORTANT: If there is already data, this command will delete it and generate them anew)

```
php bin/console doctrine:fixtures:load
```

## Technologies

- PHP 8.2
- Symfony 7.0.2
- Doctrine 2.11
- EasyAdmin 4.14