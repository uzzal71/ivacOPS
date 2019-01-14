<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scoreboard_controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_login') != 1) {
				redirect(site_url(), 'refresh');
		}
    }

    //create
    public function create()
    {
    	$data['page_name'] = 'scoreboard/scoreboard_add';
		$data['page_title'] = 'Performance Score';
		$this->load->view('backend/index',$data);
    }

    // save data
    public function save()
    {
        $data['employee_id'] = $this->input->post('employee_id', true);
        $data['center_id'] = $this->input->post('center_id', true);
        $data['date'] = $this->input->post('date', true);
        $data['recive'] = $this->input->post('recive', true);
        $data['delivery'] = $this->input->post('delivery', true);
        $data['scanning'] = $this->input->post('scanning', true);
        $data['backend'] = $this->input->post('backend', true);

        $result = $this->score->check_save_data_exist($data['employee_id'], $data['center_id'], $data['date']);

        if($result)
        {

            $error = "EMPLOYEE SCORE ALREADY EXIST!";
            $this->session->set_userdata('error', $error);
                
            redirect('scoreboard_controller/create');

        }
        else{

            $this->score->store($data);
            
            $message = "Employee Score added!";
            $this->session->set_userdata('message', $message);
                    
            redirect('scoreboard_controller/create');
            
        }

    }

    /**
    **save_multiple_score
    **/ 
    public function save_multiple_score()
    {
        $row_count = $this->input->post('number_row', true);

        for($index = 1, $range = 0; $index <= $row_count; $index++, $range++)
        {
        $employee_id = $this->input->post('employee_id', true);
        $center_id = $this->input->post('center_id', true);
        $date = $this->input->post('date', true);
        $receive = $this->input->post('receive', true);
        $delivery = $this->input->post('delivery', true);
        $scanning = $this->input->post('scanning', true);
        $backend = $this->input->post('backend', true);


      $sql = "INSERT INTO `employee_score`(`employee_id`, `date`, `center_id`, `receive`, `delivery`, `scanning`, `backend`) VALUES ('$employee_id[$range]', '$date', '$center_id', '$receive[$range]', '$delivery[$range]', '$scanning[$range]', '$backend[$range]')";
      $this->db->query($sql);

        }
        
        echo "Performance Score Saved!";

        return;
    }

    //view
    public function view()
    {
    	$data['page_name'] = 'scoreboard/scoreboard_list';
		$data['page_title'] = 'Scoreboard';
		$this->load->view('backend/index',$data);
    }

    //edit
    public function edit($id)
    {
    	$data['page_name'] = 'scoreboard/scoreboard_edit';
		$data['page_title'] = 'Scoreboard';
		$data['id'] = $id;
		$this->load->view('backend/index',$data);
    }

    //pick center name ajax reuest
    public function get_center_name()
    {
        $employee_id = $this->input->post('employee_id', true);
        $select_center_id = (object)$this->score->get_center_id($employee_id);
        foreach($select_center_id as $row):
            $center_id =  $row->center_id;
        endforeach;

        $select_center_name = (object)$this->score->get_center_name($center_id);
        foreach($select_center_name as $row):
            $center_name =  $row->center_name;
        endforeach;

        echo $center_id.','.$center_name;
    }

    //Update
    public function update($id)
    {
        $data['employee_id'] = $this->input->post('employee_id', true);
        $data['center_id'] = $this->input->post('center_id', true);
        $data['date'] = $this->input->post('date', true);
        $data['recieve'] = $this->input->post('recieve', true);
        $data['delivery'] = $this->input->post('delivery', true);
        $data['scanning'] = $this->input->post('scanning', true);
        $data['backend'] = $this->input->post('backend', true);

        $this->score->updated($id, $data);
        
        $message = "Employee Score Updated!";
        $this->session->set_userdata('message', $message);
                
        redirect('scoreboard_controller/view');
    }

    //delete
    public function destory($id)
    {
        $this->score->delete($id);
        $message = "Employee Score deleted!";
        $this->session->set_userdata('message', $message);
                
        redirect('scoreboard_controller/view');
    }

    // add behavior
    public function add_behavior()
    {
        $data['page_name'] = 'scoreboard/behavior_add';
        $data['page_title'] = 'Behavior';
        $this->load->view('backend/index',$data);
    }

    // save behavior
    public function save_behavior()
    {
        $month = $this->input->post('month', true);
        $year = $this->input->post('year', true);
        $data['behavior'] = $this->input->post('behavior', true);
        $data['late_day'] = $this->input->post('late_day', true);
        $data['working_day'] = $this->input->post('working_day', true);

       $arr = array('6th of', (string)$month,(string)$year);
       $date_created =  join(" ",$arr);
       $date = DateTime::createFromFormat('jS \o\f F Y', $date_created);
       $date_success =  $date->format('Y-m-d');
       $data['date'] = $date_success;

       $employee_id = $this->input->post('employee_id', true);
       $center_id = $this->input->post('center_id', true);
       $date = $data['date'];

       $data['center_id'] = $center_id;
       $data['employee_id'] = $employee_id;


        $result = $this->score->check_score_is_already_entry($date, $employee_id, $center_id);

        
        if($result)
        {
            $error = "Score already exist! Current month";
            $this->session->set_userdata('error', $error);      
            redirect('scoreboard_controller/add_behavior');
        }
        else
        {
            $this->score->saved_behavior($data);
            $message = "Score has been Added!";
            $this->session->set_userdata('message', $message);
                        
            redirect('scoreboard_controller/add_behavior');
        }

    }

    // behavior list
    public function behavior_list()
    {
        $data['page_name'] = 'scoreboard/behavior_list';
        $data['page_title'] = 'Behavior';
        $this->load->view('backend/index',$data);
    }

    // Edit behavior
    public function edit_behavior($id)
    {
        $data['page_name'] = 'scoreboard/behavior_edit';
        $data['page_title'] = 'Behavior';
        $data['id'] = $id;
        $this->load->view('backend/index',$data);
    }

    public function update_behavior()
    {
        $id = $this->input->post('id', true);
        $data['center_id'] = $this->input->post('center_id', true);
        $data['employee_id'] = $this->input->post('employee_id', true);
        $month = $this->input->post('month', true);
        $year = $this->input->post('year', true);
        $data['behavior'] = $this->input->post('behavior', true);
        $data['late_day'] = $this->input->post('late_day', true);
        $data['working_day'] = $this->input->post('working_day', true);
        $arr = array('6th of', (string)$month,(string)$year);
        $date_created =  join(" ",$arr);
        $date = DateTime::createFromFormat('jS \o\f F Y', $date_created);
        $date_success =  $date->format('Y-m-d');
        $data['date'] = $date_success;

        $this->score->updated_behavior($id, $data);

         $message = "Behavior has been Updated!";
        $this->session->set_userdata('message', $message);
                
        redirect('scoreboard_controller/behavior_list');
    }

    public function destory_behavior($id)
    {
        $this->score->delete_behavior($id);
        $message = " Behavior & working has been deleted!";
        $this->session->set_userdata('message', $message);
                
        redirect('scoreboard_controller/behavior_list');
    }


    // Save Receive Score
    public function save_receive_score()
    {
        $row_count = $this->input->post('number_row', true);

        for($index = 1, $range = 0; $index <= $row_count; $index++, $range++)
        {
        $employee_id = $this->input->post('employee_id', true);
        $center_id = $this->input->post('center_id', true);
        $date = $this->input->post('date', true);
        $receive = $this->input->post('receive', true);

      $sql = "INSERT INTO `employee_score`(`employee_id`, `date`, `center_id`, `receive`) VALUES ('$employee_id[$range]', '$date', '$center_id', '$receive[$range]')";
      $this->db->query($sql);

        }
        
        echo "Receive Score Saved!";

        return;
    }

	
}