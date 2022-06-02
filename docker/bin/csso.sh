#!/bin/bash

set -e

: "${REEL_CSSO_IMG:=elnebuloso/csso-cli:latest}"
: "${REEL_CSSO_CMD:=}"
: "${REEL_CSSO_DIR:=main}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REEL_CSSO_IMG=*)
    REEL_CSSO_IMG="${1#*=}"
    ;;
  --REEL_CSSO_CMD=*)
    REEL_CSSO_CMD="${1#*=}"
    ;;
  --REEL_CSSO_DIR=*)
    REEL_CSSO_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("$REEL_CSSO_IMG")
_ARGS_RUN_+=("$REEL_CSSO_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull $REEL_CSSO_IMG
dockerception-run $REEL_CSSO_DIR /app ${_ARGS_RUN_[*]}
