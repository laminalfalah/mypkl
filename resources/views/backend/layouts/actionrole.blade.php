{!! Form::model($model, ['url' => $del_url, 'method'=>'delete', 'style' => 'width: 120px']) !!}
<a href="{!! $edit_url !!}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
<button type="submit" name="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
{!! Form::close() !!}
