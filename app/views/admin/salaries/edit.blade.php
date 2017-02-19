@extends('admin.layout.default')

@section('title')
{{ $title='Sửa lương' }}
@stop

@section('content')

@if(Admin::isAdmin())
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('SalariesController@index') }}" class="btn btn-success">Danh sách lương</a>
		<a href="{{ action('SalariesController@create') }}" class="btn btn-primary">Thêm lương</a>
	</div>
</div>
@endif

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('SalariesController@update', $data->id), 'method' => 'PUT')) }}
		    <div class="box-body">
            <div class="form-group">
              <label for="email">Nhân viên</label>
                <div class="row">
                      <div class="col-sm-6">
                        {{-- {{ Form::select('personal_id', $personal, $data->personal_id, array('class' =>'form-control')) }} --}}
                        <input type="text" class="form-control" id="personal_id" value="{{$data->user->ho_ten}}" disabled>
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label for="month">Tháng</label>
                <div class="row">
                  <div class="col-sm-6">
                    {{-- {{ Form::selectRange('month', 1, 12, $data->month, array('class' =>'form-control')) }} --}}
                    <input type="text" class="form-control" id="month" value="{{$data->month}}" disabled>
                </div>
            </div>

            <div class="form-group">
              <label for="month">Năm</label>
                <div class="row">
                  <div class="col-sm-6">
                    {{-- {{ Form::selectRange('month', 1, 12, $data->month, array('class' =>'form-control')) }} --}}
                    <input type="text" class="form-control" id="month" value="{{$data->year}}" disabled>
                </div>
            </div>

            <div class="form-group">
              <label for="total"> Tổng tiền lương</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="total" placeholder="Tổng tiền lương" name="total" value="{{ str_replace('.00', '', $data->total)}} ">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="ngay_cong"> Ngày công</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="ngay_cong" placeholder="Ngày công" name="ngay_cong" value="{{$data->ngay_cong}} ">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="ngay_di_lam"> Ngày đi làm</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="ngay_di_lam" placeholder="Ngày đi làm" name="ngay_di_lam" value="{{$data->ngay_di_lam}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="luong_trach_nhiem"> Lương trách nhiệm</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="luong_trach_nhiem" placeholder="Lương trách nhiệm" name="luong_trach_nhiem" value="{{$data->luong_trach_nhiem}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="phu_cap"> Phụ cấp</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="phu_cap" placeholder="Phụ cấp" name="phu_cap" value="{{$data->phu_cap}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="kieu_luong"> Kiểu lương</label>
              <div class="row">
                <div class="col-sm-6">
                     {{ Form::select('kieu_luong', $salaries_category, $data->kieu_luong, array('class' =>'form-control')) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="pay_time">Thời gian trả</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="pay_time" placeholder="Thời gian trả" name="pay_time" value="{{$data->pay_time}}">
                    </div>
                </div>
            </div>



            <div class="form-group">
              <label for="description">Ghi chú</label>
              <div class="row">
                <div class="col-sm-6">
                <textarea class="form-control" id="description" placeholder="Ghi chú" name="description">{{$data->description}}</textarea>
                </div>
              </div>
            </div>

          </div>
				<!-- /.box-body -->

				<div class="box-footer">
					<input type="submit" class="btn btn-primary" value="Lưu lại" />
				</div>
			{{ Form::close() }}
		</div>
		<!-- /.box -->
	</div>
</div>

@stop
