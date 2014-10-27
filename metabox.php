<?php

add_action("admin_init", "metabox_admin");
add_action("save_post", "box_savedata");

function box_savedata($post_id ) {
	$program = sanitize_text_field($_POST['program']);
	$level = sanitize_text_field($_POST['level']);
	$completion = sanitize_text_field($_POST['completion']);
	$source = sanitize_text_field($_POST['source']);
	
	update_post_meta($post_id, "Program", $program);
	update_post_meta($post_id, "Level", $level);
	update_post_meta($post_id, "Estimated Completion Time", $completion);
	update_post_meta($post_id, "Download Source Files", $source);
	
}

function metabox_admin() {
	add_meta_box("tutorialdetails", "Tutorial Details", "box_tutdetail", "post", "side", "high");
}

function box_tutdetail($post) {
	
	$program =  get_post_meta($post->ID, 'Program', true);
	$level =  get_post_meta($post->ID, 'Level', true);
	$completion = get_post_meta($post->ID, 'Estimated Completion Time', true);
	
	$source = get_post_meta($post->ID, 'Download Source Files', true); ?>
	<style type="text/css">
		.boxtut input, .boxtut select {
			width:100%;
		}
	</style>
    <div class="boxtut">
    <label for="program">Program : </label>
    <input type="text" name="program" value="<?php echo $program; ?>" /><br />
	<label for="level">Level</label>
    <select name="level">
    	<option value=""></option>
    	<option value="Beginner" <?php echo (($level == "Beginner")?"selected":""); ?>>Beginner</option>
        <option value="Intermediate" <?php echo (($level == "Intermediate")?"selected":""); ?>>Intermediate</option>
        <option value="Advance" <?php echo (($level == "Advance")?"selected":""); ?>>Advance</option>
    </select>
    <br />
	<label for="completion">Estimate Completion Time</label>
    <input type="text" name="completion" value="<?php echo $completion; ?>" /><br />
	<label for="source">Source (URL)</label>
    <input type="text" name="source" value="<?php echo $source; ?>" />
    </div>
    <?php
}

?>