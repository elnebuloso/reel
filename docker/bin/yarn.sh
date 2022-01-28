#!/bin/bash

set -e

: "${REDO_YARN:=node:alpine}"
: "${REDO_YARN_EXEC:=yarn}"
: "${REDO_YARN_DIR:=main}"

dockerception-pull $REDO_YARN
dockerception-run $REDO_YARN_DIR /app $REDO_YARN $REDO_YARN_EXEC $@
