#!/bin/bash

set -e

: "${REEL_NPM_IMG:=node:20-alpine}"
: "${REEL_NPM_CMD:=npm}"
: "${REEL_NPM_DIR:=main}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REEL_NPM_IMG=*)
    REEL_NPM_IMG="${1#*=}"
    ;;
  --REEL_NPM_CMD=*)
    REEL_NPM_CMD="${1#*=}"
    ;;
  --REEL_NPM_DIR=*)
    REEL_NPM_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("$REEL_NPM_IMG")
_ARGS_RUN_+=("$REEL_NPM_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull $REEL_NPM_IMG
dockerception-run $REEL_NPM_DIR /app ${_ARGS_RUN_[*]}
