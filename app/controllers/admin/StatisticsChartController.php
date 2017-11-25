<?php

class StatisticsChartController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::except('_token');
		$strorage_loss = null;
		$scale_rate = null;
		if( !empty($input['product']) ){
			$model = CommonNormal::getProductCategoryId($input['product']);
			$type = ($model[0] == PRODUCTCATEGORY) ? 'ProductCategory' : 'Product';
			$proId = $model[1];
			$strorage_loss = StorageLoss::where('model_name', $type)
				->where('model_id', $proId)
				->where('warehouse_id', '>', 0)
				->join('warehouse', 'storage_loss.warehouse_id', '=', 'warehouse.id')
				->get();

			$departmentId = Input::get('department_id');
			$warehouseId = Input::get('warehouse_id');
			$scale_rate = ScaleKCS::select(['transfer_type', 'package_weight', 'number_ticket', DB::raw('DATE_FORMAT(created_at, "%m/%Y") as created')])
				->where('category_id', $input['product'])
				->whereNotNull('package_weight')
				->where('package_weight', '!=', 0)
				->whereBetween('created_at', ['2016-01-07 00:00:00', '2018-01-07 00:00:00']);
			
			if( !empty($departmentId) ){
				$scale_rate = $scale_rate->where('department_id', $departmentId);
			}
			if( !empty($warehouseId) ){
				$scale_rate = $scale_rate->where('warehouse_id', $warehouseId);
			}
			$scale_rate = $scale_rate
				->groupBy('number_ticket')
				->orderBY('created', 'ASC')
				->get();
		}
		// dd($scale_rate->toArray());
		return View::make('admin.chart.dashboard')->with([
			'strorage_loss' => $strorage_loss,
			'scale_rate' => $scale_rate
		]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function search()
	{
		return View::make('admin.chart.dashboard');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
