<?php

namespace App\Http\Data;

use App\Publication;
use App\Http\Object\PublicationEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;

class PublicationRepository
{
    protected $model;

    protected $fieldSearchable = [ 'id', 'title', 'content', 'user_id' ];

    public function __construct( Application $app )
    {
        $this->model = $app->make( Publication::class );
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
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
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
        return $query->with('comments');
    }

    public function transform($query, $relations)
    {
        if( is_countable($query) ) {
            $users = collect();
            foreach ($query as $value) {
                $entity = new PublicationEntity($value);

                if ($relations) 
                    $entity->setPublications($value->comments);

                $users->push($entity->toResponse());
            }
        } else {
            $entity = new PublicationEntity($query);

            if ($relations) 
                $entity->setPublications($value->comments);
                
            return $entity->toResponse();
        }

        return $users;
    }
}
