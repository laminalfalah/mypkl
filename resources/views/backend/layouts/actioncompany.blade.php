{!! Form::model($model, ['url' => route('dashboard.company'), 'method'=>'delete', 'style' => 'width: 120px']) !!}
<a href="{!! $detail_url !!}" class="btn btn-sm btn-primary"><i class="fa fa-list"></i></a>
{!! Form::close() !!}
