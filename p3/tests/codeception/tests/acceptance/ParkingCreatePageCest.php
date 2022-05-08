<?php

class ParkingCreatePageCest
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
    public function addsANewParking(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/parkings/create');
        $I->fillField('[test=lot-input]', 'Test Parking');
        $I->fillField('[test=slug-input]', 'test-parking');
        $I->fillField('[test=plate-input]', 'test-plate');
        $I->fillField('[test=model-input]', 'test-model');
        $I->fillField('[test=make-input]', 'test-make');
        // $I->fillField('[test=image-input]', '/images/CO_Mur_006.jpg');


        $I->selectOption('[test=customer-dropdown]', 1);
        $I->fillField('[test=year-input]', 2000);
        $I->selectOption('[test=terms-input]', true);
        
        $I->fillField('[test=rules-textarea]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in pulvinar libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in pulvinar libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.');
        $I->click('[test=submit-button]');

        # Assert
        $I->amOnPage('/parkings/create');
        $I->see('Your Parking Ticket has been created');
        // $I->amOnPage('/parkings/test-parking');
      //  $I->see('test-plate');
    }

    /**
     *
     */
    public function showsValidation(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/parkings/create');
        $I->click('[test=submit-button]');

        # Assert we see global error feedback
        $I->seeElement('[test=global-error-feedback]');

        # Assert we see at least one field valdiation
        $I->seeElement('[test=error-field-slug]');
    }

    /**
     *
     */
    public function preventsDuplicateSlugs(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/parkings/create');
        $I->fillField('[test=lot-input]', 'Test Parking');
        
        $I->fillField('[test=slug-input]', 'test-parking'); // duplicate check using an existing slug

        //  $I->selectOption('[test=customer-dropdown]', 1);
        //  $I->fillField('[test=plate-input]', 'test-plate');
        //    $I->fillField('[test=model-input]', 'test-model2');
        //    $I->fillField('[test=make-input]', 'test-make2');
        // $I->fillField('[test=image-input]', '/images/CO_Mur_006.jpg');

        $I->fillField('[test=year-input]', 2000);
        $I->selectOption('[test=terms-input]', true);
        
        $I->fillField('[test=rules-textarea]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in pulvinar libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in pulvinar libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.');
       
        $I->click('[test=submit-button]');

        # Assert
        $I->amOnPage('/parkings/create');
        $I->see('The Parking Space has already been taken.');
        // $I->see('The Parking Space has already been taken.', '[test=error-field-slug]');
    }
}