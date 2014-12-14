[![Travis build](https://travis-ci.org/dardarlt/hangman.svg?branch=master)](https://travis-ci.org/dardarlt/hangman.svg?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dardarlt/hangman/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dardarlt/hangman/?branch=master)
-----------

Hangman game api  and library
===========

This app is build on symfony 2

Installation instructions
----------
Change config/parameters.yml  to meet your database requirements

Run 
```composer update```

Run 
```php app/console doctrine:schema:update --force```

As environment, any box with Php 5.4 and MySql will be ok.
Any docker or vagrant box like https://github.com/scotch-io/scotch-box will be quickiest solutions.  
 


