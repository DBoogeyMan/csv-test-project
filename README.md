# csv-test-project

To start that project please run next commands from the root of project:
1. docker-compose up
2. docker exec csv-apache-php-container composer install

To generate dates list you need run that command `docker exec csv-apache-php-container php scripts/generateDatesCsv.php` if you use docker another way use `php scripts/generateDatesCsv.php`
To calculate names and generate list you need run that command `docker exec csv-apache-php-container php scripts/generateNamesSumCsv.php` if you use docker another way use `php scripts/generateNamesSumCsv.php`
