Silex Skeleton ReSTful
======================

Description
-----------
This skeleton (-updated- now, you can also call it boilerplate) is built using [Silex][2] for general [ReSTful (API)][6] purposes.

Background
----------
The reason I made this code is because I was having a hard time finding a good EXAMPLE on utilizing Silex for real life usage.
I need a maintainable and testable code that made especially for API.

Of course there are many good slides and information out there, but most are just giving piece by piece explanation.

I'm not a good reader. I'm not I just want EXAMPLE!

FAQ
---
"Dude, you can design silex however you want. That's the beauty of it."
- "Yes, I know. But I want a nice, solid framework out of it."

"Why don't you just use Symfony2 then?"
- "Too much"
(Don't miss understand me. I like Symfony2, I use it for some of my projects. But let's be honest, it's just too bulky sometimes.)

"Is this code actually working?"
- "Yeap. I use it for some smaller projects of mine. In fact, I use this more than Symfony2 I can say."

"Enough chit-chat. Show me!"
- "Here!"

What you need to know
---------------------
 * [PHP][1]
 * [Silex][2]
 * [Doctrine][3]
 * [Composer][4]
 * [PHPUnit & DBUnit][5] (Optional)

Installation
------------
1. Clone this Repository:

    "git clone git@github.com:makusu/silex-skeleton-rest.git"

2. Go to the main directory and install the composer package:

    "php composer.phar install"

You need to add option "--dev" behind if you want to have the controller test working properly.

3. For this test, you need to put this sql command in MySQL.

    CREATE DATABASE `tododb`;

    CREATE DATABASE `todotestdb`;

    CREATE TABLE `tododb`.`item` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `created` datetime NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE `todotestdb`.`item` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `created` datetime NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    insert into `tododb`.`item` values
    (null, "Download silex-skeleton-rest.", "2013-01-01 00:00:00"),
    (null, "Utilize the skeleton so I can use it for my project.", "2013-01-06 19:00:00");

    insert into `todotestdb`.`item` values
    (null, "Download silex-skeleton-rest.", "2013-01-01 00:00:00"),
    (null, "Utilize the skeleton so I can use it for my project.", "2013-01-06 19:00:00");

Why do we need to have 2 same database?
It's not compulsory. The idea is just to differentiate between our development and our test database environment.

4. Change the config to suit your environment. Don't worry, it's very simple.
 * app/config/dev.php
 * app/config/prod.php
 * app/config/test.php
 * Copy app/phpunit.xml.dist into app/phpunit.xml, and take a look at the <php> environment at the bottom of the file
 * Your server configuration must be pointing to: web/index.php (prod) and web/index_dev.php (dev)

5. If everything has been installed & configured properly, try to put this url in your browser:

    http://silex-skeleton-rest/item

You should see this result:

    [{"id":"1","name":"Download silex-skeleton-rest.","created":"2013-01-01 00:00:00"},{"id":"2","name":"Utilize the skeleton so I can use it for my project.","created":"2013-01-06 19:00:00"}]

Try also put this in your url:

    http://silex-skeleton-rest/item/1
    http://silex-skeleton-rest/item/2

If you can see a nice json result out of it, you can try to use http method POST, PUT and DELETE to manipulate the database using your api.

6. If point 5 is good, you can just run this command at your main directory:

    phpunit -c app/

7. Take your time and look around the code to understand more.

8. You're ready to use it for your own purpose. Enjoy!

[1]: http://php.net/
[2]: http://silex.sensiolabs.org/
[3]: http://www.doctrine-project.org/
[4]: http://getcomposer.org/
[5]: http://www.phpunit.de/
[6]: http://en.wikipedia.org/wiki/Representational_state_transfer
