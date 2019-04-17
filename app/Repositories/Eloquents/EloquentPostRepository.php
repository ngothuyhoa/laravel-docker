<?php

namespace App\Repositories\Eloquents;
use App\Contracts\Repositories\PostRepository;
use App\Post;

class EloquentPostRepository extends EloquentBaseRepository implements PostRepository
{
    protected $model;
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function paginate() {
        return $this->model->paginate();
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function countView() {
        return 1;
    }

    
}