#!/bin/bash

set -e

: "${REDO_COMPOSER_DIR:=main}"

docker build --rm --pull --target dev-composer --tag uuid-based-on-args --file Dockerfile .
dockerception-run $REDO_COMPOSER_DIR /app uuid-based-on-args composer $@
