<?php
/**
 * Template part for displaying Step start
 *
 * @param array $args Contains 'content' which has the ACF fields for this block.
 */
$name = $content['step_start']['step_name'];
$hidden = $args['count'] > 1 ? 'hidden' : '';
?>

<section class="checklist-step <?= $hidden ?>" data-name="<?= $name ?>" data-step="<?= $args['count'] ?>">

