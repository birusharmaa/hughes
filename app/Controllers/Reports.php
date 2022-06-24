<?php

namespace App\Controllers;

class Reports extends Security_Controller
{

    function __construct()
    {
        parent::__construct();

        //check permission to access this module
        $this->init_permission_checker("client");
    }

    /* load clients list view */

    function index($tab = "")
    {
        echo "Wrong Choice";
        exit;        
        $this->access_only_allowed_members();
        $view_data = $this->make_access_permissions_view_data();
        //$view_data['can_edit_clients'] = $this->can_edit_clients();
        $view_data["show_project_info"] = $this->can_manage_all_projects();
        $view_data["show_own_clients_only_user_id"] = $this->show_own_clients_only_user_id();
        $view_data['tab'] = clean_data($tab);
        $view_data["page_title"] = "";
        //return $this->template->rander("reports/pending_report", $view_data);
    }

    function pending_report($tab = ""){
        $this->access_only_allowed_members();
        $view_data = $this->make_access_permissions_view_data();
        $view_data["show_project_info"] = $this->can_manage_all_projects();
        $view_data["show_own_clients_only_user_id"] = $this->show_own_clients_only_user_id();
        $view_data['tab'] = clean_data($tab);
        $view_data["page_title"] = "Pending dispath reports";
        return $this->template->rander("reports/pending_reports_list", $view_data);
    }



    function list_data(){

        $options = [];
        if(!empty($this->request->getPost("start_date"))){
            $options = [
                'start_date' => $this->request->getPost("start_date"),
                'end_date' => $this->request->getPost("end_date"),
            ];
        }

        if($this->login_user->is_admin==1){
            $res =  $this->dispatch_advice_list_data_of_client('', $options);
        }else{
            $res =  $this->dispatch_advice_list_data_of_client($this->login_user->id, $options);
        }
        return $res;
    }

    function lead_status_report($tab = ""){
        $this->access_only_allowed_members();
        $view_data = $this->make_access_permissions_view_data();
        $view_data["show_project_info"] = $this->can_manage_all_projects();
        $view_data["show_own_clients_only_user_id"] = $this->show_own_clients_only_user_id();
        $view_data['tab'] = clean_data($tab);
        $view_data["page_title"] = "Lead status reports";
        return $this->template->rander("report_leads/report_leads_list", $view_data);
    }


    function client_status_report($tab = ""){
        $this->access_only_allowed_members();
        $view_data = $this->make_access_permissions_view_data();
        $view_data["show_project_info"] = $this->can_manage_all_projects();
        $view_data["show_own_clients_only_user_id"] = $this->show_own_clients_only_user_id();
        $view_data['tab'] = clean_data($tab);
        $view_data["page_title"] = "Client status reports";
        return $this->template->rander("report_clients/report_clients_list", $view_data);
    }

    function mis_payment($tab = ""){
        // $filename = 'users_' . date('Ymd') . '.csv';
        // header('Content-Type: text/csv; charset=utf-8');
		// header('Content-Disposition: attachment; filename=employees-' . $filename);
		// //$output = fopen('php://output', 'w');
        // $output = fopen('php://output', 'w');
        // $header = array("ID", "Name", "Email", "City");
        // $usersData = [
        //     [1, 'Biru Sharma', 'biru@gmail.com', 'Noida'], [1, 'Sharma Biru', 'biru@gmail.com2222', 'New Delhi']
        // ];

        // // file creation 
        // fputcsv($output, $header);
        // foreach ($usersData as $line) {
        //     fputcsv($output, $line);
        // }
        // fclose($output);
        
        
        $this->access_only_allowed_members();
        $view_data = $this->make_access_permissions_view_data();
        $view_data["show_project_info"] = $this->can_manage_all_projects();
        $view_data["show_own_clients_only_user_id"] = $this->show_own_clients_only_user_id();
        $view_data['tab'] = clean_data($tab);
        $view_data["page_title"] = "MIS reports";
        return $this->template->rander("report_mis_payment/report_mis_list", $view_data);
    }

    function pending_application_report($tab = ""){
        $this->access_only_allowed_members();
        $view_data = $this->make_access_permissions_view_data();
        $view_data["show_project_info"] = $this->can_manage_all_projects();
        $view_data["show_own_clients_only_user_id"] = $this->show_own_clients_only_user_id();
        $view_data['tab'] = clean_data($tab);
        $view_data["page_title"] = "Pending application reports";
        return $this->template->rander("report_clients/report_clients_list", $view_data);
    }


    private function _make_row($data, $custom_fields = null){

        // $group_list = "";
        // if ($data->client_groups) {
        //     $groups = explode(",", $data->client_groups);
        //     foreach ($groups as $group) {
        //         if ($group) {
        //             $group_list .= "<li>" . $group . "</li>";
        //         }
        //     }
        // }

        // if ($group_list) {
        //     $group_list = "<ul class='pl15'>" . $group_list . "</ul>";
        // }

        $row_data = array(
            'Order#'.$data->id,
            $data->company_name,
            $data->date,
            to_currency($data->total_amount),
            '<span style="color:'.$data->color.'">'.$data->dispatch_title."<span>"
        );

        // foreach ($custom_fields as $field) {
        //     $cf_id = "cfv_" . $field->id;
        //     $row_data[] = $this->template->view("custom_fields/output_" . $field->field_type, array("value" => $data->$cf_id));
        // }
        return $row_data;
    }

    private function make_access_permissions_view_data() {

        $access_invoice = $this->get_access_info("invoice");
        $view_data["show_invoice_info"] = (get_setting("module_invoice") && $access_invoice->access_type == "all") ? true : false;

        $access_estimate = $this->get_access_info("estimate");
        $view_data["show_estimate_info"] = (get_setting("module_estimate") && $access_estimate->access_type == "all") ? true : false;

        $access_estimate_request = $this->get_access_info("estimate_request");
        $view_data["show_estimate_request_info"] = (get_setting("module_estimate_request") && $access_estimate_request->access_type == "all") ? true : false;

        $access_order = $this->get_access_info("order");
        $view_data["show_order_info"] = (get_setting("module_order") && $access_order->access_type == "all") ? true : false;

        $access_proposal = $this->get_access_info("proposal");
        $view_data["show_proposal_info"] = (get_setting("module_proposal") && $access_proposal->access_type == "all") ? true : false;

        $access_ticket = $this->get_access_info("ticket");
        $view_data["show_ticket_info"] = (get_setting("module_ticket") && $access_ticket->access_type == "all") ? true : false;

        return $view_data;
    }


    function dispatch_advice_list_data_of_client($client_id = 0, $date_option)
    {
        $options = array(
            "client_id" => $client_id
        ); 
        $options = array_merge($options, $date_option);
        
        $list_data = $this->Orders_model->get_details_dispatch_advice_reports($options)->getResult();      
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }  
        echo json_encode(array("data" => $result));
    }
}