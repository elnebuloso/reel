#!/bin/bash

set -e

: "${REDO_YARN_IMG:=node:alpine}"
: "${REDO_YARN_CMD:=yarn}"
: "${REDO_YARN_DIR:=main}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REDO_YARN_IMG=*)
    REDO_YARN_IMG="${1#*=}"
    ;;
  --REDO_YARN_CMD=*)
    REDO_YARN_CMD="${1#*=}"
    ;;
  --REDO_YARN_DIR=*)
    REDO_YARN_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("$REDO_YARN_IMG")
_ARGS_RUN_+=("$REDO_YARN_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull "$REDO_YARN_IMG"
dockerception-run "$REDO_YARN_DIR" "/app" "${_ARGS_RUN_[*]}"
