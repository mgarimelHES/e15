# Project 3
+ By: Murthy Garimella
+ Production URL: http://e15p3.hesweb.me

## Feature summary < UNDER CONSTRUCTION>
*The project-3 deals with a small parking lot near an educational institution honoring the discounts accordingly. The following details are from a hypothetical project called "Your Parking ".*

+ Visitors can register/log in to park, print, view or contact *Your Parking* for any help or support.
+ Users can add/update/delete parkings in their history (license_plate, parking day, starting time, ending time, parking lot, description, review, discount type etc.)
+ There's a file uploader that's used to upload license plate images for each parking
+ User's can toggle whether parking reviews in their parking history are public or private ???/
+ Each user has a public profile page which presents a short bio about their parking preferencs (ex- east or west lot, covered or uncovered ), as well as a list of public reviews in their parking history
+ Each user has their own account page where they can edit their bio, email, password, preferences
+ Users can clone parkings from another user's public parking reviews into their reviews
+ The home page features
  + a stream of recently added parkings occupied
  + a list of categories, with a link to each category that shows a page of parkings (with links) within that category (ex- East or West Lots)

  
## Database summary ?????????
*Describe the tables and relationships used in your database. Delete the examples below and replace with your own info.*

+ My application has 3 tables in total (`users`, `movies`, `categories`)
+ There's a many-to-many relationship between `movies` and `categories`
+ There's a one-to-many relationship between `movies` and `users`
???????

## Outside resources
1. All license plate images are generated using the site - https://www.acme.com/licensemaker/licensemaker.cgi?
2. stackoverflow - https://stackoverflow.com/questions/41206049/time-calculation-in-laravel-taking-input-from-user
3. Parking image  courtesy - Repat-Armenia 

## Notes for instructor
I have made the following assumptions as a part of this application -
 - User need to select the time using the given time range ( 12:00 AM to 11.59 PM)
 - License Plate image is not included as a part of the 'create page', may be included in the next phase
 - Project3 page could be accessed from the project-2 home page 
 - Default Discount Type is set to 'Visitor', assuming if the owner of the vehicle wont have an Id, will be treated as a visitor!
 - Since the remote development server is somewhere in EMEA, the *date* is 4 hrs ahead of USA Eastern Time!