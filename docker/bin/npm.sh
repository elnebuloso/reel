#!/bin/bash

set -e

: "${REDO_NPM:=node:alpine}"
: "${REDO_NPM_EXEC:=npm}"
: "${REDO_NPM_DIR:=main}"

ARGUMENTS=""

while [ $# -gt 0 ]; do
  case "$1" in
    --REDO_NPM=*)
      REDO_NPM="${1#*=}"
      ;;
    --REDO_NPM_EXEC=*)
      REDO_NPM_EXEC="${1#*=}"
      ;;
    --REDO_NPM_DIR=*)
      REDO_NPM_DIR="${1#*=}"
      ;;
    *)
      ARGUMENTS="$ARGUMENTS $1"
  esac
  shift
done

dockerception-pull $REDO_NPM
dockerception-run $REDO_NPM_DIR /app $REDO_NPM $REDO_NPM_EXEC $ARGUMENTS
