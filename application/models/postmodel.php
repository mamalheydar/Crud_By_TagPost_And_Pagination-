<?php
class Postmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getallpost()
    {
        return $this->db->get('post');
    }
}