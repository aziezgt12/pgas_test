<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackupController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->dbutil();
        $this->load->helper('file');
    }

    public function backupDatabase() {
        // Konfigurasi backup
        $prefs = array(
            'format'      => 'zip',             // Format backup, bisa 'gzip', 'zip', atau 'txt'
            'filename'    => 'medical_record.sql',   // Nama file backup
            'add_drop'    => TRUE,              // Menambahkan perintah DROP TABLE sebelum perintah CREATE TABLE
            'add_insert'  => TRUE,              // Menambahkan data INSERT ke dalam backup
            'newline'     => "\n"               // Karakter newline yang digunakan dalam file backup
        );

        // Membuat backup database
        $backup = $this->dbutil->backup($prefs);

        // Menyimpan backup ke dalam file
        write_file('C:\xampp\htdocs\medical_record/db'.date('dmy').'.zip', $backup);

        // Menampilkan pesan berhasil
        echo "Backup database berhasil.";
    }
}
