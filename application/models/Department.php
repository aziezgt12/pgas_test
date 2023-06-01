<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department extends CI_Model
{
   function getAll($param = null)
   {
      if(strlen($param['deptId']) > 0)
      {
          $this->db->where('ID', $param['deptId']);
      }
      
      return $this->db->get('department')->result();
   }
   function save($param)
   {
        if($param['ID'] > 0)
        {
            $this->db->where("ID", $param['ID']);
            $sql = $this->db->update('department', $param);

        }else{
            $sql = $this->db->insert('department', $param);
        }

        if($sql) return true;

        return false;
   }

   function destroy($id)
   {
        $this->db->where('ID', $id);
        $sql = $this->db->delete('department');

        if($sql) return true;

        return false;
   }
}
