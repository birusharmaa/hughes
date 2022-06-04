<?php
namespace App\Models;

use CodeIgniter\Model;

class My_custom_model extends Model {

    // protected $table = null;

    // function __construct() {

    //     $this->table = 'users';
    //     parent::__construct($this->table);
    // }
    function get_team_member() {
        $sql = "SELECT * from thewings_users where deleted=0 AND user_type='staff'";
        $query =  $this->db->query($sql);
        return $query->getResult();
    }
    function getuserdetails(){
        $sql = "SELECT * from thewings_users where dob='2021-11-01'";
        $query =  $this->db->query($sql);
        // return $query->result();  
    }

    //Check category is assign or not
    function checkCategory($id=0){
        
        //Get category lists
        $sql = "SELECT `course` from `thewings_clients` where `lead_assigned_to` like('%$id%') GROUP BY `course` ";
        $query =  $this->db->query($sql);
        //return $query->getResult();
        $result = $query->getResult();
        $status = array( 'status' => 0, 'data'   => '' );
        
        if(count($result)>0){
            //Categoy id and title
            $cat_id    = array();
            $cat_title = array();
            
            //Sub categoy id and title
            $sub_id    = array();
            $sub_title = array();

            //Not assign subcategoy id and title
            $not_sub_id    = array();
            $not_sub_title = array();

            //Sub subcategoy id and title
            $sub_sub_id    = array();
            $sub_sub_title = array();

            //Not assign sub subcategoy id and title
            $not_sub_sub_id    = array();
            $not_sub_sub_title = array();

            $category_count = array();
            $sub_cat_count  = array();
            $category_display_status = array();
            //$category_display_status['category_display'] = array();

            //Fetch category id and category title
            foreach ($result as $row) {
                $sql = "SELECT `id`,`title` from thewings_category where `id` = $row->course";
                $query =  $this->db->query($sql);
                $result = $query->getRow();
                if(isset($result->title)){
                    $cat_id[]    = $result->id;
                    $cat_title[] = $result->title;

                    $cat_id_id      = $result->id;

                    $sql = "SELECT COUNT(*) As cat_count from thewings_subcaterogy where `category_id` = $result->id";
                    $query =  $this->db->query($sql);
                    $result = $query->getRow();
                    if(isset($result->cat_count)){
                        //$category_display_status[]   = $result->cat_count;
                        
                        //Number of sub category
                        $sql_sub_count = "SELECT count(`sub_cat`) AS `subcatcount` from `thewings_clients` where `course`=$cat_id_id AND `lead_assigned_to` like('%$id%') GROUP BY `sub_cat` ";
                        $query_sub_count =  $this->db->query($sql_sub_count);
                        $result_data_count = $query_sub_count->getResult();
                        if(count($result_data_count)==$result->cat_count){
                            $category_display_status['cat_id'][] = $cat_id_id;
                            $category_display_status['category_display'][] = 'none';
                        }
                    }

                }
            }


            //Sub categories id
            $sql_sub = "SELECT `sub_cat` from `thewings_clients` where `lead_assigned_to` like('%$id%') GROUP BY `sub_cat` ";
            $query_sub =  $this->db->query($sql_sub);
            $result_data = $query_sub->getResult();
            if(count($result_data)>0){
                //Sub category title and sub category id
                foreach($result_data as $row_data) {
                    $sql_sub_cat = "SELECT `id`,`title` from thewings_subcaterogy where `id` = $row_data->sub_cat";
                    $query_sub_cat =  $this->db->query($sql_sub_cat);
                    $result_sub_cat = $query_sub_cat->getRow();
                    if(isset($result_sub_cat->title)){
                        $sub_id[]    = $result_sub_cat->id;
                        $sub_title[] = $result_sub_cat->title;
                    }
                }
            }

            //If subcategory not assign
            $sql_not_sub = "SELECT `sub_cat` from `thewings_clients` where `lead_assigned_to` not like('%$id%') GROUP BY `sub_cat` ";
            $query_not_sub =  $this->db->query($sql_not_sub);
            $result_not_data = $query_not_sub->getResult();
            if(count($result_not_data)>0){
                //Sub category title and sub category id
                foreach($result_not_data as $row_not_data) {
                    $sql_not_sub_cat = "SELECT `id`,`title` from thewings_subcaterogy where `id` = $row_not_data->sub_cat";
                    $query_not_sub_cat =  $this->db->query($sql_not_sub_cat);
                    $query_not_sub_cat = $query_not_sub_cat->getRow();
                    if(isset($query_not_sub_cat->title)){
                        $not_sub_id[]    = $query_not_sub_cat->id;
                        $not_sub_title[] = $query_not_sub_cat->title;
                    }
                }
            }


            //If sub subcategory assign
            $sql_sub_sub_cat = "SELECT `subcatlist` from `thewings_clients` where `lead_assigned_to` like('%$id%') AND `subcatlist` IS NOT NULL AND `subcatlist` !='' GROUP BY `subcatlist`";
            $query_sub_sub =  $this->db->query($sql_sub_sub_cat);
            $result_data_sub_sub = $query_sub_sub->getResult();
            if(count($result_data_sub_sub)>0){
                //Sub category title and sub category id
                foreach($result_data_sub_sub as $row_sub_sub) {

                    $row_sub_sub = "SELECT `id`,`title` from thewings_sub_subcaterogy where `id` = $row_sub_sub->subcatlist";
                    $query_sub_sub_cat =  $this->db->query($row_sub_sub);
                    $query_sub_sub_cat = $query_sub_sub_cat->getRow();
                    if(isset($query_sub_sub_cat->title)){
                        $sub_sub_id[]    = $query_sub_sub_cat->id;
                        $sub_sub_title[] = $query_sub_sub_cat->title;
                    }
                }
            }

            //If not sub subcategory assign
            $not_sql_sub_sub_cat = "SELECT `subcatlist` from `thewings_clients` where `lead_assigned_to` NOT like('%$id%') AND `subcatlist` IS NOT NULL AND `subcatlist` !='' GROUP BY `subcatlist` ";
            $not_query_sub_sub =  $this->db->query($not_sql_sub_sub_cat);
            $not_result_data_sub_sub = $not_query_sub_sub->getResult();
            if(count($not_result_data_sub_sub)>0){
                //Sub category title and sub category id
                foreach($not_result_data_sub_sub as $not_row_sub_sub) {
                    $not_row_sub_sub = "SELECT `id`,`title` from thewings_sub_subcaterogy where `id` = $not_row_sub_sub->subcatlist";
                    $not_query_sub_sub_cat =  $this->db->query($not_row_sub_sub);
                    $not_query_sub_sub_cat = $not_query_sub_sub_cat->getRow();
                    if(isset($not_query_sub_sub_cat->title)){
                        $not_sub_sub_id[]    = $query_not_sub_cat->id;
                        $not_sub_sub_title[] = $query_not_sub_cat->title;
                    }
                }
            }
           
            $status = array(
                'status' => 1,
                'data'   => '',
                'cat_id' => $cat_id,
                'title'  => $cat_title,
                'sub_id' => $sub_id,
                'sub_title'  => $sub_title,
                'not_sub_id' => $not_sub_id,
                'not_sub_title'  => $not_sub_title,
                "sub_sub_cat_id" => $sub_sub_id,
                "sub_sub_cat_title" => $sub_sub_title,
                "not_sub_sub_id" => $not_sub_sub_id,
                "not_sub_sub_title" => $not_sub_sub_title,
                "category_display_status" => $category_display_status
            );

        }else{
            $status = array(
                'status' => 0,
                'data'   => ''
            );
        }
        // echo "<pre>";
        // print_r($status);
        echo json_encode($status);
        exit;
    }

