
<div class="modal-dialog ">
<div class="modal-content">
<div class="modal-header">
          <h6 class="modal-title"><i class="fa fa-gift mr5"></i>{__("Gifts")}</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
</div>
   <div class="modal-body">
 <form class="js_ajax-forms" data-url="users/gifts.php?do=send&uid={$uid}">
          <div class="">
            <div class="js_scroller" data-slimScroll-height="440">
              <div class="row no-gutters">
                {foreach $gifts as $gift}
                  <div class="col-12 col-sm-6 col-md-4 ptb5 plr5">
                    <input class="x-hidden input-label" type="radio" name="gift" value="{$gift['gift_id']}" id="gift_{$gift['gift_id']}" />
                    <label class="button-label-image" for="gift_{$gift['gift_id']}">
                      <img src="{$system['system_uploads']}/{$gift['image']}" />
                    </label>
                  </div>
                {/foreach}
              </div>
            </div>
            <!-- error -->
            <div class="alert alert-danger mb0 mt10 x-hidden"></div>
            <!-- error -->
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{__("Send")}</button>
          </div>
        </form>
</div>
</div>
</div>
