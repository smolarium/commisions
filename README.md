# Commission fee calculator

Project is an exercise of partially implementing Money Pattern in an imaginary case study using tactical DDD.

Please Note that much of this project can be simply replaced by existing libraries.
For example: https://github.com/moneyphp/money

## Using Docker
### Requirements
- Docker: https://docs.docker.com/get-docker/
### Installation
`docker build -t commissions .`

Please note that there is installation of composer dependencies inside. This might take some time. Especially on Mac ;(
### Usage
`docker run -it --rm --name commissions-runner -v "$PWD"/var:/usr/src/commissions/var commissions php bin/console.php app:process var/example.txt`

As you can probably see, you can provide your own input file here.
You need to put the file into the `var/` location because of `-v` option.
### Tests
`docker run -it --rm --name commissions-tests commissions php vendor/phpunit/phpunit/phpunit -c tests/phpunit.xml`

## Traditionally
### Requirements
- PHP 7.4: https://www.php.net/manual/en/install.php
- Composer: https://getcomposer.org/download/
### Installation
`composer install`
### Usage
`php bin/console.php app:process var/example.txt`
### Tests
`php vendor/phpunit/phpunit/phpunit -c tests/phpunit.xml`

Please note that much of what is done here might be done using 