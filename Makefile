CONSOLE=php bin/console
CONTAINER=nginx
CONTAINER_BDD=postgres
EXEC_COMMAND = docker-compose exec $(CONTAINER)
EXEC_COMMAND_BDD = docker-compose exec $(CONTAINER_BDD)

up:
	docker-compose up -d

stop:
	docker-compose stop

down:
	docker-compose down

bash:
	$(EXEC_COMMAND) /bin/ash

test:
	$(EXEC_COMMAND) vendor/bin/phpunit
