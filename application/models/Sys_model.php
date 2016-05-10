<?php
class Sys_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_apikey()
		{
	        $query = $this->db->get_where('sys_data', array('idsys_data' => 1));
	        return $query->row_array();
		}
}
