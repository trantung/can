
@extends('admin.layout.default')

@section('title')
{{ $title='Phần trăm lưu kho' }}
@stop

@section('content')

<div class="row">
    <table class="table table-striped table-bordered table-advance table-hover">
        <tbody>
            @if ($data->item)
                <tr>
                    <td>
                        <a href="javascript:;"> Vật liệu </a>
                    </td>
                    <td>  
                        {{ $data->item->name }}
                    </td>
                </tr>
            @endif
            @if ($data->ty_le_mun != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Tỷ lệ mùn </a>
                    </td>
                    <td>  
                        {{ $data->ty_le_mun }}
                    </td>
                </tr>
            @endif
            @if ($data->ty_le_qua_co != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Tỷ lệ quá cỡ </a>
                    </td>
                    <td>  
                        {{ $data->ty_le_qua_co }}
                    </td>
                </tr>
            @endif
            @if ($data->ty_le_vo != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Tỷ lệ vỏ </a>
                    </td>
                    <td> 
                        {{ $data->ty_le_vo }}
                    </td>
                </tr>
            @endif
            @if ($data->ty_le_tap_chat != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Tỷ lệ tạp chất </a>
                    </td>
                    <td>  
                        {{ $data->ty_le_tap_chat }}
                    </td>
                </tr>
            @endif
            @if ($data->do_kho != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Độ khô </a>
                    </td>
                    <td>  
                        {{ $data->do_kho }}
                    </td>
                </tr>
            @endif
            
        </tbody>
    </table>
</div>
@stop
