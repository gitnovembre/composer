<div class="form-group">
	<?php if(!empty($input->label_name)) : ?>

		<label for="<?php echo $input->label_slug; ?>" aria-label="<?php echo $input->label_slug; ?>"><?php echo $input->label_name; ?></label>

	<?php endif; ?>
	<select class="form-control" <?php echo $input->attributes; ?>>
		<?php echo $input->listOptions; ?>
	</select>

	<?php if(!empty($input->text_help)) : ?>

		<p class="help-block"><?php echo $input->text_help; ?></p>

	<?php endif; ?>
</div>
