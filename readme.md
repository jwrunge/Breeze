# General
First, thank you for taking the time to look at my work! I've enjoyed putting this project together and am looking forward to talking with you more soon.
Just some general information:
* This project was created with Lumen. I typically work with Laravel, but I wasn't so sure Laravel was small enough!
* Most of the files I worked with are in the resources/views directory, the database/migrations directory, the two model files in App/, and the controller in App/Http/Controllers. I also configured web routes in routes/web.php.
* The database is setup to use a mySQL database called 'breeze_test' with username 'root' and password '77658572'; you can change this in /.env. Once the database is set up, you can migrate in all the tables and columns using `php artisan migrate` from the root directory
* If you download locally, you can install all dependencies with `composer install`
* Sample CSVs are present in the root directory for your convenience
* I have the working product available to interact with at [206.189.65.39](http://206.189.65.39)

# Process
The finished product took about 3.5 hours to complete (though I did have to go in and fix a rather embarrassing bug later in the day), with an additional hour of planning on paper prior to beginning coding not reflected in the commit timestamps. I wanted to keep within your 3-5 hour parameters as best as possible.
My process included:
* Planning: I sketched out rough wireframes for page design, and some bullet-point list logic (which eventually turned into my unit tests).
* Environment and database setup: I used Lumen's database migrations to create both tables, and Eloquent to manipulate the models. I used League/CSV as a CSV parsing library.
* I created rough structures for the views and controller logic. At this point, I realized my paper plans were too ambitious for the timeframe, and started trying to scale back a bit--you may see that reflected in the code.
* I created unit tests in PHPUnit to check that database interaction was working as intended. Unfortunately, I was not able to do any integration testing to automate an actual CSV upload.
* I began designing pages with Bootstrap, Lumen's Blade templating system, and JQuery.
* I implemented searching and sorting for records, tied to AJAX calls. The search system was pulled from another project I am working on--it was not created on the spot.
* I did several rounds of manual bug testing and acceptance testing prior to making my 'final' commit. I may have reverted a commit somewhere in there, because I did notice later in the day that the CSV upload was no longer working properly, which I fixed. That took another ~15 minutes.

# Improvements
If I were to continue this project, I would begin by making the following improvements:
* Writing logic in the controller to ensure that the CSV uploaded is actually a CSV, and showing an error screen if it is not
* Writing logic in the controller to show an error screen if it does not receive the data it expects; currently, the CSV upload system can receive columns in any order, and can receive extra columns, but will fail if it does not receive a column it expects (such as 'person_id')
* Expanding data sorting to all possible columns (it got a bit tricky when trying to sort based on a related model)
* Generally improving the data sorting UI
* Adding views for people profiles (along with an active/archived toggle) and groups (listing all current members)
* Enabling manual entry for users and groups (I designed the controller to allow for manual entry, but there is not interface to do so)
* Making the relationship between users and groups many-to-many, and creating functionality to assign existing user lists to groups

Thank you so much for your interest in my work! Please feel free to contact me with any questions.