    function getCategory(){
        $sql = "SELECT title,id from thewings_category where status=1";
        $query =  $this->db->query($sql);
        return $query->getResult();
    }

    function getCategorybyId($id){
        $sql = "SELECT title,id from thewings_category where id='$id' AND status=1";
        $query =  $this->db->query($sql);
        
          $row =  $query->getRow();
          return $row->title;
    }
    function getsubCategorybyId($id){
        $sql = "SELECT title,id from thewings_subcaterogy where id='$id' AND status=1";
        $query =  $this->db->query($sql);
        
          $row =  $query->getRow();
          return $row->title;
    }
    function getsubsubCategorybyId($id){
        $sql = "SELECT title,id from thewings_sub_subcaterogy where id='$id' AND status=1";
        $query =  $this->db->query($sql);
        
          $row =  $query->getRow();
          return $row->title;
    }

    function setCategoryID($id){
        $sql = "SELECT title,id from thewings_subcaterogy where status=1 AND category_id ='$id' ";
        $query =  $this->db->query($sql);
        return  $query->getResult();
        // $this->db->select(array('s.s_id as state_id', 's.c_id', 's.s_name as state_name'));
        // $this->db->from('ws_states as s');
        // $this->db->where('s.c_id', $this->_countryID);
        // $query = $this->db->get();
        // return $query->result_array();
    }
    function setsubcatsubList($id){
        $sql = "SELECT title,id from thewings_sub_subcaterogy where status=1 AND subcategory_id ='$id' ";
        $query =  $this->db->query($sql);
        return  $query->getResult();
        // $this->db->select(array('s.s_id as state_id', 's.c_id', 's.s_name as state_name'));
        // $this->db->from('ws_states as s');
        // $this->db->where('s.c_id', $this->_countryID);
        // $query = $this->db->get();
        // return $query->result_array();
    }
    function updateLeadAssign($data){
       $category = $data['course'];
       $subcat = $data['sub_cat'];
       $subsubcat = $data['subcatlist'];
       $userID = $data['owner_id'];
        $condition='';
        $setData='';

       if($category){
        $condition.= " course ='$category'";
       }
       if($subcat){
        $condition.= " AND sub_cat ='$subcat'";
       }
       if($subsubcat){
        $condition.= " AND subcatlist ='$subsubcat'";
       }

       if($category){
        $setData.= " category ='$category'";
       }
       if($subcat){
        $setData.= " , sub_category ='$subcat'";
       }
       if($subsubcat){
        $setData.= " , subcatlist ='$subsubcat'";
       }

      
       $catsubcatData = "SELECT  distinct course,sub_cat,subcatlist from thewings_clients  where $condition ";
       $countdata =  $this->db->query($catsubcatData);
       if(count($countdata->getResult('array')) == 0){                
            return false;
        }else{
            $getSelecteddata = "SELECT  distinct lead_assigned_to from thewings_clients  where $condition ";
            $runQuery =  $this->db->query($getSelecteddata);
            $ownerId =  $runQuery->getResult('array');
            $owneridData = '';
            foreach($ownerId   as $ownerRow){
               $owneridData .=  $ownerRow['lead_assigned_to'].',';
            }
         $owneridData.=$userID;
            $whereinID =  rtrim($owneridData, ',');
            $updateSql = "UPDATE thewings_clients set lead_assigned_to='$whereinID' where $condition ";
            $updateuser = "UPDATE thewings_users set $setData where id='$userID' ";
            $this->db->query($updateuser);
            return $query =  $this->db->query($updateSql);
        }      
    }

