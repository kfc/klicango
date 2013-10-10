<div id="profile-friends-list">
    <h2><?php echo t('My friends'); ?><a href="javascript: void(0);" style="cursor: default;"><sub>(<?php echo sizeof($users); ?>)</sub></a><a class="find-friend-link" href="">+ Find friends</a></h2>
    <table>
        <tbody>
            <?php
                if (!empty($users)) {
                    $rows = array();
                    $i = 1;
                    $total = 0;
                    $html = '';
                    foreach ($users as $user) { 
                        $html .= '<td class="col-' . $i . '"><a href="/user/' . $user->uid . '"><img alt="" src="' . imagecache_create_url('profile_picture_big', $user->picture) . '"></a></td>';
                        $i++;
                        $html .= '<td class="col-' . $i . '"><a href="/user/' . $user->uid . '">' . $user->first_name . ' ' . $user->surname . '</a><div class="col-friends">' . $user->friends_count . ' ' . (($user->friends_count == 1) ? t('friend') : t('friends')) . '</div></td>';
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