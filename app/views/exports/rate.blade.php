<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
          <title>Document</title>
          <style>
            body{
              font-family: 'dejavu sans';
              color: #000;
            }
            table{
              font-size: 12px;
              border-collapse: collapse;
            }
            .content{
              margin: 5px 0;
            }
            .content th{
              text-align: center;
              font-weight: 500;
            }
            .content th{
              font-weight: 600;
            }
            .content th, .content td{
              border: 1px solid #ddd;
              padding: 5px;
              vertical-align: middle;
              line-height: 1.5;
            }
          </style>
       </head>
    <body>
        <table width="100%" border="0" style="font-size: 12px">
          <tbody>
            <tr>
              <td></td>
              <td align="right"><strong>{{$company->name}}</strong>
            </td>
            </tr>
            <tr>
              <td><strong></strong></td>
              <td align="right"><strong>{{$department->name}}</strong></td>
            </tr>
            
            <tr>
              <td>
              
              </td>
              <td align="right">
                Địa chỉ: @if(!empty($company))
                <strong>{{$company->address}}</strong>
                @else
                ...............................................
                @endif
              </td>
            </tr>
            <tr>
              <td>
              
              </td>
              <td align="right">
                Email: @if(!empty($company))
                <strong>{{$company->email}}</strong>
                @else
                ...............................................
                @endif
              </td>
            </tr>
            <tr>
              <td>
              
              </td>
              <td align="right">
                Fax: @if(!empty($company))
                <strong>{{$company->fax}}</strong>
                @else
                ...............................................
                @endif
              </td>
            </tr>
            <tr>
              <td>
              
              </td>
              <td align="right">
                Số: .....................
              </td>
            </tr>
            <tr>
              <td>
              
              </td>
              <td align="right">
                Ngày: ......./........./............
              </td>
            </tr>
            <tr>
              <td>
              
              </td>
              <td align="right">
                Liên ............
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center" style="font-size: 22px">
              <strong>
              CHỨNG THƯ GIÁM ĐỊNH VỀ ĐỘ ẨM
              </strong></td>
            </tr>

            <tr>
              <td width="20%">
                Tên mẫu hàng :
              </td>
              <td align="left">
                {{ $product }}
              </td>
            </tr>
            @if ($campaignCode!= '' )
              <tr>
                <td width="20%">
                  Mã chiến dịch :
                </td>
                <td align="left">
                  {{ $campaignCode }}
                </td>
              </tr>
            @endif
            <tr>
              <td width="20%">
                Số lượng mẫu :
              </td>
              <td align="left">
                ....... mẫu (~0,2 kg)
              </td>
            </tr>
            <tr>
              <td width="20%">
                Nguồn gốc mẫu :
              </td>
              <td align="left">
                Lấy mẫu tàu xe
              </td>
            </tr>
            <tr>
              <td width="20%">
                Ngày phân tích :
              </td>
              <td align="left">
                ...../..../.......
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center" style="font-size: 16px">
              <strong>
              KẾT QUẢ PHÂN TÍCH
              </strong></td>
            </tr>
            <tr>
              <td colspan="2" align="center" style="font-size: 16px">
               Mẫu hàng được phân tích tại phòng thí nghiệm của {{ $company->name }}, {{ $department->name }}
              </td>
            </tr>
            <tr>
              <td>
                Kết quả như sau :
              </td>
            </tr>
          </tbody>
        </table>
        <table width="100%" border="1" style="font-size: 12px">
          <tbody>
            <tr>
              <td rowspan="2">STT</td>
              <td rowspan="2">PHƯƠNG TIỆN</td>
              <td colspan="2" align="center">KÝ HIỆU MẪU</td>
              <td rowspan="2">ĐỘ KHÔ</td>
              <td rowspan="2">TỶ LỆ MÙN</td>
              <td rowspan="2">TỶ LỆ QUÁ CỠ</td>
              <td rowspan="2">TỶ LỆ VỎ</td>
              <td rowspan="2">LƯỢNG HÀNG</td>
            </tr>
            <tr>
              <td>SỐ PHIẾU</td>
              <td>NGÀY</td>
            </tr>
            @foreach ($log as $key => $value)
              <tr>
                <td>{{ $key + 1 }}</td>
                @if($value)
                <td>{{ $value->number_car }}</td>
                <td>{{ $value->number_ticket }}</td>
                <td>{{ $value->created_at }}</td>
                <td>{{ $value->do_kho }}</td>
                <td>{{ $value->ty_le_mun }}</td>
                <td>{{ $value->ty_le_qua_co }}</td>
                <td>{{ $value->ty_le_vo }}</td>
                <td>{{ $value->package_weight }}</td>
                @else
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                @endif
              </tr>
            @endforeach
            <?php
              $totalDoKho = 0;
              $totalMun = 0;
              $totalQuaCo = 0;
              $totalVo = 0;
              $totalLuongHang = 0;
              $howMany = count($log);
              foreach ($log as $key => $value) {
                if ($value) {
                  $totalDoKho = $totalDoKho + $value->do_kho;
                  $totalMun = $totalMun + $value->ty_le_mun;
                  $totalQuaCo = $totalQuaCo + $value->ty_le_qua_co;
                  $totalVo = $totalVo + $value->ty_le_vo;
                  $totalLuongHang = $totalLuongHang + $value->package_weight;
                } 
              }
              ?>
            @if ($howMany > 0)
              <tr>
                <td colspan="4">KẾT QUẢ TRUNG BÌNH</td>
                <td>{{ round($totalDoKho / $howMany, 2) }}</td>
                <td>{{ round($totalMun / $howMany, 2) }}</td>
                <td>{{ round($totalQuaCo / $howMany, 2) }}</td>
                <td>{{ round($totalVo / $howMany, 2) }}</td>
                <td>{{ round($totalLuongHang / $howMany, 2) }}</td>
              </tr>
            @endif
          </tbody>
        </table>
        <table width="100%" border="0" style="font-size: 12px">
          <tbody>
            <tr>
              <td>Thời gian phân tích: Từ ngày ..../..../.....  đến ngày ..../..../.....</td>
            </tr>
            <tr>
              <td><strong>PHÂN TÍCH VIÊN</strong></td>
              <td><strong>TP .PHÂN TÍCH</strong></td>
            </tr>
          </tbody>
        </table>
    </body>
</html>