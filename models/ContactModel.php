<?php 

class ContactModel extends BaseModel
{
	public static function get_data( $table )
	{
		$fields = ['id', 'title', 'summary', 'content', 'thumbnail', 'published'];

		$call_func = new BaseModel;
		return $call_func->base_get_data( $fields, $table );
	}

	public static function get_data_by_id( $table, $id )
	{
		$fields = ['id', 'title', 'summary', 'content', 'thumbnail', 'published'];

		$call_func = new BaseModel;
		return $call_func->base_get_by_id( $fields, $table, $id );
	}

	// get specific data by condition
	public static function get_data_by_condition( $table, $condition_key, $condition_value )
	{
		$fields = ['id', 'title', 'summary', 'content', 'thumbnail', 'published'];

		$call_func = new BaseModel;
		return $call_func->base_get_data_by_condition( $fields, $table, $condition_key, $condition_value );
	}

	public static function handleAdd( $data_package_values )
	{
		$fields = ['title', 'summary', 'content', 'thumbnail', 'published'];

		$call_func = new BaseModel;
		return $call_func->base_handleAdd( $data_package_values, $fields, 'blogs' );
	}

	public static function handleEdit( $data_package_values, $id )
	{
		$fields = ['title', 'summary', 'content', 'thumbnail', 'published'];

		$call_func = new BaseModel;
		return $call_func->base_handleEdit( $data_package_values, $fields, 'blogs', $id );
	}

	public static function handleDelete( $table, $id )
	{
		$call_func = new BaseModel;
		return $call_func->base_handleDelete( $table, $id );
	}
}

?>