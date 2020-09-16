# Email Signature Generator

## Getting Started
To get a copy of this project up and running on your local environment:
##### With Git:
```shell script
$ git clone https://github.com/KipchirchirIan/email-signature-generator-slim.git && cd email-signature-generator-slim/config
$ cp env.example.php env.php
````
* Change values in ```config/env.php``` to match your database credentials
* Import database in ```database``` folder to your MySQL server.

```shell script
$ composer install
$ cd public
$ php -S localhost:8080
```

### Prerequisites

To install, you need:

```
1. Git
2. Composer
3. Apache/XAMPP
4. MySQL
```
## Built With

* [Slim Framework](http://www.slimframework.com/docs/v4)
