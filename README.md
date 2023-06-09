# tmc-test

## Getting Started
### Installing
A step by step series of examples that tell you how to get first a development
environment running

    cd project
    cp .env.example .env
    cp src/.env.example src/.env
    docker-compose up
    docker-compose exec tmccase composer install
    
    
 ### if there is a problem with file directory permissions, please run the command below
    docker-compose exec --user root  tmccase  chown -R dev:www-data ./storage
    
### Seeder example data and migration
    docker-compose exec tmccase php artisan migrate:refresh --seed
