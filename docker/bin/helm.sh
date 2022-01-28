#!/bin/bash

set -e

: "${REDO_HELM:=alpine/helm:latest}"
: "${REDO_HELM_EXEC:=}"
: "${REDO_HELM_DIR:=.}"

dockerception-pull $REDO_HELM
dockerception-run $REDO_HELM_DIR /app "--volume $(pwd)/.helm/cache:/root/.cache/helm" "--volume $(pwd)/.helm/config:/root/.config/helm" "--volume $(pwd)/.helm/data:/root/.local/share/helm" $REDO_HELM $REDO_HELM_EXEC $@
