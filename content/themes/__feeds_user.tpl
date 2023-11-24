 <li class="feeds-item" {if $_user['id']}data-id="{$_user['id']}" {/if}>
    <div class="data-container {if $_small}small{/if}">
      <a class="data-avatar" href="{$system['system_url']}/{$_user['user_name']}{if $_search}?ref=qs{/if}">
        
        <img src="{$_user['user_picture']}" alt="">
        {if $_reaction}
          <div class="data-reaction">
            <div class="inline-emoji no_animation">
              {include file='__reaction_emojis.tpl' _reaction=$_reaction}
            </div>
          </div>
        {/if}
      </a>
      <div class="data-content">
        <div class="float-right">
          <!-- buttons -->
          {if $_connection == "gifts"}
            
             <button class="btn btn-block btn-sm btn-side bg-pink border-0 rounded-pill mb20" data-toggle="modal" data-url="posts/gift_wish.php?id={{$_user['user_id']}}" class="btn-success wish-button" data-uid="{$_user['user_id']}"><i class="fas fa-gift fa-lg mr10"></i><span class="gift-cards">Send Card</span></button>
              
         
{/if}
 </div>
          </div>