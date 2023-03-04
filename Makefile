CONTAINER = @docker exec -it php_victory
PROJECT_NAME=victory

dev.migrate.run:
	$(CONTAINER) php bin/console doctrine:migrations:migrate -n

dev.migrate.make:
	$(CONTAINER) php bin/console make:migration

dev.cache.clear:
	$(CONTAINER) php bin/console cache:pool:clear redis.cache

dev.db.reset:
	$(CONTAINER) php bin/console doctrine:database:drop --force
	$(CONTAINER) php bin/console doctrine:database:create

dev.entity.regenerate:
	$(CONTAINER) php bin/console make:entity --regenerate