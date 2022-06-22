<?php

namespace App\Models;

class Dispatch_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'dispatch_advice';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $orders_table = $this->db->prefixTable('orders');
        $clients_table = $this->db->prefixTable('clients');
        $taxes_table = $this->db->prefixTable('taxes');
        $order_items_table = $this->db->prefixTable('order_items');
        $order_status_table = $this->db->prefixTable('order_status');
        $users_table = $this->db->prefixTable('users');
        $projects_table = $this->db->prefixTable('projects');

        $where = "";
        $id = get_array_value($options, "id");
      
        if ($id) {
            $where .= " AND $orders_table.client_id=$id";
        }
        $client_id = get_array_value($options, "client_id");
        if ($client_id) {
            $where .= " AND $orders_table.client_id=$client_id";
        }

        $order_date = get_array_value($options, "order_date");
        $deadline = get_array_value($options, "deadline");
        if ($order_date && $deadline) {
            $where .= " AND ($orders_table.order_date BETWEEN '$order_date' AND '$deadline') ";
        }

        $after_tax_1 = "(IFNULL(tax_table.percentage,0)/100*IFNULL(items_table.order_value,0))";
        $after_tax_2 = "(IFNULL(tax_table2.percentage,0)/100*IFNULL(items_table.order_value,0))";

        $discountable_order_value = "IF($orders_table.discount_type='after_tax', (IFNULL(items_table.order_value,0) + $after_tax_1 + $after_tax_2), IFNULL(items_table.order_value,0) )";

        $discount_amount = "IF($orders_table.discount_amount_type='percentage', IFNULL($orders_table.discount_amount,0)/100* $discountable_order_value, $orders_table.discount_amount)";

        $before_tax_1 = "(IFNULL(tax_table.percentage,0)/100* (IFNULL(items_table.order_value,0)- $discount_amount))";
        $before_tax_2 = "(IFNULL(tax_table2.percentage,0)/100* (IFNULL(items_table.order_value,0)- $discount_amount))";

        $order_value_calculation = "(
            IFNULL(items_table.order_value,0)+
            IF($orders_table.discount_type='before_tax',  ($before_tax_1+ $before_tax_2), ($after_tax_1 + $after_tax_2))
            - $discount_amount
           )";

        $status_id = get_array_value($options, "status_id");
        if ($status_id) {
            $where .= " AND $orders_table.status_id='$status_id'";
        }

        //prepare custom fild binding query
        $custom_fields = get_array_value($options, "custom_fields");
        $custom_field_filter = get_array_value($options, "custom_field_filter");
        $custom_field_query_info = $this->prepare_custom_field_query_string("orders", $custom_fields, $orders_table, $custom_field_filter);
        $select_custom_fieds = get_array_value($custom_field_query_info, "select_string");
        $join_custom_fieds = get_array_value($custom_field_query_info, "join_string");
        $custom_fields_where = get_array_value($custom_field_query_info, "where_string");

        $sql = "SELECT $orders_table.*, $clients_table.currency, $clients_table.currency_symbol, $clients_table.company_name, $projects_table.title as project_title,
           $order_value_calculation AS order_value, tax_table.percentage AS tax_percentage, tax_table2.percentage AS tax_percentage2, $order_status_table.title AS order_status_title, $order_status_table.color AS order_status_color, CONCAT($users_table.first_name, ' ', $users_table.last_name) AS created_by_user, $users_table.user_type AS created_by_user_type $select_custom_fieds
        FROM $orders_table
        LEFT JOIN $clients_table ON $clients_table.id= $orders_table.client_id
        LEFT JOIN $order_status_table ON $orders_table.status_id = $order_status_table.id 
        LEFT JOIN (SELECT $taxes_table.* FROM $taxes_table) AS tax_table ON tax_table.id = $orders_table.tax_id
        LEFT JOIN (SELECT $taxes_table.* FROM $taxes_table) AS tax_table2 ON tax_table2.id = $orders_table.tax_id2 
        LEFT JOIN (SELECT order_id, SUM(total) AS order_value FROM $order_items_table WHERE deleted=0 GROUP BY order_id) AS items_table ON items_table.order_id = $orders_table.id 
        LEFT JOIN $users_table ON $users_table.id=$orders_table.created_by
        LEFT JOIN $projects_table ON $projects_table.id= $orders_table.project_id
        $join_custom_fieds
        WHERE $orders_table.deleted=0 $where $custom_fields_where";
        return $this->db->query($sql);
    }


    function get_details_dispatch_advice($options = array()){
        $orders_table = $this->db->prefixTable('orders');
        $clients_table = $this->db->prefixTable('clients');
        $taxes_table = $this->db->prefixTable('taxes');
        $order_items_table = $this->db->prefixTable('order_items');
        $order_status_table = $this->db->prefixTable('order_status');
        $users_table = $this->db->prefixTable('users');
        $projects_table = $this->db->prefixTable('projects');

      
        $sql = "SELECT thewings_orders.*, thewings_order_items.`id` as order_item_id, thewings_order_items.`title`, thewings_order_items.`description`, thewings_order_items.`products`, thewings_order_items.`gst`, thewings_order_items.`affected_area`, thewings_order_items.`pestgo_gel`, thewings_order_items.`quantity`, thewings_order_items.`unit_type`, thewings_order_items.`rate`, thewings_order_items.`total`, 
        thewings_order_items.`order_id`,  thewings_clients.`company_name`, thewings_clients.`father_name`, thewings_clients.`lead_source_id`, thewings_clients.`address`, thewings_clients.`city`, thewings_clients.`state`, thewings_clients.`zip`, thewings_clients.`country`, thewings_clients.`nature_of_industry`, thewings_clients.`name_of_contact_person`, thewings_clients.`designation`, thewings_clients.`mobile`, thewings_clients.`phone`, thewings_clients.`email`, thewings_clients.`website`,  thewings_clients.`product`, thewings_clients.`affected_area`, thewings_clients.`cds_upload`, thewings_clients.`enquiry_date`, thewings_clients.`remarks`, thewings_clients.`gst_number`, thewings_clients.`currency_symbol`, thewings_clients.`currency`,thewings_clients.`disable_online_payment`, thewings_clients.`group_ids`
        FROM `thewings_orders` 
        LEFT JOIN thewings_order_items ON thewings_orders.id = thewings_order_items.order_id
        LEFT JOIN thewings_clients ON thewings_orders.client_id = thewings_clients.id
        WHERE thewings_orders.client_id=".$options["client_id"]." AND thewings_orders.order_staus=3 AND thewings_orders.deleted=0;";


        return $this->db->query($sql);

    }

}
