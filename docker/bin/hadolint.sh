#!/bin/bash

set -e

: "${REDO_HADOLINT_IMG:=hadolint/hadolint:latest}"
: "${REDO_HADOLINT_CMD:=hadolint}"
: "${REDO_HADOLINT_DIR:=.}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REDO_HADOLINT_IMG=*)
    REDO_HADOLINT_IMG="${1#*=}"
    ;;
  --REDO_HADOLINT_CMD=*)
    REDO_HADOLINT_CMD="${1#*=}"
    ;;
  --REDO_HADOLINT_DIR=*)
    REDO_HADOLINT_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("$REDO_HADOLINT_IMG")
_ARGS_RUN_+=("$REDO_HADOLINT_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull "$REDO_HADOLINT_IMG"
dockerception-run "$REDO_HADOLINT_DIR" "/app" "${_ARGS_RUN_[*]}"
