up: docker-up

stop: docker-stop

docker-up:
	docker-compose up -d

docker-stop:
	docker-compose stop