BR - Site des Bars d'etage
==========================


1) Installing Dependencies
--------------------------

Symfony uses Composer to manage its dependencies.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Then, run the following command to install the project dependencies:

    php composer.phar install

2) Checking your System Configuration
-------------------------------------

Before starting coding, make sure that your local system is properly
configured for Symfony.

Execute the `check.php` script from the command line:

    php app/check.php

The script returns a status code of `0` if all mandatory requirements are met,
`1` otherwise.

Access the `config.php` script from a browser:

    http://localhost/path/to/symfony/app/web/config.php

If you get any warnings or recommendations, fix them before moving on.

3) Configuring the Installation
-------------------------------

Modify app/config/parameters.yml to match your installation

Run the following commands to set up the database:

	php app/console doctrine:database:create





4) Testing the Application
--------------------------

To start a local server, run:
	php app/console server:run

You can also use another web server, such as Apache.

Congratulations! You're now ready to use Symfony.

