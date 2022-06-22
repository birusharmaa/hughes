<?php

namespace App\Models;

class Dispatch_status_model extends Crud_model {

    protected $table = null;
    

    function __construct() {
        $this->table = 'dispatch_status';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
       
        $dispatch_status_table = $this->db->prefixTable('dispatch_status');
        $orders_table = $this->db->prefixTable('orders');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $dispatch_status_table.id=$id";
        }

        $sql = "SELECT $dispatch_status_table.*, (SELECT COUNT($orders_table.id) FROM $orders_table WHERE $orders_table.deleted=0 AND $orders_table.status_id=$dispatch_status_table.id) AS total_orders
        FROM $dispatch_status_table
        WHERE $dispatch_status_table.deleted=0 $where
        ORDER BY $dispatch_status_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $dispatch_status_table = $this->db->prefixTable('order_status');

        $sql = "SELECT MAX($dispatch_status_table.sort) as sort
        FROM $dispatch_status_table
        WHERE $dispatch_status_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->resultID->num_rows) {
            return $result->getRow()->sort;
        } else {
            return 0;
        }
    }

    // function get_first_status() {
    //     $dispatch_status_table = $this->db->prefixTable('order_status');

    //     $sql = "SELECT $dispatch_status_table.id AS first_order_status
    //     FROM $dispatch_status_table
    //     WHERE $dispatch_status_table.deleted=0
    //     ORDER BY $dispatch_status_table.sort ASC
    //     LIMIT 1";

    //     return $this->db->query($sql)->getRow()->first_order_status;
    // }

}
