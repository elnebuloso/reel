#!/bin/bash

set -e

: "${REEL_YARN_IMG:=node:alpine}"
: "${REEL_YARN_CMD:=yarn}"
: "${REEL_YARN_DIR:=main}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REEL_YARN_IMG=*)
    REEL_YARN_IMG="${1#*=}"
    ;;
  --REEL_YARN_CMD=*)
    REEL_YARN_CMD="${1#*=}"
    ;;
  --REEL_YARN_DIR=*)
    REEL_YARN_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("$REEL_YARN_IMG")
_ARGS_RUN_+=("$REEL_YARN_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull $REEL_YARN_IMG
dockerception-run $REEL_YARN_DIR /app ${_ARGS_RUN_[*]}
