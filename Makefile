ifeq ($(ENV), dev)
	file_env_npm_name := .env.dev
	de := docker exec teacher-tool-php
else
	file_env_npm_name := .env.prod
	de :=
endif

sy := $(de) php bin/console
dc := docker-compose

.PHONY: down
down: ## Down docker-compose.yml file
	$(dc) down --remove-orphans

.PHONY: up
up: ## Up docker-compose.yml file
	$(dc) up -d --build

.PHONY: install
install: up ## Installer les dépendances symfony
	$(de) composer install

.PHONY: install_prod
install_prod: 
	cd api && composer install && cd ..

.PHONY: node_modules
node_modules: 
	cd app && npm install && cd ..

.PHONY: migrations
migrations: install ## Génère les tables dans la base de données
	$(de) php bin/console doctrine:migrations:migrate -q

.PHONY: fixtures
fixtures: ## Génèrer des fausses données tables dans la base de données
	$(de) php bin/console doctrine:fixtures:load -q

.PHONY: env_prod
env_prod: 
	ENV=prod

.PHONY: env_dev
env_dev: 
	ENV=dev

.PHONY: file_env_npm
file_env_npm: 
	cd app && envsubst < $(file_env_npm_name) > .env && cd .. && 
	cd api && envsubst < $(file_env_npm_name) > .env && cd .. 


.PHONY: reset
reset: ## Delete all volumes and all images
	docker volume rm $$(docker volume ls -q) && docker rmi $$(docker images -q) 

.PHONY: help
help: ## Affiche cette aide
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: jwt_keys
jwt_keys: 
	$(de) php bin/console lexik:jwt:generate-keypair --overwrite

.PHONY: clear
clear:
	$(sy) cache:clear

.PHONY: deploy
deploy:
	ssh icri5960@109.234.161.72 'cd public_html/hacking-project && git pull origin master && make prod ENV=prod'

.PHONY: dev
dev: env_dev up install migrations fixtures

.PHONY: prod
prod: env_prod file_env_npm install_prod node_modules migrations fixtures
