where=${args[--where]}
env=${args[--env]}

function init_docker() {
  echo "Docker .env file initialization"
  docker_dir="$root_dir/.docker"
  cp "$docker_dir/.env.example" "$docker_dir/.env"

  function fill_dev_values() {
    echo "Added $USER as USER variable"
    sed -i "s/USER=/&$USER/" .docker/.env
    echo "Added $(id -u "$USER") as USER_ID variable"
    sed -i "s/USER_ID=/&$(id -u "$USER")/" .docker/.env
    echo "Added $(id -g "$USER") as USER_GID variable"
    sed -i "s/USER_GID=/&$(id -g "$USER")/" .docker/.env
    echo "Set compose to work with dev overriding"
    sed -i "s/COMPOSE_FILE=/&docker-compose.yaml:docker-compose.dev.yaml/" "$docker_dir/.env"
  }

  function fill_prod_values() {
    echo "Set compose to work with prod overriding"
    sed -i "s/COMPOSE_FILE=/&docker-compose.yaml:docker-compose.prod.yaml/" "$docker_dir/.env"
  }

  case $env in
  "dev")
    fill_dev_values
    ;;
  "prod")
    fill_prod_values
    ;;
  esac
}

function init_root() {
  echo "Root .env file initialization"
  cp "$root_dir/.env.example" "$root_dir/.env"

  generate_cookie_validation_key
}

function init_all() {
  init_docker
  init_root
}

case "$where" in
"all")
  init_all
  ;;
"root")
  init_root
  ;;
"docker")
  init_docker
  ;;
esac
