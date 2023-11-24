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

$info = $user->get_id_info();
$smarty->assign('info',$info);

// page footer
page_footer("gifts");
