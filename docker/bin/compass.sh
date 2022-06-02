#!/bin/bash

set -e

: "${REEL_COMPASS_IMG:=elnebuloso/compass:latest}"
: "${REEL_COMPASS_CMD:=compass}"
: "${REEL_COMPASS_DIR:=main}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REEL_COMPASS_IMG=*)
    REEL_COMPASS_IMG="${1#*=}"
    ;;
  --REEL_COMPASS_CMD=*)
    REEL_COMPASS_CMD="${1#*=}"
    ;;
  --REEL_COMPASS_DIR=*)
    REEL_COMPASS_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("$REEL_COMPASS_IMG")
_ARGS_RUN_+=("$REEL_COMPASS_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull $REEL_COMPASS_IMG
dockerception-run $REEL_COMPASS_DIR /app ${_ARGS_RUN_[*]}
