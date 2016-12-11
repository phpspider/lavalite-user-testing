@include('public::notifications')
<div class="container"> 
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-dark  header-title m-t-0"> {{ trans('cms.edit')  }} Module </h4>
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
    ->id('edit-test-test')
    ->method('PUT')
    ->files('true')
    ->action(trans_url('user/test/test') .'/'.$test['eid'])!!}
        @include('test::user.test.partial.entry')
    {!! Form::close() !!}
</div>
