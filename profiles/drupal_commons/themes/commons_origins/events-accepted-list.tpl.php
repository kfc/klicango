<?php
    if ($public == true) {
        $type = 'Top public events<a href="javascript: void(0)" onclick="loadFindEvents(0, 10);">+ Find events</a>';
    } else {
        $type = 'My private events';
    }
?>
<div id="top-event-list">
    <h2><?php echo $type; ?></h2>
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