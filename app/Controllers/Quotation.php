<?php

namespace App\Controllers;

class Quotation extends Security_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->access_only_team_members();
    }

    function modal_form()
    {
        $lead_id = $this->request->getPost('client');
        $view_data['model_info'] = $this->Clients_model->get_one($lead_id);
        $view_data['quotData'] = $this->QuotationModel->get_one($this->request->getPost('id'));
        $view_data["owners_dropdown"] = $this->_get_owners_dropdown();
        $view_data['sources'] = $this->Lead_source_model->get_details()->getResult();
        return $this->template->view('leads/quotation/modal_form', $view_data);
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
        $quat_id = $this->request->getPost('quat_id');

        if ($quat_id) {
            if (isset($_FILES['file_upload'])) {
                $file_name = rand() . $_FILES['file_upload']['name'];
                $cds_file_name = "/files/file_upload/" . $file_name;
                $file = $this->request->getFile('file_upload');
                $file->move('./files/quatation_image', $file_name);
            } else {
                $file_name =  $this->request->getPost('QuotOldFile');
            }
        } else {
            if (isset($_FILES['file_upload'])) {
                $file_name = rand() . $_FILES['file_upload']['name'];
                $cds_file_name = "/files/file_upload/" . $file_name;
                $file = $this->request->getFile('file_upload');
                $file->move('./files/quatation_image', $file_name);
            }
        }

        $data = array(
            "date" => $this->request->getPost('quotation_date'),
            "mode" => $this->request->getPost('lead_source_id'),
            "product" => $this->request->getPost('product'),
            "quantity" => $this->request->getPost('quantity'),
            "supply_rate" => $this->request->getPost('rate_of_supply'),
            "app_rate" => $this->request->getPost('rate_of_application'),
            "freight" => $this->request->getPost('freight'),
            "other_terms" => $this->request->getPost('other_terms'),
            "lead_id" => $this->request->getPost('client_id'),
            "file" => $file_name,
            "status" => $this->request->getPost('status'),
            "created_date" => get_current_utc_time(),
            "created_by" =>  $this->request->getPost('session_id'),
        );
        $data = clean_data($data);
        $save_id = $this->QuotationModel->ci_save($data, $quat_id);
        if ($this->request->getPost('status') == '1') {
            $data = array(
                "lead_status_id" => 4,
            );

            $data = clean_data($data);
            $clientStatusUpdate = $this->request->getPost('client_id');
            $clientId = $this->Clients_model->ci_save($data, $clientStatusUpdate);
        }


        /**
         * Activity Model
         */
        if ($quat_id) {
            $status = 'Updated';
        } else {
            $status = 'Created';
        }
        $statusdata = array(
            "sesion_id" => $_SESSION['user_id'],
            "lead_id" => $this->request->getPost('client_id'),
            "status" => $status,
            "page" => 'Literature',
            "change_date_time" => get_current_utc_time(),
        );
        $statusdata = clean_data($statusdata);
        $statusInsert = $this->LeadActivityModel->ci_save($statusdata);




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
        $note_info = $this->QuotationModel->get_one($id);
        if ($this->QuotationModel->delete($id)) {
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
        $list_data = $this->QuotationModel->get_details($options)->getResult();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }

    private function _row_data($id)
    {
        $options = array("id" => $id);
        $data = $this->QuotationModel->get_details($options)->getRow();
        return $this->_make_row($data);
    }

    private function _make_row($data)
    {
        if ($data->created_by == $this->login_user->id || $this->login_user->is_admin) {
            $actions = modal_anchor(get_uri("Quotation/modal_form"), "<i data-feather='edit' class='icon-16'></i>", array("class" => "edit", "title" => app_lang('edit_Quotation'), "data-post-id" => $data->id, "data-post-client" => $data->lead_id))
                . js_anchor("<i data-feather='x' class='icon-16'></i>", array('title' => app_lang('delete_Quotation'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("Quotation/delete"), "data-action" => "delete-confirmation"));
        }
        if ($data->status == 0) {
            $status = "<a href='#'><span class='badge bg-primary status' data-id='$data->id' data-to='$data->lead_id' title='Click to sent Quotation'> Quotation Create</span></a>";
        } else {
            $status = ("<span class='badge bg-green'>Quotation Sent</span>");
        }
        return array(
            $data->date,
            $data->quantity,
            $data->supply_rate,
            $data->app_rate,
            $data->freight,
            $status,
            $actions
        );
    }
    function status()
    {
        /**
         * Lead status change
         */
        $ass_id = $this->request->getPost('id');
        $data = array(
            "status" => 1,
        );
        $data = clean_data($data);
        $save_id = $this->QuotationModel->ci_save($data, $ass_id);
        /**
         * Client status change
         */
        $clientStatData = array(
            "lead_status_id" => 4,
        );
        $clientStatData = clean_data($clientStatData);
        $clientStatusUpdate = $this->request->getPost('to');
        $clientId = $this->Clients_model->ci_save($clientStatData, $clientStatusUpdate);
        /**
         * Lead Activity Status Model
         */
        $status = 'Quotation Sent';
        $statusdata = array(
            "sesion_id" => $_SESSION['user_id'],
            "lead_id" => $this->request->getPost('to'),
            "status" => $status,
            "page" => 'Assessment',
            "change_date_time" => get_current_utc_time(),
        );
        $statusdata = clean_data($statusdata);
        $statusInsert = $this->LeadActivityModel->ci_save($statusdata);
        if ($save_id) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => 'Quotation Sent'));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('error_occurred')));
        }
    }
}
