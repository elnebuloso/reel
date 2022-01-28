#!/bin/bash

set -e

: "${REDO_NPM:=node:alpine}"
: "${REDO_NPM_EXEC:=npm}"

dockerception-pull "${REDO_NPM}"
dockerception-run /app "${REDO_NPM} ${REDO_NPM_EXEC}" "$@"
