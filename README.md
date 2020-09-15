# PHP - Oportunitties

This library allows opportunities to be sent internally for Code Igniter 3.x and Laravel

## Installation

Use the composer to install this library

```bash
composer require epicsweb/php-opportunities
```

## Configuration

#### CodeIgniter

Create or edit a file in your code igniter application folder and set this vars: **/application/config/epicsweb.php**

```php
<?php if( !defined('BASEPATH')) exit('No direct script access allowed');

$config['op_url']       = 'YOUR_BASE_URL_API';
$config['op_token']     = 'YOUR_SECRET_TOKEN';
```

#### Laravel

Set in your **.env** file

```
OP_URL=YOUR_BASE_URL_API;
OP_TOKEN=YOUR_SECRET_TOKEN;
```

## Usage

#### CodeIgniter

Change file **/application/config/config.php**:

```php
$config['composer_autoload'] = FALSE;
↓
$config['composer_autoload'] = realpath(APPPATH . '../vendor/autoload.php');
```

#### CodeIgniter & Laravel

Import the vendor library **Epicsweb\PhpOpportnities** and call the function

### Add new opportunity

```php
$data = [
    'account_id'            => (array)   [1,2,3],             // req | int | Conta EPICS ID
    'name'                  => (string)  'Lead Name',         // req
    'email'                 => (string)  'Lead Email',        // req email or telephone
    'phone'                 => (string)  '55 17 99999-8888',  // req email or telephone
    'message'               => (string)  'Text or Html',      // opt
    'date_initial'          => (date)    'Y-m-d'              // opt
];

$opportunity = new Epicsweb\PhpOpportunities;
$opportunity->send_opportunity( $data, 'post' ); //ALLOW "put" && "get"
 ```

#### Array Data Label
```php
req => 'required value'

* dont use html_entities, urlencode, json_encode, and other in the array key or values
```

### License
This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/epicsweb/mensagens-php/blob/master/LICENSE) file for details
