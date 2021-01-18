.PHONY: install
install: ## Install the app
	@docker-compose run --rm mars-rover php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
		&& php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
		&& php composer-setup.php \
		&& php -r "unlink('composer-setup.php');" \
		&& php composer.phar install

.PHONY: tests
tests: ## Run PHPUnit tests
	@docker-compose run --rm mars-rover php bin/phpunit tests

.PHONY: script
script: ## Launch the script to test the rover
	@docker-compose run --rm mars-rover php public/index.php

.PHONY: help
help: ## Show this help.
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'
