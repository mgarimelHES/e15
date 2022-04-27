<?php

class BookIndexPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }

    public function showsNewBooks(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/books');

        # Assert there are 3 results
        $resultCount = count($I->grabMultiple('[test=new-book-link]'));
        $I->assertEquals(3, $resultCount);
    }

    public function addsNewUsers(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/register');

        # Interact with form elements
        $I->fillField('[name=name]', 'Jane Harvard');
        $I->fillField('[name=email]', 'jane@harvard.edu');
       
        $I->fillField('[name=password]', 'asdfasdf');
        $I->fillField('[name=password-confirm]', 'asdfasdf');
        
        $I->click('[button]');


        # Assert register success
        # Assert expected results
        $I->see('Jane Harvard');

        # Assert the existence of text within a specific element on the page
        $I->see('Logout', 'nav');
    }
}