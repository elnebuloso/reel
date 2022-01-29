#!/bin/bash

set -e

: "${REDO_NPM_IMG:=node:alpine}"
: "${REDO_NPM_CMD:=npm}"
: "${REDO_NPM_DIR:=main}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REDO_NPM_IMG=*)
    REDO_NPM_IMG="${1#*=}"
    ;;
  --REDO_NPM_CMD=*)
    REDO_NPM_CMD="${1#*=}"
    ;;
  --REDO_NPM_DIR=*)
    REDO_NPM_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("$REDO_NPM_IMG")
_ARGS_RUN_+=("$REDO_NPM_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull "$REDO_NPM_IMG"
dockerception-run "$REDO_NPM_DIR" "/app" "${_ARGS_RUN_[*]}"
