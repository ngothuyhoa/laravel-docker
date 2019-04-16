<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'category_id', 'title', 'content', 'view', 'vote', 'status', 'slug'
    ];

    protected $perPage;
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
        $this->perPage = config('paginate.post');
    }
}
