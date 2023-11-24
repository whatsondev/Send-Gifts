<?php

/**
 * profile
 * 
 * @package Sngine
 * @author Zamblek
 */

// fetch bootloader
require('bootloader.php');

// user access
if ($user->_logged_in || !$system['system_public']) {
  user_access();
}

// check username
if (is_empty($_GET['username']) || !valid_username($_GET['username'])) {
  _error(404);
}

try {


      /* gifts system */
      if ($system['gifts_enabled']) {
        /* get gifts */
        $gifts = $user->get_gifts();
        /* assign variables */
        $smarty->assign('gifts', $gifts);

        /* get gift */
        if (isset($_GET['gift']) && is_numeric($_GET['gift'])) {
          $gift = $user->get_gift($_GET['gift']);
          /* assign variables */
          $smarty->assign('gift', $gift);

        }
        $mygift = $user->get_my_gift($profile['user_id']);
        
         
          $smarty->assign('mygift', $mygift);

      }

} catch (Exception $e) {
  _error(__("Error"), $e->getMessage());
}

// page header
page_header($profile['name'], $profile['user_biography'], $profile['user_picture']);

// assign variables
$smarty->assign('profile', $profile);
$smarty->assign('view', $_GET['view']);

// page footer
page_footer("profile");
