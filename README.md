# redo

CI/CD Abstraction Command Line Runner

## Features

- Dockerception

## Usage

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

## Development

Build redo container for local development

```shell
./app.sh build
```

Run redo in an interactive bash in test/base directory, also supporting bash completion

```shell
./app.sh test base bash
```

Run redo commands and dockerception in test/base directory

```shell
./app.sh test base redo docker:build
```













## Configuration

### Environment Variables

#### REDO_VERBOSE_LEVEL

- **0** - no logging
- **1** - info messages
- **2** - debug messages

#### REDO_DOCKERCEPTION_PULL_POLICY

- IfNotPresent 
- Always

## PHP Base Container Image

https://github.com/codecasts/php-alpine
