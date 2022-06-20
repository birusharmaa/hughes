<?php

namespace App\Models;

class LeadActivityModel extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'leads_activity_logs';
        parent::__construct($this->table);  
    }

    function get_details($options = array()) {
        $activity = $this->db->prefixTable('leads_activity_logs'); 
        $users_table = $this->db->prefixTable('users');
        $client_table = $this->db->prefixTable('clients');
        $where = "";
        $or_where = "";
       
        $id = $options['id'];
       $sessionId = $_SESSION['user_id'];
        if ($id) {
            $where .= " $activity.sesion_id=$sessionId AND $activity.lead_id=$id";
            $or_where = " $activity.is_public=1 AND $activity.deleted=0 AND $activity.id=$id"; //check public note 
        }
        else{
            $where .= " $activity.sesion_id=0";
        }
        $sql = "SELECT $activity.*,$users_table.first_name,$client_table.name_of_contact_person,$client_table.created_date FROM $activity
        LEFT JOIN $users_table ON $users_table.id=$activity.sesion_id 
        LEFT JOIN $client_table ON $client_table.id=$activity.lead_id 
        Where $where order by $activity.id DESC";
        return $this->db->query($sql);
    }

}

