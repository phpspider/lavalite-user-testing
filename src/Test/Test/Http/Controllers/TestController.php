<?php

namespace Test\Test\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Test\Test\Interfaces\TestRepositoryInterface;

class TestController extends BaseController
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
        $this->middleware('web');
        $this->setupTheme(config('theme.themes.public.theme'), config('theme.themes.public.layout'));

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
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        return $this->theme->of('test::public.test.index', compact('tests'))->render();
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
        $test = $this->repository->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        return $this->theme->of('test::public.test.show', compact('test'))->render();
    }
}
