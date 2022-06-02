# Reel

Development and CI/CD Abstraction

***Currently under heavy development***

## Table of contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Usage](#usage)
4. [Development / Contribute](#development--contribute)
5. [Documentation](docs/index.md)

## Requirements

- Docker

## Installation

Download and install the latest **Reelx**, Reel Execution script for the current version

#### Linux

```shell
curl -sSL https://raw.githubusercontent.com/elnebuloso/reel/main/reelx.sh -o /usr/local/bin/reelx \
&& chmod +x /usr/local/bin/reelx
```

## Usage

Run Reel bash on current working directory, also supporting bash completion

```shell
reelx bash
```

Run a Reel Command on current working directory, see [Reel Commands](docs/commands/reel.md)

```shell
reelx reel <command>
```

Run a Command on current working directory, see [Commands](docs/commands.md)

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
