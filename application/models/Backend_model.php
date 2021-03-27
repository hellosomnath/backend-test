<?php
/**
 * 
 */
class Backend_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function checkLogin($email, $password)
	{
		$user = $this->db->get_where('users', array('email' => $email, 'password' => md5($password)))->row();

		return empty($user) ? false : $user;
	}
}
?>