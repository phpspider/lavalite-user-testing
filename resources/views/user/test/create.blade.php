@include('public::notifications')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-dark  header-title m-t-0"> {{ trans('cms.create')  }} Test </h4>
        </div>
        <div class="col-md-6">
            <a href="{{ trans_url('/user/test/test') }}" class="btn btn-default pull-right"> {{ trans('cms.back')  }}</a>
        </div>
    </div>
    <p class="text-muted m-b-25 font-13">
        Your awesome text goes here.
    </p>
    <hr/>

    {!!Form::horizontal_open()
    ->id('create-test-test')
    ->method('POST')
    ->files('true')
    ->action(trans_url('user/test/test'))!!}
            @include('test::user.test.partial.entry')
            {!! Form::hidden('upload_folder')!!}
    {!! Form::close() !!}
</div>