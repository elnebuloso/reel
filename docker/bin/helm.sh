#!/bin/bash

set -e

: "${REDO_HELM_IMG:=alpine/helm:latest}"
: "${REDO_HELM_CMD:=}"
: "${REDO_HELM_DIR:=.}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REDO_HELM_IMG=*)
    REDO_HELM_IMG="${1#*=}"
    ;;
  --REDO_HELM_CMD=*)
    REDO_HELM_CMD="${1#*=}"
    ;;
  --REDO_HELM_DIR=*)
    REDO_HELM_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("--volume $(pwd)/$REDO_HELM_DIR/.helm/cache:/root/.cache/helm")
_ARGS_RUN_+=("--volume $(pwd)/$REDO_HELM_DIR/.helm/config:/root/.config/helm")
_ARGS_RUN_+=("$REDO_HELM_IMG")
_ARGS_RUN_+=("$REDO_HELM_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull $REDO_HELM_IMG
dockerception-run $REDO_HELM_DIR /app ${_ARGS_RUN_[*]}
