Feature: Smoke testing service
    In order to find out if the service works
    As a devops
    I want to get a response telling me if anything is broken

    Scenario: Adding a storage location
        When I query the smoke test endpoint
        Then the response body should say the smoke test result is 'PASS'
