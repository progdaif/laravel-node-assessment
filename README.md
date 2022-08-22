# Your assignment
The purpose of this test is to assess your Laravel skills, NodeJS skills and the ability to connect different microservice together. It also tests your ability to read specifications and your problem solving skills

- You have max 4h of time.

### Evaluation Criteria
- Laravel skills
- NodeJS skills
- Microservices understanding
- Problem solving skills
- Ability to read specs


# Parking Reservations microservices
Parkos is moving to Microservices and we want to separate our Reservation system and Email communication system into dedicated Microservices. The Reservation service should handle storage for all the reservations and dispatch events to the Email communication system that will take care of sending emails.

## Reservation API
- Create an API that can do basic Create, Read and (CRU of CRUD) actions for parking reservations. It must be __RESTFUL__
- Reservations should contain at least the departure and arrival dates + times
- The API needs to send __asynchronous__ triggers that can be used by the Email communication service.
- You need to use at least the following technologies and concepts
    - MySQL
    - Laravel (latest stable version)
    - RabbitMQ and/or Redis

## Email communication System
- Make a small microservice in NodeJS
- Be sure it responds to the asynchronous triggers created by the Reservation API
- If a reservations gets status = paid, send an email to the customer of that reservation
- In stead of sending a real email, a simple console.log is fine as well

## Bonus section
- OWASP Top 10
- Tests
- API documentation

# Working environment

This code repository includes a docker-compose YAML file. You can use this file or setup your own stuff.

The docker-compose environment includes everything you need: nginx, php (with laravel), rabbitmq, redis, node and mysql

## Useful hints and instructions

- Start the docker env by running `docker compose up --detach`
- The node app runs with nodemon, so changes will be reloaded automatically
- If you want to run a command in the laravel container (like the required `composer install`), enter the terminal with `docker compose run laravel sh`
- The Laravel app runs via nginx on [http://localhost:8080](http://localhost:8080)
- The docker setup has an internal network where you can reach individual containers with there DNS service name (for example: db:3306, or redis:6379)
- Checkout the docker-compose.yml file for more details, like the mysql username and pass and service names