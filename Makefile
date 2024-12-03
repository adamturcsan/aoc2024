HAS_HOST_IP=$(shell grep -c 'HOST_IP' .env)

init_host_ip :
ifeq "$(HAS_HOST_IP)" "0"
	echo "HOST_IP=$$(hostname -I | awk '{print $$1}')" >> .env
endif
	echo "Initialized"

init_app :
	docker-compose up -d

run : init_host_ip init_app

stop :
	docker-compose down

cli:
	docker-compose exec aoc /bin/bash

unit-test:
	docker-compose exec -e XDEBUG_MODE=coverage aoc vendor/bin/phpunit
