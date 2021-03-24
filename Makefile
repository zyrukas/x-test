.PHONY: default
default: help

.PHONY: help
help: ## Get this help
	@echo Tasks:
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.PHONY: dev
dev: ## This should start the environment and have it 100% ready and operational, without any manual action needed.
	docker-compose build
	docker-compose run --rm xa-php-fpm composer install
	docker-compose up -d
	docker-compose exec -u0 -d xa-php-fpm service supervisor start

.PHONY: up
up: ## Start containers
	docker-compose up -d
	docker-compose exec -u0 -d xa-php-fpm service supervisor start

.PHONY: down
down: ## Remove containers
	docker-compose down

.PHONY: test
test: ## Run phpspec and behat tests
	docker-compose -f docker-compose-test.yml --env-file .env.test up -d
	docker-compose exec xa-php-fpm bin/phpspec run
	sleep 5 ## Sleep needed because of rabbitmq boot, healthcheck in docker-compose.yml is not very convenient
	docker-compose exec xa-php-fpm bin/behat
	docker-compose -f docker-compose-test.yml --env-file .env.test stop
