<p align="center">
    This repository is an example of a PHP microservice API using Domain-Driven Design (DDD) principles keeping the 
    code as simple as possible. 
  <br />
  <br />
  Stack used: <br />
  - <strong>Framework:</strong> PhpSlim 3 <br/>
  - <strong>Language:</strong> PHP 7.4 <br/>
  - <strong>Database:</strong> Mariadb <br/>
  - <strong>Cache:</strong> Redis <br/>
  - <strong>Unit testing:</strong> PHPUnit <br/>
  - <strong>Functional testing:</strong> Codeception <br/>
  - <strong>Infrastructure:</strong> Docker with Docker compose <br/>
</p>

## 🚀 Environment Setup

### 🐳 Needed tools

1. [Install Docker](https://www.docker.com/get-started)
2. Clone this project: `git@github.com:vaanngs/housfy-offices-api.git`
3. Move to the project folder: `cd housfy-offices-api`

### 🛠️ Environment configuration

1. Create a local environment file (`cp .env .env.dist`)
2. Configure XDEBUG section. There are examples for MAC Os & Linux.
4. Install all dependencies with: `make install`
5. Seed Database with fixtures (migrations) with: `make migrations`

### ✅ Tests execution

1. Execute unit tests with: `make test-unit`. There is coverage provided on: `var/phpunit/html/index.html`
2. Execute functional tests with: `make test-functional`

## 👩‍💻 Project explanation

This project tries to replicate a simple office API microservice. It's decoupled from any framework 
(I use PHPSlim only in the UI layer) but it has Simfony libraries such as Doctrine & Console.
