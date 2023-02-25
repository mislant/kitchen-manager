docker_dir="$root_dir/.docker"
ensure_env "$docker_dir"
export_env "$docker_dir"

docker compose down
