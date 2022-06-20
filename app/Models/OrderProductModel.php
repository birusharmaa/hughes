<?php

namespace App\Models;

class OrderProductModel extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'orders_product';
        parent::__construct($this->table);  
    }

    function get_details($options = array()) {
        $ordProd = $this->db->prefixTable('orders_product'); 
        $users_table = $this->db->prefixTable('users');
        $where = "";
        $or_where = "";
       
        $id = $options['id'];
    
        if ($id) {
            $where .= " AND $ordProd.lead_id=$id";
        }
        else{
            $where .= " AND $ordProd.lit_to=0";
        }
        $sql = "SELECT $ordProd.*,$users_table.first_name FROM $ordProd
        WHERE $ordProd.deleted=0 $where";
       
        return $this->db->query($sql);
    }

}

