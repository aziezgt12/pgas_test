<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    private $tableUsers = "ch_gen_tbl_user";
    private $tableGroup = "ch_gen_tbl_utl_user_group";
    private $tableMnuAccess = "ch_gen_tbl_utl_menu_access";
    private $tableMenuHdr = "ch_gen_tbl_utl_menu_hdr";
    private $tableMenuSub = "ch_gen_tbl_utl_menu_dtl";
    private $tableMenuSubDtl = "ch_gen_tbl_utl_menu_dtlsub";
    private $tableFactory = "ch_gen_tbl_mst_factory";
    private $tableFactoryAccess = "ch_gen_tbl_utl_factory_access";

    function getAllUsers()
    {
        $this->db->select("userid, position_name, groupid, user_group_name, firstname, lastname, mobilenumber, c.factory_name");
        $this->db->join("ch_gen_tbl_utl_user_group b", "a.groupid = b.user_group_id");
        $this->db->join("gen_tbl_mst_factory c", "a.groupid = b.user_group_id", "left");
        $this->db->join("gen_tbl_mst_position d", "a.position_id = d.position_id");
        $this->db->group_by("userid");

        return $this->db->get("ch_gen_tbl_user a")->result();
    }

    // Region Group Users
    function getAllGroup()
    {
        return $this->db->get($this->tableGroup)->result();
    }

    function saveGroupUser($param)
    {
        return $this->db->insert($this->tableGroup, $param);
    }
    // End Region Group Users

    // Region Menu
    function saveMenu($param, $headerId, $userId)
    {
        if ($param['menu_level'] == 1) {
            $data = [
                "menuhdr_id"    => $param['menu_id'],
                "menuhdr_title" => $param['title'],
                "created_by"    => $userId,
                "created_date"  => date("Y-m-d H:i:s")
            ];
            $save = $this->db->insert($this->tableMenuHdr, $data);
        } else if ($param['menu_level'] == 2) {
            $data = [
                "menudtl_id"    => $param['menu_id'],
                "menudtl_title" => $param['title'],
                "menudtl_link" => $param['link'],
                "menudtl_icon" => $param['icon'],
                "menuhdr_id" => $headerId,
                "created_by"    => $userId,
                "created_date"  => date("Y-m-d H:i:s")
            ];
            $save = $this->db->insert($this->tableMenuSub, $data);
        } else if ($param['menu_level'] == 3) {
            $data = [
                "menudtlsub_id"    => $param['menu_id'],
                "menudtlsub_title" => $param['title'],
                "menudtlsub_link" => $param['link'],
                "menudtlsub_icon" => $param['icon'],
                "menudtl_id" => $headerId,
                "created_by"    => $userId,
                "created_date"  => date("Y-m-d H:i:s")
            ];
            $save = $this->db->insert($this->tableMenuSubDtl, $data);
        }




        if ($save) {
            return true;
        } else {
            return false;
        }
    }

    function deletedMenu($param, $userId)
    {
        if ($param['menu_level'] == 1) {

            $this->db->where('menuhdr_id', $param['menu_id']);
            $deleted = $this->db->delete($this->tableMenuHdr);
        } elseif ($param['menu_level'] == 2) {

            $this->db->where('menudtl_id', $param['menu_id']);
            $deleted = $this->db->delete($this->tableMenuSub);
        } elseif ($param['menu_level'] == 3) {

            $this->db->where('menudtlsub_id', $param['menu_id']);
            $deleted = $this->db->delete($this->tableMenuSubDtl);
        }

        return $deleted;
    }
    // End Region Menu

    // Region Menu Access 
    function SaveAccess($param)
    {
        $this->db->trans_begin();

        $this->db->where("user_group_id", $param['group_id']);
        $delete = $this->db->delete($this->tableMnuAccess);

        if ($delete) {
            foreach ($param['menu_id'] as $key => $val) :
                $data[] = [
                    "user_group_id" => $param['group_id'],
                    "menu_id" => $val,
                ];
            endforeach;

            $this->db->insert_batch($this->tableMnuAccess, $data);
        }

        // $this->db->where("user_group_id", $param['group_id']);
        // $deleteFactoryAccess = $this->db->delete($this->tableFactoryAccess);
        // if ($deleteFactoryAccess) {
        //     foreach ($param['factory_id'] as $key => $val) :
        //         $dataFa[] = [
        //             "user_group_id" => $param['group_id'],
        //             "factory_id" => $val,
        //         ];
        //     endforeach;

        //     $this->db->insert_batch($this->tableFactoryAccess, $dataFa);
        // }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    // End Region Menu Access
}
