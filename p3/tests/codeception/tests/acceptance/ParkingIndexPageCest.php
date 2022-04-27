<?php

class ParkingIndexPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }

    public function showsNewParkings(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/parkings');

        # Assert there are 3 results
        $resultCount = count($I->grabMultiple('[test=new-parking-link]'));
        $I->assertEquals(3, $resultCount);
    }
}