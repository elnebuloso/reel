#!/bin/bash

tag="redo-dev"

case $1 in
  "build")
    docker build --rm --pull --tag ${tag} --target prod --file Dockerfile .
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
      docker run --tty --interactive --rm ${args} ${tag} bash
    else
      docker run --tty --interactive --rm ${args} ${tag} "${@:3}"
    fi
  ;;

  *)
    echo "missing command"
  ;;
esac
