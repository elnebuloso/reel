#!/bin/bash

set -e

: "${REDO_HADOLINT:=hadolint/hadolint:latest}"
: "${REDO_HADOLINT_EXEC:=hadolint}"

dockerception-pull "${REDO_HADOLINT}"
dockerception-run /app "${REDO_HADOLINT} ${REDO_HADOLINT_EXEC}" "$@"
