<?php

class ParkingShowPageCest
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
    public function showsParking(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');

        $I->amOnPage('/parkings/parkingReceipt-2');
        $I->see('Mur-999');
    }

    /**
     *
     */
    public function deletesParking(AcceptanceTester $I)
    {
        # Setup
        $slug = 'parkingReceipt-2';
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/parkings/'.$slug);

        # Act
        $I->click('[test=delete-button]');
        $I->click('[test=confirm-delete-button]');

        # Assert
        $I->dontSeeElement('[test=parking-link-' . $slug . ']');
    }

    /**
     *
     */
    public function parkingNotFound(AcceptanceTester $I)
    {
        # Act
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/parkings/parkingReceipt-1');

        # Assert
        $I->see('Parking is not found');
        $I->seeElement('[test=all-parkings-heading]');
    }
}