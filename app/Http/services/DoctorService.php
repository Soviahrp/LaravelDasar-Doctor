<?php

namespace App\Http\Services;

use App\Models\Doctor;
use Illuminate\Support\Str;
use Illuminate\Http\Client\Request;

class DoctorService
{

    public function getWithPaginate(int $paginate = 10, ?string $search = null)
    {
        $query = Doctor::latest()->select(['uuid', 'name', 'email', 'phone']);

        if ($search) {
            $query->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
        }

        return $query->paginate($paginate);
    }


    public function getById(string $id)
    {
        return Doctor::where('uuid', $id)->firstOrfail();
    }

    public function create(array $data)
    {
        $data['uuid'] = Str::uuid();
        return Doctor::create($data);
    }

    public function update(array $data, string $id)
    {
        $getDoctor = $this->getById($id);

        return $getDoctor->update($data);
    }

    public function delete(string $id)
    {
        $getDoctor = $this->getById($id);

        return $getDoctor->delete();
    }
}
