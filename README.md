# Fantasy Premier League Scraper and Statistical Analysis

## Overview

The most difficult aspect of playing in a fantasy league is the lack of statistical data provided to the players in regards to the way the league works. How do we know what the best value players are depending on games played or minutes fielded? How do we which of two player to select given the forthcoming fixture schedule?

The aim of this project is to scrape the data from the fantasy.premierleague.com website and create specific statistical models to determine the questions posed above and much more!

Although the solution provided (once the application is finally completed) won't tell you what team to select week in week out, it will not only save you time in overall player selections, it will also, on average, guide you to a higher point total per round.


## Technology Required / Used

1. PHP 5.5 - The backend calls run via php scripts.
2. Apache 2 (or some other web server to run PHP)
3. MySQL - for datastorage
4. Angular JS - Single Page Application requirement
5. Twitter Bootstrap 3.1 - Simplified CSS (I am a bad designer :( )
6. Angular UI Bootstrap - Removes the need to use jQuery with Bootstrap
7. MeerkoDB - MySQL DB Library for PHP


## Application Infrastructure Overview

This SPA application (yes I know "application" is redundant here...) runs using AngularJS to provide the frontend features.

The data provided to Angular comes from PHP calls (via ajax). The data returned is JSON.

The PHP communicates with the MySQL database using the MeerkoDB library.

The data in the database is scraped using a personal Object Oriented scraper. (see the src/scripts/php folder).

## Setting Up (For Linux - figure it out for any other OS)

1. Ensure you have PHP 5.5, Apache 2 (or something similar), MySQL installed on your machine.
2. Clone this repository
3. Create a virtual host to the epl-scraper/src/public folder as root.
4. Set up the DB. (see below)
4. Scrape the FPL website for data (see below)
5. Write this data to the database (see below)
6. Open the webapp with localhost or whatever you resolved your virtual host to :)

### Setting up the Database

1. Create a database with whatever auth you prefer. Save the details to this DB in src/config/config.php
2. Run the src/scripts/sql/init.sql script on the DB. Now you have the schema loaded!

### Scraping Data into the Database

*Note: If you want to use provided sample data, skip to step 3 and run the command with src/data/feb2.json as input file*

1. cd into the src/scripts/php folder.
2. run `php fpl-player-scraper.php FILE_NAME_HERE` to get all the latest data from the official FPL website. Obviously provide a file name for the above command. (5 minutes ~)
3. run `php fpl-player-data-parser.php FILE_NAME_HERE` to write the data you scraped to the database. (1 minute ~)
4. Your Database is ready to go. Repeat above everytime games have been played and data is available.

## Upcoming Features

1. More statistical modelling, probably will use D3.js for this.
2. Comparing two teams through input. This will help with head to head
3. Security. This is very MVP at the moment. I need to look into this more soon!
4. Refactor my Angular JS parts. I'm still learning it. Not sure with best practices!
5. Better design (who knows when this will happen....)
6. Caching datasets
7. Formatting data provided (dates mainly)
8. Pagination on search

## Acknowledgements

The data used for this application is being sources from the fantasy.premierleague.com website.

## Usage

MIT Licence. Please credit me if you do use large portions of this code. - Ash Ramesh
