<div class='col-md-4 col-sm-6'>
                       {!! Form::text('name')
                       -> label(trans('test::test.label.name'))
                       -> placeholder(trans('test::test.placeholder.name'))!!}
                </div>

{!!   Form::actions()
->large_primary_submit('Submit')
->large_inverse_reset('Reset')
!!}