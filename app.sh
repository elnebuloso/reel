#!/bin/bash

DEV_IMAGE="redo-dev"

case $1 in
"prepare")
  dos2unix main/redo
  chmod +x main/redo
  git update-index --chmod=+x main/redo

  dos2unix app.sh
  chmod +x app.sh
  git update-index --chmod=+x app.sh

  dos2unix redo.sh
  chmod +x redo.sh
  git update-index --chmod=+x redo.sh
  ;;

"build")
  docker build --rm --pull --tag ${DEV_IMAGE} --target prod --file Dockerfile .
  ;;

"install")
  _ARGS_RUN_=()
  _ARGS_RUN_+=("--tty")
  _ARGS_RUN_+=("--interactive")
  _ARGS_RUN_+=("--rm")
  _ARGS_RUN_+=("--volume /var/run/docker.sock:/var/run/docker.sock")
  _ARGS_RUN_+=("--volume $(pwd):$(pwd)")
  _ARGS_RUN_+=("--workdir $(pwd)")
  _ARGS_RUN_+=("${DEV_IMAGE}")

  docker run ${_ARGS_RUN_[*]} composer install
  ;;

"update")
  _ARGS_RUN_=()
  _ARGS_RUN_+=("--tty")
  _ARGS_RUN_+=("--interactive")
  _ARGS_RUN_+=("--rm")
  _ARGS_RUN_+=("--volume /var/run/docker.sock:/var/run/docker.sock")
  _ARGS_RUN_+=("--volume $(pwd):$(pwd)")
  _ARGS_RUN_+=("--workdir $(pwd)")
  _ARGS_RUN_+=("${DEV_IMAGE}")

  docker run ${_ARGS_RUN_[*]} composer update
  ;;

"test")
  _ARGS_RUN_=()
  _ARGS_RUN_+=("--tty")
  _ARGS_RUN_+=("--interactive")
  _ARGS_RUN_+=("--rm")
  _ARGS_RUN_+=("--volume /var/run/docker.sock:/var/run/docker.sock")
  _ARGS_RUN_+=("--volume $(pwd)/main:/redo --volume $(pwd)/VERSION:/VERSION")
  _ARGS_RUN_+=("--volume $(pwd)/test/$2:$(pwd)/test/$2 --workdir $(pwd)/test/$2")

  if [[ -f "$(pwd)/test/$2/.redo.env" ]]; then
    _ARGS_RUN_+=("--env-file $(pwd)/test/$2/.redo.env")
  fi

  if [[ -f "$(pwd)/test/$2/.redo.env.local" ]]; then
    _ARGS_RUN_+=("--env-file $(pwd)/test/$2/.redo.env.local")
  fi

  _ARGS_RUN_+=("${DEV_IMAGE}")

  if [[ -z "${@:3}" ]]; then
    docker run ${_ARGS_RUN_[*]} bash
  else
    docker run ${_ARGS_RUN_[*]} "${@:3}"
  fi
  ;;

*)
  echo "missing command"
  ;;
esac
