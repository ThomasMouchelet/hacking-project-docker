.PHONY: install
install: ## Installer les dépendances symfony
	cd api && composer install && cd ..

.PHONY: node_modules
node_modules: 
	cd app && npm update && npm install && cd ..

.PHONY: migrations
migrations: ## Génère les tables dans la base de données
	cd api && php bin/console doctrine:migrations:migrate -q && cd ..

.PHONY: fixtures
fixtures: ## Génèrer des fausses données tables dans la base de données
	cd api && php bin/console doctrine:fixtures:load -q && cd ..

.PHONY: files_env
files_env: 
	cd app && envsubst < .env.prod > .env && cd .. && cd api && envsubst < .env.prod > .env && cd ..

.PHONY: help
help: ## Affiche cette aide
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: jwt_keys
jwt_keys: 
	cd api && php bin/console lexik:jwt:generate-keypair --overwrite && cd ..

.PHONY: clear
clear:
	cd api && cache:clear && cd ..

.PHONY: prod
prod: install migrations fixtures node_modules jwt_keys