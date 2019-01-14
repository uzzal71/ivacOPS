<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_register_controller extends CI_Controller {

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

    /**asset_register
    * Class create function
    */
    public function create()
    {
    	$data['page_name'] = 'asset_register/add_asset_register';
		$data['page_title'] = 'Asset Register';
		$this->load->view('backend/index',$data);
    }

    /**
    * Class View Function
    */
    public function view()
    {
        $data['page_name'] = 'asset_register/asset_register_list';
        $data['page_title'] = 'Asset Register';
        $this->load->view('backend/index',$data); 
    }


    /**
    *Class Save Income Entry Function
    **/
    public function save_asset_entry()
    {
        $row_count = $this->input->post('number_row', true);
        for($index = 1, $range = 0; $index <= $row_count; $index++, $range++)
        {        
        $center_id = $this->input->post('center_id', true);
        $asset_id = $this->input->post('asset_id', true);
        $asset_name = $this->input->post('asset_name', true);
        $purchase_value = $this->input->post('purchase_value', true);
        $quantity = $this->input->post('quantity', true);        
        $asset_amount = $this->input->post('asset_amount', true);
        $depreciation_rate = $this->input->post('depreciation_rate', true);
        $date = $this->input->post('date', true);
        $remarks = $this->input->post('remarks', true);
        $created_at = date("y-m-d h:i:s");
        $created_by = $this->session->userdata('employee_id');


      $sql = "INSERT INTO `tbl_asset_register_log`(`center_id`, `asset_id`, `asset_name`, `purchase_value`, `quantity`, `asset_amount`, `depreciation_rate`, `remarks`, `date`, `created_at`, `created_by`) VALUES ('$center_id', '$asset_id[$range]','$asset_name[$range]', '$purchase_value[$range]', '$quantity[$range]', '$asset_amount[$range]', '$depreciation_rate[$range]', '$remarks[$range]', '$date', '$created_at', '$created_by')";
      $this->db->query($sql);

        }
        echo "Asset Information Saved!";
        return;
    }

    /**
    ** Edit Asset Register
    **/
    public function edit($id)
    {
        $data['page_name'] = 'asset_register/edit_asset_register';
        $data['page_title'] = 'Asset Edit';
        $data['id'] = $id;
        $this->load->view('backend/index',$data);
    }

    /**
    * Class Asset Register Delete Function
    **/
    public function destory($id)
    {
        $result=$this->asset_register->delete_data($id);
        $message = "Asset has been Deleted!";
        $this->session->set_userdata('message', $message);
        redirect('asset_register_controller/view');
    }

    /**
    **update_asset_info
    **/
    public function update_asset_info()
    {
        $id = $this->input->post('center_id', true);
        $data['center_id'] = $this->input->post('center_id', true);
        $data['asset_id'] = $this->input->post('asset_id', true);
        $data['asset_name'] = $this->input->post('asset_name', true);
        $data['purchase_value'] = $this->input->post('purchase_value', true);
        $data['quantity'] = $this->input->post('quantity', true);        
        $data['asset_amount'] = $this->input->post('asset_amount', true);
        $data['depreciation_rate'] = $this->input->post('depreciation_rate', true);
        $data['date'] = $this->input->post('date', true);
        $data['remarks'] = $this->input->post('remarks', true);
        $data['created_at'] = date("y-m-d h:i:s");
        $data['created_by'] = $this->session->userdata('employee_id');

        $this->asset_register->update($id, $data);
        echo "Asset has been Updated!";

    }



	
}