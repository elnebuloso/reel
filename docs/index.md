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

Provided Commands via Dockerception calls, Reel Calls this Commands via other Docker Containers.

- [ansible-lint](commands.md#ansible-lint)
- [compass](commands.md#compass)
- [csso](commands.md#csso)
- [hadolint](commands.md#hadolint)
- [helm](commands.md#helm)
- [npm](commands.md#npm)
- [yarn](commands.md#yarn)
