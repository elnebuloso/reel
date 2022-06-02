# Commands

## Dockerception

Provided Commands via Dockerception calls, Reel Calls this Commands via other Docker Containers.

- [ansible-lint](#ansible-lint)
- [compass](#compass)
- [csso](#csso)
- [hadolint](#hadolint)
- [helm](#helm)
- [npm](#npm)
- [yarn](#yarn)

### ansible-lint

#### Environment Variables

```text
REEL_ANSIBLE_LINT_IMG=cytopia/ansible-lint:latest
REEL_ANSIBLE_LINT_CMD=
REEL_ANSIBLE_LINT_DIR=main
```

#### Usage

Example

```shell
ansible-lint --version
```

Example: Override Environment Variables via Command Line Option

```shell
ansible-lint --version --REEL_ANSIBLE_LINT_IMG=cytopia/ansible-lint:5
```

### compass

#### Environment Variables

```text
REEL_COMPASS_IMG=elnebuloso/compass:latest
REEL_COMPASS_CMD=compass
REEL_COMPASS_DIR=main
```

#### Usage

Example

```shell
compass --version
```

Example how to override variables via cli options

```shell
compass --version --REEL_COMPASS_IMG=1.0.3
```

### csso

#### Environment Variables

```text
REEL_CSSO_IMG=elnebuloso/csso-cli:latest
REEL_CSSO_CMD=
REEL_CSSO_DIR=main
```

#### Usage

Example

```shell
csso --version
```

Example how to override variables via cli options

```shell
csso --version --REEL_CSSO_IMG=4.1.0
```

### hadolint

#### Environment Variables

```text
REEL_HADOLINT_IMG=hadolint/hadolint:latest
REEL_HADOLINT_CMD=hadolint
REEL_HADOLINT_DIR=.
```

#### Usage

Example

```shell
hadolint --version
```

Example how to override variables via cli options

```shell
hadolint --version --REEL_HADOLINT_IMG=2.8.0-alpine
```

### helm

#### Environment Variables

```text
REEL_HELM_IMG=alpine/helm:latest
REEL_HELM_CMD=
REEL_HELM_DIR=.
```

#### Usage

Example

```shell
# reel development
helm version
```

Example how to override variables via cli options

```shell
helm version --REEL_HELM_IMG=alpine/helm:3.8.0
```

### npm

#### Environment Variables

```shell
REEL_NPM_IMG=node:alpine
REEL_NPM_CMD=npm
REEL_NPM_DIR=main
```

#### Usage

Example

```shell
npm --version
```

Example how to override variables via cli options

```shell
npm --version --REEL_NPM_IMG=node:12
```

### yarn

#### Environment Variables

```shell
REEL_YARN_IMG=node:alpine
REEL_YARN_CMD=yarn
REEL_YARN_DIR=main
```

#### Usage

Example

```shell
yarn --version
```

Example how to override variables via cli options

```shell
yarn --version --REEL_YARN_IMG=node:12
```
