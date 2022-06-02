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
curl -sSL https://raw.githubusercontent.com/elnebuloso/reel/main/reelx.sh -o /usr/local/bin/reelx \
&& chmod +x /usr/local/bin/reelx
```

### Run

Run Reel bash, also supporting bash completion

```shell
reelx bash
```

Run a Reel Command

```shell
reelx reel <command>
```

Run a Command

```shell
reelx <command>
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
./dev.sh test
```

Run a Reel Bash in demo/base directory, also supporting bash completion

```shell
./dev.sh demo base bash
```

Run a Reel Command in demo/base directory

```shell
./dev.sh demo base reel <command>
```

Run a Command in demo/base directory

```shell
./dev.sh demo base <command>
```
