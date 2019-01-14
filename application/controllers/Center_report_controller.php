<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Center class extends CI_Controller
*/
class Center_report_controller extends CI_Controller
{
	/**
	* Class Controller
	*/
	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_login') != 1) {
				redirect(site_url(), 'refresh');
		}
    }

    /**
    * Center Report Function
    */
	public function center_report()
	{
		$data['page_name'] = 'center_report/center_report';
		$data['page_title'] = 'Center Report';
		$this->load->view('backend/index',$data);
	}

	/**
	* Class Monthly Balance Sheet Function
	**/
	public function monthly_balance_sheet()
	{
		$center_id = $this->input->post('center_id', true);
		$data['year_month'] = $this->input->post('year_month', true);
		$data['center_id'] = $center_id;
		$data['centers'] = $this->income_entry->get_center_name($center_id);
		$this->load->view('backend/admin/center_report/monthly_balance_sheet', $data);
	}

	/**
	* Class Yearly Balance Sheet Function
	**/
	public function yearly_balance_sheet()
	{
		$center_id = $this->input->post('center_id', true);
		$data['year'] = $this->input->post('year', true);
		$data['center_id'] = $center_id;
		$data['centers'] = $this->income_entry->get_center_name($center_id);
		$this->load->view('backend/admin/center_report/yearly_balance_sheet', $data);
	}

	/**
	* Class Asset Register Sheet Function
	**/
	public function asset_sheet()
	{
		$center_id = $this->input->post('center_id', true);
		$data['year'] = $this->input->post('year', true);
		$data['center_id'] = $center_id;
		$data['centers'] = $this->income_entry->get_center_name($center_id);
		$this->load->view('backend/admin/center_report/asset_sheet', $data);
	}

	/**
	* Class Income Report Function
	**/
	public function income_report()
	{
		$this->load->view('backend/admin/center_report/income_report');
	}

	/**
	* Class Expense Report Function
	**/
	public function expense_report()
	{
		$this->load->view('backend/admin/center_report/expense_report');
	}

	/**
	* Class Income Details Report Function
	**/
	public function income_report_details()
	{
		$center_id = $this->input->post('center_id', true);
		$data['from'] = $this->input->post('from', true);
		$data['to'] = $this->input->post('to', true);
		$data['center_id'] = $center_id;
		$data['centers'] = $this->income_entry->get_center_name($center_id);
		$this->load->view('backend/admin/center_report/income_report_details', $data);
	}

	/**
	* Class Expense Details Report Function
	**/
	public function expense_report_details()
	{
		$center_id = $this->input->post('center_id', true);
		$data['from'] = $this->input->post('from', true);
		$data['to'] = $this->input->post('to', true);
		$data['center_id'] = $center_id;
		$data['centers'] = $this->income_entry->get_center_name($center_id);
		$this->load->view('backend/admin/center_report/expense_report_details', $data);
	}

	/**
	* Income Report Excel Generator
	**/
	public function income_report_details_excel()
	{
		$this->load->view('backend/admin/center_report/income_report_details_excel');
	}

	/**
	**expense_report_details_excel
	**/
	public function expense_report_details_excel()
	{
		$this->load->view('backend/admin/center_report/expense_report_details_excel');
	}

	/**
	**asset_sheet_excel
	**/
	public function asset_sheet_excel()
	{
		$this->load->view('backend/admin/center_report/asset_sheet_excel');
	}

	/**
	**monthly_balance_sheet_excel
	**/
	public function monthly_balance_sheet_excel()
	{
		$this->load->view('backend/admin/center_report/monthly_balance_sheet_excel');
	}

	/**
	**yearly_balance_sheet_excel
	**/
	public function yearly_balance_sheet_excel()
	{
		$this->load->view('backend/admin/center_report/yearly_balance_sheet_excel');
	}

}