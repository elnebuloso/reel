#!/bin/bash

set -e

: "${REDO_HADOLINT:=hadolint/hadolint:latest}"
: "${REDO_HADOLINT_EXEC:=hadolint}"
: "${REDO_HADOLINT_DIR:=.}"

ARGUMENTS=""

while [ $# -gt 0 ]; do
  case "$1" in
    --REDO_HADOLINT=*)
      REDO_HADOLINT="${1#*=}"
      ;;
    --REDO_HADOLINT_EXEC=*)
      REDO_HADOLINT_EXEC="${1#*=}"
      ;;
    --REDO_HADOLINT_DIR=*)
      REDO_HADOLINT_DIR="${1#*=}"
      ;;
    *)
      ARGUMENTS="$ARGUMENTS $1"
  esac
  shift
done

dockerception-pull $REDO_HADOLINT
dockerception-run $REDO_HADOLINT_DIR /app $REDO_HADOLINT $REDO_HADOLINT_EXEC $ARGUMENTS
