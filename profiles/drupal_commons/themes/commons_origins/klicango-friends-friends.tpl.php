<?php 
  global $user;
?>
<div id="profile-friends-list">
<?php if(in_array('individual', $user->roles)):?>
    <h2><?php echo t('My friends'); ?><a href="javascript: void(0);" style="cursor: default;"><sub>(<?php echo sizeof($users); ?>)</sub></a><a class="find-friend-link friend-link-list" href="javascript: void(0);" onclick="loadJoinFriends(0, 10);">Find friends</a></h2>
<?php else : ?>
    <h2><?php echo t('My followers'); ?><a href="javascript: void(0);" style="cursor: default;"><sub>(<?php echo sizeof($users); ?>)</sub></a></h2>
<?php endif; ?>
    <table>
        <tbody>
            <?php
                if (!empty($users)) {
                    $rows = array();
                    $i = 1;
                    $total = 0;
                    $html = '';
                    foreach ($users as $friend) { 
                        $html .= '<td class="col-' . $i . '"><a href="/user/' . $friend->uid . '"><img alt="" src="' . imagecache_create_url('profile_picture_big', $friend->picture) . '"></a></td>';
                        $i++;
                        $html .= '<td class="col-' . $i . '"><a href="/user/' . $friend->uid . '">' . $friend->first_name . ' ' . $friend->surname . '</a><div class="col-friends">' . $friend->friends_count . ' ' . (($friend->friends_count == 1) ? t('friend') : t('friends')) . '</div></td>';
                        $i++;
                        $total++;
                        if ($i == 5 || $total == sizeof($users)) {
                            $rows[] = $html;
                            $i = 1;
                            $html = '';
                        }
                    }
                    echo '<tr>' . implode('</tr><tr>', $rows) . '</tr>';
                } else {
                    echo '<tr><td>No friends found</td></tr>';
                }
            ?>
        </tbody>
    </table>
</div>