# Traditionally:
### Requirements
- PHP 7.4: https://www.php.net/manual/en/install.php
- Composer: https://getcomposer.org/download/
### Installation
`composer install`
### Usage
`php bin/console.php app:process var/example.txt`
### Tests
`php vendor/phpunit/phpunit/phpunit -c tests/phpunit.xml`
# Using Docker
### Requirements
- Docker: https://docs.docker.com/get-docker/
### Installation
`docker build -t commissions .`
### Usage
`docker run -it --rm --name commissions-runner -v "$PWD":/usr/src/commissions -w /usr/src/commissions commissions php bin/console.php app:process var/example.txt`

As you can probably see, you can provide your own input file here
### Tests
`docker run -it --rm --name commissions-tests -v "$PWD":/usr/src/commissions -w /usr/src/commissions commissions php vendor/phpunit/phpunit/phpunit -c tests/phpunit.xml`