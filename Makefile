DOCKER_COMPOSE = docker compose -f docker-compose.yml -f ./docker-compose.yml
DOCKER_COMPOSE_PHP = docker compose exec php-fpm

#############################
# DOCKER COMPOSE OPERATIONS #
#############################

env:
	cp .env .env.local

up:
	${DOCKER_COMPOSE} up -d --build

down:
	${DOCKER_COMPOSE} down

restart:
	${DOCKER_COMPOSE} restart

###############
# APPLICATION #
###############

init: up composer migrate

php:
	${DOCKER_COMPOSE} exec -u www-data php-fpm bash

composer:
	${DOCKER_COMPOSE} exec -u www-data php-fpm composer install

cache-clear:
	${DOCKER_COMPOSE} exec -u www-data php-fpm bin/console cache:clear

tests:
	${DOCKER_COMPOSE} exec -u www-data php-fpm bin/phpunit

rebuild: cache-clear down up

############
# DATABASE #
############

migrate:
	${DOCKER_COMPOSE} exec -u www-data php-fpm bin/console d:m:m
