#!/bin/bash

DEV="no"
DEV_IMAGE="reel-dev"
IMAGE="elnebuloso/reel:latest"
SKIP_PULL="no"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --dev)
    DEV="yes"
    ;;
  --image=*)
    IMAGE="${1#*=}"
    ;;
  --skip-pull)
    SKIP_PULL="yes"
    ;;
  *)
    _ARGS_+=("$1")
    ;;
  esac
  shift
done

if [[ "$DEV" = "yes" ]]; then
  IMAGE=$DEV_IMAGE
fi

if [[ "$SKIP_PULL" = "no" ]]; then
  if [[ "$DEV" = "no" ]]; then
    docker pull $IMAGE
  fi
fi

_ARGS_RUN_=()
_ARGS_RUN_+=("--rm")
_ARGS_RUN_+=("--interactive")
_ARGS_RUN_+=("--tty")
_ARGS_RUN_+=("--volume /var/run/docker.sock:/var/run/docker.sock")
_ARGS_RUN_+=("--volume $(pwd):$(pwd)")
_ARGS_RUN_+=("--workdir $(pwd)")

if [[ -f "$(pwd)/.reel.env" ]]; then
  _ARGS_RUN_+=("--env-file $(pwd)/.reel.env")
fi

if [[ -f "$(pwd)/.reel.env.local" ]]; then
  _ARGS_RUN_+=("--env-file $(pwd)/.reel.env.local")
fi

if [[ "${_ARGS_[0]}" = "" ]]; then
  echo "missing command"
  exit 1
fi

_ARGS_RUN_+=("$IMAGE")

if [[ "${_ARGS_[0]}" = "bash" ]]; then
  _ARGS_RUN_+=("bash")
else
  _ARGS_RUN_+=("${_ARGS_[*]}")
fi

docker run ${_ARGS_RUN_[*]}
