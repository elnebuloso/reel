#!/bin/bash

_DEV_IMAGE_="reel-dev"

_ARGS_BUILD_=()
_ARGS_BUILD_+=("--rm")
_ARGS_BUILD_+=("--pull")
_ARGS_BUILD_+=("--target prod")
_ARGS_BUILD_+=("--file Dockerfile")

case $1 in
"build")
  docker build ${_ARGS_BUILD_[*]} --tag ${_DEV_IMAGE_} .
  ;;

"push")
  docker tag ${_DEV_IMAGE_} elnebuloso/reel:latest
  docker push elnebuloso/reel:latest
  ;;

*)
  echo "missing command"
  ;;
esac
