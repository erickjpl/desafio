<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Object\UserEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;

class UserRepository
{
    protected $model;

    protected $fieldSearchable = [ 'id', 'name', 'lastname', 'email' ];

    public function __construct( Application $app )
    {
        $this->model = $app->make( User::class );
    }

    public function all($search = [], $limit = null, $columns = ['*'])
    {
        try {
            $query = $this->model->newQuery();
            
            if (count($search)) {
                foreach($search as $key => $value) {
                    if ( in_array($key, $this->fieldSearchable) )
                        $query->where($key, $value);
                }
            }

            if (!is_null($limit)) 
                $query->limit($limit);
            
            return $this->transform($query->get($columns));
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function create($input)
    {
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

    public function find($id, $columns = ['*'])
    {
        try {
            $query = $this->model->newQuery();

            return $query->find($id, $columns);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($input);

        $model->save();

        return $model;
    }

    public function delete($id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        return $model->delete();
    }

    public function transform($query)
    {
        if( is_countable($query) ) {
            $users = collect();
            foreach ($query as $value) {
                $entity = new UserEntity($value);
                $users->push($entity->toResponse());
            }
        } else {
            $entity = new UserEntity($query);
            return $entity->toResponse();
        }

        return $users;
    }
}
