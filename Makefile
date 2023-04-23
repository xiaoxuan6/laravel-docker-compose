up:
	@docker-compose up -d

.PHONY: build

build:
	@docker-compose up -d --build

down:
	@docker-compose down

restart: down up

rmi:
	@docker images | grep "xiaoxuan6/php" | grep -v "8.0" | xargs docker rmi

status:
	@docker ps -a

s: status

clean:
	@docker volume prune

list:
	@docker-compose run --rm artisan list

migrate:
	@docker-compose run --rm artisan migrate

log:
	@docker-compose logs -f

run:
	@build/env
