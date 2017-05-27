
@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa "'. $data->name .'"' }}
@stop

@section('content')

<div class="row">
    <table class="table table-striped table-bordered table-advance table-hover">
        <tbody>
            @if ($data->number_ticket != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->number_ticket }}
                    </td>
                </tr>
            @endif
            @if ($data->number_car != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->number_car }}
                    </td>
                </tr>
            @endif
            @if ($data->transfer_type != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->transfer_type }}
                    </td>
                </tr>
            @endif
            @if ($data->warehouse_id != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->warehouse_id }}
                    </td>
                </tr>
            @endif
            @if ($data->department_id != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->department_id }}
                    </td>
                </tr>
            @endif
            @if ($data->campaign_name != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->campaign_name }}
                    </td>
                </tr>
            @endif
            @if ($data->campaign_method != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->campaign_method }}
                    </td>
                </tr>
            @endif
            @if ($data->campaign_code != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->campaign_code }}
                    </td>
                </tr>
            @endif
            @if ($data->customer_id != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->customer_id }}
                    </td>
                </tr>
            @endif
            @if ($data->customer_name != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->customer_name }}
                    </td>
                </tr>
            @endif
            @if ($data->customer_phone != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->customer_phone }}
                    </td>
                </tr>
            @endif
            @if ($data->customer_address != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->customer_address }}
                    </td>
                </tr>
            @endif
            @if ($data->customer_fax != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->customer_fax }}
                    </td>
                </tr>
            @endif
            @if ($data->scale_at != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->scale_at }}
                    </td>
                </tr>
            @endif
            @if ($data->first_scale_hour != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->first_scale_hour }}
                    </td>
                </tr>
            @endif
            @if ($data->second_scale_hour != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->second_scale_hour }}
                    </td>
                </tr>
            @endif
            @if ($data->first_scale_weight != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->first_scale_weight }}
                    </td>
                </tr>
            @endif
            @if ($data->second_scale_weight != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->second_scale_weight }}
                    </td>
                </tr>
            @endif
            @if ($data->package_weight != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->package_weight }}
                    </td>
                </tr>
            @endif
            @if ($data->app_id != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->app_id }}
                    </td>
                </tr>
            @endif
            @if ($data->code != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->code }}
                    </td>
                </tr>
            @endif
            @if ($data->type != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $data->type }}
                    </td>
                </tr>
            @endif
            
            <tr>
                <td>
                    <a href="javascript:;"> Tên thường gọi </a>
                </td>
                <td>  
                    {{ $data->ten_thuong_goi }}
                </td>
            </tr>
            <tr>
                <td>
                    <a href="javascript:;"> Giới tính </a>
                </td>
                <td>  
                    {{ $data->gioi_tinh }}
                </td>
            </tr>
            <tr>
                <td>
                    <a href="javascript:;"> Năm sinh </a>
                </td>
                <td>  
                    {{ $data->ho_ten }}
                </td>
            </tr>
            <tr>
                <td>
                    <a href="javascript:;"> Nơi sinh </a>
                </td>
                <td>  
                    {{ $data->ho_ten }}
                </td>
            </tr>
            <tr>
                <td>
                    <a href="javascript:;"> Địa chỉ thường trú </a>
                </td>
                <td>  
                    {{ $data->dia_chi_thuong_tru }}
                </td>
            </tr>
            <tr>
                <td>
                    <a href="javascript:;"> Địa chỉ tạm trú </a>
                </td>
                <td>  
                    {{ $data->dia_chi_tam_tru }}
                </td>
            </tr>
            <tr>
                <td>
                    <a href="javascript:;"> Số điện thoại </a>
                </td>
                <td>  
                    {{ $data->mobile }}
                </td>
            </tr>
            <tr>
                <td>
                    <a href="javascript:;"> Mã nhân viên </a>
                </td>
                <td>  
                    {{ $data->ma_nv }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
@stop
