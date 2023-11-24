<?php

 /**
   * get_gifts
   * 
   * @return array
   */
  public function get_gifts()
  {
    global $db;
    $gifts = [];
    $get_gifts = $db->query("SELECT * FROM gifts") or _error("SQL_ERROR_THROWEN");
    if ($get_gifts->num_rows > 0) {
      while ($gift = $get_gifts->fetch_assoc()) {
        $gifts[] = $gift;
      }
    }
    return $gifts;
  }


  /**
   * get_gift
   * 
   * @return array
   */
  public function get_gift($gift_id)
  {
    global $db;
    $get_gift = $db->query(sprintf("SELECT gifts.image, users.user_name, users.user_firstname, users.user_lastname FROM users_gifts INNER JOIN gifts ON users_gifts.gift_id = gifts.gift_id INNER JOIN users ON users_gifts.from_user_id = users.user_id WHERE users_gifts.id = %s AND users_gifts.to_user_id = %s", secure($gift_id, 'int'), secure($this->_data['user_id'], 'int'))) or _error("SQL_ERROR_THROWEN");
    if ($get_gift->num_rows == 0) {
      return $false;
    }
    return $get_gift->fetch_assoc();
  }

  public function get_my_gift($user){
   
    global $db;
    $gifts = [];
    $get_gifts = $db->query(sprintf("SELECT gifts.gift_id,gifts.image,gifts.name from (SELECT gift_id FROM `users_gifts` WHERE to_user_id=%s group by gift_id ) as t JOIN gifts where t.gift_id=gifts.gift_id",secure($user,'int'))) or _error("SQL_ERROR_THROWEN");
    if ($get_gifts->num_rows > 0) {
      while ($gift = $get_gifts->fetch_assoc()) {
       
        $gift_id= $gift['gift_id'];
        $gift['image']=get_picture($gift['image'],1);
        $gift_users=$db->query(sprintf("SELECT * from users JOIN (SELECT from_user_id FROM `users_gifts` WHERE gift_id=%s and to_user_id=%s)as t where users.user_id= t.from_user_id",secure($gift_id,'int'),secure($user,'int'))) or _error("SQL_ERROR_THROWEN");
        if ($gift_users->num_rows > 0) {
          $ii=0;
          while ($g = $gift_users->fetch_assoc()) {
            $ii++;
            $g['user_picture']=get_picture($g['user_picture'],1);
            $gift['users'][]=$g;
            if($ii<4){
              $gift['im_users'][]=$g;
            }
          }
        }
       
        $gift['count']=$ii;
        $gift['user_id']= $user;
        $gifts[] = $gift;
        
      }
      
    return $gifts;
  }
}

public function who_gifts($gift_id, $user){
  // echo $user_id;
  global $db;
  $gifts = [];
  $gift_users=$db->query(sprintf("SELECT * from users JOIN (SELECT from_user_id FROM `users_gifts` WHERE gift_id=%s and to_user_id=%s)as t where users.user_id= t.from_user_id",secure($gift_id,'int'),secure($user,'int'))) or _error("SQL_ERROR_THROWEN");
  if ($gift_users->num_rows > 0) {
   
    while ($g = $gift_users->fetch_assoc()) {
      $g['user_picture']=get_picture($g['user_picture'],1);
      $gifts[] = $g;
    }
  }
  return $gifts;
}

  public function get_id_info(){
    global $db;
    // echo $username;
    $gifts = [];
    $get_gift = $db->query(sprintf("SELECT * FROM `users` where user_registered > now() - INTERVAL 5 day ORDER BY user_id DESC LIMIT 10")) or _error("SQL_ERROR_THROWEN");
    if ($get_gift->num_rows == 0) {
      return $false;
    }
    if ($get_gift->num_rows > 0) {
      while ($gift = $get_gift->fetch_assoc()) {
        $gift['user_picture'] = get_picture($gift['user_picture'], $gift['user_gender']);
        $gift['mutual_friends_count'] = $this->get_mutual_friends_count($gift['user_id']);
        $gifts[] = $gift;
      }
      }
    
    return $gifts;
  }

  /**
   * send_gift
   *
   * @param integer $user_id
   * @param integer $gift_id
   * 
   * @return void
   */
  public function send_gift($user_id, $gift_id)
  {
    global $db, $system;
    /* check if the viewer allowed to send a gift to the target */
    $get_target_user = $db->query(sprintf("SELECT user_privacy_gifts FROM users WHERE user_id = %s", secure($user_id, 'int'))) or _error("SQL_ERROR_THROWEN");
    if ($get_target_user->num_rows == 0) {
      _error(400);
    }
    $target_user = $get_target_user->fetch_assoc();
    if ($target_user['user_privacy_gifts'] == "me" || ($target_user['user_privacy_gifts'] == "friends" && !$this->friendship_approved($user_id))) {
      throw new Exception(__("You can't send a gift to this user"));
    }
    /* send the gift to the target user */
    $db->query(sprintf("INSERT INTO users_gifts (from_user_id, to_user_id, gift_id) VALUES (%s, %s, %s)", secure($this->_data['user_id'], 'int'),  secure($user_id, 'int'), secure($gift_id, 'int'))) or _error("SQL_ERROR_THROWEN");
    /* post new notification */
    $this->post_notification(array('to_user_id' => $user_id, 'action' => 'gift', 'node_url' => $db->insert_id));
  }

?>