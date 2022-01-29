#!/bin/bash

set -e

: "${REDO_DOCKERCEPTION_PULL_POLICY:=IfNotPresent}"
: "${REDO_VERBOSE_LEVEL:=0}"

PULL_DOCKER_IMAGE="no"

if [[ "$(docker images -q $1 2>/dev/null)" == "" ]]; then
  PULL_DOCKER_IMAGE="yes"
fi

if [[ "${REDO_DOCKERCEPTION_PULL_POLICY}" == "Always" ]]; then
  PULL_DOCKER_IMAGE="yes"
fi

if [[ "${PULL_DOCKER_IMAGE}" == "yes" ]]; then
  if [[ ${REDO_VERBOSE_LEVEL} -ge 1 ]]; then
    echo -e "\e[36mDocker Image Pull [${REDO_DOCKERCEPTION_PULL_POLICY}] \e[34m$1\e[0m"
  fi

  if [[ ${REDO_VERBOSE_LEVEL} -ge 2 ]]; then
    docker pull $1
  else
    docker pull --quiet "$1" >/dev/null 2>&1
  fi
fi
