# Project 3
+ By: Murthy Garimella
+ Production URL: http://e15p3.hesweb.me

## Feature summary < UNDER CONSTRUCTION>
*The project-3 deals with a small parking lot near an educational institution honoring the discounts accordingly. The following details are from a hypothetical project called "Your Parking ".*

+ Visitors can register/log in to park, print, view or contact *Your Parking* for any help or support.
+ Users can add/update/delete parkings in their history (license_plate, parking lot, description, review, discount type etc.)
+ There's a file uploader that's used to upload license plate images for each parking and it will be done in phase-2
+ User's can toggle whether parking reviews in their parking history are public or private , it will be implemented in a later phase-2.
+ Each user has a public profile page which presents a short bio about their parking preferencs (ex- east or west lot, covered or uncovered ), as well as a list of public reviews in their parking history in a future phase.
+ Each user has their own account page where they can edit their bio, email, password, preferences as a part of profile and it will be done in future.
+ Users can clone parkings from another user's public parking reviews into their reviews future plan.
+ The home page features
  + a stream of recently added parkings occupied
  + a list of categories, with a link to each category that shows a page of parkings (with links) within that category (ex- East or West Lots) (Future needs)

  
## Database summary 
*Describe the tables and relationships used in your database. Delete the examples below and replace with your own info.*

+ My application has 3 tables in total (`customers`, `parkings`, `users`)
+ There's a many-to-many relationship between `customers` and `parkings`
+ There's a one-to-many relationship between `parkings` and `users`
+ Note - Reviews table has been created and it will have many-to-many relationships in the next phase!

## Outside resources
1. All license plate images are generated using the site - https://www.acme.com/licensemaker/licensemaker.cgi?
2. stackoverflow - https://stackoverflow.com/questions/41206049/time-calculation-in-laravel-taking-input-from-user
3. Parking image  courtesy - Repat-Armenia 

## Notes for instructor
I have made the following assumptions as a part of this application -
 - Reviews page is not included in this project3, however it will be done in the next phase.
 - License Plate image is not included as a part of the p3, may be included in the next phase
 - Project3 alert 'yellow' is not coming as designed, could be a stylesheet issue.
 - Default Discount Type is set to 'Visitor', assuming if the owner of the vehicle wont have an Id, will be treated as a visitor!
 - All the Testing is working good (See below), except duplicate slug check during Create and it is working during Edit. 

 ## Tests

 root@hes:/var/www/e15/p3/tests/codeception# codecept run acceptance --steps 
Codeception PHP Testing Framework v4.1.31 https://helpukrainewin.org
Powered by PHPUnit 8.5.24 #StandWithUkraine

Acceptance Tests (24) -----------------------------------------------------------------------------------------------------------------------------------------------------------------
LoginPageCest: Try to test
Signature: LoginPageCest:tryToTest
Test: tests/acceptance/LoginPageCest.php:tryToTest
Scenario --
 PASSED 

LoginPageCest: User can log in
Signature: LoginPageCest:userCanLogIn
Test: tests/acceptance/LoginPageCest.php:userCanLogIn
Scenario --
 I am on page "/login"
 I see "Login"
 I see element "#email"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","asdfasdf"
 I click "button"
 I see "Jill Harvard"
 I see "Logout","nav"
 PASSED 

ParkingCreatePageCest: Adds a new parking
Signature: ParkingCreatePageCest:addsANewParking
Test: tests/acceptance/ParkingCreatePageCest.php:addsANewParking
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/create"
 I fill field "[test=slug-input]","test-parking"
 I fill field "[test=lot-input]","Test Parking"
 I fill field "[test=plate-input]","test-plate"
 I fill field "[test=model-input]","test-model"
 I fill field "[test=make-input]","test-make"
 I select option "[test=customer-dropdown]",1
 I fill field "[test=year-input]",2000
 I select option "[test=terms-input]",true
 I fill field "[test=rules-textarea]","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in pulvinar libero. Pellentesque habitant morbi tristique senectus et netus..."
 I click "[test=submit-button]"
 I am on page "/parkings/create"
 I see "Your Parking Ticket has been created"
 PASSED 

