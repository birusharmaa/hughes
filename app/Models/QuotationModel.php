<?php

namespace App\Models;

class QuotationModel extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'quotation';
        parent::__construct($this->table);  
    }

    function get_details($options = array()) {
        $quatationTab = $this->db->prefixTable('quotation'); 
        $users_table = $this->db->prefixTable('users');
        $where = "";
        $or_where = "";
       
        $id = $options['id'];
    
        if ($id) {
            $where .= " AND $quatationTab.lead_id=$id";
            $or_where = " $quatationTab.is_public=1 AND $quatationTab.deleted=0 AND $quatationTab.id=$id"; //check public note 
        }
        else{
            $where .= " AND $quatationTab.lit_to=0";
        }
        $sql = "SELECT $quatationTab.*,$users_table.first_name FROM $quatationTab
        LEFT JOIN $users_table ON $users_table.id=$quatationTab.created_by
        WHERE $quatationTab.deleted=0 $where";
       
        return $this->db->query($sql);
    }

}

