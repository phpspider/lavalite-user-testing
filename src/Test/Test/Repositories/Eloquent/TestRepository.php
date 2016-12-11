<?php

namespace Test\Test\Repositories\Eloquent;

use Test\Test\Interfaces\TestRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class TestRepository extends BaseRepository implements TestRepositoryInterface
{
    /**
     * Booting the repository.
     *
     * @return null
     */
    public function boot()
    {
        $this->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'));
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        $this->fieldSearchable = config('package.test.test.search');
        return config('package.test.test.model');
    }
}
