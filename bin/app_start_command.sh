docker_dir="$root_dir/.docker"
ensure_env "$docker_dir"
export_env "$docker_dir"

just_config=${args["--show-config"]}
if [ "$just_config" == "1" ]; then
  docker compose config
  exit
fi

if [ -n "$(docker compose ps -q)" ]; then
  echo "Down running containers"
  docker compose down
fi

rebuild=${args["--rebuild"]}
if [ "$rebuild" == "1" ]; then
  echo "Rebuild images"
  docker compose build
fi

echo "Starting application"
docker compose up -d
echo "Application started"
