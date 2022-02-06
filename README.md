# redo

CI/CD Abstraction Command Line Runner

## Currently, under heavy development

## Table of contents

1. [Features](#features)
2. [Usage](#usage)
3. [Development / Contribute](#development--contribute)

## Features

- Dockerception

## Usage

### Requirements

- Docker Installation

### Installation

Download and install the latest redo bash script for the current version

#### Linux

```shell
curl -sSL https://raw.githubusercontent.com/elnebuloso/redo/main/redo.sh -o /usr/local/bin/redo \
&& chmod +x /usr/local/bin/redo
```

### Run

```shell
redo list
redo docker:build
```

#### Interactive mode with code completion

If you want to keep redo open in interactive mode with code completion, run redo with **--watch** option.

```shell
redo --shell
```

### Configuration

Redo can be completely configured via environment variables.

To easily configure the environment variables during local development with REDO, simply place a .redo.env file in the root directory of the respective project and configure redo with the variables defined there.

#### Environment Variables

##### REDO_VERBOSE_LEVEL

- **0** - no logging (Default)
- **1** - info messages
- **2** - debug messages

##### REDO_DOCKERCEPTION_PULL_POLICY

- IfNotPresent (Default)
- Always

## Dockerception

Provided Tools via Dockerception calls

- ansible-lint
- compass
- csso
- hadolint
- helm
- npm
- yarn

### ansible-lint

Environment Variables

```shell
REDO_ANSIBLE_LINT_IMG=cytopia/ansible-lint:latest
REDO_ANSIBLE_LINT_CMD=
REDO_ANSIBLE_LINT_DIR=main
```

Usage

```shell
# redo development
./app.sh test base ansible-lint --version
./app.sh test base ansible-lint --version --REDO_ANSIBLE_LINT_IMG=cytopia/ansible-lint:5
```

### compass

Environment Variables

```shell
REDO_COMPASS_IMG=elnebuloso/compass:latest
REDO_COMPASS_CMD=compass
REDO_COMPASS_DIR=main
```

Usage

```shell
# redo development
./app.sh test base compass --version
./app.sh test base compass --version --REDO_COMPASS_IMG=1.0.3
```

### csso

Environment Variables

```shell
REDO_CSSO_IMG=elnebuloso/csso-cli:latest
REDO_CSSO_CMD=
REDO_CSSO_DIR=main
```

Usage

```shell
# redo development
./app.sh test base csso --version
./app.sh test base csso --version --REDO_CSSO_IMG=4.1.0
```

### hadolint

Environment Variables

```shell
REDO_HADOLINT_IMG=hadolint/hadolint:latest
REDO_HADOLINT_CMD=hadolint
REDO_HADOLINT_DIR=.
```

Usage

```shell
# redo development
./app.sh test base hadolint --version
./app.sh test base hadolint --version --REDO_HADOLINT_IMG=2.8.0-alpine
```

### helm

Environment Variables

```shell
REDO_HELM_IMG=alpine/helm:latest
REDO_HELM_CMD=
REDO_HELM_DIR=.
```

Usage

```shell
# redo development
./app.sh test base helm version
./app.sh test base helm version --REDO_HELM_IMG=alpine/helm:3.8.0
```

### npm

Environment Variables

```shell
REDO_NPM_IMG=node:alpine
REDO_NPM_CMD=npm
REDO_NPM_DIR=main
```

Usage

```shell
# redo development
./app.sh test base npm --version
./app.sh test base yarn --version --REDO_NPM_IMG=node:12
```

### yarn

Environment Variables

```shell
REDO_YARN_IMG=node:alpine
REDO_YARN_CMD=yarn
REDO_YARN_DIR=main
```

Usage

```shell
# redo development
./app.sh test base yarn --version
./app.sh test base yarn --version --REDO_YARN_IMG=node:12
```

## Development / Contribute

Prepare redo application for local development

```shell
./app.sh prepare
```

Build redo application container for local development

```shell
./app.sh build
```

Install or Update Dependencies, requires building the redo application container

```shell
./app.sh install
./app.sh update
```

Run Tests, requires building the redo application container

```shell
./app.sh tests
```












Run redo in an interactive bash in test/base directory, also supporting bash completion

```shell
./app.sh test base bash
```

Run redo commands and dockerception in test/base directory

```shell
./app.sh test base redo docker:build
```

## MISC

### Based on PHP Base Container Image

https://github.com/codecasts/php-alpine
