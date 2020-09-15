.DEFAULT_GOAL := help

APP=php-nginx
USER=www-data
COMMAND_DOCKER = docker-compose
COMMAND_DOCKER_EXEC = $(COMMAND_DOCKER) exec -T

.PHONY: build
build: ## Permet de construire l'image php et nginx
	@$(COMMAND_DOCKER) build --force-rm

.PHONY: up
up: ## Permet de démarrer le container
	@$(COMMAND_DOCKER) up -d --remove-orphans $(APP)

.PHONY: install
install: ## Permet d'installer les dépendances
	@$(COMMAND_DOCKER_EXEC) --user $(USER) $(APP) composer install -o --no-progress --no-interaction

.PHONY: start
start: build up install ## Permet de builder, up et installer les dépendances de l'application

.PHONY: exec
exec: ## Ouvre le shell dans le container (options: user [www-data], cmd [/bin/ash])
	$(eval cmd ?= /bin/ash)
	$(eval user ?= $(USER))
	@$(COMMAND_DOCKER) exec --user $(user) $(APP) $(cmd)


.PHONY: unit-testing
unit-testing: ## Permet de lancer les tests unitaire
	$(eval tag ?= )
	@$(COMMAND_DOCKER_EXEC) --user $(USER) $(APP) ./bin/phpunit --group=$(tag)


.PHONY: help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' Makefile | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-23s\033[0m %s\n", $$1, $$2}'
