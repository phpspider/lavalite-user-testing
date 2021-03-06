<?php

namespace Test\Test\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class TestItemTransformer extends TransformerAbstract
{
    public function transform(\Test\Test\Models\Test $test)
    {
        return [
            'id'                => $test->getRouteKey(),
            'name'              => $test->name,
        ];
    }
}