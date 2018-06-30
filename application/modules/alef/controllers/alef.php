<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Auth extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
      
    }

    public function index()
    {
        $this->load->add_package_path(APPPATH.'application/config/ion_auth');
        $this->load->library('ion_auth');
    }

}
?>






