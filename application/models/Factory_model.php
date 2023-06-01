<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Factory_model extends CI_Model
{
    private $tblFactory = "ch_gen_tbl_mst_factory";



    function getAll()
    {
        return $this->db->get($this->tblFactory)->result();
    }

    // get Full Field Factory Access
    function getFactoryAccess($groupId)
    {
        $this->db->select("a.factory_id, b.factory_name, b.factory_abbr");
        $this->db->join("ch_gen_tbl_mst_factory b", "a.factory_id = b.factory_id");
        $this->db->where("user_group_id", $groupId);
        return $this->db->get("ch_gen_tbl_utl_factory_access a")->result();
    }
    // function getFactoryAccess($groupId)
    // {
    //     $this->db->select("a.factory_id");
    //     $this->db->join("ch_gen_tbl_mst_factory b", "a.factory_id = b.factory_id");
    //     $this->db->where("user_group_id", $groupId);
    //     return $this->db->get("ch_gen_tbl_utl_factory_access a")->result();
    // }
}
