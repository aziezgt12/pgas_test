<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_Setting extends BaseController
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
		$this->load->model("Setting_model", "Setting");
		$this->load->model("Factory_model", "Factory");
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

		$data['titlePage'] = "Setting";

		$data['listOfUsers'] = $this->Setting->getAllUsers();
		$data['listOfGroup'] = $this->Setting->getAllGroup();
		$data['listOfMenu'] = $this->getMenu();
		$data['listOfFactory'] = $this->Factory->getAll();


		// echo "<pre>";
		// print_r($data['listOfFactory']);
		// echo "</pre>";
		// die;
		// print_r($_SESSION);
		// die;


		$this->layout('index', $data);
	}

	// Menu
	function saveMenu()
	{
		try {


			$param = $this->input->post();
			// echo $this->httpResponseCode(200, $param);
			// die;


			$headerId = 0;
			if ($param['menu_level'] > 1) {
				if ($param['menu_level'] == 2) {
					$headerId = $param['header'];
				} elseif ($param['menu_level'] == 3) {
					$getHeaderId = $this->getMenuHeaderId($param['header']);
					$headerId = $getHeaderId->menudtl_id;
				}
			}

			$save = $this->Setting->saveMenu($param, $headerId, $this->userId);

			if ($save) {
				echo $this->httpResponseCode(200, "Save Menu Successfully");
			} else {
				echo $this->httpResponseCode(400, "Wrong Queries");
			}
		} catch (\Throwable $th) {
			echo json_encode($th->getMessage());
		}
	}

	function deletedMenu()
	{
		try {


			$param = $this->input->post();


			$save = $this->Setting->deletedMenu($param, $this->userId);

			if ($save) {
				echo $this->httpResponseCode(200, "Delete Menu Successfully");
			} else {
				echo $this->httpResponseCode(400, "Wrong Queries");
			}
		} catch (\Throwable $th) {
			echo json_encode($th->getMessage());
		}
	}
	// End Menu


	// Menu Access
	function getMEnuAccess()
	{
		$listOfMenuAccess = $this->getMenuAccessByGroup($this->input->get("group_id"));

		$menuAcces = [];
		foreach ($listOfMenuAccess as $item) {
			$menuAcces[] = $item['menu_id'];
		}


		$listMenu = $this->getMenu();

		if ($listMenu) {
			echo "<ol class='dd-list' id='menuDetect'>";
			foreach ($listMenu as $val) :
				$checked = in_array($val['hdrId'], $menuAcces) == true ? "checked" : "";

				echo "<li class='dd-item' data-id='2' style='position: 'sticky'; top:'0px'; background-color: 'white'>";
				echo "<div class='dd-handle'><input $checked name='menu_id[]' type='checkbox' value='" . $val['hdrId'] . "' id='blankCheckbox' aria-label=''...'> " . $val['hdrId'] . " - " . $val['title'] . "</div>";
				echo "<ol class='dd-list'>";
				foreach ($val['menuLevel2'] as $levl2) :
					$checked = in_array($levl2['subMenuId'], $menuAcces) == true ? "checked" : "";
					echo "<li class='dd-item' data-id='3'>";
					echo "<div class='dd-handle'><input $checked name='menu_id[]' type='checkbox' value='" . $levl2['subMenuId'] . "' id='blankCheckbox' aria-label=''...'>  " . $levl2['subMenuId'] . " - " . $levl2['subMenuTitle'] . "</div>";
					echo "<ol class='dd-list'>";
					foreach ($levl2['menuLevel3'] as $lvl3) :
						$checked = in_array($lvl3['dtlMenuId'], $menuAcces) == true ? "checked" : "";
						echo "<li class='dd-item' data-id='6'>";
						echo "<div class='dd-handle'><input $checked name='menu_id[]' type='checkbox' value='" . $lvl3['dtlMenuId'] . "' id='blankCheckbox' aria-label=''...'> " . $lvl3['dtlMenuId'] . " - " . $lvl3['dtlTitle'] . "</div>";
						echo "</li>";
					endforeach;
					echo "</ol>";
					echo "</li>";
				endforeach;
				echo "</ol>";
				echo "</li>";
			endforeach;
			echo "</ol>";
		} else {
			echo "<div class='alert alert-danger' style='margin-top: 25px;'>Data Not Found</div>";
		}
	}

	function saveAccessMenu()
	{
		try {
			$param = $this->input->post();
			// echo json_encode($param);
			// die;

			$save = $this->Setting->SaveAccess($param);


			if ($save) {
				echo $this->httpResponseCode(200, $param['group_id']);
			} else {
				echo $this->httpResponseCode(400, "Wrong Queries");
			}
		} catch (\Throwable $th) {
			echo json_encode($th->getMessage());
		}
	}

	// End Menu Access

	// Group User
	public function saveMenuGroupUser()
	{
		try {
			$param = [];
			$param = $this->input->post();
			$param = array_merge($param, ['created_by' => $this->userId, "created_date" => date("Y-m-d H:i:s")]);


			$exec = $this->Setting->saveGroupUser($param);

			if ($exec) {
				echo $this->httpResponseCode(200, "Create Group Successfully");
			} else {
				echo $this->httpResponseCode(400, "Wrong Queries");
			}
		} catch (\Throwable $th) {
			echo json_encode($th->getMessage());
		}
	}
	// End Group User

	// Factory Access
	function getFactoryAccess()
	{
		$param = $this->input->post();

		$listFactory = $this->Factory->getAll();
		$listFactoryAccess = $this->Factory->getFactoryAccess($param['group_id']);

		$factoryAccess = [];
		foreach ($listFactoryAccess as $item) {
			$factoryAccess[] = $item->factory_id;
		}

		echo "<hr>";
		echo "<div class='form-group'>";
		echo "<label class='mb-3'>Factory Access</label>";
		echo "<div>";
		foreach ($listFactory as $item) :
			$checked = in_array($item->factory_id, $factoryAccess) == true ? "checked" : "";
			echo "<div class='custom-control custom-checkbox mb-2'>";
			echo "<input $checked type='checkbox' class='custom-control-input' id='customCheck1-$item->factory_abbr' data-parsley-multiple='groups' data-parsley-mincheck='2' name='factory_id[]' value='$item->factory_id'>";
			echo "<label class='custom-control-label' for='customCheck1-$item->factory_abbr'>$item->factory_name</label>";
			echo "</div>";
		endforeach;
		echo "</div>";
		echo "</div>";
	}
	// End Factory Access


}