ParkingCreatePageCest: Shows validation
Signature: ParkingCreatePageCest:showsValidation
Test: tests/acceptance/ParkingCreatePageCest.php:showsValidation
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/create"
 I click "[test=submit-button]"
 I see element "[test=global-error-feedback]"
 I see element "[test=error-field-slug]"
 PASSED 

ParkingCreatePageCest: Prevents duplicate slugs
Signature: ParkingCreatePageCest:preventsDuplicateSlugs
Test: tests/acceptance/ParkingCreatePageCest.php:preventsDuplicateSlugs
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/create"
 PASSED 

ParkingEditPageCest: Edits parking
Signature: ParkingEditPageCest:editsParking
Test: tests/acceptance/ParkingEditPageCest.php:editsParking
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-3/edit"
 I fill field "[test=lot-input]","abc-123"
 I click "[test=update-parking-button]"
 I see "HES-011"
 PASSED 

ParkingEditPageCest: Shows validation
Signature: ParkingEditPageCest:showsValidation
Test: tests/acceptance/ParkingEditPageCest.php:showsValidation
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-3/edit"
 I fill field "[test=lot-input]",""
 I click "[test=update-parking-button]"
 I see element "[test=global-error-feedback]"
 I see element "[test=error-field-parkingLot]"
 PASSED 

ParkingEditPageCest: Prevents duplicate slugs
Signature: ParkingEditPageCest:preventsDuplicateSlugs
Test: tests/acceptance/ParkingEditPageCest.php:preventsDuplicateSlugs
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-3/edit"
 I fill field "[test=slug-input]","parkingReceipt-2"
 I click "[test=update-parking-button]"
 I see "The Parking Space has already been taken.","[test=error-field-slug]"
 PASSED 

ParkingIndexPageCest: Shows parkings
Signature: ParkingIndexPageCest:showsParkings
Test: tests/acceptance/ParkingIndexPageCest.php:showsParkings
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings"
 I click "[test=parking-link-parkingReceipt-3]"
 I see "HES-011"
 PASSED 

ParkingIndexPageCest: Shows new parkings
Signature: ParkingIndexPageCest:showsNewParkings
Test: tests/acceptance/ParkingIndexPageCest.php:showsNewParkings
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings"
 I grab multiple "[test=new-parking-link]"
 I assert equals 3,3
 PASSED 

ParkingListPageCest: Shows empty list
Signature: ParkingListPageCest:showsEmptyList
Test: tests/acceptance/ParkingListPageCest.php:showsEmptyList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/2"
 I am on page "/list"
 I see element "[test=no-parkings-message]"
 PASSED 

ParkingListPageCest: Adds parking to list
Signature: ParkingListPageCest:addsParkingToList
Test: tests/acceptance/ParkingListPageCest.php:addsParkingToList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/2"
 I am on page "/parkings/parkingReceipt-2"
 I click "[test=add-to-list-button]"
 I fill field "[test=comments-textarea]","Lorem ipsum dolor sit amet, consectetur adipiscing elit."
 I click "[test=add-to-list-button]"
 I am on page "/list"
 I see "Lorem ipsum dolor sit amet, consectetur adipiscing elit.","[test=parkingReceipt-2-comments-textarea]"
 PASSED 

ParkingListPageCest: Removes parking from list
Signature: ParkingListPageCest:removesParkingFromList
Test: tests/acceptance/ParkingListPageCest.php:removesParkingFromList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-4"
 I click "[test=parkingReceipt-4-remove-from-list-button]"
 I am on page "/list"
 I don't see element "[test=parkingReceipt-4-remove-from-list-button]"
 PASSED 

ParkingListPageCest: Update parking on list
Signature: ParkingListPageCest:updateParkingOnList
Test: tests/acceptance/ParkingListPageCest.php:updateParkingOnList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/list"
 I fill field "[test="parkingReceipt-4-comments-textarea"]","Some new comment please..."
 I click "[test="parkingReceipt-4-update-button"]"
 I am on page "/list"
 I see "Some new comment please...","[test="parkingReceipt-4-comments-textarea"]"
 PASSED 

ParkingShowPageCest: Shows parking
Signature: ParkingShowPageCest:showsParking
Test: tests/acceptance/ParkingShowPageCest.php:showsParking
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-2"
 I see "Mur-999"
 PASSED 

