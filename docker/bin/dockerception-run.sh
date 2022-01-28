#!/bin/bash

set -e

: "${REDO_VERBOSE_LEVEL:=0}"

RUN="docker run -it --rm --workdir $1 --volume $(pwd):$1 ${@:2}"

if [[ ${REDO_VERBOSE_LEVEL} -ge 2 ]]; then
    echo -e "\e[36m${RUN}\e[0m"
fi

$RUN
