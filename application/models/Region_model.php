<?php
class Region_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_region($id)
		{
	        $query = $this->db->get_where('cat_region', array('idcat_region' => $id));
	        return $query->row_array();
		}

        public function get_regions()
		{
	        $this->db->select("idcat_region, reg_region, reg_platform, reg_host"); 
			$this->db->from('cat_region');
			$query = $this->db->get();

			return $query->result_array();
		}
}
