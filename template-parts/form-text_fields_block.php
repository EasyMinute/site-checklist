<?php
/**
 * Template part for displaying text-fields-block
 *
 * @param array $args Contains 'content' which has the ACF fields for this block.
 */
$title = $content['text_fields_block']['title'];
$description = $content['text_fields_block']['description'];
$description_placement = $content['text_fields_block']['description_placement'];
$block_weight = $content['text_fields_block']['block_weight'];
$fields = $content['text_fields_block']['fields'];
?>

<div class="checklist-block texted" data-weight="<?= isset($block_weight) ? $block_weight : 0 ?>">
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
        <input type="text"
               name="<?= $field['name'] ?>"
               id="checklist-field_<?= $field['name'] . '_' . $key ?>"
               class="checklist-field"
               data-weight="<?= $field['weight'] ?>"
               placeholder="<?= $field['title'] ?>">
    <?php endforeach ?>
</div>