<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('URL');
        $this->load->model('Taskmodel');
        $this->load->helper(array('form', 'url', "myurl"));
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('session');
    }

    public function index()
    {
        redirect_on_index("crud");
        $this->load->model('Taskmodel');
        $config['total_rows'] = $this->Taskmodel->count();
        $query ['table_count_row'] = $config['total_rows'];
        $config['first_link'] = 'First Page';
        $config['last_link'] = 'Last Page';
        $config['next_link'] = 'Next Page';
        $config['prev_link'] = 'Prev Page';
        $config['base_url'] = 'http://localhost/a/crud/index';
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $query['segment'] = $config['uri_segment'];
        $query['q'] = $this->Taskmodel->get($config['per_page'], $this->uri->segment($config['uri_segment']));
        $this->pagination->initialize($config);
        $query['pagination'] = $this->pagination->create_links();
        $this->load->view('main', $query);
    }
    /*
      public  function insertdata(){
          if (isset ($_POST['insert']) ){
              $title=$_POST['title'];
              $content=$_POST['content'];
              $this->Taskmodel->insert( $title,$content);
              redirect(base_url());
          }else{
              $this->load->view('insert');
          }
      }
      public function updatedata(){
          if(isset ($_POST['update'])){
              if($_POST['title']=="" && trim($_POST['content'])==""){
                  redirect(base_url()."updatedata?id=".$_POST['id']);
              }
              $this->Taskmodel->update($_POST['id'],$_POST['title'],$_POST['content']);
              redirect(base_url()."Crud");
          }else {
              $id=$_GET['id'];
              $this->load->view('update', compact("id"));
          }

  //        if (isset ($_POST['update']) and  !($_POST['title'])==Null and !($_POST['content'])==Null){
  //            $title=$_POST['title'];
  //            $content=$_POST['content'];
  //            $this->Taskmodel->update_model($id,$title,$content);
  //        }elseif (isset ($_POST['update']) and  ($_POST['title'])==Null and !($_POST['content'])==Null){
  //            redirect(base_url()."updatedata?id=".$id);
  //        }
  //        elseif (isset ($_POST['update']) and  !($_POST['title'])==Null and ($_POST['content'])==Null){
  //            redirect(base_url()."updatedata?id=".$id);
  //        } elseif (isset ($_POST['update']) and  ($_POST['title'])==Null and ($_POST['content'])==Null) {
  //            redirect(base_url() . "updatedata?id=" .$id);
  //        }
  //        else
    }
      }
      public function deletedata(){
          $id=$_GET['id'];
          $this->Taskmodel->delete($id);
          redirect(base_url());
      }*/
///////////////////////////////////////////////////////////
    public function insert()
    {
        $this->form_validation->set_rules('title', 'title', array('required', 'min_length[5]', 'max_length[30]', 'trim'));
        $this->form_validation->set_rules('tags', 'tags', array('required', 'min_length[5]', 'max_length[30]', 'trim'));
        $this->form_validation->set_rules('content', 'content', array('required', 'min_length[5]', 'max_length[30]', 'trim'));
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = $this->session->set_flashdata('title', $this->input->post('title'));
            $data['tags'] = $this->session->set_flashdata('tags', $this->input->post('tags'));
            $data['content'] = $this->session->set_flashdata('content', $this->input->post('content'));
            $this->load->view('insert', $data);
        } else {
            $all_tag = explode(",", $this->input->post('tags'));
            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $this->Taskmodel->insert($data, $all_tag);
            redirect(base_url() . "crud/index");
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules(
            'title',
            'عنوان',
            [
                'min_length[5]',
                'max_length[30]',

            ],
            [
                'min_length' => 'کمه',
                'max_length' => 'زیاده'
            ]
        );
        $this->form_validation->set_rules(
            'tags',
            'برچسب',
            [
                'min_length[5]',
                'max_length[30]',
                'trim'
            ],
            [
                'min_length' => 'sdfsdfsght',
                'max_length' => 'asdsadsaf'
            ]
        );
        $this->form_validation->set_rules('content','محتوا', array('min_length[5]','max_length[30]','trim'));
        if ($this->form_validation->run() == FALSE){
            $id = $this->input->get('id');
            $databaseData = $this->Taskmodel->find($id);
            $this->load->view('edit',compact('id', 'databaseData'));
        }else{
            $datatitle = $this->input->post('title');
           // $all_tag=explode(",", $this->input->post('tags'));
            $all_tag=$this->input->post('tags');
            //  var_dump($all_tag);
            $datacontent = $this->input->post('content');
            $this->Taskmodel->edit($_POST['id'], $datatitle,$datacontent, $all_tag);
            redirect(base_url() . "crud/");
        }
    }
    public function delete()
    {
        $id=$this->input->get('id');
        $this->Taskmodel->delete($id);
        redirect(base_url()."crud/");
    }

}

?>



