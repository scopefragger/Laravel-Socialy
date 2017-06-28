# Laravel Socialy - Social feeds for Laravel 5.1+
# Note - Not currently stable

## Installation

1. The preferred method of installation is via [Packagist][] and [Composer][]. Run the following command to install the package and add it as a requirement to your project's `composer.json`:

    ```bash
    composer require scopefragger/laravel-socialy
    ```

- Add the following to your config/app.php

    ```bash
    Scopefragger\LaravelSocialy\LaravelSocialyServiceProvider::class
    ```


- Finaly,  make sure you run the migrations


## Usage - Command Line

Socialy collects your social data in the background as you work,  without you needing to any extra work,  to get set up.  Add your required social feed access tokens to your .ENV ( Read bellow for a list of these ) you can then run the collections manualy!

    ```bash
    Scopefragger\LaravelSocialy\LaravelSocialyServiceProvider::class
    ```



## Config

As with most Laravel packages,  Magic Views has the abuilty to define some options

1. Path | ``` String ```
Option allows you to define the path prior to your slug such as `flats` or `frontend`,  you can leave this empty if you wish to work from the root

    ```php
        'path' => '',
    ```

            OR

    ```php
        'path' => 'flats/',
    ```

2. View Folder | ``` String ```
Specify the folder that you are wanting to look in when a slug is provided,  such as pages/moduals etc...
    ```php
    'view_folder' => 'pages',
    ```
## Requirements

- PHP 5.6
- LARAVEL 5.1+


## Final Comments
This Package was created to solve a problem,  it has helped in anyway feel free to link back, give a star or recomend the package to others.

If by anychance you find a bug or can reccomend a feature,  feel free to log a bug or raise a ticket in the issue tracker

## Copyright and license
MIT License

Copyright (c) 2017 Mark Anthony Jones

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

[app]: http://tools.ietf.org/html/rfc4122
[packagist]: https://packagist.org/packages/scopefragger/mappy
[composer]: http://getcomposer.org/
[source]: https://github.com/scopefragger/mappy
[release]: https://packagist.org/packages/scopefragger/mappy



