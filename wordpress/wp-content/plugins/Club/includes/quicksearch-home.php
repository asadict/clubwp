<?php
function quick_home_search_shortcode(){
global $wpdb,$post; ?>
<div class="search-main quick-search-home">
    <form role="search" method="post" id="quicksearch" name="quicksearch" action="/sports-offer">
<!--         <input type="hidden" name="post_type" value="clubjobs" /> -->
<div class="row">
    <div class="custom-col-6 ">
        <div class="row custom-row">
          <div class="custom-col custom-col-md-6 custom-col-xl-6">
            <div class="custom-form-group">
                    <select name="quick_sports" id="quick_sports" class="custom-form-control">
                        <option value="" selected >Sports</option>
                        <?php
                        $quick_sports = get_terms([
                                'taxonomy'  => 'sports',
                                'hide_empty'    => false
                        ]);
                        foreach($quick_sports as $tag){ ?>
                        <option value="<?php echo $tag->term_id;?>" <?php if($tag->term_id == $_POST['quick_sports']){ echo "selected"; }?>><?php echo $tag->name; ?></option>
                   <?php } ?>
                    </select>
              </div> 
            </div>
            <div class="custom-col custom-col-md-6 custom-col-xl-6">
              <div class="custom-form-group">
                    <select name="quick_target_group" id="quick_target_group" class="custom-form-control">
                        <option value="" selected >Target group</option>
                        <?php
                        $quick_target_group = get_terms([
                                'taxonomy'  => 'target_groups',
                                'hide_empty'    => false
                        ]);
                        foreach($quick_target_group as $tag){ ?>
                        <option value="<?php echo $tag->term_id;?>" <?php if($tag->term_id == $_POST['quick_target_group']){ echo "selected"; } ?>><?php echo $tag->name; ?></option>
                   <?php } ?>
                    </select>
              </div> 
            </div>
            
        </div>
    </div>
    <div class="custom-col-3">
         <div class="search-submit contact-footer">
                  <!-- <input type="submit" name="searchsubmit"  class="input-arrow" id="searchsubmit" value="Submit" onclick="location.href='<?php //echo "/provider-detail"; ?>'"  /> -->
                  <button type="submit" name="searchsubmit" class="input-arrow" id="searchsubmit" onclick="location.href='<?php echo "/provider-detail"; ?>'">Submit</button>  
          </div>
      </div>
  </div>
</form>  
</div>
<?php
}
add_shortcode('QuickHomeSearch','quick_home_search_shortcode'); ?>
