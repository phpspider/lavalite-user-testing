<div class="box-header with-border">
    <h3 class="box-title"> Edit  {!! trans('test::test.name') !!} [{!!$test->name!!}] </h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#test-test-edit'  data-load-to='#test-test-entry' data-datatable='#test-test-list'><i class="fa fa-floppy-o"></i> Save</button>
        <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#test-test-entry' data-href='{{trans_url('admin/test/test')}}/{{$test->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('cms.cancel') }}</button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#test" data-toggle="tab">{!! trans('test::test.tab.name') !!}</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('test-test-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(trans_url('admin/test/test/'. $test->getRouteKey()))!!}
        <div class="tab-content">
            <div class="tab-pane active" id="test">
                @include('test::admin.test.partial.entry')
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>