#!/bin/bash

set -e

: "${REDO_YARN:=node:alpine}"
: "${REDO_YARN_EXEC:=yarn}"
: "${REDO_YARN_DIR:=main}"

ARGUMENTS=""

while [ $# -gt 0 ]; do
  case "$1" in
    --REDO_YARN=*)
      REDO_YARN="${1#*=}"
      ;;
    --REDO_YARN_EXEC=*)
      REDO_YARN_EXEC="${1#*=}"
      ;;
    --REDO_YARN_DIR=*)
      REDO_YARN_DIR="${1#*=}"
      ;;
    *)
      ARGUMENTS="$ARGUMENTS $1"
  esac
  shift
done

dockerception-pull $REDO_YARN
dockerception-run $REDO_YARN_DIR /app $REDO_YARN $REDO_YARN_EXEC $ARGUMENTS
