## —— Make file ————————————————————————————————————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'


## —— Project tools ————————————————————————————————————————————————————————
fix-perms: ## Fix permissions of all var files
	chmod -R 777 var/*

purge: ## Purge cache and logs
	rm -rf var/logs/*.log
	ls var | grep -v logs | grep -v cache | xargs -I % sh -c 'rm -rf var/%'
	ls var/cache/doctrine | grep -v '.gitkeep' | xargs -I % sh -c 'rm -rf var/cache/doctrine/%'


## —— Housfy Offices API ———————————————————————————————————————————————————————————
cs-fix: ## Executes cs fixer
	docker exec officesphp bash -c "bin/php-cs-fixer --no-interaction -v fix"

install: ## Install vendors according to the current composer.lock file
	docker exec officesphp bash -c "composer install"

update: ## Update vendors according to the current composer.json file
	docker exec officesphp bash -c "composer update"

migrations: ## Load data to DB, ATTENTION!!: This Will remove all previous data
	docker exec officesphp bash -c "bin/console housfy:offices:migrations:load"

test-unit: phpunit.xml ## Launch unit tests inside docker container
	docker exec officesphp bash -c "bin/phpunit --stop-on-failure --testdox --colors=always"

test-functional: ## Launch functional tests inside docker container
	docker exec officesphp bash -c "bin/codecept run functional --colors=always"

precommit-test: ## This is an automatic command to prevent commits without testing!! :)
	docker exec officesphp bash -c "bin/phpunit --stop-on-failure --testdox --colors=always"
	docker exec officesphp bash -c "bin/codecept run functional"

## —— Rabbit Consumers ———————————————————————————————————————————————————————————
listen-findalloffices: ## Run Find all offices consumer
	docker exec officesphp bash -c "bin/console housfy:offices:rabbitmq:consumer:findalloffices"