ParkingShowPageCest: Deletes parking
Signature: ParkingShowPageCest:deletesParking
Test: tests/acceptance/ParkingShowPageCest.php:deletesParking
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-2"
 I click "[test=delete-button]"
 I click "[test=confirm-delete-button]"
 I don't see element "[test=parking-link-parkingReceipt-2]"
 PASSED 

ParkingShowPageCest: Parking not found
Signature: ParkingShowPageCest:parkingNotFound
Test: tests/acceptance/ParkingShowPageCest.php:parkingNotFound
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-1"
 I see "Parking is not found"
 I see element "[test=all-parkings-heading]"
 PASSED 

UserFeatureCest: User can register
Signature: UserFeatureCest:userCanRegister
Test: tests/acceptance/UserFeatureCest.php:userCanRegister
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/register"
 I fill field "[test=name-input]","Test User"
 I fill field "[test=email-input]","test@email.com"
 I fill field "[test=password-input]","asdfasdf"
 I fill field "[test=password-confirm-input]","asdfasdf"
 I click "[test=register-button]"
 I see "Test User"
 I see "Logout","nav"
 PASSED 

UserFeatureCest: Registration is validated
Signature: UserFeatureCest:registrationIsValidated
Test: tests/acceptance/UserFeatureCest.php:registrationIsValidated
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/register"
 I fill field "[test=name-input]","Test User"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","asdfasdf"
 I fill field "[test=password-confirm-input]","asdfasdf"
 I click "[test=register-button]"
 I see "The email has already been taken."
 PASSED 

UserFeatureCest: User can log in
Signature: UserFeatureCest:userCanLogIn
Test: tests/acceptance/UserFeatureCest.php:userCanLogIn
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/login"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","asdfasdf"
 I click "[test=login-button]"
 I see "Jill Harvard"
 I see "Logout","nav"
 PASSED 

UserFeatureCest: User can logout
Signature: UserFeatureCest:userCanLogout
Test: tests/acceptance/UserFeatureCest.php:userCanLogout
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/"
 I click "[test=logout-button]"
 I see element "[test=login-link]"
 PASSED 

UserFeatureCest: Login is validated
Signature: UserFeatureCest:loginIsValidated
Test: tests/acceptance/UserFeatureCest.php:loginIsValidated
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/login"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","bad-password"
 I click "[test=login-button]"
 I see "These credentials do not match our records."
 PASSED 

UserFeatureCest: Guests cant visit restricted pages
Signature: UserFeatureCest:guestsCantVisitRestrictedPages
Test: tests/acceptance/UserFeatureCest.php:guestsCantVisitRestrictedPages
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/parkings"
 I see element "[test=login-button]"
 PASSED 

SearchPageCest: Search yields results
Signature: SearchPageCest:searchYieldsResults
Test: tests/acceptance/WelcomePageCest.php:searchYieldsResults
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/"
 I fill field "[test=search-input]","Lot-West"
 I click "[test=search-button]"
 I see "Lot-West"
 I grab multiple "[test=search-result-link]"
 I assert equals 4,4
 PASSED 

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Time: 1.31 minutes, Memory: 18.99 MB

OK (24 tests, 31 assertions)
root@hes:/var/www/e15/p3/tests/codeception# codecept run acceptance --steps >> ./p3results2.out
root@hes:/var/www/e15/p3/tests/codeception# 
root@hes:/var/www/e15/p3/tests/codeception# 
root@hes:/var/www/e15/p3/tests/codeception# 
root@hes:/var/www/e15/p3/tests/codeception# 
root@hes:/var/www/e15/p3/tests/codeception# cat p3results2.out 
Codeception PHP Testing Framework v4.1.31 https://helpukrainewin.org
Powered by PHPUnit 8.5.24 #StandWithUkraine

Acceptance Tests (24) -----------------------------------------------------------------------------------------------------------------------------------------------------------------
LoginPageCest: Try to test
Signature: LoginPageCest:tryToTest
Test: tests/acceptance/LoginPageCest.php:tryToTest
Scenario --
 PASSED 

LoginPageCest: User can log in
Signature: LoginPageCest:userCanLogIn
Test: tests/acceptance/LoginPageCest.php:userCanLogIn
Scenario --
 I am on page "/login"
 I see "Login"
 I see element "#email"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","asdfasdf"
 I click "button"
 I see "Jill Harvard"
 I see "Logout","nav"
 PASSED 

