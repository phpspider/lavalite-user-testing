@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('test::test.name') !!} <small> {!! trans('cms.manage') !!} {!! trans('test::test.names') !!}</small>
@stop

@section('title')
{!! trans('test::test.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('cms.home') !!} </a></li>
    <li class="active">{!! trans('test::test.names') !!}</li>
</ol>
@stop

@section('entry')
<div class="box box-warning" id='test-test-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="test-test-list" class="table table-striped table-bordered data-table">
    <thead  class="list_head">
        <th>{!! trans('test::test.label.name')!!}</th>
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('search[name]')->raw()!!}</th>
    </thead>
</table>
@stop

@section('script')
<script type="text/javascript">

var oTable;
$(document).ready(function(){
    app.load('#test-test-entry', '{!!trans_url('admin/test/test/0')!!}');
    oTable = $('#test-test-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/test/test') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#test-test-list .search_bar input, #test-test-list .search_bar select').each(
                function(){
                    aoData.push( { 'name' : $(this).attr('name'), 'value' : $(this).val() } );
                }
            );
            app.dataTable(aoData);
            $.ajax({
                'dataType'  : 'json',
                'data'      : aoData,
                'type'      : 'GET',
                'url'       : sSource,
                'success'   : fnCallback
            });
        },

        "columns": [
            {data :'name'},
        ],
        "pageLength": 25
    });

    $('#test-test-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#test-test-list').DataTable().row( this ).data();

        $('#test-test-entry').load('{!!trans_url('admin/test/test')!!}' + '/' + d.id);
    });

    $("#test-test-list .search_bar input, #test-test-list .search_bar select").on('keyup select', function (e) {
        e.preventDefault();
        console.log(e.keyCode);
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
});
</script>
@stop

@section('style')
@stop

