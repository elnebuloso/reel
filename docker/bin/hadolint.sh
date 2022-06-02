#!/bin/bash

set -e

: "${REEL_HADOLINT_IMG:=hadolint/hadolint:latest}"
: "${REEL_HADOLINT_CMD:=hadolint}"
: "${REEL_HADOLINT_DIR:=.}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REEL_HADOLINT_IMG=*)
    REEL_HADOLINT_IMG="${1#*=}"
    ;;
  --REEL_HADOLINT_CMD=*)
    REEL_HADOLINT_CMD="${1#*=}"
    ;;
  --REEL_HADOLINT_DIR=*)
    REEL_HADOLINT_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("$REEL_HADOLINT_IMG")
_ARGS_RUN_+=("$REEL_HADOLINT_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull $REEL_HADOLINT_IMG
dockerception-run $REEL_HADOLINT_DIR /app ${_ARGS_RUN_[*]}
