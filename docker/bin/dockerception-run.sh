#!/bin/bash

set -e

: "${REEL_VERBOSE_LEVEL:=0}"

_RUN_=()
_RUN_+=("docker")
_RUN_+=("run")
_RUN_+=("-it")
_RUN_+=("--rm")
_RUN_+=("--volume $(pwd)/$1:$2")
_RUN_+=("--workdir $2")
_RUN_+=("${@:3}")

if [[ ${REEL_VERBOSE_LEVEL} -ge 2 ]]; then
  echo -e "\e[36m${_RUN_[*]}\e[0m"
fi

${_RUN_[*]}
