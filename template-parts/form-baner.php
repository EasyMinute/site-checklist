<?php
/**
 * Template part for displaying baner
 *
 * @param array $args Contains 'content' which has the ACF fields for this block.
 */
$title = $content['baner']['title'];
$logo = $content['baner']['logo'];
$form_text = $content['baner']['form_text'];
$loading_text = $content['baner']['loading_text'];
$final_text = $content['baner']['final_text'];

?>

<div class="checklist-baner checklist-block">
    <div class="checklist-baner__header">
        <img src="<?= esc_url( $logo['url'] ) ?>" alt="<?= esc_attr( $logo['alt'] ) ?>">
    </div>
    <div class="checklist-baner__main">
        <h1><?= $title ?></h1>
        <p><?= $form_text ?></p>
    </div>
</div>