ParkingCreatePageCest: Adds a new parking
Signature: ParkingCreatePageCest:addsANewParking
Test: tests/acceptance/ParkingCreatePageCest.php:addsANewParking
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/create"
 I fill field "[test=slug-input]","test-parking"
 I fill field "[test=lot-input]","Test Parking"
 I fill field "[test=plate-input]","test-plate"
 I fill field "[test=model-input]","test-model"
 I fill field "[test=make-input]","test-make"
 I select option "[test=customer-dropdown]",1
 I fill field "[test=year-input]",2000
 I select option "[test=terms-input]",true
 I fill field "[test=rules-textarea]","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in pulvinar libero. Pellentesque habitant morbi tristique senectus et netus..."
 I click "[test=submit-button]"
 I am on page "/parkings/create"
 I see "Your Parking Ticket has been created"
 PASSED 

ParkingCreatePageCest: Shows validation
Signature: ParkingCreatePageCest:showsValidation
Test: tests/acceptance/ParkingCreatePageCest.php:showsValidation
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/create"
 I click "[test=submit-button]"
 I see element "[test=global-error-feedback]"
 I see element "[test=error-field-slug]"
 PASSED 

ParkingCreatePageCest: Prevents duplicate slugs
Signature: ParkingCreatePageCest:preventsDuplicateSlugs
Test: tests/acceptance/ParkingCreatePageCest.php:preventsDuplicateSlugs
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/create"
 PASSED 

ParkingEditPageCest: Edits parking
Signature: ParkingEditPageCest:editsParking
Test: tests/acceptance/ParkingEditPageCest.php:editsParking
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-3/edit"
 I fill field "[test=lot-input]","abc-123"
 I click "[test=update-parking-button]"
 I see "HES-011"
 PASSED 

ParkingEditPageCest: Shows validation
Signature: ParkingEditPageCest:showsValidation
Test: tests/acceptance/ParkingEditPageCest.php:showsValidation
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-3/edit"
 I fill field "[test=lot-input]",""
 I click "[test=update-parking-button]"
 I see element "[test=global-error-feedback]"
 I see element "[test=error-field-parkingLot]"
 PASSED 

ParkingEditPageCest: Prevents duplicate slugs
Signature: ParkingEditPageCest:preventsDuplicateSlugs
Test: tests/acceptance/ParkingEditPageCest.php:preventsDuplicateSlugs
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-3/edit"
 I fill field "[test=slug-input]","parkingReceipt-2"
 I click "[test=update-parking-button]"
 I see "The Parking Space has already been taken.","[test=error-field-slug]"
 PASSED 

ParkingIndexPageCest: Shows parkings
Signature: ParkingIndexPageCest:showsParkings
Test: tests/acceptance/ParkingIndexPageCest.php:showsParkings
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings"
 I click "[test=parking-link-parkingReceipt-3]"
 I see "HES-011"
 PASSED 

ParkingIndexPageCest: Shows new parkings
Signature: ParkingIndexPageCest:showsNewParkings
Test: tests/acceptance/ParkingIndexPageCest.php:showsNewParkings
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings"
 I grab multiple "[test=new-parking-link]"
 I assert equals 3,3
 PASSED 

ParkingListPageCest: Shows empty list
Signature: ParkingListPageCest:showsEmptyList
Test: tests/acceptance/ParkingListPageCest.php:showsEmptyList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/2"
 I am on page "/list"
 I see element "[test=no-parkings-message]"
 PASSED 

ParkingListPageCest: Adds parking to list
Signature: ParkingListPageCest:addsParkingToList
Test: tests/acceptance/ParkingListPageCest.php:addsParkingToList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/2"
 I am on page "/parkings/parkingReceipt-2"
 I click "[test=add-to-list-button]"
 I fill field "[test=comments-textarea]","Lorem ipsum dolor sit amet, consectetur adipiscing elit."
 I click "[test=add-to-list-button]"
 I am on page "/list"
 I see "Lorem ipsum dolor sit amet, consectetur adipiscing elit.","[test=parkingReceipt-2-comments-textarea]"
 PASSED 

