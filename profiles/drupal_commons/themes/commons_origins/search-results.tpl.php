<?php
  global $user;
  //dpm($search_results);
?>
<div class="search-results-page">
  <h1><?php echo t('Search results for ')?>"<?php echo $_REQUEST['term']?>"</h1>

  <div class="search-result-group">
    <?php if(!empty($search_results['events'])):?>
      <h2><?php echo t('Events')?></h2>
      <ul class="search-items">
      <?php foreach($search_results['events'] as $_event):?>
        <li>
          <?php echo $_event['picture'];?>
          <div class="search-result-text">
            <?php echo $_event['text'];?>  
          </div>
          <?php if(!$_event['accepted']):?>
            <div class="search-result-buttons">
              <a href="javascript: void(0);" class="black-button add-event-link" title="<?php echo $_event['event']['title']?>" id="event_<?php echo $_event['event']['nid']?>" onclick="acceptEvent(<?php echo $_event['event']['nid']?>)">Add to my calendar</a>  
            </div>
          <?php endif;?>
        </li>
      <?php endforeach;?>
      </ul>
    <?php endif;?>
  </div>

  <div class="search-result-group">
    <?php if(!empty($search_results['places'])):?>
      <h2><?php echo t('Places')?></h2>
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
      <h2><?php echo t('People')?></h2>
      <ul class="search-items">
      <?php foreach($search_results['users'] as $_uid => $_user):?>
        <li>
          <?php echo $_user['picture'];?>
          <div class="search-result-text">
            <?php echo $_user['text'];?>  
          </div>
          <?php if($_uid != $user->uid  && !$_user['is_friend']):?>
            <div class="search-result-buttons">
              <a href="/addfriend/<?php echo $_uid?>" class="black-button action-friend-user-page" title="<?php echo $_user['title']?>" id="add-friend-user-page"><?php echo t('Add friend')?></a>  
            </div>  
          <?php elseif($_uid != $user->uid):?>
            <div class="search-result-buttons i-like-this-place">        
              <a href="/removefriend/<?php echo $_uid?>" class="white-button action-friend-user-page" title="<?php echo $_user['title']?>" id="remove-friend-user-page"><?php echo t('Friend')?></a>  
            </div>  
          <?php endif;?>
          
        </li>
      <?php endforeach;?>
      </ul>
    <?php endif;?>
  </div>
</div>
