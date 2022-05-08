<?php

class SearchPageCest
{
    /**
     *
     */
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }
    
    /**
     *
     */
    public function searchYieldsResults(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/');
        $I->fillField('[test=search-input]', 'Lot-West');
        $I->click('[test=search-button]');

        # Assert
        $I->see('Lot-West');
        $resultCount = count($I->grabMultiple('[test=search-result-link]'));
        $I->assertEquals(4, $resultCount);
    }
}