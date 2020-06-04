<?php

namespace App\Http\Data;

use App\User;
use App\Http\Object\UserEntity;
use App\Http\Object\PublicationEntity;
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

    public function all($search = [], $limit = null, $relations = false, $columns = ['*'])
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

            if ($relations) 
                $query = $this->relations($query);
            
            return $this->transform($query->get($columns), $relations);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function create($input)
    {
        $input['password'] = \Hash::make($input['password']);
        
        \DB::transaction(function() use ($input) {
            
            $model = $this->model->newInstance($input);

            $model->save();

            return $model;
        });
    }

    public function find($id, $relations = false, $columns = ['*'])
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

    public function relations($query)
    {
        return $query->with('publications');
    }

    public function transform($query, $relations)
    {
        if( is_countable($query) ) {
            $users = collect();
            foreach ($query as $value) {
                $entity = new UserEntity($value);

                if ($relations) 
                    $entity->setPublications($value->publications);

                $users->push($entity->toResponse());
            }
        } else {
            $entity = new UserEntity($query);

            if ($relations) 
                $entity->setPublications($value->publications);
                
            return $entity->toResponse();
        }

        return $users;
    }
}
