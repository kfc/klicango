<?php
  global $user;
  //dpm($search_results);
?>
<div class="search-results-page">
  <h1><?php echo t('Search results for ')?>"<?php echo $_REQUEST['term']?>"</h1>

  <div class="search-result-group">
    <?php if(!empty($search_results['events'])):?>
      <div class="group-title">
        <span><?php echo t('Events')?></span>
        <div class="search-result-group-line"></div>
      </div>
      <ul class="search-items">
      <?php foreach($search_results['events'] as $_event):?>
        <li>
          <?php echo $_event['picture'];?>
          <div class="search-result-text">
            <?php echo $_event['text'];?>  
          </div>
          <?php if(!$_event['accepted']):?>
            <div class="search-result-buttons">
              <a href="javascript: void(0);" class="black-button add-event-link" title="<?php echo $_event['event']['title']?>" id="event_<?php echo $_event['event']['nid']?>" onclick="acceptEvent(<?php echo $_event['event']['nid']?>)"><?php echo t("Add to my calendar")?></a>  
            </div>
          <?php else:?>
            <div class="search-result-buttons">
              <a href="javascript: void(0);" class="white-button already-accepted add-event-link" title="<?php echo $_event['event']['title']?>" id="event_<?php echo $_event['event']['nid']?>" onclick="acceptEvent(<?php echo $_event['event']['nid']?>)"><?php echo t("I'm going")?></a>  
            </div>
          <?php endif;?>
        </li>
      <?php endforeach;?>
      </ul>
    <?php endif;?>
  </div>

  <div class="search-result-group">
    <?php if(!empty($search_results['places'])):?>
      <div class="group-title">
        <span><?php echo t('Places')?></span>
        <div class="search-result-group-line"></div>
      </div>
      <ul class="search-items">
      <?php foreach($search_results['places'] as $_uid => $_place):?>
        <li>
          <?php echo $_place['picture'];?>
          <div class="search-result-text">
            <?php echo $_place['text'];?>  
          </div>
          <?php if(!$_place['followed']):?>
            <div class="search-result-buttons">
              <a href="/follow/<?php echo $_uid?>" class="black-button follow-place-action" title="<?php echo $_place['title']?>" id="follow-place-calendar"><?php echo t('Follow this place')?></a>  
            </div>  
          <?php else:?>
            <div class="search-result-buttons i-like-this-place">        
              <a href="/unfollow/<?php echo $_uid?>" class="white-button follow-place-action" title="<?php echo $_place['title']?>" id="unfollow-place-calendar"><?php echo t('I like this place')?></a>  
            </div>  
          <?php endif;?>
          
        </li>
      <?php endforeach;?>
      </ul>
    <?php endif;?>
  </div>

  <div class="search-result-group">
    <?php if(!empty($search_results['users'])):?>
      <div class="group-title">
        <span><?php echo t('People')?></span>
        <div class="search-result-group-line"></div>
      </div>
      <ul class="search-items">
      <?php foreach($search_results['users'] as $_uid => $_user):?>
        <li>
          <?php echo $_user['picture'];?>
          <div class="search-result-text">
            <?php echo $_user['text'];?>  
          </div>
          <?php if($_uid != $user->uid  && (!$_user['friend_status'] || !$_user['friend_status'] == 4) ):?>
            <div class="search-result-buttons">
              <a href="/addfriend/<?php echo $_uid?>" class="black-button action-friend-search-page" title="<?php echo $_user['title']?>" rel="add-friend-user-page"><?php echo t('Add friend')?></a>  
            </div>  
          <?php elseif($_uid != $user->uid  && $_user['friend_status'] == 3):?>
            <div class="search-result-buttons i-like-this-place">        
              <a href="/removefriend/<?php echo $_uid?>" class="white-button action-friend-search-page" title="<?php echo $_user['title']?>" rel="remove-friend-user-page"><?php echo t('Friend')?></a>  
            </div>  
          <?php elseif($_uid != $user->uid  && $_user['friend_status'] == 1):?>
            <div class="search-result-buttons i-like-this-place">        
              <a href="/removefriend/<?php echo $_uid?>" class="white-button action-friend-search-page" title="<?php echo $_user['title']?>" rel="remove-friend-user-page"><?php echo t('Invitation pending')?></a>  
            </div>  
          <?php endif;?>
          
        </li>
      <?php endforeach;?>
      </ul>
    <?php endif;?>
  </div>
</div>
