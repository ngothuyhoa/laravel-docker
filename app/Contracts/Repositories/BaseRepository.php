<?php
namespace App\Contracts\Repositories;
interface BaseRepository
{
    public function store($data = []);
    public function update($id, $data = []);
    public function delete($id);
    public function show($id);
    public function all();
}