#!/bin/bash

_DEV_IMAGE_="redo-dev"

_ARGS_BUILD_=()
_ARGS_BUILD_+=("--rm")
_ARGS_BUILD_+=("--pull")
_ARGS_BUILD_+=("--target prod")
_ARGS_BUILD_+=("--file Dockerfile")

_ARGS_RUN_=()
_ARGS_RUN_+=("--tty")
_ARGS_RUN_+=("--interactive")
_ARGS_RUN_+=("--rm")
_ARGS_RUN_+=("--volume /var/run/docker.sock:/var/run/docker.sock")
_ARGS_RUN_+=("--volume $(pwd):$(pwd)")
_ARGS_RUN_+=("--workdir $(pwd)")

if [[ -f "$(pwd)/.redo.env" ]]; then
  _ARGS_RUN_+=("--env-file $(pwd)/.redo.env")
fi

if [[ -f "$(pwd)/.redo.env.local" ]]; then
  _ARGS_RUN_+=("--env-file $(pwd)/.redo.env.local")
fi

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
  docker build ${_ARGS_BUILD_[*]} --tag ${_DEV_IMAGE_} .
  ;;

"install")
  _ARGS_=()
  _ARGS_+=("composer")
  _ARGS_+=("install")
  docker run ${_ARGS_RUN_[*]} ${_DEV_IMAGE_} ${_ARGS_[*]}
  ;;

"update")
  _ARGS_=()
  _ARGS_+=("composer")
  _ARGS_+=("update")
  docker run ${_ARGS_RUN_[*]} ${_DEV_IMAGE_} ${_ARGS_[*]}
  ;;

"tests")
  _ARGS_=()
  _ARGS_+=("phpunit")
  _ARGS_+=("--configuration ./main/tests/phpunit.xml")
  _ARGS_+=("--bootstrap ./main/tests/bootstrap.php")
  _ARGS_+=("--coverage-html ./.redo/reports/phpunit/all/coverage/html")
  _ARGS_+=("--testsuite all")
  docker run ${_ARGS_RUN_[*]} ${_DEV_IMAGE_} ${_ARGS_[*]}
  ;;

"demo")
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

  _ARGS_RUN_+=("${_DEV_IMAGE_}")

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
