<?php

class Site_Checklist_Shortcode {

	public static function render_form_shortcode($atts) {
		$atts = shortcode_atts([
			'id' => null,
		], $atts, 'proacto_form');

		$form_id = intval($atts['id']);
		if (!$form_id) {
			return __('Invalid form ID.', 'site_checklist');
		}

		$form = get_post($form_id);
		if (!$form || $form->post_type !== 'forms') {
			return __('Form not found.', 'site_checklist');
		}

		// Get the custom fields associated with the form
		$form_data = get_post_meta($form_id);

		// Get the flexible content field
		$form_content = get_field('builder', $form_id);
        $form_options = get_field('form_options', $form_id);

        $step_counter = 0;

		// Customize the output based on your form structure
		ob_start();
		?>
		<form class="proacto-form">
            <?php
            foreach ($form_content as $content) {

	            $layout = $content['acf_fc_layout']; // Get the layout name


	            if ($layout == 'step_start') {
                    $step_counter++;
	            }

	            $template_path = plugin_dir_path(__FILE__) . '../template-parts/form-' . $layout . '.php';

	            if (file_exists($template_path)) {
		            $args = [
			            'content' => $content,
			            'count' => $step_counter,
		            ];
		            include $template_path;
	            } else {
		            echo __('Template not found: ', 'site_checklist') . $template_path;
	            }
            }
            ?>
            <div class="checklist-final hidden">
                <div id="checklist-final__circle" class="checklist-final__circle"></div>
                <div class="checklist-final__texts">
                    <h2 class="checklist-final__title low hidden">
                        <?= $form_options['title_low'] ?>
                    </h2>
                    <h2 class="checklist-final__title medium hidden">
		                <?= $form_options['title_medium'] ?>
                    </h2>
                    <h2 class="checklist-final__title hight hidden">
		                <?= $form_options['title_hight'] ?>
                    </h2>
                    <div class="checklist-final__text low hidden">
	                    <?= $form_options['text_low'] ?>
                    </div>
                    <div class="checklist-final__text medium hidden">
		                <?= $form_options['text_medium'] ?>
                    </div>
                    <div class="checklist-final__text hight hidden">
		                <?= $form_options['text_hight'] ?>
                    </div>

                    <a href="." class="checklist-final__refresh">
                        <?= __('Пройти ще раз', 'site_checklist') ?>
                    </a>
                </div>
            </div>
		</form>
		<?php
		return ob_get_clean();
	}
}
