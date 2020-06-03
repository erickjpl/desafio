<?php

namespace App\Http\Data;

use App\Comment;
use App\Http\Object\CommentEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;

class CommentRepository
{
    protected $model;

    protected $fieldSearchable = [ 'id', 'content', 'status', 'publication_id' ];

    public function __construct( Application $app )
    {
        $this->model = $app->make( Comment::class );
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
        return $query->with('publication');
    }

    public function transform($query, $relations)
    {
        if( is_countable($query) ) {
            $users = collect();
            foreach ($query as $value) {
                $entity = new CommentEntity($value);

                if ($relations) 
                    $entity->setPublication($value->publication);

                $users->push($entity->toResponse());
            }
        } else {
            $entity = new CommentEntity($query);

            if ($relations) 
                    $entity->setPublication($value->publication);

            return $entity->toResponse();
        }

        return $users;
    }
}
