Feature: Getting stuff out of the config file
    In order to get my service to connect to the database
    As a developer building a service which has a database
    I want to use the config library to get the password etc. from the secret config file

    Background:
        Given the config library is initialised with the file 'tests/fixtures/example-config-file.ini'

    Scenario: Getting a simple setting
        When I get the setting 'REDIS_ENDPOINT'
        Then I should get the value 'localhost'

    Scenario: Getting a setting that doesn't exist
        When I try to get the setting 'THING_THAT_ISNT_IN_THE_FILE'
        Then I should get a helpful error message

    Scenario: Finding out whether we're on dev or not
        When I ask whether or not this is the dev environment
        Then I should get a response of true

    Scenario: Confirming we're not on dev by default
        Given the config library is initialised with the file 'tests/fixtures/example-production-config-file.ini'
        When I ask whether or not this is the dev environment
        Then I should get a response of false

    Scenario: Getting a Postgres Data Source Name
        When I get the DNS for the service 'auth'
        Then I should get the value 'pgsql:dbname=auth;host=localhost;user=hara;password=XXXXXX'

    Scenario: File doesn't exist
        Given the config library is initialised with the file 'this-file-doesnt-exist.ini'
        When I try to get the setting 'WHATEVER'
        Then I should get an error message telling me the file is missing