    function getState(){
        $sql = "SELECT DISTINCT  state from thewings_clients ";
        $query =  $this->db->query($sql);
        return  $query->getResult();
    }
    function getCity(){
        $sql = "SELECT DISTINCT  city from thewings_clients ";
        $query =  $this->db->query($sql);
        return  $query->getResult();
    }
    function getZip(){
        $sql = "SELECT DISTINCT  zip from thewings_clients ";
        $query =  $this->db->query($sql);
        return  $query->getResult();
    }

    //get filter data one row
    function getOneRow($data,$user){
        $category   = $data['course'];
        $subcat     = $data['sub_cat'];
        $subsubcat  = $data['subcatlist'];
        $state      = $data['state'];
        $city       = $data['city'];
        $zip        = $data['zip'];

        $where='';
        if($category){ 
            $where.= " course ='$category'";
        }
        if($subcat){
            $where.= " AND sub_cat ='$subcat'";
        }
        if($subsubcat){
            $where.= " AND subcatlist ='$subsubcat'";
        }
        if($state){
            $where.= " AND state ='$state'";
        }
        if($city){
            $where.= " AND city ='$city'";
        }
        if($zip){
            $where.= " AND zip ='$zip'"; 
        }

        $sql = "SELECT * from thewings_clients where $where AND (lead_action_status ='1' "." AND lead_assigned_to like('%$user%'))";
        $query =  $this->db->query($sql);
        $query = $query->getRow();
        if(!empty($query->id)){
            $where.= " AND lead_action_status ='1' "." AND lead_assigned_to like('%$user%')";
        }else{
            //Make where condition as string        
            $where='';
            if($category){ 
                $where.= " course ='$category'";
            }
            if($subcat){
                $where.= " AND sub_cat ='$subcat'";
            }
            if($subsubcat){
                $where.= " AND subcatlist ='$subsubcat'";
            }
            if($state){
                $where.= " AND state ='$state'";
            }
            if($city){
                $where.= " AND city ='$city'";
            }
            if($zip){
                $where.= " AND zip ='$zip'"; 
            }
            $where.= " AND lead_action_status ='0' AND lead_assigned_to like('%$user%') "; 
        }
        
        $getOnelead = "SELECT *  from thewings_clients  where $where ";
        $query =  $this->db->query($getOnelead);
        // echo $this->db->getLastQuery();
        // exit;
        return $query->getRow();    
        // return $query->getRow();
     }


