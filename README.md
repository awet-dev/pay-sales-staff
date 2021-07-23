# Pay Sales Staff

### To start the project run
- `composer install` to install composer dependency
- `yarn install` to install javascript dependence
- `bin/console d:d:create` to create database
- `bin/console d:s:u --force` to persist the entity to the database
- `symfony serve -d` to start the local server
- `yarn watch` to build javascript asset
- Click the link and [home](https://127.0.0.1:8000)

### Register and Sing In 
- Register by clicking this [register](https://127.0.0.1:8000/)
- The password has to be min 6 characters
- Then if successfully registered you will be redirected to [log-in](https://127.0.0.1:8000/login)
- After logged in you will be landing to the admin dashboard.

### Create customer and product 
- To make transaction you need to have customer and products
- So create the customer and product with the field list there
- make transaction to the specified customer 

### Salary and bonus
- The salary and bonus is handled by javascript, it is automatic
- For the salary is paid at the working day of the month
- The bonus is paid to the supplier in the 15th working day of the next month. if it is holiday then postponed to the next Wednesday after 15th of the next month

### CSV file report
- to get the csv report for the salary and bonus download it from the admin dashboard