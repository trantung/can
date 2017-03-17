@extends('admin.layout.default')
@section('title')
{{ $title=' Hồ sơ nhân viên' }}
@stop

@section('content')
<ul class="nav nav-tabs">
    <li class="active">
        <a href="#tab_1_1" data-toggle="tab"> Thông tin cá nhân </a>
    </li>
    <li>
        <a href="#tab_1_2" data-toggle="tab"> Trình độ học vấn </a>
    </li>
    <li>
        <a href="#tab_1_3" data-toggle="tab"> Nơi làm việc </a>
    </li>
    <li>
        <a href="#tab_1_4" data-toggle="tab"> Lịch sử công tác </a>
    </li>
    <li>
        <a href="#tab_1_5" data-toggle="tab"> File đính kèm </a>
    </li>
    <li>
        <a href="#tab_1_6" data-toggle="tab"> Lịch sử khen thưởng kỉ luật </a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active in" id="tab_1_1">
        <table class="table table-striped table-bordered table-advance table-hover">
            <tbody>
                <tr>
                    <td>
                        <a href="javascript:;"> Họ tên </a>
                    </td>
                    <td>  
                        {{ $personal->ho_ten }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="javascript:;"> Tên thường gọi </a>
                    </td>
                    <td>  
                        {{ $personal->ten_thuong_goi }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="javascript:;"> Giới tính </a>
                    </td>
                    <td>  
                        {{ $personal->gioi_tinh }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="javascript:;"> Năm sinh </a>
                    </td>
                    <td>  
                        {{ $personal->ho_ten }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="javascript:;"> Nơi sinh </a>
                    </td>
                    <td>  
                        {{ $personal->ho_ten }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="javascript:;"> Địa chỉ thường trú </a>
                    </td>
                    <td>  
                        {{ $personal->dia_chi_thuong_tru }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="javascript:;"> Địa chỉ tạm trú </a>
                    </td>
                    <td>  
                        {{ $personal->dia_chi_tam_tru }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="javascript:;"> Số điện thoại </a>
                    </td>
                    <td>  
                        {{ $personal->mobile }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="javascript:;"> Mã nhân viên </a>
                    </td>
                    <td>  
                        {{ $personal->ma_nv }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="tab_1_2">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <th>Trường</th>
                <th>Ngành học</th>
                <th>Bằng cấp & chứng chỉ</th>
                <th>Năm tốt nghiệp</th>
                <th>Chỉnh sửa lần cuối</th>
            </thead>
            <tbody>
                @foreach($personal->employmentEducational as $key => $value)
                <tr>
                  <td>{{$value->school_name}}</td>
                  <td>{{$industry_category_id[$value->industry_id]}}</td>
                  <td>{{$bang_cap[$value->certificate_id]}}</td>
                  <td>{{date('d-m-Y',strtotime($value->graduation_year) ) }}</td>
                  <td>{{  date('h:m d-m-Y',strtotime($value->updated_at) ) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="tab_1_3">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <th>Công ty</th>
                  <th> Vị trí</th>
                  <th> Trạng thái</th>
                  <th> Ngày bắt đầu </th>
                  <th> Công văn bổ nhiệm </th>
            </thead>
            <tbody>
                @foreach($employmentPositions as $key => $value)
                <tr>
                  <td>{{ $value->company_name_text }}</td>
                  <td>{{isset($position_category_id[$value->position])? $position_category_id[$value->position] : '' }}</td>
                  <td> {{$value->is_main_position =='N'? 'Kiêm nhiệm' : 'Vị trí chính'}}</td>
                  <td>{{date('d-m-Y',strtotime($value->start_date) )}}</td>
                  <td>@if(!empty($value->attachFile2))
                  <a href="{{ url($value->attachFile2->link) }}" download="{{$position_category_id[$value->position]}}-{{ $value->attachFile2->link }}">Tải về</a>@endif</td>
                  <td>
                        {{-- <a class="btn btn-info btn-xs" href="{{ route('hr.is_main_position',[$personal->id, $value->id]  ) }}">Vị trí chính</a> --}}
                        <a href="{{ route('employment.editPositionHistory', $value->id) }}" class="btn btn-info btn-xs">Sửa</a>
                         {{ Form::open(array('method' => 'DELETE', 'route' => ['employment.moveHistory', $personal->id, $value->id], 'style'=>" display: inline-block;")) }}
                        <input href="#" type ="submit" class="btn btn-danger btn-xs" aria-hidden="true" onclick="return confirm('Bạn có chắc chắn muốn bỏ kiêm nhiệm?');" value="Bỏ kiêm nhiệm" />
                        {{ Form::close() }}
                    {{-- </div> --}}
                  </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="tab_1_4">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <th>Công ty</th>
                  <th>Thời gian bắt đầu</th>
                  <th>Thời gian kết thúc</th>
                  <th>Vị trí</th>
                  <th>Lý do chuyển công tác</th>
                  <th>Ghi chú</th>
            </thead>
            <tbody>
                @foreach($employmentHistory as $key => $value)
                {{-- {{dd($employmentHistory->toJson())}} --}}
                <tr>
                  <td>{{$value->company_name_text }}</td>
                  <td>
                    {{date('d-m-Y',strtotime($value->start_date ) )}}
                  </td>
                  <td>
                    @if($value->end_date == NULL || $value->end_date == '0000-00-00')
                        Đến nay
                    @else
                        {{date('d-m-Y',strtotime($value->end_date ) )}}
                    @endif
                  </td>
                  <td>{{isset($value->positionHistory->name) ? $value->positionHistory->name: '' }}</td>
                  <td>{{$value->why_out}}</td>
                  <td>{{$value->description}}</td>
                  <td>
                        <a href="{{ route('employment.editHistory', $value->id) }}" class="btn btn-info btn-xs">Sửa</a>
                        {{ Form::open(array('method' => 'DELETE', 'route' => ['employment.destroyHistory', $personal->id, $value->id], 'style'=>" display: inline-block;")) }}
                        <input href="#" type ="submit" class="btn btn-danger btn-xs" aria-hidden="true" onclick="return confirm('Bạn có chắc chắn muốn xóa?');" value="Xóa" />
                        {{ Form::close() }}
                  </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="tab_1_5">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <th>Tên file</th>
                  <th>Ghi chú</th>
            </thead>
            <tbody>
                @foreach($personal->employmentFiles as $key => $value)
                <tr>
                  <td>{{$value->name}}</td>
                  <td>{{$value->description}}</td>
                  <td>
                    <a href="{{ url($value->link) }}"  class="btn btn-info btn-xs">Xem</a>
                    {{-- <a href="{{ url($value->link) }}"  class="btn btn-primary btn-xs">Tải về</a> --}}
                    <a href="{{ url($value->link) }}" download="{{$value->name}}-{{ $value->link}}"  class="btn btn-primary btn-xs">Tải về</a>

                    {{-- <div class="admin-action"> --}}
                        {{ Form::open(array('method' => 'DELETE', 'route' => ['employment.destroyFile', $personal->id, $value->id], 'style'=>" display: inline-block;")) }}
                        <input href="#" type ="submit" class="btn btn-danger  btn-xs" aria-hidden="true" onclick="return confirm('Bạn có chắc chắn muốn xóa?');" value="Xóa"/>
                        {{ Form::close() }}
                    {{-- </div> --}}
                  </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="tab_1_6">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <th>Ngày tháng</th>
                  <th>Lý do</th>
                  <th>Ghi chú</th>
                  <th>Chỉnh sửa lần cuối</th>
            </thead>
            <tbody>
                @foreach($employmentBonusHistory as $key => $value)
                <tr>
                  <td>{{ date('d-m-Y',strtotime($value->date) )  }}</td>
                  <td>{{ $value->categoryName <> null ?  $value->categoryName->name : ''}}</td>
                  <td>{{ $value->description }}</td>
                  <td>{{  date('h:m d-m-Y',strtotime($value->updated_at) ) }}</td>
                  <td>
                   {{ Form::open(array('method' => 'DELETE', 'route' => ['employment.destroyBonusHistory', $personal->id, $value->id], 'style'=>" display: inline-block;")) }}
                        <input href="#" type ="submit"  class="btn btn-danger btn-xs"  aria-hidden="true" onclick="return confirm('Bạn có chắc chắn muốn xóa?');" value="Xóa" />
                        {{ Form::close() }}
                  </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
