<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Notifications\Notifiable;

class Model extends BaseModel
{
    use Notifiable;

    //public $preventsLazyLoading = true;
}
