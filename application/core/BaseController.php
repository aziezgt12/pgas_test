<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter-HMVC
 *
 * @package    CodeIgniter-HMVC
 * @author     N3Cr0N (N3Cr0N@list.ru)
 * @copyright  2019 N3Cr0N
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @link       <URI> (description)
 * @version    GIT: $Id$
 * @since      Version 0.0.1
 * @filesource
 *
 */

class BaseController extends MX_Controller
{
    //
    public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layout,....
     */
    protected $data = array();
    protected $userId = null;
    protected $groupId = null;
    protected $factoryId = null;

    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
        // To inherit directly the attributes of the parent class.
        parent::__construct();

        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI = &get_instance();

        // Copyright year calculation for the footer
        $begin = 2019;
        $end =  date("Y");
        $date = "$begin - $end";
        $this->data['copyright'] = $date;

        $this->userId = $this->session->userdata("userId");
        $this->groupId = $this->session->userdata("groupId");
        $this->factoryId = $this->session->userdata("factoryId");


        // Cek Session Login
        if (empty($this->userId)) {
            redirect("C_Auth");
        }

        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            error_reporting(1);
        } else {
            error_reporting(0);
        }
    }

    function layout($template, $data = null)
    {



        $data['listMenu'] = $this->getMenu($this->groupId);

        $data['_stylesheet']      = $this->load->view('layout/_partial/stylesheet', $data, true);
        $data['_menu']       = $this->load->view('layout/_partial/menu', $data, true);
        $data['_navigation'] = $this->load->view('layout/_partial/navigation', $data, true);
        $data['_titlePage'] = isset($data['titlePage']) ? $data['titlePage'] : "Not Set";
        $data['_content']    = $this->load->view($template, $data, true);
        $data['_script']     = $this->load->view('layout/_partial/script', $data, true);


        $this->load->view('/layout/index.php', $data);
    }

    function getMenu($groupId = null)
    {
        if ($groupId != null) {
            $this->db->where("b.user_group_id", $groupId);
            $this->db->join("ch_gen_tbl_utl_menu_access b", "b.menu_id = a.menuhdr_id");
            $menuLevel1 = $this->db->get('ch_gen_tbl_utl_menu_hdr a')->result_array();
        } else {
            $menuLevel1 = $this->db->get('ch_gen_tbl_utl_menu_hdr a')->result_array();
        }

        foreach ($menuLevel1 as $item) :

            $menuDetail = [];
            if ($groupId != null) {
                $this->db->where("b.user_group_id", $groupId);
                $this->db->where("menuhdr_id", $item['menuhdr_id']);
                $this->db->join("ch_gen_tbl_utl_menu_access b", "b.menu_id = a.menudtl_id");
                $menuLevel2 = $this->db->get('ch_gen_tbl_utl_menu_dtl a')->result_array();
            } else {
                $menuLevel2 = $this->db->where("menuhdr_id", $item['menuhdr_id'])->get('ch_gen_tbl_utl_menu_dtl')->result_array();
            }

            foreach ($menuLevel2 as $subMenu) {
                $detlSub = [];

                if ($groupId != null) {
                    $this->db->where("b.user_group_id", $groupId);
                    $this->db->where("menudtl_id", $subMenu['menudtl_id']);
                    $this->db->join("ch_gen_tbl_utl_menu_access b", "b.menu_id = a.menudtlsub_id");
                    $menuLevel3 = $this->db->get('ch_gen_tbl_utl_menu_dtlsub a')->result_array();
                } else {
                    $menuLevel3 = $this->db->where("menudtl_id", $subMenu['menudtl_id'])->get('ch_gen_tbl_utl_menu_dtlsub')->result_array();
                }


                foreach ($menuLevel3 as $dtlSubmenu) {
                    $detlSub[] = [
                        "hdr"       => $dtlSubmenu['menudtl_id'],
                        "dtlMenuId" => $dtlSubmenu['menudtlsub_id'],
                        "dtlTitle"     => $dtlSubmenu['menudtlsub_title'],
                        "dtlLink"      => $dtlSubmenu['menudtlsub_link'],
                        "dtlIcon"      => $dtlSubmenu['menudtlsub_icon'],
                    ];
                }

                $menuDetail[] = [
                    "hdrId"        => $subMenu['menuhdr_id'],
                    "subMenuId"    => $subMenu['menudtl_id'],
                    "subMenuTitle" => $subMenu['menudtl_title'],
                    "subMenuLink" => $subMenu['menudtl_link'],
                    "subMenuIcon" => $subMenu['menudtl_icon'],
                    "menuLevel3"  => $detlSub
                ];
            }

            $listMenu[] = [
                "hdrId" => $item['menuhdr_id'],
                "title" => $item['menuhdr_title'],
                "style" => $item['menu_style'],
                "menuLevel2" => $menuDetail
            ];
        endforeach;

        if (count($menuLevel1) > 0) {
            return $listMenu;
        } else {
            return false;
        }
    }
    protected function getMenuAccessByGroup($group_id)
    {
        return $this->db->select('menu_id')->where("user_group_id", $group_id)->get('ch_gen_tbl_utl_menu_access')->result_array();
    }
    protected function getMenuHeaderId($menuId)
    {
        return $this->db->get_where("ch_gen_tbl_utl_menu_dtl", ["menudtl_id" => $menuId])->row();
    }
    protected function httpResponseCode($code, $message)
    {
        return json_encode(["code" => $code, "message" => $message]);
    }
}
