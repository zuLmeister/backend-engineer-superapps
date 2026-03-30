<?php

namespace App\Services\ListProject;

use App\Models\ListProject;
use Illuminate\Support\Facades\DB;


class ListProjectService
{
    public function getAll(int $perPage = 10)
    {
        return ListProject::with([])->paginate($perPage);
    }

    public function store(array $data): ListProject
    {
        return DB::transaction(function () use ($data) {

            

            

            $listProject = ListProject::create($data);

            

            return $listProject->load([]);
        });
    }

    public function update(ListProject $listProject, array $data): ListProject
    {
        return DB::transaction(function () use ($listProject, $data) {

            

            

            $listProject->update($data);

            

            return $listProject->load([]);
        });
    }

    public function delete(ListProject $listProject): void
    {
        DB::transaction(function () use ($listProject) {
            $listProject->delete();
        });
    }
}
