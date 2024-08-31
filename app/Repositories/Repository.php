<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
  protected $model;
  protected $perPage = 10;

  protected array $searchable = [];


  /**
   * @param array $attributes
   * @return mixed
   */
  public function all (array $attributes = []): mixed
  {
	$defaultData = [
		'order_by' => 'id',
		'order'    => 'DESC',
		'where'    => [],
		'with'     => [],
		'search'   => [],
		'filters'  => []
	];

	$data = array_merge($defaultData, $attributes);

	$query = $this->model->query();

	if (!empty($data[ 'where' ])) {
	  foreach ($data[ 'where' ] as $where) {
		$query->where($where[ 0 ], $where[ 1 ], $where[ 2 ]);
	  }
	}

	if (!empty($data[ 'search' ])) {
	  $query->where(function($query) use ($data) {
		foreach ($this->searchable as $searchable) {
		  $query->orWhere($searchable, 'LIKE', '%' . $data[ 'search' ] . '%');
		}
	  });
	}

	if (!empty($data[ 'with' ])) {
	  foreach ($data[ 'with' ] as $with) {
		$query->with($with);
	  }
	}

	$models = $query->orderBy($data[ 'order_by' ], $data[ 'order' ])->get();

	return $models;
  }

  /**
   * @param array $attributes
   * @return mixed
   */
  public function get (array $attributes = []): mixed
  {
	$defaultData = [
		'per_page' => 10,
		'order_by' => 'id',
		'order'    => 'DESC',
		'where'    => [],
		'with'     => [],
		'search'   => [],
		'filters'  => []
	];

	$data = array_merge($defaultData, $attributes);

	$query = $this->model->query();

	if (!empty($data[ 'where' ])) {
	  foreach ($data[ 'where' ] as $where) {
		$query->where($where[ 0 ], $where[ 1 ], $where[ 2 ]);
	  }
	}

	if (!empty($data[ 'search' ])) {
	  $query->where(function($query) use ($data) {
		foreach ($this->searchable as $searchable) {
		  $query->orWhere($searchable, 'LIKE', '%' . $data[ 'search' ] . '%');
		}
	  });
	}

	if (!empty($data[ 'with' ])) {
	  foreach ($data[ 'with' ] as $with) {
		$query->with($with);
	  }
	}

	$models = $query->orderBy($data[ 'order_by' ], $data[ 'order' ])->paginate($data[ 'per_page' ]);

	return $models;
  }

  /**
   * @param int|string $perPage
   * @param int|string $page
   * @return mixed
   */
  public function paginate (int|string $perPage = 10, int|string $page = 1): mixed
  {
	$models = $this->model->query()->paginate($perPage, ['*'], 'page', $page);
	return $models;
  }

  /**
   * @param $match
   * @param $attribute
   * @return mixed
   */
  public function createOrUpdate ($match, $attribute): mixed
  {
	if (empty($attribute)) {
	  $attribute = $match;
	}

	$model = $this->model->query()->where($match)->first();

	if (!$model) {
	  return $this->create($attribute);
	}

	return $this->update($model->id, $attribute);
  }

  /**
   * @param array $attributes
   * @return mixed
   */

  public function create (array $attributes): mixed
  {
	$model = $this->model->create($attributes);
	return $model;
  }

  /**
   * @param array $attributes
   * @param int $id
   * @return mixed
   */
  public function update (array $attributes, int $id): mixed
  {
	$model = $this->getModel($id);

	if (!$model) {
	  return null;
	}

	$model->update($attributes);
	return $model;
  }

  /**
   * @param $identifier
   * @param string $key
   * @return Model
   * */
  public function getModel ($identifier, string $key = 'id')
  {
	if ($identifier instanceof Model) {
	  return $identifier;
	}

	$model = $this->model->where($key, $identifier)->first();
	return $model;
  }

  /**
   * @param int $id
   * @return mixed
   */
  public function delete (int $id): mixed
  {
	$model = $this->getModel($id);

	if (!$model) {
	  return null;
	}

	$model->delete();
	return $model;
  }

  /**
   * @param $id
   * @return Model
   */
  public function find ($id)
  {
	$model = $this->model->find($id);
	return $model;
  }

  /**
   * @param $id
   * @return mixed
   */
  public function findOrFail ($id): mixed
  {
	$model = $this->model->query()->findOrFail($id);
	return $model;
  }

  /**
   * @param $match
   * @param array $attribute
   * @return mixed
   */
  public function createOrGet ($match, array $attribute = []): mixed
  {
	if (empty($attribute)) {
	  $attribute = $match;
	}

	$model = $this->model->query()->where($match)->first();

	if (!$model) {
	  return $this->create($attribute);
	}

	return $model;
  }
}
