#!/usr/bin/env bash

clear;

# PHPUnit tests
./vendor/bin/phpunit --config tests/phpunit/phpunit.xml;
PHPUNIT_RETURN_CODE=$?

# PHPSpec tests
./vendor/bin/phpspec run --config tests/phpspec/phpspec.yml;
PHPSPEC_RETURN_CODE=$?

# Behat service-level tests
./vendor/bin/behat -c tests/behat/behat.yml --suite integrationtesting;
BEHAT_SERVICELEVEL_RETURN_CODE=$?

# Print results so you don't have to scroll
echo;
echo -n 'PHPUnit return code:             ';
echo $PHPUNIT_RETURN_CODE;

echo -n 'PHPSpec return code:             ';
echo $PHPSPEC_RETURN_CODE;

echo -n 'Behat serivce-level return code: ';
echo $BEHAT_SERVICELEVEL_RETURN_CODE;

# Work out an exit code, and exit
TOTAL_EXIT_CODE=$((PHPUNIT_RETURN_CODE + PHPSPEC_RETURN_CODE + BEHAT_SERVICELEVEL_RETURN_CODE + BEHAT_WEBSERVERL_RETURN_CODE))

if [ $TOTAL_EXIT_CODE -eq 0 ]
then
  exit 0;
else
  exit 100;
fi
