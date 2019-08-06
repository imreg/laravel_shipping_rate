# laravel_shipping_rate

##### 1. Initial Steps

All code can be executed in command line. This solution applies single responsibility and dependency injection, 
utilizing layer structure and dependency inversion.
 
- Database logic is in Repositories
- Business logic is in Services

##### 1.1 Deploy source 
```
composer install
```

##### 1.2 Edit .env file for DB connection 
```
.env
```

##### 1.3 Database migration 
```
php artisan migrate
```

##### 1.4 Seed dummy data 
```
php artisan db:seed
```

##### 1.4 Run local server 
```
php artisan serve
```


##### 2. Commandline functions

##### 2.1 Curl POST requests

##### 2.1.1 If country code exists
###### Request
```
curl -d '{"price":60,"weight":50,"country_code":"MX"}' -H "Content-Type: application/json" -X POST http://127.0.0.1:8000/api/calculate
```
###### Response
```
{"price":60,"weight":50,"country_code":"MX","shipping_fee":40,"total":100}
```

##### 2.1.2 If country code does not exist
###### Request
```
curl -d '{"price":60,"weight":60,"country_code":"PL"}' -H "Content-Type: application/json" -X POST http://127.0.0.1:8000/api/calculate

```
###### Response
```
{"error":"Error: PL doesn't have any shipping rates"}
```

##### 3. Function Test 
```
bin/phpspec run
```
