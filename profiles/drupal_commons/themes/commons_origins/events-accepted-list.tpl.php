<?php
    if ($public == true) {
        $type = 'Top public events';
    } else {
        $type = 'My private events';
    }
?>
<div id="top-event-list">
    <h2><?php echo $type; ?><a href="">+ Find events</a></h2>
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