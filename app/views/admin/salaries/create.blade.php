@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Thêm lương' }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('SalariesController@index') }}" class="btn btn-success">Danh sách lương</a>
  </div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => 'SalariesController@store')) }}
          <div class="box-body">
            <div class="form-group">
              <label for="email">Nhân viên</label>
                <div class="row">
                      <div class="col-sm-6">
                        {{ Form::select('personal_id', $personal, Input::old('personal_id'), array('class' =>'form-control', 'id'=>'birds')) }}
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label for="month">Tháng</label>
                <div class="row">
                  <div class="col-sm-6">
                    {{ Form::selectRange('month', 1, 12, Input::old('month'), array('class' =>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
              <label for="month">Năm</label>
                <div class="row">
                  <div class="col-sm-6">
                    {{ Form::selectRange('year', 1999, 2970, Input::old('year'), array('class' =>'form-control')) }}
                </div>
            </div>

            <div class="form-group">
              <label for="total"> Tổng tiền lương</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="total" placeholder="Tổng tiền lương" name="total" value="{{Input::old('total')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="ngay_cong"> Ngày công</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="ngay_cong" placeholder="Ngày công" name="ngay_cong" value="{{Input::old('ngay_cong')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="ngay_di_lam"> Ngày đi làm</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="ngay_di_lam" placeholder="Ngày đi làm" name="ngay_di_lam" value="{{Input::old('ngay_di_lam')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="luong_trach_nhiem"> Lương trách nhiệm</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="luong_trach_nhiem" placeholder="Lương trách nhiệm" name="luong_trach_nhiem" value="{{Input::old('luong_trach_nhiem')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="phu_cap"> Phụ cấp</label>
              <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="phu_cap" placeholder="Phụ cấp" name="phu_cap" value="{{Input::old('phu_cap')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="kieu_luong"> Kiểu lương</label>
              <div class="row">
              	<div class="col-sm-6">
                    {{ Form::select('kieu_luong', $salaries_category, Input::old('kieu_luong'), array('class' =>'form-control')) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="pay_time">Thời gian trả</label>
              	<div class="row">
                	<div class="col-sm-6">
                		<input type="text" class="form-control" id="pay_time" placeholder="Thời gian trả" name="pay_time" value="{{Input::old('pay_time')}}">
            		</div>
      			</div>
            </div>

            <div class="form-group">
              <label for="thuong_le_tet">thưởng lễ tết</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="thuong_le_tetme" placeholder="Thời gian trả" name="thuong_le_tet" value="{{Input::old('thuong_le_tetme')}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label for="tong_giam_tru">Tổng giảm trừ</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="tong_giam_trume" placeholder="Thời gian trả" name="tong_giam_tru" value="{{Input::old('tong_giam_trume')}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label for="tien_dien_thoai">Tiền địên thoại</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="patien_dien_thoai" placeholder="Thời gian trả" name="tien_dien_thoai" value="{{Input::old('patien_dien_thoai')}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label for="thuc_linh">Thực lĩnh</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="thuc_linhy_time" placeholder="Thời gian trả" name="thuc_linh" value="{{Input::old('thuc_linhy_time')}}">
                    </div>
                </div>
            </div>


            <div class="form-group">
              <label for="description">Ghi chú</label>
              <div class="row">
                <div class="col-sm-6">
                <textarea class="form-control" id="description" placeholder="Ghi chú" name="description">{{Input::old('description')}}</textarea>
                </div>
                </div>
              </div>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <input type="submit" class="btn btn-primary" value="Lưu lại" />
            <input type="reset" class="btn btn-default" value="Nhập lại" />
          </div>
        {{ Form::close() }}
      </div>
      <!-- /.box -->
	</div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8" async defer>
  $(document).ready(function(){

    $( function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }
        function extractLast( term ) {
          return split( term ).pop();
        }

        function getStoreId(){
          return 1;
        }


        $( "#birds" )
          // don't navigate away from the field on tab when selecting an item
          .on( "keydown", function( event ) {
            console.log('vao');
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
              event.preventDefault();
            }
          })
          .autocomplete({
            source: function( request, response ) {

              $.getJSON( "search", {
                term: extractLast( request.term ),
                store: getStoreId()
              }, response );
            },
            search: function() {
              // custom minLength
              var term = extractLast( this.value );
              if ( term.length < 2 ) {
                return false;
              }
            },
            focus: function() {
              // prevent value inserted on focus
              return false;
            },
            select: function( event, ui ) {
              // console.log(ui);
              var terms = split( this.value );
              // remove the current input
              terms.pop();
              // add the selected item
              terms.push( ui.item.value );
              // add placeholder to get the comma-and-space at the end
              terms.push( "" );
              this.value = "";

              var count = $('#countLine').val();
              appendNewLine(ui.item, count);
              $('#countLine').val(parseInt(count) + 1);
              // this.value = terms.join( ", " );
              return false;
            }
          })
          .autocomplete( "instance" )._renderItem = function( ul, item ) {
          return $( "<li>" )
            .append( "<div> Mã sp: " + item.code + "<br>Tên sp: " + item.label + "</div>" )
            .appendTo( ul );
        };;
      } );


  });
</script>


@stop
@endif