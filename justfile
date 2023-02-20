#! /usr/bin/env just --justfile

init-env target="all" env="dev":
    #!/usr/bin/env bash
    initDockerEnv() {
      echo "Created .docker/.env"
      cp .docker/.env.example .docker/.env

      if [ {{env}} == "dev" ]; then
        echo "Added $USER as USER variable"
        sed -i "s/USER=/&$USER/" .docker/.env
        echo "Added $(id -u $USER) as USER_ID variable"
        sed -i "s/USER_ID=/&$(id -u $USER)/" .docker/.env
        echo "Added $(id -g $USER) as USER_GID variable"
        sed -i "s/USER_GID=/&$(id -g $USER)/" .docker/.env
        echo "Set compose to work with dev overriding"
        sed -i "s/COMPOSE_FILE=/&docker-compose.yaml:docker-compose.dev.yaml/" .docker/.env
      elif [ {{env}} == "prod" ]; then
        echo "Set compose to work with prod overriding"
        sed -i "s/COMPOSE_FILE=/&docker-compose.yaml:docker-compose.prod.yaml/" .docker/.env
      fi
    }

    initAppEnv() {
      echo "Created .env file!"
      cp .env.example .env

      echo "Generated application cookie validation key"
      validationKey=$(echo $RANDOM | md5sum | head -c 20)
      sed -i "s/COOKIE_VALIDATION_KEY=/&$validationKey/" .env
    }

    if [ {{target}} == "all" ]; then
      initDockerEnv
      initAppEnv
    elif [ {{target}} == "docker" ]; then
      initDockerEnv
    elif [ {{target}} == "app" ]; then
      initAppEnv
    fi

generate-cookie-validation-key:
    #!/usr/bin/env bash
    ENV=".env"
    if ! test -f "$ENV"; then
        echo "$ENV not exists."
        exit 1
    fi
    sed -i "s/COOKIE_VALIDATION_KEY=/&$(echo $RANDOM | md5sum | head -c 20)/" "$ENV"

migrate:
    @php vendor/bin/phinx migrate -c ./phinx.php

up: down build
    @docker compose --env-file=.docker/.env up -d

down:
    @docker compose --env-file=.docker/.env down

build:
    @docker compose --env-file=.docker/.env build

config:
    @docker compose --env-file=.docker/.env config
