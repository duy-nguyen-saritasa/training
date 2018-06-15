all: install build static run

install:
	bash install.sh

build:
	docker-compose build --no-cache --build-arg hostUID=`id -u` --build-arg hostGID=`id -g` web

start: run

run:
	docker-compose -p training-backend up -d web

stop:
	docker-compose -p training-backend kill

destroy:
	docker-compose -p training-backend down

logs:
	docker-compose -p training-backend logs web

shell:
	docker-compose -p training-backend exec --user nginx web bash

root:
	docker-compose -p training-backend exec web bash

cs:
	php vendor/bin/phpcs

csfix:
	php vendor/bin/phpcbf

test:
	php vendor/bin/phpunit

static:
	yarn run development

watch:
	yarn run watch

lint:
	yarn run lint

lintfix:
	yarn run lint:fix

swagger:
	cd Artifacts/API && ./bundle.sh

ip:
	docker inspect training-backend-web | grep \"IPAddress\"
