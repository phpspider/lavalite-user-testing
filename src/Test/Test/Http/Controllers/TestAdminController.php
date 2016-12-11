<?php

namespace Test\Test\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Form;
use Test\Test\Http\Requests\TestAdminWebRequest;
use Test\Test\Interfaces\TestRepositoryInterface;
use Test\Test\Models\Test;

/**
 * Admin web controller class.
 */
class TestAdminController extends BaseController
{
    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    protected $guard = 'admin.web';

    /**
     * Initialize test controller.
     *
     * @param type TestRepositoryInterface $test
     *
     * @return type
     */
    public function __construct(TestRepositoryInterface $test)
    {
        $this->middleware('web');
        $this->middleware('auth:admin.web');
        $this->setupTheme(config('theme.themes.admin.theme'), config('theme.themes.admin.layout'));

        $this->repository = $test;
        parent::__construct();
    }

    /**
     * Display a list of test.
     *
     * @return Response
     */
    public function index(TestAdminWebRequest $request)
    {
        $pageLimit = $request->input('pageLimit');
        if ($request->wantsJson()) {
            $tests  = $this->repository
            ->pushCriteria(new \Test\Test\Repositories\Criteria\TestAdminCriteria())
                ->setPresenter('\\Test\\Test\\Repositories\\Presenter\\TestListPresenter')
                ->scopeQuery(function ($query) {
                    return $query->orderBy('id', 'DESC');
                })->paginate($pageLimit);

            $tests['recordsTotal']    = $tests['meta']['pagination']['total'];
            $tests['recordsFiltered'] = $tests['meta']['pagination']['total'];
            $tests['request']         = $request->all();
            return response()->json($tests, 200);

        }

        $this   ->theme->prependTitle(trans('test::test.names').' :: ');
        return $this->theme->of('test::admin.test.index')->render();
    }

    /**
     * Display test.
     *
     * @param Request $request
     * @param Model   $test
     *
     * @return Response
     */
    public function show(TestAdminWebRequest $request, Test $test)
    {
        if (!$test->exists) {
            return response()->view('test::admin.test.new', compact('test'));
        }

        Form::populate($test);
        return response()->view('test::admin.test.show', compact('test'));
    }

    /**
     * Show the form for creating a new test.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(TestAdminWebRequest $request)
    {

        $test = $this->repository->newInstance([]);

        Form::populate($test);

        return response()->view('test::admin.test.create', compact('test'));

    }

    /**
     * Create new test.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(TestAdminWebRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.web');
            $test          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('test::test.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/test/test/'.$test->getRouteKey())
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
            ], 400);
        }
    }

    /**
     * Show test for editing.
     *
     * @param Request $request
     * @param Model   $test
     *
     * @return Response
     */
    public function edit(TestAdminWebRequest $request, Test $test)
    {
        Form::populate($test);
        return  response()->view('test::admin.test.edit', compact('test'));
    }

    /**
     * Update the test.
     *
     * @param Request $request
     * @param Model   $test
     *
     * @return Response
     */
    public function update(TestAdminWebRequest $request, Test $test)
    {
        try {

            $attributes = $request->all();

            $test->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('test::test.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/test/test/'.$test->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/test/test/'.$test->getRouteKey()),
            ], 400);

        }
    }

    /**
     * Remove the test.
     *
     * @param Model   $test
     *
     * @return Response
     */
    public function destroy(TestAdminWebRequest $request, Test $test)
    {

        try {

            $t = $test->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('test::test.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/test/test/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/test/test/'.$test->getRouteKey()),
            ], 400);
        }
    }
}
