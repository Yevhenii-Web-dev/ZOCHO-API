<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<p align="center"><a href="https://laravel.com" target="_blank"></a>ZOHO API CONNECT</p>



## About Project

Simple connect with Laravel 9 to ZOHO API CRM. 
You can add new or delete contacts,deals also can crate new deals associate with contacts.

## Usage
- **Clone this repository**
- **Prepare standard commands in Laravel(1. composer i , 2.php artisan key:generate)**
- **After that go to ZOHO CRM and register your free akk https://www.zoho.com/crm/login.html**
- **Next generate "Grand code" on ZOHO API  https://api-console.zoho.eu/**
- **Select "Add client" and add "Self Client**
- **After that in field  Scope past "ZohoCRM.modules.ALL", select "10 min" and in field Scope Description add "contacts,deals", press create, copy code to the .env file in project variable: ZOHO_GRAND_CODE"**
- **The next step select field "Client Secret" and copy Client ID -> ZOHO_CLIENT_ID, Client Secret -> ZOHO_CLIENT_SECRET to the .env file "**
- **After go to your app project "{domain_address}/api" and press button "Generate token"**
- **Copy your new token and past him to ZOHO_REFRESH_TOKEN in .env file**
- **After this if all steps are made, app will be work**
