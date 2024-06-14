<?php
/**
 * Template part for displaying step-end
 *
 * @param array $args Contains 'content' which has the ACF fields for this block.
 */
$button_next_text = $content['step_end']['button_next_text'];
$button_prev_text = $content['step_end']['button_prev_text'];
$is_final = $content['step_end']['is_final'];
$type = $is_final ? 'submit' : 'button';
?>

    <div class="checklist-step__foot">
        <?php if (!empty($button_prev_text)): ?>
            <button class="checklist-nav__prev" data-step="<?= $args['count'] - 1 ?>">
                <?= $button_prev_text ?>
            </button>
        <?php endif; ?>
        <?php if (!empty($button_next_text)): ?>
            <button class="checklist-nav__next" type="<?= $type ?>" data-step="<?= $args['count'] + 1  ?>">
                <?= $button_next_text ?>
            </button>
        <?php endif; ?>
    </div>
</section>
