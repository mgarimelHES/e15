<?php

class ParkingIndexPageCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }

    /**
     *
     */
    public function showsParkings(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/parkings');

        $I->click('[test=parking-link-parkingReceipt-3]');
        $I->see('HES-011');
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