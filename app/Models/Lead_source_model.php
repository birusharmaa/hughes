<?php

namespace App\Models;

class Lead_source_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'lead_source';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $lead_source_table = $this->db->prefixTable('lead_source');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $lead_source_table.id=$id";
        }

        $sql = "SELECT $lead_source_table.*
        FROM $lead_source_table
        WHERE $lead_source_table.deleted=0 $where
        ORDER BY $lead_source_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $lead_source_table = $this->db->prefixTable('lead_source');

        $sql = "SELECT MAX($lead_source_table.sort) as sort
        FROM $lead_source_table
        WHERE $lead_source_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->resultID->num_rows) {
            return $result->getRow()->sort;
        } else {
            return 0;
        }
    }

    function get_lead_source_by_id($id)
    {
        $lead_source_table = "thewings_lead_source";
        $sql = "SELECT title FROM $lead_source_table WHERE id=".$id;
        $result = $this->db->query($sql)->getRow();
        if (count($result)) {
            return $result->title;
        } else {
            return 0;
        }
    }

}