     function changeStatus($id,$status,$owner){
        

        $getoriginalAssign = "SELECT lead_assigned_to,lead_action_status FROM `thewings_clients` where id='$id'";
        $query =  $this->db->query($getoriginalAssign);
        $allInsteredData =$query->getRowArray();

        $lead_assigned_to =  $allInsteredData['lead_assigned_to'];
        // $lead_action_status =  $allInsteredData['lead_action_status'];
        // $lead_id =  $id;
        // date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
        // $insertedData =  date('d-m-Y H:i:s');
        // $insertcronjobdata = "INSERT INTO `thewings_cronjobdata`(`lead_id`, `lead_assigned_to`, `lead_action_status`, `insertedData`) VALUES ('".$lead_id."','".$lead_assigned_to."','".$lead_action_status."','".$insertedData."')";
        // $this->db->query($insertcronjobdata);
        $updateSql = "UPDATE thewings_clients set lead_action_status='$status',lead_assigned_to='$lead_assigned_to' where id= ".$id;
        return $query =  $this->db->query($updateSql);
     }

     function changeStatusAjax($updateSql){ 
       return $query =  $this->db->query($updateSql);
     }

     function getTimeLineResult($data,$user){
        $category = $data['course'];
        $subcat = $data['sub_cat'];
        $subsubcat = $data['subcatlist'];
        $state = $data['state'];
        $city = $data['city'];
        $zip = $data['zip'];
         $where='';
        $sql = "SELECT * from thewings_clients where lead_action_status ='1' "." AND lead_assigned_to = ".$user;
        $query =  $this->db->query($sql);
        $query = $query->getRow();
        if(isset($query->id))
        {
            $where='';
            $where.= " lead_action_status ='1' "." AND lead_assigned_to = ".$user;
        }
        else
        {
            $where='';
            if($category){ 
            $where.= " course ='$category'";
            }
            if($subcat){
            $where.= " AND sub_cat ='$subcat'";
            }
            if($subsubcat){
            $where.= " AND subcatlist ='$subsubcat'";
            }
            if($state){
            $where.= " AND state ='$state'";
            }
            if($city){
            $where.= " AND city ='$city'";
            }
            if($zip){
            $where.= " AND zip ='$zip'"; 
            }
            $where.= " AND lead_action_status ='0'"; 
        }
       
          $getOnelead = "SELECT *  from thewings_clients  where $where ";
         $query =  $this->db->query($getOnelead);
         return $query->getRow();
        
        // return $query->getRow();
     }

     function getAssignLead($id){
         $newSql = "SELECT thewings_clients.id,thewings_clients.req_extension,thewings_clients.lead_assigned_to,thewings_clients.student_name,thewings_clients.client_migration_date,thewings_clients.phone,thewings_clients.email,thewings_clients.last_lead_status,
        thewings_clients.lead_action_status,thewings_category.title FROM `thewings_clients`
        LEFT JOIN thewings_category ON thewings_clients.course = thewings_category.id 
        WHERE (thewings_clients.lead_assigned_to like('%$id%') AND thewings_clients.lead_action_status='2')";
        $query =  $this->db->query($newSql);
       return  $query->getResult(); 
    }

    function getAllremarkdata($id){
         $dataremark ="SELECT * FROM `thewings_time_line` where lead_id='$id'";
        $query =  $this->db->query($dataremark);
      
        return  $query->getResult();


    }
 

