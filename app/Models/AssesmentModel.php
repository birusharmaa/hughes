<?php

namespace App\Models;

class AssesmentModel extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'assesment';
        parent::__construct($this->table);  
        parent::init_activity_log("assesment", "tech_person", "cstmr_person", "phone");
    }

    function get_details($options = array()) {
        $assesment = $this->db->prefixTable('assesment'); 
        $users_table = $this->db->prefixTable('users');
        $where = "";
        $or_where = "";
       
        $id = $options['id'];
    
        if ($id) {
            $where .= " AND $assesment.lead_id=$id";
            $or_where = " $assesment.is_public=1 AND $assesment.deleted=0 AND $assesment.id=$id"; //check public note 
        }
        else{
            $where .= " AND $assesment.lit_to=0";
        }
        $sql = "SELECT $assesment.*,$users_table.first_name FROM $assesment
        LEFT JOIN $users_table ON $users_table.id=$assesment.created_by
        WHERE $assesment.deleted=0 $where";
        return $this->db->query($sql);
    }

}

