<?php

class ApiImportManagement extends ApiController {


    private $actionApp;

    public function importBangCan()
    {
        $input = Input::all();
        dd($input);
        $user_id = $input['user_id'];
        $input['can_lan1'] = $input['kl_tong'];
        $input['can_lan2'] = $input['kl_xe'];
        $dataReturn = [];
        $actionData =  array();
        //phai check them user thuoc chi nhanh nao
        $ssuserid = Common::checkSessionLogin($input);
        $id_bc_log = CommonNormal::create($input,'BangCanLog');
        $this->checkDataPost($input);
        return Common::returnData(200,SUCCESS,$user_id,$ssuserid, $dataReturn);
    }

    public function importKiemDinh()
    {
        //TODO
    }

    public function importSanXuat()
    {
     //TODO
    }

    public function importKhachHang()
    {
        $input = Input::all();
        $user_id = $input['user_id'];
        $ssuserid = Common::checkSessionLogin($input);
            $id_kd_log = CommonNormal::create($input,'KhachHangLog');
            if ($id_kd_log)
                $checkIdKH = checkIdKH('KhachHang',$input['id_kh']);
            if ($checkIdKH){
                $actionData['id_status'] = ERROR_SYSTEM;
                $actionData['description'] = 'Mã khách hàng đã tồn tại';
            }else{
                if(CommonNormal::create($input,'KhachHang')){
                    $actionData['id_status'] = SUCCESS_CODE;
                    $actionData['description'] = 'Thêm mới dữ liệu thành công';
                }else{
                    
                }
                
            }
        return Common::returnData(200,SUCCESS,$user_id,$ssuserid, $actionData);
    }

    public function getTheLoai(){
	$input = Input::all();
        $user_id = $input['user_id'];
        $ssuserid = Common::checkSessionLogin($input);
        // $data = TheLoai::select('id','name','thanh_pham_id', 'status')->get();
        $data = TheLoai::select('id', 'name')->where('status', ACTIVE)->get();
        return Common::returnData(200,SUCCESS,null,null, $data);
    }

    public function getThanhPham(){
        $input = Input::all();
        $user_id = $input['user_id'];
        $ssuserid = Common::checkSessionLogin($input);
        $data = ThanhPham::select('id','name', 'status')->get();
        return Common::returnData(200,SUCCESS,null,null, $data);
    }

    public function changePassword()
    {
        $input = Input::except('_token');
        $user = User::find($input['user_id']);
        $session_id = Common::checkSessionLogin($input);
        if(!isset($input['old_password']))
        {
            $data['id_status'] = ERROR_CODE;
            $data['description'] = 'Phải nhập mật khẩu cũ';
        }
        else
        {
            if(isset($input['new_passwod']))
            {
                if(Auth::user()->attempt(['username' => $user->username, 'password' => $input['old_password']]))
                {
                    $inputPass['password'] = Hash::make($input['new_passwod']);
                    CommonNormal::update($input['user_id'], $inputPass, 'User');
                    $data['id_status'] = SUCCESS_CODE;
                    $data['description'] = 'Cập nhật mật khẩu thành công';
                }else{
                    $data['id_status'] = ERROR_CODE;
                    $data['description'] = 'Mật khẩu cũ không đúng';
                }
            }
            else
            {
                $data['id_status'] = ERROR_CODE;
                $data['description'] = 'Phải nhập mật khẩu mới';
            }
        }
        return Common::returnData(200, SUCCESS, $input['user_id'], $session_id, $data);
    }

    public function importTheLoai(){
        $input = Input::all();
        $user_id = $input['user_id'];
        $ssuserid = Common::checkSessionLogin($input);
            $checkIdKH = checkIdKH('TheLoai',$input['id_the_loai']);
        if ($checkIdKH){
            CommonNormal::update($input['id_the_loai'],$input,'TheLoai');
            $data['id_status'] = SUCCESS_CODE;
            $data = 'Sửa thông tin thành công';
        }else{
            CommonNormal::create($input,'TheLoai');
            $data['id_status'] = SUCCESS_CODE;
            $data = 'Thêm mới thành công';
        }
        return Common::returnData(200,SUCCESS,$user_id,$ssuserid, $data);
    }


   public function validateInputBangCan($input)
    {
        if (!empty($input) && !empty($input['id_bang_can']) && !empty($input['id_so_phieu'])
            && !empty($input['id_chi_nhanh']) && !empty($input['id_action']) && arrayMethod($input['id_action'])) {
            return true;
        }
        return 0;
    }

    public function validateInputKiemDinh($input)
    {
        if (!empty($input) && !empty($input['id_bang_kd']) && !empty($input['id_so_phieu'])
            && !empty($input['id_chi_nhanh']) && !empty($input['id_action']) && arrayMethod($input['id_action'])) {
            return true;
        }
        return 0;
    }

