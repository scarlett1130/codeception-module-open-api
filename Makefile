.PHONY: $(filter-out help, $(MAKECMDGOALS))
.DEFAULT_GOAL := help

help:
	@echo "\033[33mUsage:\033[0m\n  make [target] [arg=\"val\"...]\n\n\033[33mTargets:\033[0m"
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[32m%-10s\033[0m %s\n", $$1, $$2}'

build: ## Installs dependencies and builds test actors
	@docker-compose up -d --remove-orphans
	@docker-compose exec php vendor/bin/codecept build

test: ## Runs tests
	@docker-compose exec php vendor/bin/codecept run