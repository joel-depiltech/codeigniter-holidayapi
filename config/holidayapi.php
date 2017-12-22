<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| ENVIRONMENT
|--------------------------------------------------------------------------
|
| This item determines which API key should be used.
| Value can be 'live' or 'test'
|
*/
$config['holidayapi_environment'] = (ENVIRONMENT == 'production' ? 'live' : 'test');

/*
|--------------------------------------------------------------------------
| Test API Key
|--------------------------------------------------------------------------
|
| Test keys are unmetered and return dummy holiday day.
|
*/
$config['holidayapi_test_api_key'] = '058f4506-caf0-4bdd-b52b-cbc98e20e02e';

/*
|--------------------------------------------------------------------------
| Live API Key
|--------------------------------------------------------------------------
|
| Limited to 500 calls per month, historical data only.
|
*/
$config['holidayapi_live_api_key'] = '*** Fill in your own Live API key ***';
