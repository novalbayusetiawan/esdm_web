<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_Auth
{
	public $CI = FALSE;
	private $_authFile = "";
	private $_controller = "";
	private $_method = "";
	private $_accessLevel = "";
	private $_isAllowed = FALSE;
	private $_isAjax = FALSE;
	private $_exceptedPage = array();
	private $_loginPage = "";
	private $_loginAjax = array();
	private $_restrictedPage = "";
	private $_restrictedAjax = array();

	public function __construct(){
		$this->CI =& get_instance();
        $this->setAuthFile($this->CI->config->item("folder_secret", "my_config").$this->CI->config->item("user_roles", "my_config"));
        $this->setController($this->CI->uri->segment(1));
        $this->setMethod($this->CI->uri->segment(2));
        $this->setAccessLevel($this->CI->session->userdata("acc_level"));
        $this->isAjax($this->CI->input->is_ajax_request());
        $this->setLoginPage("user/signin_form");
        $this->setLoginAjax(array(
            "success" => false,
            "title" => "LOGIN FIRST",
            "messages" => "YOU HAVE NO RIGHTS TO ACCEESS THIS PAGE! <br> RELOAD THE OR CLICK ".auto_link(base_url("users/signin_form"))."."
        ));
        $this->setRestrictedPage("page/access_denied");
        $this->setRestrictedAjax(array(
            "success" => false,
            "title" => "ACCESS DENIED",
            "messages" => "YOU HAVE NO RIGHTS TO ACCEESS THIS PAGE!"
        ));
	}

	public function run(){
		$auth = json_decode(file_get_contents($this->_authFile), TRUE);
		$regexp_level = @$auth[$this->_controller][$this->_method];
        $excepted = FALSE;
        foreach($this->_exceptedPage as $row){
            if( $this->_controller."/".$row == $this->_controller."/".$this->_method){
                $excepted = TRUE;
                break;
            }
        }
        if(!$excepted){
            if(!$this->_accessLevel){
                if(!$this->_isAjax)
                    redirect($this->_loginPage);
                else
                    Exit(json_encode($this->_loginAjax));
            }
            if($regexp_level){
                if(in_array($this->_accessLevel, explode("|", $regexp_level))){
                    $this->_isAllowed = TRUE;
                }else{
                    $this->_isAllowed = FALSE;
                }
            }else{
                $this->_isAllowed = TRUE;
            }
            if(!$this->_isAllowed){
                if(!$this->_isAjax){
                    redirect($this->_restrictedPage);
                }else{
                    Exit(json_encode($this->_restrictedAjax));
                }
            }
        }
	}

	public function isAjax($param){
		$this->_isAjax = $param;
	}

	public function setExceptedPage($param){
        $this->_exceptedPage = $param;
	}

	public function setLoginPage($param){
        $this->_loginPage = $param;
	}

	public function setLoginAjax($param){
        $this->_loginAjax = $param;
	}

	public function setRestrictedPage($param){
        $this->_restrictedPage = $param;
	}

	public function setRestrictedAjax($param){
        $this->_restrictedAjax = $param;
	}

	public function setAuthFile($param){
		$this->_authFile = strtolower($param);
	}

	public function setController($param){
		$this->_controller = strtolower($param);
	}

	public function setMethod($param){
		$this->_method = $param;
		if(!$this->_method){
			$this->_method = "index";
        }
		$this->_method = strtolower($this->_method);
	}

	public function setAccessLevel($param){
		$this->_accessLevel = strtolower($param);
	}
}