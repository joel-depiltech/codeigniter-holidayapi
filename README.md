# CodeIgniter Holiday API
[CodeIgniter](https://www.codeigniter.com) third-party library deals with [Holiday API](https://holidayapi.com) based an official PHP library.

## Installation

Please use [Composer](https://getcomposer.org) to install it and include it as a third-party [package](https://www.codeigniter.com/user_guide/libraries/loader.html#application-packages) in your CodeIgniter application.

Note that following steps assume that you have correctly installed Composer and configured CodeIgniter on your server.

1. Make sure you already use Composer auto-loader in your config file (application/config/config.php)

```php $config['composer_autoload'] = TRUE; // or a custom path as 'vendor/autoload.php' ```

2. Include this **package** with Loader library

```php $this->load->add_package_path(APPPATH . 'third_party/holidayapi'); ```

3. Include this **library** with Loader library

```php $this->load->library('HolidayAPI'); ```


## Usage

A simple to call to holidays method :

```php
<?php
$holidays = $this->holidayapi->holidays('FR');
print_r($holidays);
```
