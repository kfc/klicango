<div id="invite-friends-form" title="Invite friends">
    <form id="invite-friends">
        <div class="form-item search-for-friends">
            <input type="text" name="field-search-for-friends" id="search-friends" placeholder="<?php echo t('Type at least 2 symbols to start search');?>"/>
        </div>
        <div class="scroll-pane">
        </div>
        <div class="form-submit">   
            <input type="button" value="<?php echo t('Invite')?>" onclick="preprocessRequest(<?php echo $event_id; ?>);"/>
        </div>
    </form>
</div>