    function getFollowupRemark($id){
        $dataremark ="SELECT * FROM `thewings_time_line` where lead_id='$id'";
       $query =  $this->db->query($dataremark);
     
       return  $query->getResult();


   }


    
    function fetchxlheader($cat,$table){
        $sql = "SELECT header from $table where id='$cat' AND status=1";
        $query =  $this->db->query($sql);
        $row =  $query->getRow();
        return $row->header;
    }

    function getLeadHeader() {
        $fields = $this->db->getFieldNames('thewings_clients');

        return $fields;
        
    }
    function add_lead($data){
        $db      = \Config\Database::connect();
        $builder = $db->table('thewings_clients');
        $x= $builder->insert($data);
        return $x->connID->insert_id;
     
       

    }
    function update_lead($data){
       
        $builder->insert($data);
    }
    
    function getAllremarkbyId($id){
          $sql = "SELECT * FROM `thewings_time_line` WHERE `lead_id`=$id ORDER BY id DESC";
          $query =  $this->db->query($sql);
           return $query->getResult('array');
    }
    // ----------------------------------------Corn job data-----------------------------------------------
    function getDataofUnsuccess(){
                $getUnsuccessdata = "select lead_id from thewings_time_line where created_at < now() - INTERVAL 1 DAY and call_status <= 5";
                 $query =  $this->db->query($getUnsuccessdata);
                    return $query->getResult('array');

    }



    function UpdateLeadStaus($id){
         $uniqueStr = implode(',', array_unique(explode(',', $id)));
          $whereinID =  rtrim($uniqueStr, ',');
          $res = "update  `thewings_clients` set lead_action_status ='3' WHERE `id` in($whereinID)";
          $query =  $this->db->query($res);


    }

    function getSccessleadData(){
        $getsuccessdata = "select * from thewings_time_line where created_at < now() - INTERVAL 7 DAY and call_status >5 ";
         $query =  $this->db->query($getsuccessdata);
            return $query->getResult('array');

    }

    function UpdateLeadsuccessStaus($id){
        $uniqueStr = implode(',', array_unique(explode(',', $id)));
         $whereinID =  rtrim($uniqueStr, ',');
        $res = "update `thewings_clients` set lead_action_status ='3' WHERE (`id` in ($whereinID) AND `last_lead_status`='0')";
        $query =  $this->db->query($res);
        


   }



    // ----------------------------------------Corn job data-----------------------------------------------

    function getAssignedCat($assignId){
        $getCatsubcat = "SELECT distinct course,sub_cat,subcatlist FROM `thewings_clients` where `lead_assigned_to` like('%$assignId%')";
        $query =  $this->db->query($getCatsubcat);
         $getid =  $query->getResult('array');
         $course_ID='';
         $sub_catID = '';
         foreach($getid as $rowId){
             $course_ID.= "'".$rowId['course']."'".',';
             $sub_catID.= "'".$rowId['sub_cat']."'".',';



         }
         
    $uniqueID = implode(',', array_unique(explode(',', $course_ID)));
    $uniqueUserID =  rtrim($uniqueID, ',');
    $gettitle = "SELECT title FROM `thewings_category` where `id` IN($uniqueUserID)";
      
    $query =  $this->db->query($gettitle);
    $query->getResult('array');
    $category = array();
    foreach($query->getResult('array') as $catRow){
        $category[] =  $catRow['title'];
    }


    $sub_catuniqueID = implode(',', array_unique(explode(',', $sub_catID)));
    $sub_catuniqueUserID =  rtrim($sub_catuniqueID, ',');
    $getsub_cattitle = "SELECT title FROM `thewings_subcaterogy` where `id` IN($sub_catuniqueUserID)";
      
    $query1 =  $this->db->query($getsub_cattitle);
    $query1->getResult('array');
    $subcategory = array();

    foreach($query1->getResult('array') as $subcatRow){
        $subcategory[] = $subcatRow['title'];
    }

    $data['cat'] = $category;
    $data['subcat'] = $subcategory;
    return $data;
    }

    function getfollowupnotice($role_id,$user_id){
       if($role_id == 0){
          $cond = "AND lead_owner='$user_id'";
       }
       $currentData =   get_current_utc_time();
        $date =  date('Y-m-d',strtotime($currentData));
        $sql = "SELECT * FROM `thewings_time_line` WHERE lead_owner=$user_id AND call_status='7' AND follow_up_date='$date' $cond";
        $query =  $this->db->query($sql);
        return $query->getResult('array');
    }

