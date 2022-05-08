<?php

class BookIndexPageCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->comment('try to test!!');
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
        //$I->amOnPage('/test/login-as/1');
        # Act
        $I->amOnPage('/login');
         
        $I->click('[test=register-link]');

        $I->amOnPage('/register');

        # Interact with form elements
        
        $I->fillField('[test=name-input]', 'Jane Harvard');
        $I->fillField('[test=email-input]', 'jane@harvard.edu');
       
        $I->fillField('[test=password-input]', 'asdfasdf');
        $I->fillField('[test=password-confirm-input]', 'asdfasdf');
        
        $I->click('[test=register-button]');


        # Assert register success
        # Assert expected results
        $I->see('Jane Harvard');

        # Assert the existence of text within a specific element on the page
        $I->see('Logout', 'nav');
    }

    /**
    *
    */
    public function addsANewBook(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/books/create');
        $I->fillField('[test=title-input]', 'Test Book');
        $I->fillField('[test=slug-input]', 'test-book');
        $I->selectOption('[test=author-dropdown]', 1);
        $I->fillField('[test=published-year-input]', 2000);
        $I->fillField('[test=cover-url-input]', 'https://hes-bookmark.s3.amazonaws.com/cover-placeholder.png');
        $I->fillField('[test=purchase-url-input]', 'https://www.barnesandnoble.com/test-book');
        $I->fillField('[test=info-url-input]', 'https://en.wikipedia.org/wiki/test-book');
        $I->fillField('[test=description-textarea]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in pulvinar libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in pulvinar libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.');
        $I->click('[test=submit-button]');

        # Afferm
        $I->see('Your book was added');
        $I->amOnPage('/books/test-book');
        $I->see('Test Book');
    }
}