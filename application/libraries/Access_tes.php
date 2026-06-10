<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* ZYA CBT
* Achmad Lutfi
* achmdlutfi@gmail.com
* achmadlutfi.wordpress.com
*/
#[AllowDynamicProperties]
class Access_tes{
	function __construct(){
		$this->CI =& get_instance();
		
		$this->CI->load->helper('cookie');
		$this->CI->load->model('cbt_user_model');
		$this->CI->load->library('encryption');
		
		$this->users_model =& $this->CI->cbt_user_model;
	}
	
	
	/**
	 * proses login
	 * 0 = username tak ada
	 * 1 = sukses
	 * 2 = password salah
	 * @param unknown_type $username
	 * @param unknown_type $password
	 * @return boolean
	 */
	function login($username, $password){
		$result = $this->users_model->get_by_username($username);
		if($result){
			$decrypted = $this->CI->encryption->decrypt($result->user_password);
			if($decrypted === FALSE) {
				// Fallback to plain text if not yet encrypted
				$decrypted = $result->user_password;
			}

			if($password === $decrypted){
				// If legacy plain text, dynamically encrypt it on successful login
				if($result->user_password === $decrypted) {
					$encrypted = $this->CI->encryption->encrypt($password);
					$this->users_model->update('user_name', $username, array('user_password' => $encrypted));
				}
				return 1;
			}else{
				return 2;
			}
		}
		return 0;
	}
	
	function is_login(){
		if($this->CI->session->userdata('cbt_tes_user_id')) {
			$username = $this->CI->session->userdata('cbt_tes_user_id');
			$user = $this->users_model->get_by_username($username);
			if ($user) {
				$current_ip = $this->CI->input->ip_address();
				$current_ua = $this->CI->input->user_agent();
				$current_sig = md5($current_ip . '_' . $current_ua);
				
				if (empty($user->user_ip)) {
					// Backward compatibility: set it if empty
					$this->users_model->update('user_name', $username, array('user_ip' => $current_sig));
					return TRUE;
				}
				
				if ($user->user_ip !== $current_sig) {
					$this->logout();
					return FALSE;
				}
				return TRUE;
			}
		}
		return FALSE;
	}
	
	function get_username(){
		return $this->CI->session->userdata('cbt_tes_user_id');
	}
    
    function get_nama(){
		return $this->CI->session->userdata('cbt_tes_nama');
	}
    
    function get_group(){
		return $this->CI->session->userdata('cbt_tes_group');
	}
    
    function get_group_id(){
		return $this->CI->session->userdata('cbt_tes_group_id');
	}
	
	function is_token(){
		return (($this->CI->session->userdata('cbt_tes_token')) ? TRUE : FALSE);
	}
	
	function remove_token(){
		$this->CI->session->unset_userdata('cbt_tes_token');
	}
	
	/**
	 * logout
	 */
	function logout(){
		$this->CI->session->unset_userdata('cbt_tes_tanda');
		$this->CI->session->unset_userdata('cbt_tes_user_id');
		$this->CI->session->unset_userdata('cbt_tes_nama');
		$this->CI->session->unset_userdata('cbt_tes_group_id');
		$this->CI->session->unset_userdata('cbt_tes_group');
		$this->CI->session->unset_userdata('cbt_tes_token');
	}
}