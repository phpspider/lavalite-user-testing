<?php

namespace Test\Test\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Test\Test\Http\Requests\TestAdminApiRequest;
use Test\Test\Interfaces\TestRepositoryInterface;
use Test\Test\Models\Test;

/**
 * Admin API controller class.
 */
class TestAdminApiController extends BaseController
{
    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    protected $guard = 'admin.api';

    /**
     * Initialize test controller.
     *
     * @param type TestRepositoryInterface $test
     *
     * @return type
     */
    public function __construct(TestRepositoryInterface $test)
    {
        $this->middleware('api');
        $this->middleware('jwt.auth:admin.api');
        $this->setupTheme(config('theme.themes.admin.theme'), config('theme.themes.admin.layout'));

        $this->repository = $test;
        parent::__construct();
    }

    /**
     * Display a list of test.
     *
     * @return json
     */
    public function index(TestAdminApiRequest $request)
    {
        $tests  = $this->repository
            ->pushCriteria(new \Test\Test\Repositories\Criteria\TestAdminCriteria())
            ->setPresenter('\\Test\\Test\\Repositories\\Presenter\\TestListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $tests['code'] = 2000;
        return response()->json($tests) 
                         ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display test.
     *
     * @param Request $request
     * @param Model   Test
     *
     * @return Json
     */
    public function show(TestAdminApiRequest $request, Test $test)
    {
        $test         = $test->presenter();
        $test['code'] = 2001;
        return response()->json($test)
                         ->setStatusCode(200, 'SHOW_SUCCESS');;

    }

    /**
     * Show the form for creating a new test.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(TestAdminApiRequest $request, Test $test)
    {
        $test         = $test->presenter();
        $test['code'] = 2002;
        return response()->json($test)
                         ->setStatusCode(200, 'CREATE_SUCCESS');

    }

    /**
     * Create new test.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(TestAdminApiRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $test          = $this->repository->create($attributes);
            $test          = $test->presenter();
            $test['code']  = 2004;

            return response()->json($test)
                             ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
;
        }
    }

    /**
     * Show test for editing.
     *
     * @param Request $request
     * @param Model   $test
     *
     * @return json
     */
    public function edit(TestAdminApiRequest $request, Test $test)
    {
        $test         = $test->presenter();
        $test['code'] = 2003;
        return response()-> json($test)
                        ->setStatusCode(200, 'EDIT_SUCCESS');;
    }

    /**
     * Update the test.
     *
     * @param Request $request
     * @param Model   $test
     *
     * @return json
     */
    public function update(TestAdminApiRequest $request, Test $test)
    {
        try {

            $attributes = $request->all();

            $test->update($attributes);
            $test         = $test->presenter();
            $test['code'] = 2005;

            return response()->json($test)
                             ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the test.
     *
     * @param Request $request
     * @param Model   $test
     *
     * @return json
     */
    public function destroy(TestAdminApiRequest $request, Test $test)
    {

        try {

            $t = $test->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('test::test.name')]),
                'code'     => 2006
            ])->setStatusCode(202, 'DESTROY_SUCCESS');

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4006,
            ])->setStatusCode(400, 'DESTROY_ERROR');
        }
    }
}
