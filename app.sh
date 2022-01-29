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

"test")
  args=""
  args="$args --volume $(pwd)/main:/redo --volume $(pwd)/VERSION:/VERSION"
  args="$args --volume $(pwd)/test/$2:$(pwd)/test/$2 --workdir $(pwd)/test/$2"
  args="$args --volume /var/run/docker.sock:/var/run/docker.sock"

  if [[ -f "$(pwd)/test/$2/build.env" ]]; then
    args="$args --env-file $(pwd)/test/$2/build.env"
  fi

  if [[ -f "$(pwd)/test/$2/build.env.local" ]]; then
    args="$args --env-file $(pwd)/test/$2/build.env.local"
  fi

  if [[ -z "${@:3}" ]]; then
    docker run --tty --interactive --rm ${args} ${DEV_IMAGE} bash
  else
    docker run --tty --interactive --rm ${args} ${DEV_IMAGE} "${@:3}"
  fi
  ;;

*)
  echo "missing command"
  ;;
esac
