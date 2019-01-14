<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_entry_controller extends CI_Controller {

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
    	$data['page_name'] = 'expense_entry/add_expense_entry';
		$data['page_title'] = 'Expense Entry';
        $data['last_id']=$this->expense_entry->select_last_expense_code();
		$this->load->view('backend/index',$data);
    }

    /**
    * Class View Function
    */
    public function view()
    {
        $data['page_name'] = 'expense_entry/expense_entry_list';
        $data['page_title'] = 'Expense Entry';
        $this->load->view('backend/index',$data); 
    }

    /**
    *
    **/
    public function pick_latest_expense_code(){

        $ex_date=$this->input->post('date',true);
            $newDate = date("Ym", strtotime($ex_date));
        $final="EX".$newDate;
        $expense_code=$this->expense_entry->pick_latest_expense_code($final);

        foreach ($expense_code as $expense_code) {
            
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

            //$numbers=$number+1;
        }

        $value=$final.$number;
        echo $value;
    }

    /**
    *Class Save Expense Entry Function
    **/
    public function save_expense_entry()
    {
        $row_count = $this->input->post('number_row', true);
        for($index = 1, $range = 0; $index <= $row_count; $index++, $range++)
        {
        $expense_code = $this->input->post('expense_code', true);
        $center_id = $this->input->post('center_id', true);
        $date = $this->input->post('date', true);
        $expense_id = $this->input->post('expense_id', true);
        $expense_amount = $this->input->post('expense_amount', true);
        $quantity = $this->input->post('quantity', true);
        $actual_amount = $this->input->post('actual_amount', true);
        $remarks = $this->input->post('remarks', true);
        $created_at = date("y-m-d h:i:s");
        $created_by = $this->session->userdata('employee_id');


      $sql = "INSERT INTO `tbl_daily_expense_log`(`center_id`, `expense_id`, `expense_code`, `expense_amount`, `quantity`, `actual_amount`, `remarks`, `date`, `created_at`, `created_by`) VALUES ('$center_id', '$expense_id[$range]', '$expense_code', '$expense_amount[$range]', '$quantity[$range]', '$actual_amount[$range]', '$remarks[$range]', '$date', '$created_at', '$created_by')";
      $this->db->query($sql);

        }
        echo "Expense Information Saved!";
        return;
    }

    /**
    * Class Expense Delete Function
    **/
    public function destory($expense_code)
    {
        $result=$this->expense_entry->delete_data($expense_code);
        $message = "Expense has been Deleted!";
        $this->session->set_userdata('message', $message);
        redirect('Expense_entry_controller/view');
    }

    /**
    *single_list_view
    **/
    public function single_list_view($expense_code)
    {
        $data['expense_code'] = $expense_code;
        $this->load->view('backend/admin/expense_entry/single_list_view', $data);
    }

    /**
    ** Class Expese info Edit Function
    **/
    public function edit($expense_code)
    {
        $data['page_name'] = 'expense_entry/edit_expense_entry';
        $data['page_title'] = 'Expense Edit';
        $data['expense_info']=$this->expense_entry->get_expense_info_to_update($expense_code);
        $this->load->view('backend/index',$data);
    }





	
}