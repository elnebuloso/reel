# Commands

## Dockerception

### ansible-lint

Environment Variables

```shell
REEL_ANSIBLE_LINT_IMG=cytopia/ansible-lint:latest
REEL_ANSIBLE_LINT_CMD=
REEL_ANSIBLE_LINT_DIR=main
```

Usage

```shell
ansible-lint --version
```

Override Environment Variables via option

```shell
ansible-lint --version --REEL_ANSIBLE_LINT_IMG=cytopia/ansible-lint:5
```
