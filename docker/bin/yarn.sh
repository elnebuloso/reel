#!/bin/bash

set -e

: "${REDO_YARN:=node:alpine}"
: "${REDO_YARN_EXEC:=yarn}"

dockerception-pull "${REDO_YARN}"
dockerception-run "${REDO_YARN} ${REDO_YARN_EXEC}" "$@"
