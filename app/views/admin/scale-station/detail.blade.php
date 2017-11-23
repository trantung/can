
@extends('admin.layout.default')

@section('title')
{{ $title='Thông tin chi tiết' }}
@stop

@section('content')

<div class="row">
    <table class="table table-striped table-bordered table-advance table-hover">
        <tbody>
            <tr>
                <td colspan="2" class="text-center">
                    <H1><a href="javascript:;">Cân</a></H1>
                </td>
                
            </tr>
            @if ($data->user_id != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Người cân </a>
                    </td>
                    <td>
                        @if($user = Admin::find($data->user_id))
                            {{ $user->username }}
                        @endif
                    </td>
                </tr>
            @endif

            @if ($data->number_ticket != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Số phiếu </a>
                    </td>
                    <td>  
                        {{ $data->number_ticket }}
                    </td>
                </tr>
            @endif
            @if ($data->number_car != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Số xe </a>
                    </td>
                    <td>  
                        {{ $data->number_car }}
                    </td>
                </tr>
            @endif
            @if ($data->transfer_type != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Kiểu cân </a>
                    </td>
                    <td>  
                        {{ getNameOfTransfer($data->transfer_type) }}
                    </td>
                </tr>
            @endif
            @if ($data->warehouse_id != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Kho </a>
                    </td>
                    <td> 
                        @if ($warehouse = Warehouse::find($data->warehouse_id))
                            {{ $warehouse->name }}
                        @endif
                    </td>
                </tr>
            @endif
            @if ($data->department_id != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Chi nhánh xuất nhập </a>
                    </td>
                    <td>  
                        @if ($department = Company::find($data->department_id))
                            {{ $department->name }}
                        @endif
                    </td>
                </tr>
            @endif
            @if ($data->campaign_name != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Tên chiến dịch </a>
                    </td>
                    <td>  
                        {{ $data->campaign_name }}
                    </td>
                </tr>
            @endif
            @if ($data->campaign_method != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Phương tiện chiến dịch </a>
                    </td>
                    <td>  
                        {{ $data->campaign_method }}
                    </td>
                </tr>
            @endif
            @if ($data->campaign_code != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Mã chiến dịch </a>
                    </td>
                    <td>  
                        {{ $data->campaign_code }}
                    </td>
                </tr>
            @endif
            @if ($data->customer_id != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Id khách hàng </a>
                    </td>
                    <td>  
                        {{ $data->customer_id }}
                    </td>
                </tr>
            @endif
            @if ($data->customer_name != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Tên khách hàng </a>
                    </td>
                    <td>  
                        {{ $data->customer_name }}
                    </td>
                </tr>
            @endif
            @if ($data->customer_phone != '')
                <tr>
                    <td>
                        <a href="javascript:;"> SDT khách hàng </a>
                    </td>
                    <td>  
                        {{ $data->customer_phone }}
                    </td>
                </tr>
            @endif
            @if ($data->customer_address != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Địa chỉ khách hàng </a>
                    </td>
                    <td>  
                        {{ $data->customer_address }}
                    </td>
                </tr>
            @endif
            @if ($data->customer_fax != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Fax </a>
                    </td>
                    <td>  
                        {{ $data->customer_fax }}
                    </td>
                </tr>
            @endif
            @if ($data->scale_at != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Ngày cân </a>
                    </td>
                    <td>  
                        {{ $data->scale_at }}
                    </td>
                </tr>
            @endif
            @if ($data->first_scale_hour != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Giờ cân lần 1 </a>
                    </td>
                    <td>  
                        {{ $data->first_scale_hour }}
                    </td>
                </tr>
            @endif
            @if ($data->second_scale_hour != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Giờ cân lần 2 </a>
                    </td>
                    <td>  
                        {{ $data->second_scale_hour }}
                    </td>
                </tr>
            @endif
            @if ($data->first_scale_weight != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Trọng lượng cân lần 1(kg) </a>
                    </td>
                    <td>  
                        {{ number_format($data->first_scale_weight) }}
                    </td>
                </tr>
            @endif
            @if ($data->second_scale_weight != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Trọng lượng cân lần 2(kg) </a>
                    </td>
                    <td>  
                        {{ number_format($data->second_scale_weight) }}
                    </td>
                </tr>
            @endif
            @if ($data->package_weight != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Trọng lượng hàng (kg)</a>
                    </td>
                    <td>  
                        {{ $data->package_weight }}
                    </td>
                </tr>
            @endif
            @if ($data->app_id != '')
                <tr>
                    <td>
                        <a href="javascript:;"> App id </a>
                    </td>
                    <td>  
                        {{ $data->app_id }}
                    </td>
                </tr>
            @endif
            @if ($data->code != '')
                <tr>
                    <td>
                        <a href="javascript:;"> Mã trạm cân</a>
                    </td>
                    <td>  
                        {{ $data->code }}
                    </td>
                </tr>
            @endif
            <tr>
                <td colspan="2" class="text-center">
                    <a href="javascript:;"><H1>Kiểm định</H1></a>
                </td>
            </tr>
            @if($kcs)
                @if($user = Admin::find($data->user_id))
                    <tr>
                        <td>
                            <a href="javascript:;">Người KCS</a>
                        </td>
                        <td>  
                            {{ $user->username }}
                        </td>
                    </tr>
                @endif
                @if ($kcs->weight_total != '')
                    <tr>
                        <td>
                            <a href="javascript:;"> Tổng trọng lượng </a>
                        </td>
                        <td>  
                            {{ $kcs->weight_total }} (g)
                        </td>
                    </tr>
                @endif
                @if ($kcs->trong_luong_mun != '')
                    <tr>
                        <td>
                            <a href="javascript:;"> Trọng lượng mùn </a>
                        </td>
                        <td>  
                            {{ $kcs->trong_luong_mun }} (g)
                        </td>
                    </tr>
                @endif
                @if ($kcs->trong_luong_qua_co != '')
                    <tr>
                        <td>
                            <a href="javascript:;"> Trọng lượng quá cỡ </a>
                        </td>
                        <td>  
                            {{ $kcs->trong_luong_qua_co }} (g)
                        </td>
                    </tr>
                @endif
                @if ($kcs->trong_luong_vo != '')
                    <tr>
                        <td>
                            <a href="javascript:;"> Trọng lượng vỏ </a>
                        </td>
                        <td>  
                            {{ $kcs->trong_luong_vo }} (g)
                        </td>
                    </tr>
                @endif
                @if ($kcs->trong_luong_tap_chat != '')
                    <tr>
                        <td>
                            <a href="javascript:;"> TRọng lượng tạp chất </a>
                        </td>
                        <td>  
                            {{ $kcs->trong_luong_tap_chat }}(g)
                        </td>
                    </tr>
                @endif
                @if ($kcs->ty_le_mun != '')
                    <tr>
                        <td>
                            <a href="javascript:;"> Tỷ lệ mùn (%)</a>
                        </td>
                        <td>  
                            {{ $kcs->ty_le_mun }}
                        </td>
                    </tr>
                @endif
                @if ($kcs->ty_le_qua_co != '')
                    <tr>
                        <td>
                            <a href="javascript:;"> Tỷ lệ quá cỡ (%)</a>
                        </td>
                        <td>  
                            {{ $kcs->ty_le_qua_co }}
                        </td>
                    </tr>
                @endif
                @if ($kcs->ty_le_vo != '')
                    <tr>
                        <td>
                            <a href="javascript:;"> Tỷ lệ vỏ (%)</a>
                        </td>
                        <td>  
                            {{ $kcs->ty_le_vo }}
                        </td>
                    </tr>
                @endif
                @if ($kcs->ty_le_tap_chat != '')
                    <tr>
                        <td>
                            <a href="javascript:;"> Tỷ lệ tạp chất (%) </a>
                        </td>
                        <td>  
                            {{ $kcs->ty_le_tap_chat }}
                        </td>
                    </tr>
                @endif
                @if ($kcs->do_kho != '')
                    <tr>
                        <td>
                            <a href="javascript:;"> Độ khô(%) </a>
                        </td>
                        <td>  
                            {{ $kcs->do_kho }}
                        </td>
                    </tr>
                @endif
                @if ($kcs->do_kho != '')
                    <tr>
                        <td>
                            <a href="javascript:;"> Thời gian KCS </a>
                        </td>
                        <td>  
                            {{ $kcs->created_at }}
                        </td>
                    </tr>
                @endif
            @else
            <tr>
                <td colspan="2" class="text-center">
                    <a href="javascript:;"><H1>Không có KCS</H1></a>
                </td>
            </tr>
            @endif
            
            
        </tbody>
    </table>
</div>
@stop
