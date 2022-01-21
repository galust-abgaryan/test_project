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
MAIL_FROM_ADDRESS=test@test.test
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

We will achieve this result
<br>
Login page
http://127.0.0.1:8000/login
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/users/login.png?raw=true)

Successfully Login
http://127.0.0.1:8000/home
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/users/successfully_login.png?raw=true)

Users list
http://127.0.0.1:8000/users
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/users/index.png?raw=true)

Users list pagination
http://127.0.0.1:8000/users
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/users/pagination.png?raw=true)

Optimized query
http://127.0.0.1:8000/users
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/users/optimized_query.png?raw=true)

Create new user
http://127.0.0.1:8000/users/create
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/users/add.png?raw=true)

Create new user with validation
http://127.0.0.1:8000/users/create
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/users/add_validation.png?raw=true)

Edit user
http://127.0.0.1:8000/users/1/edit
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/users/edit.png?raw=true)

Edit user successfully
http://127.0.0.1:8000/users/1/edit
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/users/successfully_updated.png?raw=true)

User Show page
http://127.0.0.1:8000/users/1
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/users/show.png?raw=true)

User Deletion confirmation
http://127.0.0.1:8000/users
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/users/delete_confirmation.png?raw=true)

When new user create that time will be sent email.<br>
You can edit that text also <br>

http://127.0.0.1:8000/mail-templates/1/edit
![alt text](http://127.0.0.1:8000/images/users/mail_template.png?raw=true)

User will be get email like this
![alt text](http://127.0.0.1:8000/images/users/mail.png?raw=true)


For make new post crud with **label, content** columns  

```
php artisan make:migration create_posts_table
```
fill data
```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('label', 50);
            $table->longText('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
```
then
```
php artisan migrate
```

add in routes.web.php
```
Route::resource('/posts', 'PostController');
```

edit config/codearea-view.php adding this lines under sidebar.sidebars array
```
 [
    'label' => 'Post',
    'route' => 'posts.index',
    'icon' => 'menu',
],
```

this file content will be like this
```
<?php
//https://themes-pixeden.com/font-demos/7-stroke/
return [
    'actions' => [
        'edit' => [
            'icon' => 'pen',
        ],
        'show' => [
            'icon' => 'eye',
        ],
        'destroy' => [
            'icon' => 'trash',
        ],
    ],
    'sidebar' => [
        [
            'header' => 'Dashboard',
            'sidebars' => [
                [
                    'label' => 'Users',
                    'route' => 'users.index',
                    'icon' => 'user',
                ],
                [
                    'label' => 'Mail templates',
                    'route' => 'mail-templates.index',
                    'icon' => 'mail',
                ],
                [
                    'label' => 'Post',
                    'route' => 'posts.index',
                    'icon' => 'menu',
                ],
            ],
        ],
    ]
];
```
Controller app/Http/Controllers/PostController.php
```
<?php

namespace App\Http\Controllers;

class PostController extends BaseController
{

}
```

Service app/Services/PostService.php
```
<?php

namespace App\Services;

class PostService extends BaseService
{

}
```

Model app/Models/Post.php
```
<?php

namespace App\Models;

class Post extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'content',
    ];

    /**
     * @var string[]
     */
    protected $paginateable = [
        'label',
    ];
}
```

Now you can access http://127.0.0.1:8000/posts, and it will be show same general index page

![alt text](https://github.com/davitbek/test_project/tree/main/public/images/posts/index.png?raw=true)

For can add new post need fill resources/views/web/posts/partials/form.blade.php
```
{{ Form::model($item ?? null, ['route' => $route, 'files' => true, 'method' => isset($item) ? "PUT" : "POST"]) }}

<div class="row">
    <div class="col-sm-12">
        {{ Form::bsText('label') }}
    </div>

    <div class="col-sm-12">
        {{ Form::bsTextarea('content', null, ['class' => 'form-control tinymce']) }}
    </div>

    <div class="col-sm-12">
        {{ Form::bsSubmit($title, ['class' => 'btn btn-default']) }}
    </div>

</div>

{{ Form::close() }}

@include('partials.tinymce')
```
Now Crud is ready

For add validation <br>
Validator app/Validators/PostValidator.php

```
<?php

namespace App\Validators;

class PostValidator extends BaseValidator
{
    /**
     * @return array
     */
    public function create()
    {
        return [
            'label' => 'required|max:50',
            'content' => 'required',
        ];
    }
}
```

for preview possible actions

![alt text](https://github.com/davitbek/test_project/tree/main/public/images/posts/index.png?raw=true)
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/posts/create.png?raw=true)
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/posts/create_with_error.png?raw=true)
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/posts/successfully_created.png?raw=true)
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/posts/edit.png?raw=true)
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/posts/successfully_updated.png?raw=true)
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/posts/show.png?raw=true)
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/posts/delete_confirmation.png?raw=true)
![alt text](https://github.com/davitbek/test_project/tree/main/public/images/posts/successfully_deleted.png?raw=true)

