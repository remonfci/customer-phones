SHELL := /bin/bash


EXEC_PHP ?= docker-compose exec -T code php
RUN_PHP ?= docker-compose run --rm code php
EXEC_COMPOSER ?= docker-compose exec -T code composer
RUN_COMPOSER ?= docker-compose run --rm -T code composer

# Used by the "make dump" target, to save your database with a timestamp on it.
CURRENT_DATE = `date "+%Y-%m-%d_%H-%M-%S"`

# Helper vars for pretty display
_TITLE := "\033[32m[%s]\033[0m %s\n"
_ERROR := "\033[31m[%s]\033[0m %s\n"

##
## General purpose
## ───────────────
##

.DEFAULT_GOAL := help
help: ## ❓ Show this help.
	@printf "\n Available commands:\n\n"
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-25s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m## */[33m/'
.PHONY: help


##
## Project
## ───────
##
start: ## 🚀 Start the PHP and Database containers.
	@printf $(_TITLE) "Server" "Start App"
	@docker-compose up
.PHONY: start

##
## Setup
## ─────
##
install: docker vendor start ## Install and start the project.
.PHONY: install

docker:
	@printf $(_TITLE) "Project" "Pull Docker images"
	docker-compose pull
	@printf $(_TITLE) "Project" "Build Docker images"
	@docker-compose build --no-cache
.PHONY: docker

vendor: ## 🐘 Install Composer dependencies.
	@printf $(_TITLE) "PHP" "Install Composer dependencies"
	$(RUN_COMPOSER) install
.PHONY: vendor

##
## Quality and tests
## ─────────────────
##

qa: ## Execute QA tools
	$(MAKE) cs
	$(MAKE) phpstan
	$(MAKE) phpunit
.PHONY: qa

cs: ## Execute php-cs-fixer.
	@printf $(_TITLE) "QA" "php-cs-fixer"
	$(EXEC_PHP) artisan fixer:fix
.PHONY: cs

phpstan: ## Execute PHPStan.
	@printf "\n"$(_TITLE) "QA" "phpstan"
	$(EXEC_PHP) -d memory_limit=1G vendor/bin/phpstan analyse
.PHONY: phpstan

phpunit: ## Execute PHPUnit.
	@printf "\n"$(_TITLE) "QA" "phpunit"
	$(EXEC_PHP) vendor/bin/phpunit tests
.PHONY: phpunit
