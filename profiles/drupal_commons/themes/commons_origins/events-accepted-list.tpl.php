<?php
    if ($public == true) {
        $type = 'public';
    } else {
        $type = 'private';
    }
?>
<div id="top-event-list">
    <h2>My <?php echo $type; ?> events<a href="">+ Find events</a></h2>
    <table>
        <tbody>
            <?php
                if (!empty($events)) {
                    foreach ($events as $event) {
                        echo $event;
                    }
                } else {
                    echo '<tr><td>No events found</td></tr>';
                }
            ?>
        </tbody>
    </table>
</div>