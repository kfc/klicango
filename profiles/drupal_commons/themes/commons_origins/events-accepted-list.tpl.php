<div id="top-event-list">
    <h2>My public events<a href="">+ Find events</a></h2>
    <table>
        <tbody>
            <?php
                foreach ($events as $event) {
                    echo $event;
                }
            ?>
        </tbody>
    </table>
</div>