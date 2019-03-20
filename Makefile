# This Makefile allows developers to run common build- and test-related tasks.

# A default command if "make" is called by itself.
# Usage: $ make  OR  $ make it
.PHONY: it
it: test

# Install Composer dependencies.
# Usage: $ make vendor
vendor: composer.json composer.lock
	composer install

# Run all tests.
# Usage: $ make test
.PHONY: test
test: vendor
	php vendor/bin/phpunit
