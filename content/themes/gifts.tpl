{include file='_head.tpl'}
{include file='_header.tpl'}

<!-- page content -->
<div class="container mt20 offcanvas">
  <div class="row">



      <!-- side panel -->
      <div class="col-md-4 col-lg-3 offcanvas-sidebar js_sticky-sidebar">
        {include file='_sidebar.tpl'}
      </div>
      <!-- side panel -->

      <!-- content panel -->
      <div class="col-md-8 col-lg-9 offcanvas-mainbar">

        <!-- tabs -->
        <div class="content-tabs  shadow-sm clearfix">
          <ul>
            <li {if $view == ""}class="active" {/if}>
                <a href="{$system['system_url']}/gifts/">{__("Gift Cards")}</a>
            </li>
            
         
          </ul>
        </div>
        <!-- tabs -->
      
     
        
        <!-- content -->
   {if $view == ""}
        
            <div class="card">
              <div class="card-header bg-transparent">
                <strong>{__("New Users")}</strong>
              </div>
              <div class="card-body">
               <ul class="">
                  {foreach $info as $_user}
                  {include file='__feeds_user.tpl' _tpl="list" _connection="gifts"}
                    
                  {/foreach}
                </ul>

              </div>
            </div>
              
       


        {/if}

      </div>
      <!-- content panel -->

  </div>
</div>


<!-- page content -->

{include file='_footer.tpl'}



