#!/bin/bash

set -e

: "${REDO_COMPASS_IMG:=elnebuloso/compass:latest}"
: "${REDO_COMPASS_CMD:=compass}"
: "${REDO_COMPASS_DIR:=main}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REDO_COMPASS_IMG=*)
    REDO_COMPASS_IMG="${1#*=}"
    ;;
  --REDO_COMPASS_CMD=*)
    REDO_COMPASS_CMD="${1#*=}"
    ;;
  --REDO_COMPASS_DIR=*)
    REDO_COMPASS_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("$REDO_COMPASS_IMG")
_ARGS_RUN_+=("$REDO_COMPASS_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull $REDO_COMPASS_IMG
dockerception-run $REDO_COMPASS_DIR /app ${_ARGS_RUN_[*]}
