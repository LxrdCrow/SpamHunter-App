# SpamHunter Application

## About the App

SpamHunter is a simple logic game built with PHP and MySQL, where the user needs to distinguish between spam emails and legitimate emails.

## Technologies Used

- PHP 8.x
- MySQL (Relational Database)
- Composer (for autoloading and dependencies)

## Project Structure

```plaintext
/src
    /controllers
        UserController.php
        HomeController.php
        SessionController.php
        ScoreController.php
        PhishingController.php

    /db
        database.php
        migration.sql

    /helpers
        ArrayHelper.php
        GameHelper.php
        EmailTemplateHelper.php
        StringHelper.php

    /models
        User.php
        Home.php
        GameSession.php
        GameSessionScore.php
        Response.php
        PhishingEmail.php


    /routes
        web.php

    /services
        GameLogicService.php
        PhishingMailService.php

    index.php
    kernel.php
````

## Work in Progress

Add Faker

