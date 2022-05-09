<?php

class ParkingEditPageCest
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
    public function editsParking(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');

        $I->amOnPage('/parkings/parkingReceipt-3/edit');
       
        $I->fillField('[test=lot-input]', 'abc-123');
        $I->click('[test=update-parking-button]');
        $I->see('HES-011');
    }

    /**
     *
     */
    public function showsValidation(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/parkings/parkingReceipt-3/edit');
        $I->fillField('[test=lot-input]', '');
        $I->click('[test=update-parking-button]');

        # Assert we see global error feedback
        $I->seeElement('[test=global-error-feedback]');

        # Assert we see at least one field valdiation
        $I->seeElement('[test=error-field-parkingLot]');
    }

    /**
     *
     */
    public function preventsDuplicateSlugs(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/parkings/parkingReceipt-3/edit');
        
        $I->fillField('[test=slug-input]', 'parkingReceipt-2');
        $I->click('[test=update-parking-button]');

        # Assert
       
        $I->see('The Parking Space has already been taken.', '[test=error-field-slug]');
    }
}