ParkingListPageCest: Removes parking from list
Signature: ParkingListPageCest:removesParkingFromList
Test: tests/acceptance/ParkingListPageCest.php:removesParkingFromList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-4"
 I click "[test=parkingReceipt-4-remove-from-list-button]"
 I am on page "/list"
 I don't see element "[test=parkingReceipt-4-remove-from-list-button]"
 PASSED 

ParkingListPageCest: Update parking on list
Signature: ParkingListPageCest:updateParkingOnList
Test: tests/acceptance/ParkingListPageCest.php:updateParkingOnList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/list"
 I fill field "[test="parkingReceipt-4-comments-textarea"]","Some new comment please..."
 I click "[test="parkingReceipt-4-update-button"]"
 I am on page "/list"
 I see "Some new comment please...","[test="parkingReceipt-4-comments-textarea"]"
 PASSED 

ParkingShowPageCest: Shows parking
Signature: ParkingShowPageCest:showsParking
Test: tests/acceptance/ParkingShowPageCest.php:showsParking
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-2"
 I see "Mur-999"
 PASSED 

ParkingShowPageCest: Deletes parking
Signature: ParkingShowPageCest:deletesParking
Test: tests/acceptance/ParkingShowPageCest.php:deletesParking
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-2"
 I click "[test=delete-button]"
 I click "[test=confirm-delete-button]"
 I don't see element "[test=parking-link-parkingReceipt-2]"
 PASSED 

ParkingShowPageCest: Parking not found
Signature: ParkingShowPageCest:parkingNotFound
Test: tests/acceptance/ParkingShowPageCest.php:parkingNotFound
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/parkings/parkingReceipt-1"
 I see "Parking is not found"
 I see element "[test=all-parkings-heading]"
 PASSED 

UserFeatureCest: User can register
Signature: UserFeatureCest:userCanRegister
Test: tests/acceptance/UserFeatureCest.php:userCanRegister
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/register"
 I fill field "[test=name-input]","Test User"
 I fill field "[test=email-input]","test@email.com"
 I fill field "[test=password-input]","asdfasdf"
 I fill field "[test=password-confirm-input]","asdfasdf"
 I click "[test=register-button]"
 I see "Test User"
 I see "Logout","nav"
 PASSED 

UserFeatureCest: Registration is validated
Signature: UserFeatureCest:registrationIsValidated
Test: tests/acceptance/UserFeatureCest.php:registrationIsValidated
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/register"
 I fill field "[test=name-input]","Test User"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","asdfasdf"
 I fill field "[test=password-confirm-input]","asdfasdf"
 I click "[test=register-button]"
 I see "The email has already been taken."
 PASSED 

UserFeatureCest: User can log in
Signature: UserFeatureCest:userCanLogIn
Test: tests/acceptance/UserFeatureCest.php:userCanLogIn
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/login"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","asdfasdf"
 I click "[test=login-button]"
 I see "Jill Harvard"
 I see "Logout","nav"
 PASSED 

UserFeatureCest: User can logout
Signature: UserFeatureCest:userCanLogout
Test: tests/acceptance/UserFeatureCest.php:userCanLogout
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/"
 I click "[test=logout-button]"
 I see element "[test=login-link]"
 PASSED 

UserFeatureCest: Login is validated
Signature: UserFeatureCest:loginIsValidated
Test: tests/acceptance/UserFeatureCest.php:loginIsValidated
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/login"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","bad-password"
 I click "[test=login-button]"
 I see "These credentials do not match our records."
 PASSED 

UserFeatureCest: Guests cant visit restricted pages
Signature: UserFeatureCest:guestsCantVisitRestrictedPages
Test: tests/acceptance/UserFeatureCest.php:guestsCantVisitRestrictedPages
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/parkings"
 I see element "[test=login-button]"
 PASSED 

SearchPageCest: Search yields results
Signature: SearchPageCest:searchYieldsResults
Test: tests/acceptance/WelcomePageCest.php:searchYieldsResults
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/"
 I fill field "[test=search-input]","Lot-West"
 I click "[test=search-button]"
 I see "Lot-West"
 I grab multiple "[test=search-result-link]"
 I assert equals 4,4
 PASSED 

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Time: 1.18 minutes, Memory: 18.99 MB
OK (24 tests, 31 assertions)
