<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-dark  header-title m-t-0"> {!! $test['name'] !!} </h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ trans_url('tests') }}" class="btn btn-default pull-right"> Back</a>
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
        </div>  
        <div class="col-md-4">
            @include('test::public.test.aside')
        </div>

    </div>
</div>