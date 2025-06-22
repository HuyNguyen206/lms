<?php

namespace App\Models\Course;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $slugColumn = 'title';

    use HasSlug;
}
