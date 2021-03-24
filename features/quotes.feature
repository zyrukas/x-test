Feature:
    In order to prove that the authors and their quotes returns correctly.

    Scenario: It asks and checks for famous authors and for first author's quotes lis
        When asked for author quotes
        Then the quotes list response should be received

    Scenario: It checks if limit 10 cannot be exceeded
        When asked for 11 author quotes
        Then I get exception
        When asked for 10 author quotes
        Then I do not get exception
