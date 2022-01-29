#!/bin/bash

set -e

: "${REDO_CSSO_IMG:=elnebuloso/csso-cli:latest}"
: "${REDO_CSSO_CMD:=}"
: "${REDO_CSSO_DIR:=main}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REDO_CSSO_IMG=*)
    REDO_CSSO_IMG="${1#*=}"
    ;;
  --REDO_CSSO_CMD=*)
    REDO_CSSO_CMD="${1#*=}"
    ;;
  --REDO_CSSO_DIR=*)
    REDO_CSSO_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("$REDO_CSSO_IMG")
_ARGS_RUN_+=("$REDO_CSSO_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull $REDO_CSSO_IMG
dockerception-run $REDO_CSSO_DIR /app ${_ARGS_RUN_[*]}
