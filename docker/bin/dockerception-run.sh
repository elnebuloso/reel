#!/bin/bash

set -e

: "${REDO_VERBOSE_LEVEL:=0}"

RUN="docker run -it --rm --volume $(pwd)/$1:$2 --workdir $2 ${@:3}"

if [[ ${REDO_VERBOSE_LEVEL} -ge 2 ]]; then
    echo -e "\e[36m${RUN}\e[0m"
fi

$RUN
