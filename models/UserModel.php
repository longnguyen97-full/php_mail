<?php 

class UserModel extends BaseModel
{
	public static function get_data( $table )
	{
		$fields = ['id', 'fullname', 'email', 'username', 'password', 'phone', 'avatar'];

		$call_func = new BaseModel;
		return $call_func->base_get_data( $fields, $table );
	}

	public static function get_data_by_id( $table, $id )
	{
		$fields = ['id', 'fullname', 'email', 'username', 'password', 'phone', 'avatar'];

		$call_func = new BaseModel;
		return $call_func->base_get_by_id( $fields, $table, $id );
	}

	public static function handleAdd( $data_package_values )
	{
		$fields = ['fullname', 'email', 'username', 'password', 'phone', 'avatar', 'encryption_iv', 'encryption_key'];

		$call_func = new BaseModel;
		return $call_func->base_handleAdd( $data_package_values, $fields, 'users' );
	}

	public static function handleEdit( $data_package_values, $id )
	{
		$fields = ['fullname', 'email', 'username', 'password', 'phone', 'avatar'];

		$call_func = new BaseModel;
		return $call_func->base_handleEdit( $data_package_values, $fields, 'users', $id );
	}

	public static function handleDelete( $table, $id )
	{
		$call_func = new BaseModel;
		return $call_func->base_handleDelete( $table, $id );
	}

	public function support_data_for_user( $table, $id )
	{
		var_dump('expression');
	}
}

?>