<div class="card">
            <div class="card-header with-icon with-nav">
                <!-- panel title -->
                <div class="mb20">
                  <i class="fas fa-gift mr10"></i>{__("Gifts")}
                </div>
              </div>
              <div class="card-body">
                <div class="container">
                
{foreach $mygift as $m}
<div class="row my-2" style="border-radius:15px;border:1px solid black;padding:7px;">
    <div class="column1" >
      <img src="{$m['image']}" width="40px" height="40px">
    </div>
    <div class="column2" >
     {$m['name']}
    </div>
    <div class="column3 panel-mutual-friends-gift">
        <div class="mt10 clearfix">
        
            {foreach $m['im_users'] as $muser }
            
            
                <ul class="float-right mr20 row">
                    <li>
                        <a data-toggle="tooltip" data-placement="top" title="{$muser['user_firstname']}" class="post-avatar-picture-gift" href="{$system['system_url']}/{$muser['user_name']}" style="background-image:url('{$muser['user_picture']}');">
                        </a>
                    </li>
                </ul>
        
      
            {/foreach}
                            
        </div>
    </div>

    <div class="column4 float-right">
    <div data-toggle="modal" data-url="users/who_sends_gifts.php?giftid={$m['gift_id']}&user={$m['user_id']}" class="dot float-right">
       <span class="float-right"><b>{$m['count']}</b></span>
    </div>   
    </div>
</div>
 {/foreach}
</div>

              </div>

            </div>
