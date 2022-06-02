# Documentation

## Table of contents

1. [Configuration](#configuration)
2. [Commands](#commands)

## Configuration

Reel can be completely configured via environment variables.

To easily configure the environment variables during local development, 
simply place a .reel.env file in the root directory of the respective project and configure Reel with the variables defined there.

### Environment Variables

#### REEL_VERBOSE_LEVEL

- **0** - no logging (Default)
- **1** - info messages
- **2** - debug messages

#### REEL_DOCKERCEPTION_PULL_POLICY

- IfNotPresent (Default)
- Always

## Commands

### Dockerception

Provided Tools via Dockerception calls, Reel Calls this Commands via other Docker Containers.

- [ansible-lint](commands.md#ansible-lint)
- compass
- csso
- hadolint
- helm
- npm
- yarn

### ansible-lint

Environment Variables

```shell
REEL_ANSIBLE_LINT_IMG=cytopia/ansible-lint:latest
REEL_ANSIBLE_LINT_CMD=
REEL_ANSIBLE_LINT_DIR=main
```

Usage

```shell
# reel development
./dev.sh test base ansible-lint --version
./dev.sh test base ansible-lint --version --REEL_ANSIBLE_LINT_IMG=cytopia/ansible-lint:5
```

### compass

Environment Variables

```shell
REEL_COMPASS_IMG=elnebuloso/compass:latest
REEL_COMPASS_CMD=compass
REEL_COMPASS_DIR=main
```

Usage

```shell
# reel development
./dev.sh test base compass --version
./dev.sh test base compass --version --REEL_COMPASS_IMG=1.0.3
```

### csso

Environment Variables

```shell
REEL_CSSO_IMG=elnebuloso/csso-cli:latest
REEL_CSSO_CMD=
REEL_CSSO_DIR=main
```

Usage

```shell
# reel development
./dev.sh test base csso --version
./dev.sh test base csso --version --REEL_CSSO_IMG=4.1.0
```

### hadolint

Environment Variables

```shell
REEL_HADOLINT_IMG=hadolint/hadolint:latest
REEL_HADOLINT_CMD=hadolint
REEL_HADOLINT_DIR=.
```

Usage

```shell
# reel development
./dev.sh test base hadolint --version
./dev.sh test base hadolint --version --REEL_HADOLINT_IMG=2.8.0-alpine
```

### helm

Environment Variables

```shell
REEL_HELM_IMG=alpine/helm:latest
REEL_HELM_CMD=
REEL_HELM_DIR=.
```

Usage

```shell
# reel development
./dev.sh test base helm version
./dev.sh test base helm version --REEL_HELM_IMG=alpine/helm:3.8.0
```

### npm

Environment Variables

```shell
REEL_NPM_IMG=node:alpine
REEL_NPM_CMD=npm
REEL_NPM_DIR=main
```

Usage

```shell
# reel development
./dev.sh test base npm --version
./dev.sh test base yarn --version --REEL_NPM_IMG=node:12
```

### yarn

Environment Variables

```shell
REEL_YARN_IMG=node:alpine
REEL_YARN_CMD=yarn
REEL_YARN_DIR=main
```

Usage

```sh
# reel development
./dev.sh test base yarn --version
./dev.sh test base yarn --version --REEL_YARN_IMG=node:12
```
