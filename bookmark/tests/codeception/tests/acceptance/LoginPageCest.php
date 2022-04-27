<?php

class LoginPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function pageLoads(AcceptanceTester $I)
    {
        # Act
        $I->amOnPage('/login');

        # Assert the existence of certain text on the page
        $I->see('Login');

        # Assert the existence of a certain element on the page
        $I->seeElement('#email');
    }

    /**
     *
     */
    public function userCanLogIn(AcceptanceTester $I)
    {
        # Act
        $I->amOnPage('/login');

        # Interact with form elements
        // $I->fillField('[name=email]', 'jill@harvard.edu');
        $I->fillField('[test=email-input]', 'jill@harvard.edu');
        // $I->fillField('[name=password]', 'asdfasdf');
        $I->fillField('[test=password-input]', 'asdfasdf');
        $I->click('[test=login-button]');

        # Assert expected results
        $I->see('Jill Harvard');

        # Assert the existence of text within a specific element on the page
        $I->see('Logout', 'nav');
    }
}