#!/bin/bash

set -e

: "${REDO_HELM:=alpine/helm:latest}"
: "${REDO_HELM_EXEC:=}"
: "${REDO_HELM_DIR:=.}"

ARGUMENTS=""

while [ $# -gt 0 ]; do
  case "$1" in
    --REDO_HELM=*)
      REDO_HELM="${1#*=}"
      ;;
    --REDO_HELM_EXEC=*)
      REDO_HELM_EXEC="${1#*=}"
      ;;
    --REDO_HELM_DIR=*)
      REDO_HELM_DIR="${1#*=}"
      ;;
    *)
      ARGUMENTS="$ARGUMENTS $1"
  esac
  shift
done

dockerception-pull $REDO_HELM
dockerception-run $REDO_HELM_DIR /app "--volume $(pwd)/.helm/cache:/root/.cache/helm" "--volume $(pwd)/.helm/config:/root/.config/helm" "--volume $(pwd)/.helm/data:/root/.local/share/helm" $REDO_HELM $REDO_HELM_EXEC $ARGUMENTS
