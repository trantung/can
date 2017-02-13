@foreach($items as $key => $value)
<div style="padding-left:15px; border-top: 1px solid #ddd; padding-top:15px; margin-top:10px">
<div class="row">
    <div class="col-xs-10">{{ $value['code'] }} - {{ $value['name'] }}</div>
    <div class="col-xs-2" style="text-align: right">
    <a href="{{ action('CompanyCategoryController@show', $value['id']) }}" class="btn btn-info" >Xem</a>
    <a href="{{ action('CompanyCategoryController@edit', $value['id']) }}" class="btn btn-primary" >Sửa</a>
    {{ Form::open(array('method'=>'DELETE', 'action' => array('CompanyCategoryController@destroy', $value['id']), 'style' => 'display: inline-block;')) }}
    <button class="btn btn-danger"  onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
    {{ Form::close() }}

    </div>
    <div class="col-xs-12">
            @if($value['childs'])
                @include('admin.system.company.item', ['items'=>$value['childs']])
            @endif
    </div>
</div>
</div>

@endforeach


