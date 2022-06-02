# Reel

Development and CI/CD Abstraction

## Currently, under heavy development

## Table of contents

1. [Usage](#usage)
2. [Development / Contribute](#development--contribute)
3. [Documentation](docs/index.md)

## Usage

### Requirements

- Docker

### Installation

Download and install the latest reel script for the current version

#### Linux

```shell
curl -sSL https://raw.githubusercontent.com/elnebuloso/reel/main/reel.sh -o /usr/local/bin/reel \
&& chmod +x /usr/local/bin/reel
```

### Run

Run Reel bash, also supporting bash completion

```shell
reel bash
```

Run Reel a command

```shell
reel <command>
```

## Development / Contribute

Prepare Reel for local development

```shell
./dev.sh prepare
```

Build Reel container for local development

```shell
./dev.sh build
```

Install Dependencies, requires building Reel

```shell
./dev.sh install
```

Update Dependencies, requires building Reel

```shell
./dev.sh update
```

Run Tests, requires building Reel

```shell
./dev.sh tests
```

Run Reel Bash in demo/base directory, also supporting bash completion

```shell
./dev.sh demo base reel bash
```

Run Reel Command in demo/base directory

```shell
./dev.sh demo base reel <command>
```
