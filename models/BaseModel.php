<?php 

class BaseModel
{
	protected $db = null;

	public function __construct() {
		
		$this->db = new Database();
		$this->connect = $this->db->connToDB();

	}

	// get data
	public function base_get_data( $fields, $table )
	{
		$fields = implode(', ', $fields);

		$sql = $this->connect->prepare("SELECT {$fields} FROM {$table}");

		return $this->template_one( $sql );
	}

	// get specific data by id
	public function base_get_by_id( $fields, $table, $id )
	{
		$fields = implode(', ', $fields);

		$sql = $this->connect->prepare("SELECT {$fields} FROM {$table} WHERE id = '".$id."'");

		return $this->template_one( $sql );	
	}

	// get specific data by id
	public function base_get_data_by_condition( $fields, $table, $condition_key, $condition_value )
	{
		$fields = implode(', ', $fields);

		$sql = $this->connect->prepare("SELECT {$fields} FROM {$table} WHERE {$condition_key} = '{$condition_value}' ");

		return $this->template_one( $sql );
	}

	public function base_authenticate( $username, $password, $table )
	{
		$sql = $this->connect->prepare("SELECT id, username, password, encryption_iv, encryption_key FROM {$table} WHERE username = '{$username}'");

		return $this->template_one( $sql );
	}

	public function base_handleAdd( $data_package_values, $fields, $table )
	{
		foreach ($data_package_values as $value) {
			$values[] = "'". $value ."'";
		}

		$fields  = implode(', ', $fields);
		$values  = implode(', ', $values);

		$query_	 = "INSERT INTO {$table} ($fields) VALUES ({$values})";

		$sql = $this->connect->prepare($query_);

		$sql->execute();

		return 'allow_create';
	}
	
	public function base_handleEdit( $data_package_values, $fields, $table, $id )
	{
		$call_func = new BaseController;
		$data_package_end = $call_func->handle_field_value( $data_package_values, $fields );

		$sql = $this->connect->prepare("UPDATE {$table} SET {$data_package_end} WHERE id = $id");

		$sql->execute();

		return 'allow_update';
	}

	public function base_handleDelete( $table, $id )
	{
		$sql = $this->connect->prepare("DELETE FROM {$table} WHERE id = {$id}");

		$sql->execute();

		return 'allow_delete';
	}

	// feature modules
	public function template_one( $sql)
	{
		$post_list = [];

		$sql->execute();

		$post_list = $sql->fetchAll();

		$connect = null;

		return $post_list;
	}

	public function get_password( $id, $current_password, $table )
	{
		$sql = $this->connect->prepare("SELECT password FROM {$table} WHERE id = '{$id}' AND password = '{$current_password}'");
		$sql->execute();
		$current_password = $sql->fetchAll();
		$connect = null;
		return $current_password;
	}

	public function base_support_data_for_user( $table, $id )
	{
		$sql = $this->connect->prepare("SELECT * FROM users WHERE id = '{$id}'");
		$sql->execute();
		$this->params['post_list'] = $sql->fetchAll();
		$connect = null;
		return $this->params['post_list'];
	}
}

?>