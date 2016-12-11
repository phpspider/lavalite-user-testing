<div class="container">
    <h1> Tests</h1>

    <div class="row">
        <div class="col-md-8">
            @forelse($tests as $test)
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-dark  header-title m-t-0"> {!! $test['name'] !!} </h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ trans_url('test') }}/{!! $test->getPublicKey() !!}" class="btn btn-default pull-right"> {{ trans('cms.details')  }}</a>
                    </div>
                </div>
                <hr/>

                <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="name">
                    {!! trans('test::test.label.name') !!}
                </label><br />
                    {!! $test['name'] !!}
            </div>
        </div>
    </div>
            </div>
            @empty
            <div class="card-box">
                <h4 class="text-dark  header-title m-t-0">No modules</h4>
                <p class="text-muted m-b-25 font-13">
                    Your search for <b>'{{Request::get('search')}}'</b> returned empty result.
                </p>
            </div>
            @endif
            {{$tests->render()}}
        </div>
        <div class="col-md-4">
            @include('test::public.test.aside')
        </div>
    </div>
</div>