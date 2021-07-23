# Pay Sales Staff

### To start the project 
- Just run `composer install` because all the other script are added to the composer.json file on the scripts object

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