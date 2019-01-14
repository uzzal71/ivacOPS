<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income_entry_controller extends CI_Controller {

	/**
	* Class Constructor
	*/
	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_login') != 1) {
				redirect(site_url(), 'refresh');
		}
    }

    /**
    * Class create function
    */
    public function create()
    {
    	$data['page_name'] = 'income_entry/add_income_entry';
		$data['page_title'] = 'Income Entry';
        $data['last_id']=$this->income_entry->select_last_income_code();
		$this->load->view('backend/index',$data);
    }

    /**
    * Class View Function
    */
    public function view()
    {
        $data['page_name'] = 'income_entry/income_entry_list';
        $data['page_title'] = 'Income Entry';
        $this->load->view('backend/index',$data); 
    }

    /**
    * Class Pick Lastest Income Code Function
    **/
    public function pick_latest_income_code(){

        $ex_date=$this->input->post('incode_date',true);
            $newDate = date("Ym", strtotime($ex_date));
        $final="IN".$newDate;
        $income_code=$this->income_entry->pick_latest_income_code($final);

        foreach ($income_code as $income_code) {
            
        }

        $number=$income_code->lastid;


        if ($number==NULL) {
            $number="001";
        }else{

            $convert_last_id = (int)$number;
            $length = strlen((string)$convert_last_id);
            if($length == 1){
                //$number= "00".(string)($convert_last_id+1);
                $number= $convert_last_id+1;
                 if($number == 10) {
                    $number = "0".(string)($number);
                 }
                 else{
                    $number = "00".(string)($number);
                 }
            }
            else if($length == 2){
                $number= $convert_last_id+1;
                 if($number == 100) {
                    $number = (string)($number);
                 }
                 else{
                    $number = "0".(string)($number);
                 }
            }
            else {
                $number = $convert_last_id + 1;
            }
        }

        $value=$final.$number;
        echo $value;
    }

    /**
    * Class Get Income Amount
    **/
    public function get_income_amount(){       

        $income_id = $this->input->post('income_id',true);
        $income_amount = $this->income_entry->get_amount($income_id);
        //print_r($users);
        if($income_amount)
        {
            foreach($income_amount as $amount)
            {
                
                $result = $amount->income_amount;
            }
        
                echo $result;
        }

        else
            {
                echo "No User Found!";
            }
    }

    /**
    *Class Save Income Entry Function
    **/
    public function save_income_entry()
    {
        $row_count = $this->input->post('number_row', true);
        for($index = 1, $range = 0; $index <= $row_count; $index++, $range++)
        {
        $income_code = $this->input->post('income_code', true);
        $center_id = $this->input->post('center_id', true);
        $date = $this->input->post('date', true);
        $income_id = $this->input->post('income_id', true);
        $income_amount = $this->input->post('income_amount', true);
        $quantity = $this->input->post('quantity', true);
        $calculated_amount = $this->input->post('calculated_amount', true);
        $actual_amount = $this->input->post('actual_amount', true);
        $remarks = $this->input->post('remarks', true);
        $created_at = date("y-m-d h:i:s");
        $created_by = $this->session->userdata('employee_id');


      $sql = "INSERT INTO `tbl_daily_income_log`(`center_id`, `income_id`, `income_code`, `income_amount`, `quantity`, `calculated_amount`, `actual_amount`, `remarks`, `date`, `created_at`, `created_by`) VALUES ('$center_id', '$income_id[$range]', '$income_code', '$income_amount[$range]', '$quantity[$range]', '$calculated_amount[$range]', '$actual_amount[$range]', '$remarks[$range]', '$date', '$created_at', '$created_by')";
      $this->db->query($sql);

        }
        echo "Income Information Saved!";
        return;
    }

    /**
    * Class Income Delete Function
    **/
    public function destory($income_code)
    {
        $result=$this->income_entry->delete_data($income_code);
        $message = "Income has been Deleted!";
        $this->session->set_userdata('message', $message);
        redirect('income_entry_controller/view');
    }

    /**
    * Class View Single List Function
    **/
    public function single_list_view($income_code)
    {
        $data['income_code'] = $income_code;
        $this->load->view('backend/admin/income_entry/single_list_view', $data);
    }

    /**
    ** Class Edit Income Info function
    **/
    public function edit($income_code)
    {    
    $data['page_name'] = 'income_entry/edit_income_entry';
    $data['page_title'] = 'Income Entry';
    $data['income_info']=$this->income_entry->get_income_info_to_update($income_code);
    $this->load->view('backend/index',$data);

    }




	
}