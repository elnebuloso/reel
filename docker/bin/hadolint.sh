#!/bin/bash

set -e

: "${REDO_HADOLINT:=hadolint/hadolint:latest}"
: "${REDO_HADOLINT_EXEC:=hadolint}"
: "${REDO_HADOLINT_DIR:=.}"

dockerception-pull $REDO_HADOLINT
dockerception-run $REDO_HADOLINT_DIR /app $REDO_HADOLINT $REDO_HADOLINT_EXEC $@
