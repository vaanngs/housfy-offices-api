<p align="center">
    <h1>Microservice Housfy's Offices API</h1>
    This repository is an example of a PHP microservice API using Domain-Driven Design (DDD) principles keeping the 
    code as simple as possible. 
  <br />
  <br />
</p>

## 🚀 Environment Setup
  Stack used: <br />
  - <strong>Framework:</strong> PhpSlim <br/>
  - <strong>Language:</strong> PHP 7.4 <br/>
  - <strong>Database:</strong> Mariadb <br/>
  - <strong>Cache:</strong> Redis <br/>
  - <strong>Queues:</strong> RabbitMQ <br/>
  - <strong>Unit testing:</strong> PHPUnit <br/>
  - <strong>Functional testing:</strong> Codeception <br/>
  - <strong>Infrastructure:</strong> Docker with Docker compose <br/>

### 🐳 Needed tools

1. [Install Docker](https://www.docker.com/get-started)
2. Clone this project: `git@github.com:vaanngs/housfy-offices-api.git`
3. Move to the project folder: `cd housfy-offices-api`

### 🛠️ Environment configuration

1. Create a local environment file (`cp .env.dist .env`)
2. Configure XDEBUG section. There are examples for MAC Os & Linux.
3. Create docker network `docker network create local_housfy_redis`
4. Start docker container with `docker-compose up -d` 
5. Let docker do its things until all containers are ready. 
   Wait specially for rabbitmq container. You can run `docker-compose up` instead of 
   step 4 to see when all containers are ready.
6. Install all dependencies with: `make install`

### 🛑 Important Notice 
There are no provided volumes for Mariadb neither Redis so each time you start
your docker containers you will lose all data.
All make commands related to cs-fixer, composer, migrations, testing (both unit & functional)
as well as the RabbitMQ consumer are run inside docker container so you dont have 
to worry to enter them with docker exec. 

### ✅ Migrations & Tests execution
1. Run migrations with `make migrations`
2. Run unit tests with: `make test-unit`. There is coverage provided on: `var/phpunit/html/index.html`
3. Run functional tests with: `make test-functional`
4. Every time you want to make a commit both unit & functional tests and cs-fixer will be triggered via 
a pre-commit hook.

### 🥳 Running the app
Now that we have seed the DB and checked all test, both unit & functional, are working you will want to see 
the project itself :) I have provided different tools to play with the app like:

- Swagger endpoints: `http://localhost:7001/docs/index.html`
- Adminer DB: `http://localhost:7099`
- RabbitMQ: `http://localhost:7098`

Check `.env` file to see the credentials. 


#### Checking Cache
If you want to check both Redis Cache and RabbitMQ Queues are working follow these steps:
1. In your terminal run `docker exec -it local_housfy_redis sh` to enter redis container.
2. Now access Redis by running `redis-cli`
3. Check there nothing cached with command `keys *` It should appear on the screen "empty array"
4. Now open another tab on terminal to run RabbitMQ consumer listener: `make listen-findalloffices`
5. Go to Swagger and test the GET endpoint.
6. Go back to your Redis terminal tab and run again `keys *` 
7. If everything was fine you will a new key "findalloffices"
8. If you run again the GET endpoint the result provided will be provided by cache.


## 👩‍💻 Project explanation

This project tries to replicate a simple office API microservice. It's decoupled from any framework 
(I use PHPSlim only in the UI layer) but it has Simfony libraries such as Doctrine (in order to access its
 powerful ORM) & Console.
