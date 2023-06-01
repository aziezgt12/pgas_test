<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spending extends CI_Model
{
   function getAll($param = null)
   {
        $this->db->select('a.*, a.ID as idPsening, b.Name AS EmployeeName, c.Name AS DepartmentName');
        $this->db->from('spending a');
        $this->db->join('employee b', 'a.EmployeeID = b.ID');
        $this->db->join('department c', 'c.ID = b.DepartmentID');
        if($param['fromDate'] != 0 )

        {
            $this->db->where("Date between '".$param['fromDate']."' and '".$param['toDate']."' ");
        }
        if($param['value'] !=  0)
        {
            $this->db->where("Value", $param['value']);
        }
        $this->db->order_by('VALUE', 'asc');
        
        $query = $this->db->get();
        $result = $query->result();
            
        return $result;
   }

   function getAllReport($param = null)
   {
        $this->db->select('b.Name AS EmployeeName, c.Name AS DepartmentName, a.Date, a.Value');
        $this->db->from('spending a');
        $this->db->join('employee b', 'a.EmployeeID = b.ID');
        $this->db->join('department c', 'c.ID = b.DepartmentID');
        if($param['fromDate'] != 0 )
        {
            $this->db->where("Date between '".$param['fromDate']."' and '".$param['toDate']."' ");
        }
        if($param['value'] != 0)
        {
            $this->db->where("Value", $param['value']);
        }
        $this->db->order_by('VALUE', 'asc');
        
        $query = $this->db->get();
        $result = $query->result();
            
        return $result;
   }

   function save($param)
   {
        if($param['ID'] > 0)
        {
            $data = [
                'EmployeeID' => $param['EmployeeID'],
                'Date' => $param['Date'],
                'Value' => str_replace(',', '', $param['Value']),
            ];
            $this->db->where("ID", $param['ID']);
            $sql = $this->db->update('spending', $param);

        }else{
            $data = [
                'EmployeeID' => $param['EmployeeID'],
                'Date' => $param['Date'],
                'Value' => str_replace(',', '', $param['Value']),
            ];
            $sql = $this->db->insert('spending', $data);
        }

        if($sql) return true;

        return false;
   }

   function destroy($id)
   {
        $this->db->where('ID', $id);
        $sql = $this->db->delete('spending');

        if($sql) return true;

        return false;
   }

   function getAllValue()
   {
    return $this->db->group_by('Value')->get('spending')->result();
   }
}
