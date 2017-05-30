<div class="form-group">
	<?php if(!empty($input->label_name)) : ?>

		<label for="<?php echo $input->label_slug; ?>" aria-label="<?php echo $input->label_slug; ?>"><?php echo $input->label_name; ?></label>

	<?php endif; ?>

	<input type="file" <?php echo $input->attributes; ?> />

	<?php if(!empty($input->text_help)) : ?>

		<p class="help-block"><?php echo $input->text_help; ?></p>

	<?php endif; ?>

	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width:2em;">0%</div>
    </div>

    <div id="status"></div>
</div>
