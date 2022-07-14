local:
	cat .env.dist > app/.env
	cat .env.test > app/.env.test

re-build:
	docker-compose rm -s -f
	docker-compose build --no-cache
	docker-compose up -d --remove-orphans
	docker-compose exec app composer install

shell:
	docker-compose exec app /bin/bash

clean:
	vendor/bin/php-cs-fixer fix src