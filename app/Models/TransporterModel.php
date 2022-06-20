<?php

namespace App\Models;

class TransporterModel extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'transporters';
        parent::__construct($this->table);  
    }
    /**
     * get Details of transpoter 
     */
    function get_details($options = array()) {
        $transporter = $this->db->prefixTable('transporters'); 
        $users_table = $this->db->prefixTable('users');
        $where = "";
        $id = $options['id'];
        $sessionId = $_SESSION['user_id'];
        if ($id) {
            $where .= " AND $transporter.id=$id";
        }
        else{
            $where .= " AND $transporter.created_by=$sessionId";
        }
        $sql = "SELECT $transporter.*,$users_table.first_name FROM $transporter
        LEFT JOIN $users_table ON $users_table.id=$transporter.created_by
        WHERE $transporter.deleted=0 $where";
        return $this->db->query($sql);
    }

}

