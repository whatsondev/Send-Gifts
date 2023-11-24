<?php

/**
 * giftcards

 */

// fetch bootloader
require('bootloader.php');

// giftcards enabled
if (!$system['pages_enabled'] || !$system['jobs_enabled']) {
  _error(404);
}

// user access
if ($user->_logged_in || !$system['system_public']) {
  user_access();
}

try {
    switch ($_GET['view']) {
        case '':
          // user access
          if ($user->_logged_in || !$system['system_public']) {
             user_access();
          }
          $smarty->assign('allcards', $user->get_all_cards());
          page_header(__("Gift Cards"));
    
          break;
    
        case 'my_cards':
          // user access
          if ($user->_logged_in || !$system['system_public']) {
            user_access();
          }
          $smarty->assign('allcards', $user->get_all_cards());
       
          // page header
          page_header(__("My Cards"));
    
          break;
        
    
        case 'send_cards':
          // user access
          user_access();
          $smarty->assign('allcards', $user->get_all_cards());
          // page header
          page_header(__("Send Cards"));
    
          break;
    
        default:
          _error(404);
          break;
      }
      /* assign variables */
      $smarty->assign('view', $_GET['view']);
    } catch (Exception $e) {
      _error(__("Error"), $e->getMessage());
    }

// page footer
page_footer("giftcards");
