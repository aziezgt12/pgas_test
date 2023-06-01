<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_Spending extends BaseController
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
		$this->load->model("Employee", "Employee");
		$this->load->model("Department", "Dept");
		$this->load->model("Spending", "Spending");
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

		$data['titlePage'] = "List Of Spending";
		$data['list'] = $this->Employee->getAll();


		$data['listEmp'] = $this->Employee->getAll();

		// echo "<pre>";
		// print_r($data);
		// die;

		$this->layout('index', $data);
	}

	function getAjax()
	{
		$param = $this->input->post();
		// echo "<pre>";
		// print_r($param);
		// die;
		$data['list'] = $this->Spending->getAll($param);

		$this->load->view('view-table', $data);

	}

	function save()
	{
		try {
			$param = $this->input->post();
			
			if(strlen($param['EmployeeID']) ==0){
				echo $this->httpResponseCode("400", "employee is required");
				return;
			}


			if(strlen($param['Value']) ==0){
				echo $this->httpResponseCode("400", "value is required");
				return;
			}
			$exec = $this->Spending->save($param);


			if ($exec) {
				$lable = $param['ID'] > 0 ? "Update" : "Save";
				echo $this->httpResponseCode("200", "$lable Data Successfully");
			} else {
				echo $this->httpResponseCode("400", "Database Error");
			}
		} catch (\Throwable $th) {
			echo $this->httpResponseCode(400, $th->getMessage());
		}
	}

	function delete()
	{
		$sql = $this->Spending->destroy($this->input->post('id'));
		if ($sql) {
			echo $this->httpResponseCode("200", "Delete Data Successfully");
		} else {
			echo $this->httpResponseCode("400", "Database Error");
		}
	}

	function pdf()
	{
		
	}
}
