#!/bin/bash

set -e

: "${REEL_ANSIBLE_LINT_IMG:=cytopia/ansible-lint:latest}"
: "${REEL_ANSIBLE_LINT_CMD:=}"
: "${REEL_ANSIBLE_LINT_DIR:=main}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REEL_ANSIBLE_LINT_IMG=*)
    REEL_ANSIBLE_LINT_IMG="${1#*=}"
    ;;
  --REEL_ANSIBLE_LINT_CMD=*)
    REEL_ANSIBLE_LINT_CMD="${1#*=}"
    ;;
  --REEL_ANSIBLE_LINT_DIR=*)
    REEL_ANSIBLE_LINT_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("$REEL_ANSIBLE_LINT_IMG")
_ARGS_RUN_+=("$REEL_ANSIBLE_LINT_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull $REEL_ANSIBLE_LINT_IMG
dockerception-run $REEL_ANSIBLE_LINT_DIR /app ${_ARGS_RUN_[*]}
