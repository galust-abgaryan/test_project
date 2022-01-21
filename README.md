need run 

```
composer install
php artisan key:generate
php artisan migrate --seed 
```

set .env values
```
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
...
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```

run 
```
php artisan serve
```

Login url http://127.0.0.1:8000/login

User credentials
```
email:      user@gmail.com
password:   password
```

for send email by job then set in .env
```
QUEUE_CONNECTION=database
```

and also run 

```
php artisan queue:work
```
You can edit email content with this url http://127.0.0.1:8000/mail-templates/1/edit


For add new languages options then need edit

```
config.web.languages
lang.[en].web.languages
```

For add new static interests options then need edit, User can manually also add any other interest
```
config.web.interests
lang.[en].web.interests
```