    function getAlertSound($user_id){
        $currentData =   get_current_utc_time();
        $date =  date('Y-m-d',strtotime($currentData));

       $sql = "SELECT thewings_time_line.*,thewings_clients.student_name,thewings_clients.phone 
       FROM `thewings_time_line` inner join thewings_clients on thewings_clients.id = thewings_time_line.lead_id 
       WHERE thewings_time_line.call_status='7' AND thewings_time_line.follow_up_date='$date' 
       AND thewings_time_line.lead_owner=$user_id AND thewings_time_line.view_status=0 
       AND (thewings_time_line.follow_up_time BETWEEN NOW() AND NOW() + INTERVAL 10 MINUTE 
       OR thewings_time_line.follow_up_time < NOW()) limit 1;";
      
        // $sql = "SELECT thewings_time_line.id,thewings_time_line.lead_id, thewings_time_line.lead_owner, thewings_time_line.call_type, 
        // thewings_time_line.call_status, thewings_time_line.subject,thewings_time_line.comment,thewings_time_line.follow_up_date,
        // TIME_FORMAT(thewings_time_line.follow_up_time, '%h:%i:%s') as follow_up_time,
        // thewings_time_line.dismiss_time,thewings_time_line.view_status,thewings_time_line.insertStatus,
        // thewings_time_line.status,thewings_time_line.notification_before,thewings_time_line.alter_status,thewings_time_line.renew,
        // thewings_time_line.create_static,thewings_time_line.created_at,thewings_time_line.updated_at,
        // thewings_clients.student_name,thewings_clients.phone 
        // FROM `thewings_time_line` 
        // inner join thewings_clients on thewings_clients.id = thewings_time_line.lead_id 
        // WHERE thewings_time_line.call_status='7' 
        // AND thewings_time_line.follow_up_date='$date' 
        // AND thewings_time_line.lead_owner=$user_id 
        // AND thewings_time_line.view_status=0 
        // AND (thewings_time_line.follow_up_time BETWEEN TIME_FORMAT(NOW(), '%h:%i:%s') 
        // AND TIME_FORMAT( NOW() + INTERVAL 10 MINUTE, '%h:%i:%s') 
        // OR thewings_time_line.follow_up_time < TIME_FORMAT(NOW(), '%h:%i:%s')) limit 1;";
        $query =  $this->db->query($sql);
        return $query->getResult('array');
    }

    function UpdatedismissData($leadid){
        $currentData =   get_current_utc_time();
        $date =  date('Y-m-d',strtotime($currentData));
        $sql = "SELECT follow_up_time FROM `thewings_time_line` WHERE call_status='7'  AND id='$leadid' AND view_status='0'";
        $query =  $this->db->query($sql);
        $time  = $query->getRow();
        $newdate =  date('H:i:s',strtotime($time->follow_up_time . ' +10 minutes'));
        $update = "UPDATE thewings_time_line set follow_up_time='$newdate' where id='$leadid' ";
        $this->db->query($update);
        return true;

    }
    function updateNotificationAlter($leadId){
      $update = "UPDATE thewings_time_line set view_status=1 where  id IN($leadId)";    
       $this->db->query($update);
       return true;
        
    }

    //------------------------------------get duplicate data code-----------------------------------------
    function insertOld($id){
        $sql = "INSERT INTO thewings_clients_old (SELECT * FROM thewings_clients where id=$id);";
        $query =  $this->db->query($sql);
   }

    function updateOld($idnew,$idold){
        $sql = "SELECT * FROM `thewings_clients_temp` WHERE id=".$idnew;
        $result =  $this->db->query($sql)->getResult('array');
        unset($result[0]['id']);
        $result = array_reduce($result, 'array_merge', array());
        $fields = array();
        foreach($result as $key => $value) {
        $fields[] = $key . " = '" . $value . "'";
        }
        $fields = implode(', ', $fields);
        $updateuser = "UPDATE thewings_clients set $fields WHERE id=".$idold;
        return $query = $this->db->query($updateuser);
    }

