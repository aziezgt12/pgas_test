<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_Mst_User extends BaseController
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	/**
	 * [__construct description]
	 *
	 * @method __construct
	 */
	public function __construct()
	{
		// Load the constructer from MY_Controller
		parent::__construct();
		$this->load->model("Obat", "Obat");
	}

	/**
	 * [index description]
	 *
	 * @method index
	 *
	 * @return [type] [description]
	 */
	public function index()
	{

		$data['titlePage'] = "List Obat";
		$data['listUsers'] = $this->db->get_where('ch_gen_tbl_user', ['notactive' => 0])->result();

		$this->layout('index', $data);
	}

	function save()
	{
		try {
			$param = $this->input->post();
			$firstname = trim($param['firstname']);
			$userid = trim($param['userid']);
			$password = trim($param['password']);
			$c_password = trim($param['c_password']);

			if (empty($firstname)) {
				echo $this->httpResponseCode("400", "Fullname tidak boleh kosong");
				return;
			}

			if (empty($userid)) {
				echo $this->httpResponseCode("400", "Userid tidak boleh kosong");
				return;
			}

			$cekUser = $this->db->get_where('ch_gen_tbl_user', ['userid' => $userid])->row();

			$hashedPassword = md5(sha1(strtolower($password)));

			$data = [
				'firstname' => $firstname,
				'userid' => $userid,
			];

			if ($cekUser) {
				if (!empty($password) && !empty($c_password)) {
					if (empty($password)) {
						echo $this->httpResponseCode("400", "Password tidak boleh kosong");
						return;
					}
					if (empty($c_password)) {
						echo $this->httpResponseCode("400", "Confirm password tidak boleh kosong");
						return;
					}

					$data['userpassword'] = $hashedPassword;
				}

				$this->db->where('userid', $userid);
				$save = $this->db->update('ch_gen_tbl_user', $data);
				$action = 'Update';
			} else {
				if (empty($password)) {
					echo $this->httpResponseCode("400", "Password tidak boleh kosong");
					return;
				}
				if (empty($c_password)) {
					echo $this->httpResponseCode("400", "Confirm password tidak boleh kosong");
					return;
				}

				$data['userpassword'] = $hashedPassword;
				$save = $this->db->insert('ch_gen_tbl_user', $data);
				$action = 'Save';
			}

			if ($save) {
				echo $this->httpResponseCode("200", "$action Data Successfully");
			} else {
				echo $this->httpResponseCode("400", "Database Error");
			}

		} catch (\Throwable $th) {
			echo $this->httpResponseCode(400, $th->getMessage());
		}
	}

	function delete()
	{
		$this->db->where('userid', $this->input->post('id'));
		$sql = $this->db->delete('ch_gen_tbl_user');
		if ($sql) {
			echo $this->httpResponseCode("200", "Delete Data Successfully");
		} else {
			echo $this->httpResponseCode("400", "Database Error");
		}
	}
	


}
