#!/bin/bash

set -e

: "${REDO_NPM:=node:alpine}"
: "${REDO_NPM_EXEC:=npm}"
: "${REDO_NPM_DIR:=main}"

dockerception-pull $REDO_NPM
dockerception-run $REDO_NPM_DIR /app $REDO_NPM $REDO_NPM_EXEC $@
