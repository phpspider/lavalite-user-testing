<?php

namespace Test\Test\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Form;
use Test\Test\Http\Requests\TestUserWebRequest;
use Test\Test\Interfaces\TestRepositoryInterface;
use Test\Test\Models\Test;

class TestUserController extends BaseController
{
    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    protected $guard = 'web';

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
        $this->middleware('auth:web');
        $this->setupTheme(config('theme.themes.user.theme'), config('theme.themes.user.layout'));

        $this->repository = $test;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(TestUserWebRequest $request)
    {
        $this->repository->pushCriteria(new \Test\Test\Repositories\Criteria\TestUserCriteria());
        $tests = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        $this->theme->prependTitle(trans('test::test.names').' :: ');

        return $this->theme->of('test::user.test.index', compact('tests'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Test $test
     *
     * @return Response
     */
    public function show(TestUserWebRequest $request, Test $test)
    {
        Form::populate($test);

        return $this->theme->of('test::user.test.show', compact('test'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(TestUserWebRequest $request)
    {

        $test = $this->repository->newInstance([]);
        Form::populate($test);

        return $this->theme->of('test::user.test.create', compact('test'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(TestUserWebRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $test = $this->repository->create($attributes);

            return redirect(trans_url('/user/test/test'))
                -> with('message', trans('messages.success.created', ['Module' => trans('test::test.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Test $test
     *
     * @return Response
     */
    public function edit(TestUserWebRequest $request, Test $test)
    {

        Form::populate($test);

        return $this->theme->of('test::user.test.edit', compact('test'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Test $test
     *
     * @return Response
     */
    public function update(TestUserWebRequest $request, Test $test)
    {
        try {
            $this->repository->update($request->all(), $test->getRouteKey());

            return redirect(trans_url('/user/test/test'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('test::test.name')]))
                ->with('code', 204);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(TestUserWebRequest $request, Test $test)
    {
        try {
            $this->repository->delete($test->getRouteKey());
            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('test::test.name')]),
                'code'     => 202,
                'redirect' => trans_url('/user/test/test/0'),
            ], 202);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
