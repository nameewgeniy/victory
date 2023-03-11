CONTAINER = @docker exec -it php_victory
PROJECT_NAME=victory

migrate.run:
	$(CONTAINER) php bin/console doctrine:migrations:migrate -n

migrate.make:
	$(CONTAINER) php bin/console make:migration

cache.clear:
	$(CONTAINER) php bin/console cache:pool:clear redis.cache

db.reset:
	$(CONTAINER) php bin/console doctrine:database:drop --force
	$(CONTAINER) php bin/console doctrine:database:create

entity.regenerate:
	$(CONTAINER) php bin/console make:entity --regenerate

lint:
	$(CONTAINER) sh -c "php vendor/bin/php-cs-fixer fix"

run:
	@cd build && docker-compose up -d