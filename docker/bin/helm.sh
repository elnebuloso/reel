#!/bin/bash

set -e

: "${REEL_HELM_IMG:=alpine/helm:latest}"
: "${REEL_HELM_CMD:=}"
: "${REEL_HELM_DIR:=.}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REEL_HELM_IMG=*)
    REEL_HELM_IMG="${1#*=}"
    ;;
  --REEL_HELM_CMD=*)
    REEL_HELM_CMD="${1#*=}"
    ;;
  --REEL_HELM_DIR=*)
    REEL_HELM_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("--volume $(pwd)/$REEL_HELM_DIR/.redo/.helm/cache:/root/.cache/helm")
_ARGS_RUN_+=("--volume $(pwd)/$REEL_HELM_DIR/.redo/.helm/config:/root/.config/helm")
_ARGS_RUN_+=("$REEL_HELM_IMG")
_ARGS_RUN_+=("$REEL_HELM_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull $REEL_HELM_IMG
dockerception-run $REEL_HELM_DIR /app ${_ARGS_RUN_[*]}
