<?php
class Common {

	public static function getPermissionByModule($moduleId)
	{
		return Permission::where('module_id', $moduleId)->lists('name', 'id');
	}

	public static function saveOneToMany($modelName, $inputPrimaryKey, $input)
	{
		if ($input) {
			foreach ($input as $key => $value) {
				foreach ($value as $v) {
					$saveRole = $modelName::create([
						$key => $v,
						array_keys($inputPrimaryKey)[0] => array_values($inputPrimaryKey)[0],
					])->id;
					if (!$saveRole) {
						dd(INSERT_HAS_FAIL);
					}
				}
				
			}
		}
		return true;
	}

}