<?php

namespace App\Controllers;
use Dompdf\Dompdf;
class DispatchAdvice extends Security_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->init_permission_checker("order");
        require_once 'dompdf/autoload.inc.php';
        
    }

    function index()
    {
        $this->check_access_to_store();

        $view_data["custom_field_headers"] = $this->Custom_fields_model->get_custom_field_headers_for_table("orders", $this->login_user->is_admin, $this->login_user->user_type);
        $view_data["custom_field_filters"] = $this->Custom_fields_model->get_custom_field_filters("orders", $this->login_user->is_admin, $this->login_user->user_type);

        if ($this->login_user->user_type === "staff") {
            $view_data['order_statuses'] = $this->Order_status_model->get_details()->getResult();
            return $this->template->rander("orders/index", $view_data);
        } else {
            //client view
            $view_data["client_info"] = $this->Clients_model->get_one($this->login_user->client_id);
            $view_data['client_id'] = $this->login_user->client_id;
            $view_data['page_type'] = "full";

            return $this->template->rander("clients/orders/client_portal", $view_data);
        }
    }


    function modal_form(){        
        $orderId = $this->request->getPost('id');
        $clientID = $this->request->getPost('client');
        $view_data['order_info'] = $this->Orders_model->get_one($orderId);
        $view_data['clientInfo'] = $this->Clients_model->get_one($clientID);
        return $this->template->view('clients/orders/modal_form', $view_data);
    }

    
    /* load edit order modal */
    function modal_form_edit() {
        $this->access_only_allowed_members();

        $this->validate_submitted_data(array(
            "id" => "numeric",
            "client_id" => "numeric"
        ));     

      
        $view_data['transport_info'] = $this->TransporterModel->get_details()->getResult();      
        $view_data['model_info'] = $this->Orders_model->get_one($this->request->getPost('id'));
        $view_data['model_info2'] = $this->Order_items_model->get_one_where(['order_id' => 
        $this->request->getPost('id')]);
        $view_data['client_info'] = $this->Clients_model->get_one($view_data['model_info']->client_id);
       
        $view_data['dispatch_info'] = $this->Dispatch_model->get_one_where(['order_id' => 
        $this->request->getPost('id'),'client_id'=>$view_data['model_info']->client_id]); 

        $view_data["custom_fields"] = $this->Custom_fields_model->get_combined_details("orders", $view_data['model_info']->id, $this->login_user->is_admin, $this->login_user->user_type)->getResult();
        
        return $this->template->view('clients/dispatch_advice/modal_form_edit', $view_data);
    }

       /* load edit order modal */
    function modal_dispatch_order_edit() {
        $this->access_only_allowed_members();

        $this->validate_submitted_data(array(
            "id" => "numeric",
            "cover_id" => "numeric"
        ));     

        $id = $this->request->getPost('id');
        $cover_id = $this->request->getPost('cover_id');
        $view_data['covering_info'] = $this->Dispatch_Covering_model->get_one($cover_id);       
        $view_data['model_info'] = $this->Orders_model->get_one($id);
        $view_data['client_info'] = $this->Clients_model->get_one($view_data['model_info']->client_id);       
        $view_data['transport_info'] = $this->TransporterModel->get_one($view_data['dispatch_info']->transporter_id);   
        $view_data["custom_fields"] = $this->Custom_fields_model->get_combined_details("orders", $view_data['model_info']->id, $this->login_user->is_admin, $this->login_user->user_type)->getResult();
        $view_data['dispatch_info'] = $this->Dispatch_model->get_one_where(['order_id' => 
        $id,'client_id'=>$view_data['model_info']->client_id]); 
        return $this->template->view('clients/dispatch_advice/model_dispatch_covering', $view_data);
    }



    function process_order()
    {
        $this->check_access_to_store();
        $view_data = get_order_making_data();
        $view_data["cart_items_count"] = count($this->Order_items_model->get_all_where(array("created_by" => $this->login_user->id, "order_id" => 0, "deleted" => 0))->getResult());

        $view_data['clients_dropdown'] = "";
        if ($this->login_user->user_type == "staff") {
            $view_data['clients_dropdown'] = $this->_get_clients_dropdown();
        }

        $view_data["custom_fields"] = $this->Custom_fields_model->get_combined_details("orders", 0, $this->login_user->is_admin, $this->login_user->user_type)->getResult();

        return $this->template->rander("orders/process_order", $view_data);
    }

    function item_list_data_of_login_user()
    {
        $this->check_access_to_store();
        $options = array("created_by" => $this->login_user->id, "processing" => true);
        $list_data = $this->Order_items_model->get_details($options)->getResult();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_item_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    /* prepare a row of order item list table */

    private function _make_item_row($data)
    {
        $item = "<div class='item-row strong mb5' data-id='$data->id'><div class='float-start move-icon'><i data-feather='menu' class='icon-16'></i></div> $data->title</div>";
        if ($data->description) {
            $item .= "<span>" . nl2br($data->description) . "</span>";
        }
        $type = $data->unit_type ? $data->unit_type : "";

        return array(
            $data->sort,
            $item,
            to_decimal_format($data->quantity) . " " . $type,
            to_currency($data->rate),
            to_currency($data->total),
            modal_anchor(get_uri("orders/item_modal_form"), "<i data-feather='edit' class='icon-16'></i>", array("class" => "edit", "title" => app_lang('edit_item'), "data-post-id" => $data->id, "data-post-order_id" => $data->order_id))
                . js_anchor("<i data-feather='x' class='icon-16'></i>", array('title' => app_lang('delete'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("orders/delete_item"), "data-action" => "delete"))
        );
    }

    /* load item modal */

    function item_modal_form()
    {
        $this->check_access_to_store();
        $this->validate_submitted_data(array(
            "id" => "numeric"
        ));

        $id = $this->request->getPost('id');
        $model_info = $this->Order_items_model->get_one($id);
        if ($id) { //check permission only for existing item
            $this->check_access_to_this_order_item($model_info);
        }

        $view_data['model_info'] = $model_info;
        $view_data['order_id'] = $this->request->getPost('order_id');

        return $this->template->view('orders/item_modal_form', $view_data);
    }

    /* add or edit an order item */

    function save_item() {
        $this->check_access_to_store();
       
        $this->validate_submitted_data(array(
            "client_id" => "numeric"
        ));
    
        $order_id = $this->request->getPost("order_id");
        $dispatch_order_id = $this->request->getPost("dispatch_order_id");
        
        $client_id = $this->request->getPost('client_id');
     
        if($dispatch_order_id!='' && $dispatch_order_id>0){
            /* edit order item */
            $order_data = array(
                "advice_no" => $this->request->getPost('advice_no'),
                "staff" => $this->request->getPost('staff'),
                "vendor_code" => $this->request->getPost('vendor_code'),
                "destination" => $this->request->getPost('destination'),
                "transporter_id" => $this->request->getPost('transporter_id'),
                "distance_in_kms" => $this->request->getPost('distance_in_kms'),
                "road_permit" => $this->request->getPost('road_permit'),              
                "updated_at" => date("Y-m-d H:i:s"),  
                "updated_by" => $this->login_user->id  
            );        
            $res=$this->Dispatch_model->ci_save($order_data,$dispatch_order_id);     
         
            $redirect_to = get_uri("clients/view/$client_id");
            if($res){               
                echo json_encode(array("success" => true, "redirect_to" => $redirect_to,  
                    'message' => app_lang('record_saved')));
            }else{  
                echo json_encode(array("success" => false,
                "redirect_to" => $redirect_to, 
                'message' => app_lang('error_occurred')));
            }
          
        }else{
            /* add new order item */
            $order_data = array(
                "advice_no" => $this->request->getPost('advice_no'),
                "staff" => $this->request->getPost('staff'),
                "vendor_code" => $this->request->getPost('vendor_code'),
                "destination" => $this->request->getPost('destination'),
                "transporter_id" => $this->request->getPost('transporter_id'),
                "distance_in_kms" => $this->request->getPost('distance_in_kms'),
                "road_permit" => $this->request->getPost('road_permit'),
                "client_id" => $this->request->getPost('client_id'),
                "order_id" => $this->request->getPost('order_id'),  
                "order_staus" => 1,             
                "created_at" => date("Y-m-d H:i:s"),  
                "created_by" => $this->login_user->id  
            );
      
            $order_id = $this->Dispatch_model->ci_save($order_data);

           
            if($order_id){
                $redirect_to = get_uri("clients/view/$client_id");
                echo json_encode(array("success" => true, "redirect_to" => $redirect_to,  
                'message' => app_lang('record_saved')));
                  
            }else{
                $redirect_to = get_uri("clients/view/$client_id");
                echo json_encode(array("success" => false,
                "redirect_to" => $redirect_to, 
                'message' => app_lang('error_occurred')));
            }
         
          
        }
    }

    //update the sort value for order item
    function update_item_sort_values($id = 0)
    {
        $this->check_access_to_store();
        $sort_values = $this->request->getPost("sort_values");
        if ($sort_values) {

            //extract the values from the comma separated string
            $sort_array = explode(",", $sort_values);

            //update the value in db
            foreach ($sort_array as $value) {
                $sort_item = explode("-", $value); //extract id and sort value

                $id = get_array_value($sort_item, 0);
                $sort = get_array_value($sort_item, 1);

                $data = array("sort" => $sort);
                $this->Order_items_model->ci_save($data, $id);
            }
        }
    }

    /* delete or undo an order item */

    function delete_item()
    {
        $this->check_access_to_store();
        $this->validate_submitted_data(array(
            "id" => "required|numeric"
        ));

        $id = $this->request->getPost('id');
        $order_item_info = $this->Order_items_model->get_one($id);
        $this->check_access_to_this_order_item($order_item_info);

        if ($this->request->getPost('undo')) {
            if ($this->Order_items_model->delete($id, true)) {
                $options = array("id" => $id);
                $item_info = $this->Order_items_model->get_details($options)->getRow();
                echo json_encode(array("success" => true, "order_id" => $item_info->order_id, "data" => $this->_make_item_row($item_info), "order_total_view" => $this->_get_order_total_view($item_info->order_id), "message" => app_lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, app_lang('error_occurred')));
            }
        } else {
            if ($this->Order_items_model->delete($id)) {
                $item_info = $this->Order_items_model->get_one($id);
                echo json_encode(array("success" => true, "order_id" => $item_info->order_id, "order_total_view" => $this->_get_order_total_view($item_info->order_id), 'message' => app_lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => app_lang('record_cannot_be_deleted')));
            }
        }
    }

    /* order total section */

    private function _get_order_total_view($order_id = 0)
    {
        if ($order_id) {
            $view_data["order_total_summary"] = $this->Orders_model->get_order_total_summary($order_id);
            $view_data["order_id"] = $order_id;
            return $this->template->view('orders/order_total_section', $view_data);
        } else {
            $view_data = get_order_making_data();
            return $this->template->view('orders/processing_order_total_section', $view_data);
        }
    }

    function place_order()
    {
        $this->check_access_to_store();

        $order_items = $this->Order_items_model->get_all_where(array("created_by" => $this->login_user->id, "order_id" => 0, "deleted" => 0))->getResult();
        if (!$order_items) {
            echo json_encode(array("success" => false, 'message' => app_lang('no_items_text')));
            exit;
        }

        $order_data = array(
            "client_id" => $this->request->getPost("client_id") ? $this->request->getPost("client_id") : $this->login_user->client_id,
            "order_date" => get_today_date(),
            "note" => $this->request->getPost('order_note'),
            "created_by" => $this->login_user->id,
            "status_id" => $this->Order_status_model->get_first_status(),
            "tax_id" => get_setting('order_tax_id') ? get_setting('order_tax_id') : 0,
            "tax_id2" => get_setting('order_tax_id2') ? get_setting('order_tax_id2') : 0
        );

        $order_id = $this->Orders_model->ci_save($order_data);

        if ($order_id) {
            save_custom_fields("orders", $order_id, $this->login_user->is_admin, $this->login_user->user_type);

            //save items to this order
            foreach ($order_items as $order_item) {
                $order_item_data = array("order_id" => $order_id);
                $this->Order_items_model->ci_save($order_item_data, $order_item->id);
            }

            $redirect_to = get_uri("orders/view/$order_id");
            if ($this->login_user->user_type == "client") {
                $redirect_to = get_uri("orders/preview/$order_id");
            }

            //send notification
            log_notification("new_order_received", array("order_id" => $order_id));

            echo json_encode(array("success" => true, "redirect_to" => $redirect_to, 'message' => app_lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('error_occurred')));
        }
    }

    /* list of orders, prepared for datatable  */

    function list_data($type = "", $id = 0)
    {
        $options["client_id"] = $id;
       
        $this->access_only_allowed_members();

        // $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("orders", $this->login_user->is_admin, $this->login_user->user_type);

        // $options = array(
        //     "status_id" => $this->request->getPost("status_id"),
        //     "order_date" => $this->request->getPost("start_date"),
        //     "deadline" => $this->request->getPost("end_date"),
        //     "custom_fields" => $custom_fields,
        //     "custom_field_filter" => $this->prepare_custom_field_filter_values("orders", $this->login_user->is_admin, $this->login_user->user_type)
        // );
        // echo "<pre>";
        // print_r($options);
        // exit;

        $list_data = $this->Orders_model->get_details($options)->getResult();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }      
     
        echo json_encode(array("data" => $result));
    }

    /* prepare a row of dispatch Advice  list table */

    private function _make_row($data)
    {      
        $order_url = "";
        if ($this->login_user->user_type == "staff") {
            $order_url = anchor(get_uri("orders/view/" . $data->id), get_order_id($data->id));
        } else {
            //for client
            $order_url = anchor(get_uri("orders/preview/" . $data->id), get_order_id($data->id));
        }
     
        $client = anchor(get_uri("clients/view/" . $data->client_id), $data->company_name);

        $row_data = array(
            $order_url,
            $client,
            format_to_date($data->order_date, false),
            to_currency($data->total_amount)
        );  
  
    
        $row_data[] = js_anchor($data->dispatch_status_title, array("style" => "background-color: $data->dispatch_status_color", "class" => "badge", "data-id" => $data->id, "data-value" => $data->dispatch_status_id, "data-act" => "update-order-status"));

        $row_data[] = modal_anchor(get_uri("DispatchAdvice/modal_form_edit"), "<i data-feather='edit' class='icon-16'></i>", array("class" => "edit", "title" => app_lang('edit_order'), "data-post-id" => $data->id))
                . js_anchor("<i data-feather='x' class='icon-16'></i>", array('title' => app_lang('delete_order'), "class" => "delete","data-id" => $data->id."*".$data->client_id, "data-action-url" => get_uri("DispatchAdvice/delete"), "data-action" => "delete"))."<a href='". get_uri("DispatchAdvice/download_order/$data->id")."' download><i data-feather='download' class='icon-16'></i></a>";
        return $row_data;
    }

    
    /* prepare a row of dispatch coverning table */

    private function _make_row2($data)
    {              

        $order_url = "";
        if ($this->login_user->user_type == "staff") {
            $order_url = anchor(get_uri("orders/view/" . $data->id), get_order_id($data->id));
        } else {
            //for client
            $order_url = anchor(get_uri("orders/preview/" . $data->id), get_order_id($data->id));
        }
     
        $client = anchor(get_uri("clients/view/" . $data->client_id), $data->company_name);

        $row_data = array(
            $order_url,
            $client,
            format_to_date($data->order_date, false),
            to_currency($data->total_amount)
        );  
  
        if($data->covering_status){
            $row_data[] = js_anchor($data->cover_status_name, array("style" => "background-color: $data->cover_status_color", "class" => "badge", "data-id" => $data->id, "data-post-cover_id"=>$data->covering_id, "data-value" => $data->dispatch_status_id, "data-act" => "update-order-status"));
        }else{
            $row_data[] = js_anchor($data->cover_status_name, array("class" => "badge", "data-id" => $data->id, "data-value" => $data->dispatch_status_id, "data-post-cover_id"=>$data->covering_id, "data-act" => "update-order-status"));
        }     

        $row_data[] = modal_anchor(get_uri("DispatchAdvice/modal_dispatch_order_edit"), "<i data-feather='edit' class='icon-16'></i>", array("class" => "edit", "title" => app_lang('edit_order'), "data-post-id" => $data->id, "data-post-cover_id"=>$data->covering_id))
                . js_anchor("<i data-feather='x' class='icon-16'></i>", array('title' => app_lang('delete_order'), "class" => "delete","data-id" => $data->covering_id, "data-action-url" => get_uri("DispatchAdvice/delete_order_covering"), "data-action" => "delete"))."<a href='". get_uri("DispatchAdvice/download_order_cover/$data->covering_id")."'><i data-feather='download' class='icon-16'></i></a>";
        return $row_data;
    }

    //load the yearly view of order list
    function yearly()
    {
        return $this->template->view("orders/yearly_orders");
    }


    function download_order($order_id = 0){   
        $dompdf = new Dompdf();
        $view_data['model_info'] = $this->Orders_model->get_one($order_id);
        $view_data['model_info2'] = $this->Order_items_model->get_one_where(['order_id' => $order_id]);
        $view_data['client_info'] = $this->Clients_model->get_one($view_data['model_info']->client_id);
        $view_data['dispatch_info'] = $this->Dispatch_model->get_one_where(['order_id' => 
        $order_id,'client_id'=>$view_data['model_info']->client_id]); 
        $view_data['transport_info'] = $this->TransporterModel->get_one($view_data['dispatch_info']->transporter_id);   
        $view_data['user_info'] = $this->Users_model->get_one($view_data['model_info']->client_id);
     

        // return $this->template->view('clients/dispatch_advice/dispatch_advice_pdf', $view_data);
        // die;
        $dompdf->loadHtml($this->template->view('clients/dispatch_advice/dispatch_advice_pdf', $view_data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream();
    }


    function download_order_cover($cover_id = 0){   
        $dompdf = new Dompdf();
      

        if($cover_id>0){
            $view_data['covering_info'] = $this->Dispatch_Covering_model->get_one($cover_id);       
            $view_data['model_info'] = $this->Orders_model->get_one($view_data['covering_info']->client_id);
            $view_data['client_info'] = $this->Clients_model->get_one($view_data['model_info']->client_id);       
            $view_data['dispatch_info'] = $this->Dispatch_model->get_one_where(['order_id' => 
            $view_data['covering_info']->order_id,'client_id'=>$view_data['model_info']->client_id]); 
            $view_data['transport_info'] = $this->TransporterModel->get_one($view_data['dispatch_info']->transporter_id);   
            $view_data["custom_fields"] = $this->Custom_fields_model->get_combined_details("orders", $view_data['model_info']->id, $this->login_user->is_admin, $this->login_user->user_type)->getResult();
      
    
            // return $this->template->view('clients/dispatch_advice/dispatch_covering_pdf', $view_data);
            // die;
            $dompdf->loadHtml($this->template->view('clients/dispatch_advice/dispatch_covering_pdf', $view_data));
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream();
        }
  
    }



    private function _get_clients_dropdown()
    {
        $clients_dropdown = array("" => "-");
        $clients = $this->Clients_model->get_dropdown_list(array("company_name"), "id", array("is_lead" => 0));
        foreach ($clients as $key => $value) {
            $clients_dropdown[$key] = $value;
        }
        return $clients_dropdown;
    }

    /* add, edit dispatch covering */

    function save()
    {
        $this->check_access_to_store();
       
        $this->validate_submitted_data(array(
            "client_id" => "numeric"
        ));     
        $order_id = $this->request->getPost("order_id");
        $cover_id = $this->request->getPost("cover_id");        
        $client_id = $this->request->getPost('client_id');
     
        if($cover_id>0){
            /* edit order item */
            $order_data = array(
                "invoice_no" => $this->request->getPost('invoice_no'),
                "invoice_date" => $this->request->getPost('invoice_date'),
                "invoice_amount" => $this->request->getPost('invoice_amount'),
                "delivery_note" => $this->request->getPost('delivery_note'),
                "delivery_date" => $this->request->getPost('delivery_date'),
                "docket_no" => $this->request->getPost('docket_no'),
                "docket_date" => $this->request->getPost('docket_date'), 
                "order_status" => 1,   
                "order_id"  => $this->request->getPost('order_id'),    
                "client_id"  => $this->request->getPost('client_id'),           
                "updated_at" => date("Y-m-d H:i:s"),  
                "updated_by" => $this->login_user->id  
            );        
            $res=$this->Dispatch_Covering_model->ci_save($order_data,$cover_id);     
         
            $redirect_to = get_uri("clients/view/$client_id");
            if($res){               
                echo json_encode(array("success" => true, "redirect_to" => $redirect_to,  
                    'message' => app_lang('record_saved')));
            }else{  
                echo json_encode(array("success" => false,
                "redirect_to" => $redirect_to, 
                'message' => app_lang('error_occurred')));
            }
          
        }else{
            /* add new order item */
            $order_data = array(
                "invoice_no" => $this->request->getPost('invoice_no'),
                "invoice_date" => $this->request->getPost('invoice_date'),
                "invoice_amount" => $this->request->getPost('invoice_amount'),
                "delivery_note" => $this->request->getPost('delivery_note'),
                "delivery_date" => $this->request->getPost('delivery_date'),
                "docket_no" => $this->request->getPost('docket_no'),
                "docket_date" => $this->request->getPost('docket_date'), 
                "order_status" => 1, 
                "order_id"  => $this->request->getPost('order_id'),    
                "client_id"  => $this->request->getPost('client_id'),             
                "created_at" => date("Y-m-d H:i:s"),  
                "created_by" => $this->login_user->id  
            );
      
            $order_id = $this->Dispatch_Covering_model->ci_save($order_data);

           
            if($order_id){
                $redirect_to = get_uri("clients/view/$client_id");
                echo json_encode(array("success" => true, "redirect_to" => $redirect_to,  
                'message' => app_lang('record_saved')));
                  
            }else{
                $redirect_to = get_uri("clients/view/$client_id");
                echo json_encode(array("success" => false,
                "redirect_to" => $redirect_to, 
                'message' => app_lang('error_occurred')));
            }
         
          
        }
    }

    /* delete or undo an order */

    function delete()
    {
        $this->access_only_allowed_members();

      
        $id = $this->request->getPost('id');
        $ids = explode('*',$id);
        $order_id = $ids[0];
        $client_id =  $ids[1];
        $dispatch_info= $this->Dispatch_model->get_one_where(['order_id' => 
        $order_id,'client_id'=>$client_id]); 
        if($dispatch_info){
            if ($this->request->getPost('undo')) {
                if ($this->Dispatch_model->delete($id, true)) {
                    echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => app_lang('record_undone')));
                } else {
                    echo json_encode(array("success" => false, app_lang('error_occurred')));
                }
            } else {
                if ($this->Dispatch_model->delete($dispatch_info->id)) {                 
                    echo json_encode(array("success" => true, 'message' => app_lang('record_deleted')));
                } else {
                    echo json_encode(array("success" => false, 'message' => app_lang('record_cannot_be_deleted')));
                }
            }
        }else{
            echo json_encode(array("success" => false, 'message' => app_lang('record_cannot_be_deleted')));
        }
        
    }

      /* delete or undo an order Covering */

      function delete_order_covering()
      {
          $this->access_only_allowed_members();
  
        
          $id = $this->request->getPost('id');
         
          if($id>0){
              if ($this->request->getPost('undo')) {
                  if ($this->Dispatch_Covering_model->delete($id, true)) {
                      echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => app_lang('record_undone')));
                  } else {
                      echo json_encode(array("success" => false, app_lang('error_occurred')));
                  }
              } else {
                  if ($this->Dispatch_Covering_model->delete($id)) {                 
                      echo json_encode(array("success" => true, 'message' => app_lang('record_deleted')));
                  } else {
                      echo json_encode(array("success" => false, 'message' => app_lang('record_cannot_be_deleted')));
                  }
              }
          }else{
              echo json_encode(array("success" => false, 'message' => app_lang('record_cannot_be_deleted')));
          }
          
      }

    /* load order details view */

    function view($order_id = 0)
    {
        $this->access_only_allowed_members();

        if ($order_id) {
            validate_numeric_value($order_id);

            $view_data = get_order_making_data($order_id);

            if ($view_data) {
                $access_info = $this->get_access_info("invoice");
                $view_data["show_invoice_option"] = (get_setting("module_invoice") && $access_info->access_type == "all") ? true : false;

                $access_info = $this->get_access_info("estimate");
                $view_data["show_estimate_option"] = (get_setting("module_estimate") && $access_info->access_type == "all") ? true : false;

                $view_data["can_create_projects"] = $this->can_create_projects();

                $view_data["order_id"] = $order_id;

                $view_data['order_statuses'] = $this->Order_status_model->get_details()->getResult();

                return $this->template->rander("orders/view", $view_data);
            } else {
                show_404();
            }
        }
    }

    private function check_access_to_this_order($order_data)
    {
        //check for valid order
        if (!$order_data) {
            show_404();
        }

        //check for security
        $order_info = get_array_value($order_data, "order_info");
        if ($this->login_user->user_type == "client") {
            if ($this->login_user->client_id != $order_info->client_id) {
                app_redirect("forbidden");
            }
        }
    }

    function download_pdf($order_id = 0, $mode = "download")
    {
     
        if ($order_id) {
            validate_numeric_value($order_id);
            $order_data = get_order_making_data($order_id);
            $this->check_access_to_store();
            $this->check_access_to_this_order($order_data);

            if (@ob_get_length())
                @ob_clean();
            //so, we have a valid order data. Prepare the view.

            prepare_order_pdf($order_data, $mode);
        } else {
            show_404();
        }
    }

    //view html is accessable to client only.
    function preview($order_id = 0, $show_close_preview = false)
    {
        $this->check_access_to_store();

        if ($order_id) {
            validate_numeric_value($order_id);
            $order_data = get_order_making_data($order_id);
            $this->check_access_to_this_order($order_data);

            $order_data['order_info'] = get_array_value($order_data, "order_info");

            $view_data['order_preview'] = prepare_order_pdf($order_data, "html");

            //show a back button
            $view_data['show_close_preview'] = $show_close_preview && $this->login_user->user_type === "staff" ? true : false;

            $view_data['order_id'] = $order_id;

            return $this->template->rander("orders/order_preview", $view_data);
        } else {
            show_404();
        }
    }

    /* prepare suggestion of order item */

    function get_order_item_suggestion()
    {
        $key = $_REQUEST["q"];
        $suggestion = array();

        $items = $this->Invoice_items_model->get_item_suggestion($key, $this->login_user->user_type);

        foreach ($items as $item) {
            $suggestion[] = array("id" => $item->title, "text" => $item->title);
        }

        if ($this->login_user->user_type === "staff") {
            $suggestion[] = array("id" => "+", "text" => "+ " . app_lang("create_new_item"));
        }

        echo json_encode($suggestion);
    }

    function get_order_item_info_suggestion()
    {
        $item = $this->Invoice_items_model->get_item_info_suggestion($this->request->getPost("item_name"), $this->login_user->user_type);
        if ($item) {
            $item->rate = $item->rate ? to_decimal_format($item->rate) : "";
            echo json_encode(array("success" => true, "item_info" => $item));
        } else {
            echo json_encode(array("success" => false));
        }
    }

    function save_order_status($id = 0)
    {
        validate_numeric_value($id);
        $this->access_only_allowed_members();
        if (!$id) {
            show_404();
        }

        $data = array(
            "status_id" => $this->request->getPost('value')
        );

        $save_id = $this->Orders_model->ci_save($data, $id);

        if ($save_id) {
            log_notification("order_status_updated", array("order_id" => $id));
            $order_info = $this->Orders_model->get_details(array("id" => $id))->getRow();
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, "message" => app_lang('record_saved'), "order_status_color" => $order_info->order_status_color));
        } else {
            echo json_encode(array("success" => false, app_lang('error_occurred')));
        }
    }

    /* return a row of order list table */

    private function _row_data($id)
    {
        $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("orders", $this->login_user->is_admin, $this->login_user->user_type);

        $options = array("id" => $id, "custom_fields" => $custom_fields);
        $data = $this->Orders_model->get_details($options)->getRow();
        return $this->_make_row($data, $custom_fields);
    }

    /* load discount modal */

    function discount_modal_form()
    {
        $this->access_only_allowed_members();

        $this->validate_submitted_data(array(
            "order_id" => "required|numeric"
        ));

        $order_id = $this->request->getPost('order_id');

        $view_data['model_info'] = $this->Orders_model->get_one($order_id);

        return $this->template->view('orders/discount_modal_form', $view_data);
    }

    /* save discount */

    function save_discount()
    {
        $this->access_only_allowed_members();

        $this->validate_submitted_data(array(
            "order_id" => "required|numeric",
            "discount_type" => "required",
            "discount_amount" => "numeric",
            "discount_amount_type" => "required"
        ));

        $order_id = $this->request->getPost('order_id');

        $data = array(
            "discount_type" => $this->request->getPost('discount_type'),
            "discount_amount" => $this->request->getPost('discount_amount'),
            "discount_amount_type" => $this->request->getPost('discount_amount_type')
        );

        $data = clean_data($data);

        $save_data = $this->Orders_model->ci_save($data, $order_id);
        if ($save_data) {
            echo json_encode(array("success" => true, "order_total_view" => $this->_get_order_total_view($order_id), 'message' => app_lang('record_saved'), "order_id" => $order_id));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('error_occurred')));
        }
    }

    /* list of order items, prepared for datatable  */

    function item_list_data($order_id = 0)
    {
        validate_numeric_value($order_id);
        $this->access_only_allowed_members();

        $list_data = $this->Order_items_model->get_details(array("order_id" => $order_id))->getResult();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_item_row($data);
        }
        echo json_encode(array("data" => $result));
    }

  

    /* list of dispatch order advice of a specific client, prepared for datatable  */

    function dispatch_advice_list_data_of_client($client_id)
    {
        validate_numeric_value($client_id);
        $this->check_access_to_store();
        $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("orders", $this->login_user->is_admin, $this->login_user->user_type);

        $options = array("client_id" => $client_id, 
        "order_status" => 3,
        "custom_fields" => $custom_fields, 
        "custom_field_filter" => $this->prepare_custom_field_filter_values("orders", $this->login_user->is_admin, $this->login_user->user_type));
      
        $list_data = $this->Orders_model->get_details_dispatch_advice($options)->getResult();      
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data, $custom_fields);
        }     
        echo json_encode(array("data" => $result));
    }

      /* list of dispatch order advice of a specific client, prepared for datatable  */

      function dispatch_covering_list_data_of_client($client_id)
      {
          validate_numeric_value($client_id);
          $this->check_access_to_store();
          $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("orders", $this->login_user->is_admin, $this->login_user->user_type);
  
          $options = array("client_id" => $client_id, 
          "order_status" => 3,
          "custom_fields" => $custom_fields, 
          "custom_field_filter" => $this->prepare_custom_field_filter_values("orders", $this->login_user->is_admin, $this->login_user->user_type));
        
          $list_data = $this->Dispatch_model->get_details_dispatch_advice($options)->getResult();      
          $result = array();
          foreach ($list_data as $data) {
              $result[] = $this->_make_row2($data, $custom_fields);
          }     
          echo json_encode(array("data" => $result));
      }
}

/* End of file orders.php */
/* Location: ./app/controllers/orders.php */