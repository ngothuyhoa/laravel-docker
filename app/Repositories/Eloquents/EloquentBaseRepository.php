<?php
namespace App\Repositories\Eloquents;
use App\Contracts\Repositories\BaseRepository;
class EloquentBaseRepository implements BaseRepository
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function store($data = [])
    {
        return $this->model->create($data);
    }

    public function update($id, $data = [])
    {
        $record = $this->model->findOrFail($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->where('id', $id)->get();
    }
}