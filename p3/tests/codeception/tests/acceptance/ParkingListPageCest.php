<?php

class ParkingListPageCest
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
    public function showsEmptyList(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/2');

        # Act
        $I->amOnPage('/list');
        $I->seeElement('[test=no-parkings-message]');
    }

    /**
     *
     */
    public function addsParkingToList(AcceptanceTester $I)
    {
        # Setup
        $comments = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
        $slug = 'parkingReceipt-2';

        $I->amOnPage('/test/login-as/2');

        # Act
        $I->amOnPage('/parkings/'.$slug);
        $I->click('[test=add-to-list-button]');
        $I->fillField('[test=comments-textarea]', $comments);
        $I->click('[test=add-to-list-button]');

        # Assert
        $I->amOnPage('/list');
        $I->see($comments, '[test='. $slug .'-comments-textarea]');
    }

    /**
     *
     */
    public function removesParkingFromList(AcceptanceTester $I)
    {
        # Setup
        $slug = 'parkingReceipt-4';

        # Logging in as Jill who has the parkingReceipt-3 on list to start
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/parkings/'.$slug);
        $I->click('[test=' . $slug . '-remove-from-list-button]');

        # Assert
        $I->amOnPage('/list');
        //  $I->see('The parking Mur-012 was removed from your parking list');
        $I->dontSeeElement('[test=' . $slug . '-remove-from-list-button]');
    }

    /**
     *
     */
    public function updateParkingOnList(AcceptanceTester $I)
    {
        # Setup
        $slug = 'parkingReceipt-4';
        $newComment = 'Some new comment please...';

        # Logging in as Jill who has the parkingReceipt-2 on list to start
        $I->amOnPage('/test/login-as/1');
        
        # Act
        $I->amOnPage('/list');
        $I->fillField('[test="parkingReceipt-4-comments-textarea"]', $newComment);
        $I->click('[test="parkingReceipt-4-update-button"]');

        # Assert
        $I->amOnPage('/list');
        $I->see($newComment, '[test="parkingReceipt-4-comments-textarea"]');
    }
}