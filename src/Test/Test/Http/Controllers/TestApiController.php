<?php

namespace Test\Test\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Test\Test\Interfaces\TestRepositoryInterface;
use Test\Test\Repositories\Presenter\TestItemTransformer;

/**
 * Pubic API controller class.
 */
class TestApiController extends BaseController
{
    /**
     * Constructor.
     *
     * @param type \Test\Test\Interfaces\TestRepositoryInterface $test
     *
     * @return type
     */
    public function __construct(TestRepositoryInterface $test)
    {
        $this->middleware('api');

        $this->repository = $test;
        parent::__construct();
    }

    /**
     * Show test's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $tests = $this->repository
            ->pushCriteria(new \Test\Test\Repositories\Criteria\TestPublicCriteria())
            ->setPresenter('\\Test\\Test\\Repositories\\Presenter\\TestListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $tests['code'] = 2000;
        return response()->json($tests)
                ->setStatusCode(200, 'INDEX_SUCCESS');
    }

    /**
     * Show test.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $test = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($test)) {
            $test         = $this->itemPresenter($module, new TestItemTransformer);
            $test['code'] = 2001;
            return response()->json($test)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
