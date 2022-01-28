# redo

CI/CD Abstraction Command Line Runner

## Configuration

### Environment Variables

#### REDO_VERBOSE_LEVEL

- **0** - no logging
- **1** - info messages
- **2** - debug messages

#### REDO_DOCKERCEPTION_PULL_POLICY

- IfNotPresent 
- Always

## Dockerception

### hadolint

```shell
./app.sh test base hadolint --version
```

### helm

```shell
./app.sh test base helm version
```

### npm

```shell
./app.sh test base npm --version
```

### yarn

```shell
./app.sh test base yarn --version
```

## PHP Base Container Image

https://github.com/codecasts/php-alpine

## Development

Build redo container for local development

```shell
./app.sh build
```

Run redo in an interactive bash in test/base directory, also supporting bash completion

```shell
./app.sh test base bash
```

Run redo command in test/base directory

```shell
./app.sh test base redo docker:build
```

Set the appropriate permissions and encoding for redo

```shell
dos2unix main/redo \
&& chmod +x main/redo \
&& git update-index --chmod=+x main/redo
```

Set the appropriate permissions and encoding for app.sh

```shell
dos2unix app.sh \
&& chmod +x app.sh \
&& git update-index --chmod=+x app.sh
```
