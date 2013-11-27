<div id="invite-friends-form" <?php if ($event_id == 0) echo 'class="friends-join"'; ?> title="Invite friends">
    <form id="invite-friends">
        <div class="form-item search-for-friends">
            <input type="text" name="field-search-for-friends" class="invite-friend-search" id="search-friends" placeholder="<?php echo t('Type at least 2 symbols to start search');?>"/>
        </div>
        <div class="scroll-pane" id="event_<?php echo $event_id; ?>">
        </div>
        <div class="form-submit">   
            <input type="button" value="<?php echo t('Invite')?>" onclick="preprocessRequest(<?php echo $event_id; ?>);"/>
        </div>
    </form>
</div>