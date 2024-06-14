<?php
/**
 * Template part for displaying choises
 *
 * @param array $args Contains 'content' which has the ACF fields for this block.
 */
$title = $content['choices_block']['title'];
$description = $content['choices_block']['description'];
$description_placement = $content['choices_block']['description_placement'];
$block_weight = $content['choices_block']['block_weight'];
$fields = $content['choices_block']['choices'];
$choices_type = $content['choices_block']['choices_type'];
?>

<div class="checklist-block choises" data-weight="<?= $block_weight > 0 ? $block_weight : 0 ?>">
    <span class="checklist-block__validation">
        <?= __('Зверніть увагу на це поле', 'site_checklist') ?>
    </span>
	<p class="checklist-block__title">
		<?= $title ?>
	</p>

	<?php if(!empty($description)): ?>
        <div class="checklist-block__description <?= $description_placement ?>">
            <?= $description ?>
        </div>
    <?php endif; ?>

	<?php foreach ( $fields as $key => $field ) : ?>
        <div class="checklist-choise-wrap">
            <input type="<?= $choices_type ?>"
                   name="<?= $field['name'] ?>"
                   id="checklist-field_<?= $field['name'] . '_' . $key ?>"
                   class="checklist-field"
                   data-weight="<?= $field['weight'] > 0 ? $field['weight'] : 0 ?>">
            <label for="checklist-field_<?= $field['name'] . '_' . $key ?>">
                <?= $field['title'] ?>
            </label>
        </div>
	<?php endforeach ?>
</div>