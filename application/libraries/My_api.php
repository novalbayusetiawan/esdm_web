<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_Api
{
	public $ci = FALSE;
	private $_api = "";
	private $_app_id = "";
	private $_app_token = "";
    private $_target = "";

	public function __construct()
    {
		$this->ci =& get_instance();
        $this->_api = $this->ci->config->item("api", "esdm");
        $this->_app_id = $this->ci->config->item("app_id", "esdm");
        $this->_app_token = $this->ci->config->item("app_token", "esdm");
	}
    
    public function set_api($api)
    {
        $this->_api = $api;
    }
    
    public function set_app_id($app_id)
    {
        $this->_app_id = $app_id;
    }
    
    public function set_app_token($app_token)
    {
        $this->_app_token = $app_token;
    }

    public function get_response($target, $params = array())
    {
        $this->_target = $this->_api.$target."?app_id=".$this->_app_id."&app_token=".$this->_app_token;
        $ch = curl_init($this->_target);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function get_last_api(){
        return $this->_target;
    }
}