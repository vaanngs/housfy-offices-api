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

1. Create a local environment file (`cp .env .env.dist`)
2. Configure XDEBUG section. There are examples for MAC Os & Linux.
3. Create docker network `docker network create local_housfy_redis`
4. Start docker container with `docker-compose up -d
5. Install all dependencies with: `make install`

### 🛑 Important Notice 
There are no provided volumes for Mariadb neither Redis so each time you start
your docker containers you will lose all data.

### ✅ Migrations & Tests execution
1. Enter php-fpm container by running the command `docker exec -it officesphp bash`
2. Run migrations with `make migrations`
3. Now exit container and go back to your project folder.
4. Run unit tests with: `make test-unit`. There is coverage provided on: `var/phpunit/html/index.html`
5. Run functional tests with: `make test-functional`

## 👩‍💻 Project explanation

This project tries to replicate a simple office API microservice. It's decoupled from any framework 
(I use PHPSlim only in the UI layer) but it has Simfony libraries such as Doctrine & Console.
