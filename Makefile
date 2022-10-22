ifeq ($(ENV), dev)
	compose_file := docker-compose-dev.yml
	file_env_npm_name := .env.dev
else
	compose_file := docker-compose-prod.yml
	file_env_npm_name := .env.prod
endif


de := docker exec docker-container-php
sy := $(de) php bin/console
dc := docker-compose -f $(compose_file)

.PHONY: down
down: ## Down docker-compose.yml file
	$(dc) down --remove-orphans

.PHONY: up
up: ## Up docker-compose.yml file
	$(dc) up -d --build

.PHONY: install
install: up ## Installer les dépendances symfony
	$(de) composer install

.PHONY: node_modules
node_modules: 
	cd app && npm update && npm install && cd ..

.PHONY: migrations
migrations:  ## Génère les tables dans la base de données
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
	cd app && envsubst < $(file_env_npm_name) > .env && cd ..

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

.PHONY: deploy_pull
deploy_pull:
	ssh debian@149.202.45.43 'cd hacking-project-docker && git pull origin master && make prod ENV=prod'

.PHONY: deploy_init
deploy_init:
	ssh debian@149.202.45.43 'git clone https://github.com/ThomasMouchelet/hacking-project-docker.git && make prod ENV=prod && make jwt_keys'
	
.PHONY: dev
# dev: env_dev up install migrations fixtures node_modules
dev: env_dev up migrations fixtures node_modules

.PHONY: prod
prod: env_prod file_env_npm up install migrations fixtures
