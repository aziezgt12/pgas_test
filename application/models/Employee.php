<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Model
{
   function getAll($param = null)
   {
        $this->db->select('a.ID AS IDEmployee, a.Name AS NAME_Employee, b.Name AS Name_Department, b.ID AS DeptID');
        $this->db->from('employee a');
        $this->db->join('department b', 'a.DepartmentID = b.ID');

        if(strlen($param['employeeName']) > 0)
        {
            $this->db->like('a.Name', $param['employeeName']);
        }
        if(strlen($param['deptId']) > 0)
        {
            $this->db->where('b.ID', $param['deptId']);
        }
        
        $query = $this->db->get();
        $result = $query->result();
        return $result;
   }

   function save($param)
   {
        if($param['ID'] > 0)
        {
            $this->db->where("ID", $param['ID']);
            $sql = $this->db->update('employee', $param);

        }else{
            $sql = $this->db->insert('employee', $param);
        }

        if($sql) return true;

        return false;
   }

   function destroy($id)
   {
        $this->db->where('ID', $id);
        $sql = $this->db->delete('employee');

        if($sql) return true;

        return false;
   }
}
