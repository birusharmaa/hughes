<?php

namespace App\Controllers;

class Payment extends Security_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->access_only_team_members();
    }

    function modal_form()
    {
        $payId = $this->request->getPost('client_id');
        $view_data['model_info'] = $this->Clients_model->get_one($payId);
        $view_data['payment_methods'] = $this->Payment_methods_model->get_all_where(array("deleted" => 0))->getResult();
        $view_data['paydata'] = $this->Invoice_payments_model->get_one($this->request->getPost('id'));
        $view_data["owners_dropdown"] = $this->_get_owners_dropdown();
        $view_data['sources'] = $this->Lead_source_model->get_details()->getResult();
        return $this->template->view('clients/payments/modal_form', $view_data);
    }
    private function _get_owners_dropdown($view_type = "")
    {
        $team_members = $this->Users_model->get_all_where(array("user_type" => "staff", "deleted" => 0, "status" => "active"))->getResult();
        $team_members_dropdown = array();

        if ($view_type == "filter") {
            $team_members_dropdown = array(array("id" => "", "text" => "- " . app_lang("owner") . " -"));
        }

        foreach ($team_members as $member) {
            $team_members_dropdown[] = array("id" => $member->id, "text" => $member->first_name . " " . $member->last_name);
        }

        return $team_members_dropdown;
    }

    function save()
    {
        $payId = $this->request->getPost('id');
        
        $data = array(
            "amount" => $this->request->getPost('amount'),
            "payment_date" => $this->request->getPost('payment_date'),
            "payment_method_id" => $this->request->getPost('cashPayMeth'),
            "note" => $this->request->getPost('note'),
            "invoice_id" => $this->request->getPost('invoice_id'),
            "clientId" => $this->request->getPost('client_id'),
            "transaction_id" => $this->request->getPost('transaction_id'),
            "created_at" => get_current_utc_time(),
            "created_by" =>  $this->request->getPost('session_id'),
            
        );
        $data = clean_data($data);
        $save_id = $this->Invoice_payments_model->ci_save($data, $payId);
        if ($save_id) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => app_lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('error_occurred')));
        }
    }

    function delete()
    {
        $this->validate_submitted_data(array(
            "id" => "required|numeric"
        ));
        $id = $this->request->getPost('id');
        $note_info = $this->Invoice_payments_model->get_one($id);
        if ($this->Invoice_payments_model->delete($id)) {
            $file_path = get_setting("timeline_file_path");
            if ($note_info->files) {
                $files = unserialize($note_info->files);

                foreach ($files as $file) {
                    delete_app_files($file_path, array($file));
                }
            }
            echo json_encode(array("success" => true, 'message' => app_lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('record_cannot_be_deleted')));
        }
    }

    function list_data($type = "", $id = 0)
    {
       
        validate_numeric_value($id);
        $options = array();
        $options["id"] = $id;
        $list_data = $this->Invoice_payments_model->get_details($options)->getResult();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }

    private function _row_data($id)
    {
        $options = array("id" => $id);
        $data = $this->Invoice_payments_model->get_details($options)->getRow();
        return $this->_make_row($data);
    }

    private function _make_row($data)
    {
        if ($data->created_by == $this->login_user->id || $this->login_user->is_admin) {
            $actions = modal_anchor(get_uri("Payment/modal_form"), "<i data-feather='edit' class='icon-16'></i>", array("class" => "edit", "title" => app_lang('edit_payment'), "data-post-id" => $data->id, "data-post-client" => $data->lead_id))
                . js_anchor("<i data-feather='x' class='icon-16'></i>", array('title' => app_lang('delete_payment'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("Payment/delete"), "data-action" => "delete-confirmation"));
        }
        return array(
            $data->invoice_id,
            $data->payment_date,
            $data->payment_method_title,
            $data->note,
            $data->amount,
            $actions
        );
    }
   
}
