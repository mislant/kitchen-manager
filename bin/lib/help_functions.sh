generate_cookie_validation_key() {
  local cookie_validation_key

  cookie_validation_key=$(echo $RANDOM | md5sum | head -c 20)
  echo "Generate cookie validation key: $cookie_validation_key"
  sed -i "s/COOKIE_VALIDATION_KEY=/&$cookie_validation_key/" "$root_dir/.env"
}

ensure_env() {
  local dir

  dir=$1
  if [ ! -f "$dir/.env" ]; then
    echo "There is no environment file in $dir. Use 'env init' first!"
    exit 1
  fi
}

export_env() {
  local dir

  dir=$1
  while read -r line; do
    # Игнорируем пустые строки и комментарии
    if [[ "$line" == "" || "$line" == \#* ]]; then
      continue
    fi

    # Извлекаем имя переменной и значение из строки
    var_name=$(echo "$line" | cut -d'=' -f1)
    var_value=$(echo "$line" | cut -d'=' -f2-)

    # Экспортируем переменную в текущую сессию оболочки
    export "$var_name"="$var_value"
  done <"$dir/.env"
}
