<?php 
namespace App\Controllers;

class Google extends Security_Controller
{
  public function index()
  {
      $view_data['tab'] = clean_data($tab);
      return $this->template->rander("google/index", $view_data);
  }
}
?>









