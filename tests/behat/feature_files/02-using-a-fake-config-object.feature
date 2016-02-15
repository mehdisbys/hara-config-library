Feature: Mocking the config file for unit tests
    In order to test client code relying on the library
    As a developer building testing a service which uses the config library
    I want to inject values into a fake config object and have it behave like a real one

    Scenario: Faking a simple setting
        Given I have injected the setting 'REDIS_ENDPOINT' with the value 'fake-redis-server.com'
        When I get the setting 'REDIS_ENDPOINT'
        Then I should get the value 'fake-redis-server.com'

    Scenario: Getting a setting that doesn't exist
        When I try to get the setting 'THING_THAT_HASNT_BEEN_INJECTED'
        Then I should get a helpful error message

    Scenario: Finding out whether we're on dev or not
        Given I have injected true as a value whether or not we're on dev
        When I ask whether or not this is the dev environment
        Then I should get a response of true

    Scenario: Faking a Data Source Name
        Given I have injected the DSN 'sqlite:/tmp/sqlite.sq3'
        When I get the DNS for the service 'service-nickname'
        Then I should get the value 'sqlite:/tmp/sqlite.sq3'
