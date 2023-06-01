<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat extends CI_Model
{
   function getAll()
   {
    return $this->db->get('tb_obat')->result();
   }
}
