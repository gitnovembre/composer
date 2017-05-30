<div class="checkbox">
	<?php if (!empty($input->label_slug)) :?>

	<label for="<?php echo $input->label_slug; ?>" aria-label="<?php echo $input->label_slug; ?>">

	<?php else : ?>

	<label aria-label="<?php echo $input->label_slug; ?>">

	<?php endif; ?>

		<input type="checkbox" <?php echo $input->attributes; ?> />
		<?php echo $input->label_name; ?>

	</label>

	<?php if(!empty($input->text_help)) : ?>

		<p class="help-block"><?php echo $input->text_help; ?></p>

	<?php endif; ?>
</div>