    public function validateInputSanXuat($input)
    {
        if (!empty($input) && !empty($input['id_san_xuat']) && !empty($input['id_cty'])
            && !empty($input['id_chi_nhanh']) && !empty($input['id_action']) && arrayMethod($input['id_action'])) {
            return true;
        }
        return 0;
    }


    //haind
    public function checkDataPost($input)
    {
        //check is can chien dich
        if ($input['id_chien_dich']) {
            //check chien dich da ket thuc hay chua
            // if ($input['campaign_closed']) {
            //     # code...
            // }
            // to do??
        }
        //check exists id so phieu
        $dataCheck = ['id_so_phieu' => $input['id_so_phieu'], 'app_id' => $input['app_id']];
        if (Common::isExistsData('BangCan', $dataCheck)) {
            $this->actionapp = 'update';
        } else {
            $this->actionapp = 'insert';
        }
        // xu ly data
        $this->processData($input);

        //insert or update data tbl BangCan

        //insert tbl relation
    }

    public function processData($input = [])
    {
        //haind
        $typeApp = Common::isDataFromApp($input);
        $tinhtoan = $this->checkDataRelation($input, $typeApp);
    }

    //haind
    public function checkDataRelation($input, $type)
    {
        //1 la kiem dinh, 2 la can
        // if ($type == self::APP_CAN) {
        $relationCan = RlshipsCanKiemDinh::where('id_so_phieu', $input['id_so_phieu'])
            ->where('id_chi_nhanh', $input['id_chi_nhanh'])
            ->first();

        //step 2
        if (!$relationCan) {
            if ($type == self::APP_CAN) {
                Common::storeData('BangCan', $input, $this->getInputStoreCan());
            }
            if ($type == self::APP_KIEMDINH) {
                Common::storeData('KiemDinh', $input, $this->getInputStoreKiemDinh());
            }
            Common::storeData('RlshipsCanKiemDinh', $input, $this->getInputStoreRelation());
            return false;
        }
        //step 5
        if (!$relationCan->id_kiem_dinh) {
            //step 8
            $this->getWaitConfirm($this->actionApp);
        }
        //step 4
        if($relationCan->id_kiem_dinh) {
            //step 6
            if ($relationCan->id_status == 1) {
                $this->getWaitConfirm($this->actionApp);
               
            }
            // check kiem dinh can or tu san xuat(type = 1 can: 2 tu san xuat)
            if ($relationCan->type == 1) {
                //step 10
                if ($relationCan->id_status == 0) {
                    //step 7
                    //tinh toan
                    if (isCampaign) {
                        $listCan = RlshipsCanKiemDinh::where('id_chien_dich', $campaignId)->get();
                        foreach ($listCan as $key => $value) {
                            $data = $this->calcData($value, $type, null);
                            $this->insertOrUpdate($this->actionApp,$input['id_so_phieu'], $input['id_chi_nhanh'], $data);
                        }
                        
                    }
                    if (!isCampaign) {
                        $data = $this->calcData($relationCan, $type, $input);
                        $this->insertOrUpdate($this->actionApp,$input['id_so_phieu'], $input['id_chi_nhanh'], $data);
                    }
                    //update id_status == 1
                    //step 9
                }
            }
            if ($relationCan->type == 2) {
                //to do tu san xuat
            } 
        }
        // }
        if ($type == self::APP_KIEMDINH) {
            //TODO
        }
    }

    public function calcData($obj, $appType, $input)
    {
        // $check = RlshipsCanKiemDinh::where('id_chi_nhanh', $tableId)->where('id_so_phieu', $soPhieuId)->first();
//        if ($appType == self::APP_CAN) {
//            $arrKey = ['ty_le_mun', 'ty_le_qua_co', 'ty_le_vo', 'ty_le_tap_chat', 'tl_tong'];
//            $dataKiemDinh = [
//                'ty_le_mun' => $obj->ty_le_mun,
//                'ty_le_qua_co' => $obj->ty_le_qua_co,
//                'ty_le_vo' => $obj->ty_le_vo,
//                'ty_le_tap_chat' => $obj->ty_le_tap_chat,
//                'tl_tong' => $obj->tl_tong,
//            ];
//            $dataReturn = Common::prepareData($arrKey, $dataKiemDinh);
//            $dataReturn['kl_tong'] = $input['kl_tong'];
//            $dataReturn['kl_xe'] = $input['kl_xe'];
//            $dataReturn['kl_hang'] = $input['kl_hang'];
//            //$arrKey, $dataKiemDinh
//        }
//
//        if ($appType == self::APP_KIEMDINH) {
//            $arrKey = ['kl_tong', 'kl_xe', 'kl_hang'];
//            $dataCan = [
//                'kl_tong' => $obj->kl_tong,
//                'kl_xe' => $obj->kl_xe,
//                'kl_hang' => $obj->kl_hang,
//            ];
//            $dataReturn = Common::prepareData($arrKey, $dataCan);
//            $dataReturn['ty_le_mun'] = $input['ty_le_mun'];
//            $dataReturn['ty_le_qua_co'] = $input['ty_le_qua_co'];
//            $dataReturn['ty_le_vo'] = $input['ty_le_vo'];
//            $dataReturn['ty_le_tap_chat'] = $input['ty_le_tap_chat'];
//            $dataReturn['tl_tong'] = $input['tl_tong'];
//        }

        //to do(can check)
        $array =  (array)$obj;
        $dataReturn = array_merge($array, $input);
        return Common::calcLuongTru($dataReturn);

    }

