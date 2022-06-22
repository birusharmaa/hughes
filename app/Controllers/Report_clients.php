<?php

namespace App\Controllers;

class Report_clients extends Security_Controller
{

    function __construct()
    {
        parent::__construct();

        //check permission to access this module
        $this->init_permission_checker("client");
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

    


    private function _make_row($i, $data, $custom_fields){

        $group_list = "";
        if ($data->client_groups) {
            $groups = explode(",", $data->client_groups);
            foreach ($groups as $group) {
                if ($group) {
                    $group_list .= "<li>" . $group . "</li>";
                }
            }
        }

        if ($group_list) {
            $group_list = "<ul class='pl15'>" . $group_list . "</ul>";
        }

        $row_data = array(
            '# '.$i,
            '<span style="color:'.$data->color.'">'.$data->title."<span>",
            $data->count_row
        );

        foreach ($custom_fields as $field) {
            $cf_id = "cfv_" . $field->id;
            $row_data[] = $this->template->view("custom_fields/output_" . $field->field_type, array("value" => $data->$cf_id));
        }
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


    function dispatch_advice_list_data_of_client($client_id = 0, $options)
    {
        validate_numeric_value($client_id);
        $this->check_access_to_store();

        $list_data = $this->Orders_model->get_clients_reports($options)->getResult();     
        $result = array();
        $i = 1;
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($i, $data, $custom_fields);
            $i++;
        }  
        echo json_encode(array("data" => $result));
    }
}