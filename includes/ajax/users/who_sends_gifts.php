<?php

/**
 * ajax -> posts -> who votes

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

  // get votes
  $users = $user->who_gifts($_GET['giftid'],$_GET['user']);
  /* assign variables */
  $smarty->assign('users', $users);
  /* return */
  $return['template'] = $smarty->fetch("ajax.who_gifts.tpl");
  $return['callback'] = "$('#modal').modal('show'); $('.modal-content:last').html(response.template);";

  // return & exit
  return_json($return);
} catch (Exception $e) {
  modal("ERROR", __("Error"), $e->getMessage());
}
