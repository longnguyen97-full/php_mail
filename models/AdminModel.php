<?php 

class AdminModel extends BaseModel
{
	public static function get_data( $table )
	{
		$fields = ['id', 'username', 'email', 'role'];

		$call_func = new BaseModel;
		return $call_func->base_get_data( $fields, $table );
	}

	public static function get_data_by_id( $table, $id )
	{
		$fields = ['id', 'username', 'password', 'email', 'role'];

		$call_func = new BaseModel;
		return $call_func->base_get_by_id( $fields, $table, $id );
	}

	public static function handleAdd( $data_package_values )
	{
		$fields = ['username', 'password', 'role', 'email', 'encryption_iv', 'encryption_key'];

		$call_func = new BaseModel;
		return $call_func->base_handleAdd( $data_package_values, $fields, 'admins' );
	}

	public static function handleEdit( $data_package_values, $id )
	{
		$fields = ['username', 'password', 'role', 'email'];

		$call_func = new BaseModel;
		return $call_func->base_handleEdit( $data_package_values, $fields, 'admins', $id );
	}

	public static function handleDelete( $table, $id )
	{
		$call_func = new BaseModel;
		return $call_func->base_handleDelete( $table, $id );
	}
}

?>