#!/bin/bash

set -e

: "${REDO_PHPUNIT_DIR:=.}"
: "${REDO_PHPUNIT_DOCKER_BUILD_CONTEXT:=.}"
: "${REDO_PHPUNIT_DOCKER_BUILD_ARGS:=--rm --pull}"
: "${REDO_PHPUNIT_DOCKER_FILE_NAME:=Dockerfile}"
: "${REDO_PHPUNIT_DOCKER_FILE_TARGET:=dev-phpunit}"

_ARGS_=()

while [ $# -gt 0 ]; do
  case "$1" in
  --REDO_PHPUNIT_DIR=*)
    REDO_PHPUNIT_DIR="${1#*=}"
    ;;
  --REDO_PHPUNIT_DOCKER_BUILD_CONTEXT=*)
    REDO_PHPUNIT_DOCKER_BUILD_CONTEXT="${1#*=}"
    ;;
  --REDO_PHPUNIT_DOCKER_BUILD_ARGS=*)
    REDO_PHPUNIT_DOCKER_BUILD_ARGS="${1#*=}"
    ;;
  --REDO_PHPUNIT_DOCKER_FILE_NAME=*)
    REDO_PHPUNIT_DOCKER_FILE_NAME="${1#*=}"
    ;;
  --REDO_PHPUNIT_DOCKER_FILE_TARGET=*)
    REDO_PHPUNIT_DOCKER_FILE_TARGET="${1#*=}"
    ;;
  *)
    _ARGS_+=($1)
    ;;
  esac
  shift
done

: "${REDO_DOCKERCEPTION_BUILD_CONTEXT:=.}"
: "${REDO_DOCKERCEPTION_FILE_NAME:=Dockerfile}"
: "${REDO_DOCKERCEPTION_FILE_TARGET:=dev-phpunit}"
: "${REDO_DOCKERCEPTION_RUN_DIR:=.}"
: "${REDO_DOCKERCEPTION_RUN_WORKDIR:=/app}"

_ARGS_RUN_=()
_ARGS_RUN_+=("--REDO_DOCKERCEPTION_BUILD_TAG=phpunit")
_ARGS_RUN_+=("--REDO_DOCKERCEPTION_BUILD_CONTEXT=$REDO_PHPUNIT_DOCKER_BUILD_CONTEXT")
_ARGS_RUN_+=("--REDO_DOCKERCEPTION_FILE_NAME=$REDO_PHPUNIT_DOCKER_FILE_NAME")
_ARGS_RUN_+=("--REDO_DOCKERCEPTION_FILE_TARGET=$REDO_PHPUNIT_DOCKER_FILE_TARGET")
_ARGS_RUN_+=("--REDO_DOCKERCEPTION_RUN_DIR=$REDO_PHPUNIT_DIR")
_ARGS_RUN_+=("--REDO_DOCKERCEPTION_RUN_WORKDIR=/app")

dockerception-build-and-run ${_ARGS_RUN_[*]} phpunit ${_ARGS_[*]}
