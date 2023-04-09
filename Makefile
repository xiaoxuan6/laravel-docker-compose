up:
	@docker-compose up -d

build:
	@docker-compose up -d --build

down:
	@docker-compose down

restart: down up

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
