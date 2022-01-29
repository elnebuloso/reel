#!/bin/bash

set -e

: "${REDO_ANSIBLE_LINT_IMG:=cytopia/ansible-lint:latest}"
: "${REDO_ANSIBLE_LINT_CMD:=}"
: "${REDO_ANSIBLE_LINT_DIR:=main}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REDO_ANSIBLE_LINT_IMG=*)
    REDO_ANSIBLE_LINT_IMG="${1#*=}"
    ;;
  --REDO_ANSIBLE_LINT_CMD=*)
    REDO_ANSIBLE_LINT_CMD="${1#*=}"
    ;;
  --REDO_ANSIBLE_LINT_DIR=*)
    REDO_ANSIBLE_LINT_DIR="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

_ARGS_RUN_=()
_ARGS_RUN_+=("$REDO_ANSIBLE_LINT_IMG")
_ARGS_RUN_+=("$REDO_ANSIBLE_LINT_CMD")
_ARGS_RUN_+=("${_ARGS_[*]}")

dockerception-pull $REDO_ANSIBLE_LINT_IMG
dockerception-run $REDO_ANSIBLE_LINT_DIR /app ${_ARGS_RUN_[*]}