    public function getInputStoreKiemDinh()
    {
        return [
            'id_bang_kd',
            'id_so_phieu',
            'id_chi_nhanh',
            'id_action',
            'user_id',
            'session_id',
            'id_status',
            'thoi_gian',
            'tl_tong',
            'tl_mun',
            'tl_qua_co',
            'tl_vo',
            'tl_tap_chat',
            'ty_le_mun',
            'ty_le_qua_co',
            'ty_le_vo',
            'ty_le_tap_chat',
            'don_vi_tl',
            'don_vi_ty_le',
            'type_production',
            'type',
        ];
    }



    public function getInputStoreRelation()
    {
        return [
            'id_bang_kd',
            'id_so_phieu',
            'id_chi_nhanh',
            'id_action',
            'user_id',
            'session_id',
            'id_status',
            'thoi_gian',
            'tl_tong',
            'tl_mun',
            'tl_qua_co',
            'tl_vo',
            'tl_tap_chat',
            'ty_le_mun',
            'ty_le_qua_co',
            'ty_le_vo',
            'ty_le_tap_chat',
            'don_vi_tl',
            'don_vi_ty_le',
            'type_production',
            'type',
        ];
    }



    public function getInputStoreCan()
    {
        return [
            'id_bang_can',
            'id_so_phieu',
            'id_chi_nhanh',
            'do_kho',
            'id_cty',
            'app_id',
            'id_chien_dich',
            'user_id',
            'session_id',
            'id_action',
            'id_status',
            'id_kho',
            'id_ma_tau',
            'id_kh',
            'ten_kh',
            'so_xe',
            'ten_hang',
            'kho',
            'ngay_can',
            'gio_can_lan_1',
            'gio_can_lan_2',
            'xuat_nhap',
            'kl_tong',
            'kl_xe',
            'kl_tap_chat',
            'kl_hang',
            'luong_tru',
            'tap_chat',
            'don_gia',
            'thanh_tien',
            'don_vi_kl',
            'don_vi_ty_le',
            'nhap_hang',
            'ghi_chu',
        ];
    }
    public function insertOrUpdate($action, $soPhieuId, $chiNhanhId, $input)
    {
        $check = RlshipsCanKiemDinh::where('id_chi_nhanh', $chiNhanhId)
            ->where('id_so_phieu', $soPhieuId)
            ->where('app_id', $input['app_id'])
            ->first();
        if ($action =='insert') {
            BangCan::create($input);
            RlshipsCanKiemDinh::create($input);
        }
        if ($action =='update') {
            $input['id_status'] = STATUS_RLSHIPS_1;
            BangCan::update($input);
            RlshipsCanKiemDinh::update($input);
        }
    }

    public function getWaitConfirm($id_so_phieu='')
    {
        return returnData(200,SUCCESS, null, null , [$id_so_phieu,$this->actionApp]);
        //tra ve client
        //neu client ko dong y update-->ko xu ly
        //neu client dong y-->tinh toan
    }

    public function getProcessConfirm($id_so_phieu,$app_id,$action_app)
    {
        $input  = BangCanLog::where('id_so_phieu',$id_so_phieu)
            ->where('app_id',$app_id)
            ->orderby('id','DESC')
            ->first()->toArray();
        //TODO-->Phuong
        $arrKey = ['can_lan1', 'can_lan3'];
        
        foreach ($arrKey as $value) {
            unset($input[$value]);
        }
        $relationCan = RlshipsCanKiemDinh::where('id_so_phieu', $input['id_so_phieu'])
            ->where('id_chi_nhanh', $input['id_chi_nhanh'])
            ->first();
        $typeApp = Common::isDataFromApp($input);
        $data = $this->calcData($relationCan, $typeApp, $input);
        $this->insertOrUpdate($action_app,$id_so_phieu,$input['id_chi_nhanh'],$data);
    }

}
