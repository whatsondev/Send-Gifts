<?php

/**
 * ajax -> posts -> story
 * 
 * @package Sngine
 * @author Zamblek
 */

// fetch bootstrap
require('../../../bootstrap.php');

// check AJAX Request
is_ajax();

// user access
user_access(true);


try {

  // initialize the return array
    $return = array();
    // $bd = $GET['id'];
    $gifts= $user->get_gifts();
    $smarty->assign('gifts', $gifts);

    
    $uid= $_GET['id'];
    $smarty->assign('uid', $uid);
    $return['interest_publisher'] = $smarty->fetch("ajax.send.gift.tpl");
    $return['callback'] = "$('#modal').modal('show'); $('.modal:last').html(response.interest_publisher);";
       
  // return & exit
  return_json($return);
} catch (Exception $e) {
  modal("ERROR", __("Error"), $e->getMessage());
}