    function deleteNew($id){
        $sql = "DELETE FROM thewings_clients_temp WHERE id=".$id;
        $query =  $this->db->query($sql);
        return $query; 
    }

    // function getLeadsForProcessAllData(){
    //     //$sql = "SELECT id,student_name,email,phone,father_name,city,course,zip,country from `thewings_clients` where email='$email' AND import_file_name='$file'";
    //     $sql = "SELECT * FROM thewings_clients_temp WHERE email NOT IN (select email from thewings_clients) limit 5000;";
    //     //$sql = "SELECT * FROM thewings_clients_temp WHERE email NOT IN (select email from thewings_clients) OR phone NOT IN (select phone from thewings_clients) limit 5000;";
    //     $query =  $this->db->query($sql);
    //     return $query->getResult();
    // }



    // function totalGetLeadsForProcessAllData(){
    //     //$sql = "SELECT id,student_name,email,phone,father_name,city,course,zip,country from `thewings_clients` where email='$email' AND import_file_name='$file'";
    //     $sql = "SELECT count(id) as Total FROM thewings_clients_temp WHERE email NOT IN (select email from thewings_clients) limit 5000;";
    //     $query =  $this->db->query($sql);
    //     $query = $query->getResult();
    //     return $query[0]->Total;
    // }

    // function countGetLeadsForProcessAllData(){
    //     //$sql = "SELECT id,student_name,email,phone,father_name,city,course,zip,country from `thewings_clients` where email='$email' AND import_file_name='$file'";
    //     //17-Feb
    //     $sql = "SELECT count(id) as Pure FROM thewings_clients_temp WHERE email NOT IN (select email from thewings_clients) limit 5000;";
    //     //$sql = "SELECT count(id) as Pure FROM thewings_clients_temp WHERE email NOT IN (select email from thewings_clients) or phone NOT IN (select phone from thewings_clients) limit 5000;";
    //     $query =  $this->db->query($sql);
    //     $query = $query->getResult();
    //     return $query[0]->Pure;
    // }

    function getLeadsForProcessAllData(){
        //$sql = "SELECT id,student_name,email,phone,father_name,city,course,zip,country from `thewings_clients` where email='$email' AND import_file_name='$file'";
        $sql = "SELECT * FROM thewings_clients_temp WHERE email NOT IN (select email from thewings_clients) limit 5000;";
        $query =  $this->db->query($sql);
        return $query->getResult();
    }

    function countGetLeadsForProcessAllData(){
        //$sql = "SELECT id,student_name,email,phone,father_name,city,course,zip,country from `thewings_clients` where email='$email' AND import_file_name='$file'";
        $sql = "SELECT count(id) as Pure FROM thewings_clients_temp WHERE email NOT IN (select email from thewings_clients) limit 5000;";
        $query =  $this->db->query($sql);
        $query = $query->getResult();
        return $query[0]->Pure;
    }

    function totalGetLeadsForProcessAllData(){
        //$sql = "SELECT id,student_name,email,phone,father_name,city,course,zip,country from `thewings_clients` where email='$email' AND import_file_name='$file'";
        $sql = "SELECT count(id) as Total FROM thewings_clients_temp;";
        $query =  $this->db->query($sql);
        $query = $query->getResult();
        return $query[0]->Total;
    }



    function insertNewLeads($new_data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('thewings_clients');
        return $builder->insertBatch($new_data);
        
    }

    function deleteNewLeads($id_array)
    {
        $sql = "delete from thewings_clients_temp where id IN ($id_array)";
        $query =  $this->db->query($sql);
        return $query;
    } 

    function countLeadTempData(){
        //$sql = "SELECT id,student_name,email,phone,father_name,city,course,zip,country from `thewings_clients` where email='$email' AND import_file_name='$file'";
        $sql = "SELECT id FROM thewings_clients_temp;";
        $query =  $this->db->query($sql);
        return $query->getResult();
    }
    function getLeadsFileName(){
        $sql = "SELECT DISTINCT import_file_name from thewings_clients";
        $query =  $this->db->query($sql);
        return $query->getResult();
    }

    function getLeadsFilterDetailsTemp(){
        $sql = "SELECT id,student_name,email,phone,father_name,city,course,zip,country from thewings_clients_temp";
        $query =  $this->db->query($sql);
        return $query->getResult();
    }

