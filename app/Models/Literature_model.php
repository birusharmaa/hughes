<?php

namespace App\Models;

class Literature_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'literature';
        parent::__construct($this->table);  
        parent::init_activity_log("literature", "lit_from", "lit_to", "lit_mode");
    }

    function get_details($options = array()) {
        $literature_table = $this->db->prefixTable('literature'); 
        $users_table = $this->db->prefixTable('users');
        $where = "";
        $or_where = "";
       
        $id = $options['id'];
        if ($id) {
            $where .= " AND $literature_table.lit_to=$id";
            $or_where = " $literature_table.is_public=1 AND $literature_table.deleted=0 AND $literature_table.id=$id"; //check public note 
        }
        else{
            $where .= " AND $literature_table.lit_to=0";
        }
        $sql = "SELECT $literature_table.*,$users_table.first_name FROM $literature_table
        LEFT JOIN $users_table ON $users_table.id=$literature_table.created_by
        WHERE $literature_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}

