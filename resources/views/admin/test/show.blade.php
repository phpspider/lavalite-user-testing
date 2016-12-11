<div class="box-header with-border">
    <h3 class="box-title"> {{ trans('cms.view') }}   {!! trans('test::test.name') !!}  [{!! $test->name !!}]  </h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#test-test-entry' data-href='{{trans_url('admin/test/test/create')}}'><i class="fa fa-times-circle"></i> New</button>
        @if($test->id )
        <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#test-test-entry' data-href='{{ trans_url('/admin/test/test') }}/{{$test->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> Edit</button>
        <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#test-test-entry' data-datatable='#test-test-list' data-href='{{ trans_url('/admin/test/test') }}/{{$test->getRouteKey()}}' >
        <i class="fa fa-times-circle"></i> Delete
        </button>
        @endif
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('test::test.name') !!}</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('test-test-show')
        ->method('POST')
        ->files('true')
        ->action(trans_url('admin/test/test'))!!}
            <div class="tab-content">
                <div class="tab-pane active" id="details">
                    @include('test::admin.test.partial.entry')
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>