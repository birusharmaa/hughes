<?php

namespace App\Models;

class ActivityModel extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'activity_logs';
        parent::__construct($this->table);  
    }

    function get_details($options = array()) {
        $activityTab = $this->db->prefixTable('activity_logs'); 
        $users_table = $this->db->prefixTable('users');
        $where = "";
        $or_where = "";
        $session_id = $_SESSION['user_id'];
        $id = $options['id'];
       
        exit;
        if ($id) {
            $where .= " AND $activityTab.log_type_title= $session_id AND $activityTab.log_type_id= $id";
            $or_where = " $activityTab.is_public=1 AND $activityTab.deleted=0 AND $activityTab.id=$id"; //check public note 
        }
        else{
            $where .= " AND $activityTab.log_for_id=0";
        }
        $sql = "SELECT $activityTab.*,$users_table.first_name FROM $activityTab
        LEFT JOIN $users_table ON $users_table.id=$activityTab.created_by
        WHERE $activityTab.deleted=0 $where  ORDER BY $activityTab.id DESC";
        return $this->db->query($sql);
    }

}


