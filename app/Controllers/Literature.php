<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;

class Literature extends Security_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->access_only_team_members();
    }

    function modal_form()
    {
        $view_data['model_info'] = $this->Literature_model->get_one($this->request->getPost('id'));
        $client_id = $view_data['model_info']->lit_to;
        $view_data["client_info"] = $this->Clients_model->get_one($client_id);
        $view_data['sources'] = $this->Lead_source_model->get_details()->getResult();
        return $this->template->view('leads/literature/modal_form', $view_data);
    }


    function save()
    {
        $literId = $this->request->getPost('litId');
        $client_id = $this->request->getPost('from');
        if ($literId) {
            if (isset($_FILES['add_literature_file'])) {
                $file_name = rand() . $_FILES['add_literature_file']['name'];
                $cds_file_name = "/files/cds_files/" . $file_name;
                $file = $this->request->getFile('add_literature_file');
                $file->move('./files/literature_images', $file_name);
            } else {
                $file_name =  $this->request->getPost('litOldFile');
            }
        } else {
            $file_name = rand() . $_FILES['add_literature_file']['name'];
            $cds_file_name = "/files/cds_files/" . $file_name;
            $file = $this->request->getFile('add_literature_file');
            $file->move('./files/literature_images', $file_name);
        }
        $data = array(
            "lit_from" => $this->request->getPost('from'),
            "lit_to" => $this->request->getPost('to'),
            "lit_date" => $this->request->getPost('literature_date'),
            "lit_mode" => $this->request->getPost('lead_source_id'),
            "lit_file" => $file_name,
            "lit_status" => $this->request->getPost('status'),
            "lit_created_date" => get_current_utc_time(),
            "created_by" =>  $client_id,
        );

        $data = clean_data($data);
        if ($this->request->getPost('status') == '1') {
            $save_id = $this->Literature_model->ci_save($data, $literId);
            $data = array(
                "lead_status_id" => 2,
            );

            $data = clean_data($data);
            $clientStatusUpdate = $this->request->getPost('to');
            $clientId = $this->Clients_model->ci_save($data, $clientStatusUpdate);
        } else {
            $save_id = $this->Literature_model->ci_save($data, $literId);
            $data = array(
                "lead_status_id" => 1,
            );

            $data = clean_data($data);
            $clientStatusUpdate = $this->request->getPost('to');
            $clientId = $this->Clients_model->ci_save($data, $clientStatusUpdate);
        }


        /**
         * Activity Model
         */
        if ($literId) {
            $status = 'Updated';
        } else {
            $status = 'Created';
        }
        $statusdata = array(
            "sesion_id" => $_SESSION['user_id'],
            "lead_id" => $this->request->getPost('to'),
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

        $note_info = $this->Literature_model->get_one($id);

        if ($this->Literature_model->delete($id)) {
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
        $list_data = $this->Literature_model->get_details($options)->getResult();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    private function _row_data($id)
    {
        $options = array("id" => $id);
        $data = $this->Literature_model->get_details($options)->getRow();
        return $this->_make_row($data);
    }



    private function _make_row($data)
    {
        if ($data->created_by == $this->login_user->id || $this->login_user->is_admin) {
            $actions = modal_anchor(get_uri("Literature/modal_form"), "<i data-feather='edit' class='icon-16'></i>", array("class" => "edit", "title" => app_lang('edit_literature'), "data-post-id" => $data->id))
                . js_anchor("<i data-feather='x' class='icon-16'></i>", array('title' => app_lang('delete_literature'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("Literature/delete"), "data-action" => "delete-confirmation"));
        }
        if ($data->lit_status == 0) {
            $status = "<a href='#'><span class='badge bg-primary litstatus' data-id='$data->id' data-to='$data->lit_to' title='Click to sent literature'> Literature Create</span></a>";
        } else {
            $status = ("<span class='badge bg-green'>Literature Sent</span>");
        }
        $row_data = array(
            $data->first_name,
            $data->lit_date,
            $data->lit_file,
            $status,
            $actions
        );
        return $row_data;
    }

    function status()
    {
        /**
         * Lead status change
         */
        $literId = $this->request->getPost('id');
        $data = array(
            "lit_status" => 1,
        );
        $data = clean_data($data);
        $save_id = $this->Literature_model->ci_save($data, $literId);
        /**
         * Client status change
         */
        $clientStatData = array(
            "lead_status_id" => 2,
        );
        $clientStatData = clean_data($clientStatData);
        $clientStatusUpdate = $this->request->getPost('to');
        $clientId = $this->Clients_model->ci_save($clientStatData, $clientStatusUpdate);
        /**
         * Lead Activity Status Model
         */
        $status = 'Literature Sent';
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
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => 'Literature Sent'));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('error_occurred')));
        }
    }
}

/* End of file notes.php */
/* Location: ./app/controllers/notes.php */
