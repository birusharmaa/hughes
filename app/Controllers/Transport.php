<?php

namespace App\Controllers;

class Transport extends Security_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->access_only_team_members();
    }
    /* load leads list view */

    function index()
    {
        $view_data["page_title"] = "transport";
        return $this->template->rander("transport/index", $view_data);
    }

    function transport_modal_form()
    {
        $view_data['trans'] = $this->TransporterModel->get_one($this->request->getPost('id'));
        $view_data['sources'] = $this->Lead_source_model->get_details()->getResult();
        return $this->template->view('transport/modal_form',$view_data);
    }
    function save()
    {
        $transId = $this->request->getPost('transId');
        $data = array(
            "date" => $this->request->getPost('transDate'),
            "address" => $this->request->getPost('address'),
            "gstno" => $this->request->getPost('gstno'),
            "vhno" => $this->request->getPost('vhno'),
            "transport_comp_name" => $this->request->getPost('transport_company_name'),
            "created_by" =>  $_SESSION['user_id'],
        );
        $data = clean_data($data);
        $save_id = $this->TransporterModel->ci_save($data, $transId);
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
        $note_info = $this->TransporterModel->get_one($id);
        if ($this->TransporterModel->delete($id)) {
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
        $list_data = $this->TransporterModel->get_details($options)->getResult();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }

    private function _row_data($id)
    {
        $options = array("id" => $id);
        $data = $this->TransporterModel->get_details($options)->getRow();
        return $this->_make_row($data);
    }

    private function _make_row($data)
    {
        if ($data->created_by == $this->login_user->id || $this->login_user->is_admin) {
            $actions = modal_anchor(get_uri("Transport/transport_modal_form"), "<i data-feather='edit' class='icon-16'></i>", array("class" => "edit", "title" => app_lang('edit_Quotation'), "data-post-id" => $data->id, "data-post-client" => $data->lead_id))
                . js_anchor("<i data-feather='x' class='icon-16'></i>", array('title' => app_lang('delete_Quotation'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("Transport/delete"), "data-action" => "delete-confirmation"));
        }
       
        return array(
            $data->date,
            $data->address,
            $data->gstno,
            $data->vhno,
            $actions
        );
    }
}