    function getLeadsFilterDatabyEmail($email,$file){
        $sql = "SELECT id,student_name,email,phone,father_name,city,course,zip,country from `thewings_clients` where email='$email' AND import_file_name='$file'";
        $query =  $this->db->query($sql);
        return $query->getRow();
    }

    function getLeadsFilterDatabyPhone($phone,$file){
        $sql = "SELECT id,student_name,email,phone,father_name,city,course,zip,country from `thewings_clients` where phone='$phone' AND import_file_name='$file'";
        $query =  $this->db->query($sql);
        return $query->getRow();
    }

    function getLeadsFilterDatabyName($sname,$fname,$file){
        $sql = "SELECT id,student_name,email,phone,father_name,city,course,zip,country from `thewings_clients` where student_name='$sname' AND father_name='$fname' AND import_file_name='$file'";
        $query =  $this->db->query($sql);
        return $query->getRow();
    }


    function insertData($data)
    { 
        $this->db->query($data);
        return $this->db->trans_commit();

    }

    function insertDatas($data)
    { 
        return $this->db->query($data);
    }
    
    function fetchData($data)
    { 
        return $this->db->query($data)->getRow(); 
    }

    function fetchDatas($data)
    { 
        return $this->db->query($data)->getResult(); 
    }

    function getAssignLead1($id){
        $newSql = "select * from thewings_time_line where lead_id=".$id." order by id DESC";
        $query =  $this->db->query($newSql);
        return  $query->getRow(); 
   }   
   
   function getAssignLeadReqExt()
   {
        $newSql = "select * from thewings_request_ext";
        $query =  $this->db->query($newSql);
        return  $query->getResult();
   }

    function deleteCategory($cat_id, $owner_id){
        $sql = "SELECT `lead_assigned_to` from thewings_clients where `course` = $cat_id AND lead_assigned_to like('%$owner_id%')";
        $query =  $this->db->query($sql);
        $query = $query->getRow();
        $result = $query->lead_assigned_to;
        $final  = str_replace(",".$owner_id, '', $query->lead_assigned_to);
        
        $update = "UPDATE thewings_clients set lead_assigned_to='".$final."' where `course` =$cat_id AND lead_assigned_to ='".$result."' ";
        if($this->db->query($update)){
            echo "1";
            exit;
        }else{
            echo "0";
            exit;
        }
    }

    function deleteSubCategory($sub_cat_id  , $owner_id){
        $sql = "SELECT `lead_assigned_to` from thewings_clients where `sub_cat` = $sub_cat_id AND lead_assigned_to like('%$owner_id%')";
        $query =  $this->db->query($sql);
        $query = $query->getRow();
        $result = $query->lead_assigned_to;
        $final  = str_replace(",".$owner_id, '', $query->lead_assigned_to);
        
        $update = "UPDATE thewings_clients set lead_assigned_to='".$final."' where `sub_cat` =$sub_cat_id AND lead_assigned_to ='".$result."' ";
        if($this->db->query($update)){
            echo "1";
            exit;
        }else{
            echo "0";
            exit;
        }
    }

    function deleteSubSubCategory($sub_sub_cat_id  , $owner_id){
        $sql = "SELECT `lead_assigned_to` from thewings_clients where `subcatlist` = $sub_sub_cat_id AND lead_assigned_to like('%$owner_id%')";
        echo $sql;
        exit;
        $query =  $this->db->query($sql);
        $query = $query->getRow();
        $result = $query->lead_assigned_to;
        $final  = str_replace(",".$owner_id, '', $query->lead_assigned_to);
        
        //deleteSubSubCategory

        $update = "UPDATE thewings_clients set lead_assigned_to='".$final."' where `subcatlist` =$sub_sub_cat_id AND lead_assigned_to ='".$result."' ";
        if($this->db->query($update)){
            echo "1";
            exit;
        }else{
            echo "0";
            exit;
        }
    }

    function updatecall_status_7($leadId,$lead_assigned_to){
        $sql = 'update thewings_time_line set view_status=1 
        where id = (select id from thewings_time_line where lead_id = '.$leadId.' 
        and call_status=7 and lead_owner='.$lead_assigned_to.' 
        and view_status=0 order by id ASC limit 1);';
        $this->db->query($sql);
        return true;
    }



        //------------------------------------get duplicate data code-----------------------------------------


    


}
