<?php

namespace Test\Test\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Test\Test\Http\Requests\TestUserApiRequest;
use Test\Test\Interfaces\TestRepositoryInterface;
use Test\Test\Models\Test;

/**
 * User API controller class.
 */
class TestUserApiController extends BaseController
{

    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    protected $guard = 'api';

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
        $this->middleware('jwt.auth:api');
        $this->setupTheme(config('theme.themes.user.theme'), config('theme.themes.user.layout'));

        $this->repository = $test;
        parent::__construct();
    }

    /**
     * Display a list of test.
     *
     * @return json
     */
    public function index(TestUserApiRequest $request)
    {
        $tests  = $this->repository
            ->pushCriteria(new \Lavalite\Test\Repositories\Criteria\TestUserCriteria())
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
    public function show(TestUserApiRequest $request, Test $test)
    {

        if ($test->exists) {
            $test         = $test->presenter();
            $test['code'] = 2001;
            return response()->json($test)
                ->setStatusCode(200, 'SHOW_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

    /**
     * Show the form for creating a new test.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(TestUserApiRequest $request, Test $test)
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
    public function store(TestUserApiRequest $request)
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
                'message' => $e->getMessage(),
                'code'    => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
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
    public function edit(TestUserApiRequest $request, Test $test)
    {
        if ($test->exists) {
            $test         = $test->presenter();
            $test['code'] = 2003;
            return response()-> json($test)
                ->setStatusCode(200, 'EDIT_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }
    }

    /**
     * Update the test.
     *
     * @param Request $request
     * @param Model   $test
     *
     * @return json
     */
    public function update(TestUserApiRequest $request, Test $test)
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
    public function destroy(TestUserApiRequest $request, Test $test)
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
