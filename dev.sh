#!/bin/bash

_DEV_IMAGE_="reel-dev"

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

if [[ -f "$(pwd)/.reel.env" ]]; then
  _ARGS_RUN_+=("--env-file $(pwd)/.reel.env")
fi

if [[ -f "$(pwd)/.reel.env.local" ]]; then
  _ARGS_RUN_+=("--env-file $(pwd)/.reel.env.local")
fi

case $1 in
"prepare")
  dos2unix main/reel
  chmod +x main/reel
  git update-index --chmod=+x main/reel

  dos2unix dev.sh
  chmod +x dev.sh
  git update-index --chmod=+x dev.sh

  dos2unix reelx.sh
  chmod +x reelx.sh
  git update-index --chmod=+x reelx.sh
  ;;

"build")
  docker build ${_ARGS_BUILD_[*]} --tag ${_DEV_IMAGE_} .
  ;;

"push")
  docker tag ${_DEV_IMAGE_} elnebuloso/reel:latest
  docker push elnebuloso/reel:latest
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

"test")
  _ARGS_=()
  _ARGS_+=("phpunit")
  _ARGS_+=("--configuration ./main/tests/phpunit.xml")
  _ARGS_+=("--bootstrap ./main/tests/bootstrap.php")
  _ARGS_+=("--coverage-html ./.reel/reports/phpunit/all/coverage/html")
  _ARGS_+=("--testsuite all")
  docker run ${_ARGS_RUN_[*]} ${_DEV_IMAGE_} ${_ARGS_[*]}
  ;;

"demo")
  _ARGS_RUN_=()
  _ARGS_RUN_+=("--tty")
  _ARGS_RUN_+=("--interactive")
  _ARGS_RUN_+=("--rm")
  _ARGS_RUN_+=("--volume /var/run/docker.sock:/var/run/docker.sock")
  _ARGS_RUN_+=("--volume $(pwd)/main:/reel --volume $(pwd)/VERSION:/VERSION")
  _ARGS_RUN_+=("--volume $(pwd)/demo/$2:$(pwd)/demo/$2 --workdir $(pwd)/demo/$2")

  if [[ -f "$(pwd)/demo/$2/.reel.env" ]]; then
    _ARGS_RUN_+=("--env-file $(pwd)/demo/$2/.reel.env")
  fi

  if [[ -f "$(pwd)/demo/$2/.reel.env.local" ]]; then
    _ARGS_RUN_+=("--env-file $(pwd)/demo/$2/.reel.env.local")
  fi

  _ARGS_RUN_+=("${_DEV_IMAGE_}")

  if [[ "$3" == "bash" ]]; then
    docker run ${_ARGS_RUN_[*]} bash
  else
    docker run ${_ARGS_RUN_[*]} "${@:3}"
  fi
  ;;

*)
  echo "missing command"
  ;;
esac
