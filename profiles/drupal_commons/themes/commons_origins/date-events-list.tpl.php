<?php if(!empty($events)) : ?>
<div id="date-events-list" class="scroll-pane">
	<div class="list-item">
		<table>
			<?php
        foreach ($events as $event) {
            echo $event;
        }
            ?>
		</table>
	</div>

</div>
<?php else : ?>
<div style="margin-bottom: 10px;">
</div>
<?php endif; ?>