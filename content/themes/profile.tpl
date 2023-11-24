    <!-- gifts -->
            {if $user->_logged_in && $user->_data['user_id'] != $profile['user_id'] && $system['gifts_enabled']}
              {if $profile['user_privacy_gifts'] == "public" || ($profile['user_privacy_gifts'] == "friends" && $profile['we_friends'])}
                <button type="button" class="btn btn-block btn-md bg-pink border-0 rounded-pill mb20" data-toggle="modal" data-url="#gifts" data-options='{literal}{{/literal}"uid": {$profile["user_id"]}{literal}}{/literal}'>
                  <i class="fas fa-gift fa-lg mr10"></i>{__("Send a Gift")}
                </button>
              {/if}
            {/if}
  <!-- gifts -->
  <!-- Gift post -->
    
            {if $user->_logged_in && $mygift != null}
            
                          {include file='_gifts.tpl'}
                           
                
            {/if}
<!-- Gift post -->

{if $gift}
  <script>
    $(function() {
      modal('#gift');
    });
  </script>
{/if}
