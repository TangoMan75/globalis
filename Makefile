#/**
# * This file was generated with TangoMan Makefile Generator
# * https://github.com/TangoMan75/makefile-generator
# *
# * Test Technique Globalis
# *
# * Paravent Prolosaures, test technique Globalis.
# *
# * @version  0.1.0
# * @author   "Matthias Morin" <mat@tangoman.io>
# * @license  MIT
# * @link     https://github.com/TangoMan75/globalis
# */

.PHONY: help install tests lint lint-fix

#--------------------------------------------------
# Colors
#--------------------------------------------------

TITLE     = \033[1;42m
CAPTION   = \033[1;44m
BOLD      = \033[1;34m
LABEL     = \033[1;32m
DANGER    = \033[31m
SUCCESS   = \033[32m
WARNING   = \033[33m
SECONDARY = \033[34m
INFO      = \033[35m
PRIMARY   = \033[36m
DEFAULT   = \033[0m
NL        = \033[0m\n

#--------------------------------------------------
# Help
#--------------------------------------------------

## Print this help
help:
	@printf "${TITLE} Globalis ${NL}\n"

	@printf "${CAPTION} Description:${NL}"
	@printf "${WARNING} Paravent Prolosaures, test technique Globalis.${NL}\n"

	@printf "${CAPTION} Usage:${NL}"
	@printf "${WARNING} make [command] `awk -F '?' '/^[ \t]+?[a-zA-Z0-9_-]+[ \t]+?\?=/{gsub(/[ \t]+/,"");printf"%s=[%s]\n",$$1,$$1}' ${MAKEFILE_LIST}|sort|uniq|tr '\n' ' '`${NL}\n"

	@printf "${CAPTION} Commands:${NL}"
	@awk '/^### /{printf"\n${BOLD}%s${NL}",substr($$0,5)} \
	/^[a-zA-Z0-9_-]+:/{HELP="";if(match(PREV,/^## /))HELP=substr(PREV, 4); \
		printf " ${LABEL}%-12s${DEFAULT} ${PRIMARY}%s${NL}",substr($$1,0,index($$1,":")),HELP \
	}{PREV=$$0}' ${MAKEFILE_LIST}

## Install
install:
	@printf "${INFO}composer install --no-interaction --prefer-dist --optimize-autoloader${NL}"
	@composer install --no-interaction --prefer-dist --optimize-autoloader

## Run unit tests
tests:
	@printf "${INFO}./vendor/bin/phpunit tests/ --stop-on-failure${NL}"
	@./vendor/bin/phpunit tests/ --stop-on-failure

## Run linter
lint:
	@printf "${INFO}./vendor/bin/phpcs${NL}"
	@./vendor/bin/phpcs

## Lint source code with phpcs linter
lint-fix:
	@printf "${INFO}./vendor/bin/phpcbf${NL}"
	@./vendor/bin/phpcbf
