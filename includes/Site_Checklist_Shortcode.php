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

        <?php
		$template_path = plugin_dir_path(__FILE__) . '../template-parts/hardcode_form.php';

		if (file_exists($template_path)) {
			include $template_path;
		}
        ?>

        <?php if (false) : ?>

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
            <div class="checklist-loading hidden">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M80 40C80 62.0914 62.0914 80 40 80C17.9086 80 0 62.0914 0 40C0 17.9086 17.9086 0 40 0C62.0914 0 80 17.9086 80 40ZM5.6 40C5.6 58.9986 21.0014 74.4 40 74.4C58.9986 74.4 74.4 58.9986 74.4 40C74.4 21.0014 58.9986 5.6 40 5.6C21.0014 5.6 5.6 21.0014 5.6 40Z" fill="#E9F0FA"/>
                    <path d="M66.3044 13.6956C67.3978 12.6022 67.4039 10.8209 66.2366 9.80658C59.7912 4.20556 51.6998 0.797109 43.1384 0.123306C33.6436 -0.623947 24.1938 2.04118 16.4886 7.63932C8.78341 13.2375 3.32856 21.4012 1.1052 30.6622C-0.899617 39.0129 -0.15836 47.7615 3.17679 55.6223C3.78077 57.0458 5.47671 57.5905 6.85456 56.8885C8.23241 56.1864 8.76869 54.5037 8.18096 53.0734C5.44186 46.4071 4.85702 39.0232 6.55047 31.9695C8.46256 24.005 13.1537 16.9842 19.7802 12.1698C26.4066 7.35542 34.5335 5.0634 42.699 5.70604C49.9308 6.2752 56.7725 9.11315 62.2661 13.7782C63.4449 14.7791 65.2109 14.7891 66.3044 13.6956Z" fill="#B6009C"/>
                </svg>
            </div>
            <div class="checklist-final hidden">
                <div id="checklist-final__circle" class="checklist-final__circle"></div>
                <div class="checklist-final__texts">
                    <div class="checklist-final__diagram">
                        <svg width="260" height="260" viewBox="0 0 260 260" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="low" d="M221.67 151.686C228.122 153.204 234.654 149.204 235.434 142.622C237.915 121.692 234.115 100.396 224.376 81.5004C214.637 62.6052 199.496 47.1544 181.01 37.0311C175.197 33.8479 168.149 36.8473 165.642 42.9821L163.478 48.2775C160.971 54.4124 163.978 61.3413 169.646 64.777C181.635 72.0453 191.465 82.5175 197.958 95.1167C204.452 107.716 207.278 121.798 206.242 135.78C205.752 142.389 209.65 148.859 216.102 150.377L221.67 151.686Z" fill="#F77878"/>
                            <path class="medium" d="M37.1528 114.716C30.6148 113.631 24.363 118.057 24.0223 124.676C22.8898 146.678 28.6323 168.6 40.6108 187.326C54.755 209.438 76.5908 225.525 101.901 232.481C127.212 239.436 154.202 236.766 177.659 224.987C197.525 215.011 213.663 199.102 223.933 179.61C227.023 173.747 223.91 166.748 217.736 164.34L212.407 162.261C206.232 159.853 199.353 162.971 196.008 168.693C188.589 181.388 177.614 191.752 164.322 198.427C147.433 206.908 128 208.83 109.776 203.822C91.5529 198.815 75.8311 187.232 65.6473 171.311C57.6326 158.782 53.4953 144.265 53.6047 129.561C53.654 122.934 49.334 116.738 42.796 115.653L37.1528 114.716Z" fill="#F7C478"/>
                            <path class="high" d="M151.887 38.4352C153.428 31.9894 149.451 25.4426 142.873 24.6387C120.231 21.8719 97.1777 26.4655 77.2047 37.9169C57.2316 49.3683 41.6209 66.9424 32.5698 87.8803C29.94 93.9636 33.5807 100.703 39.9219 102.63L45.3952 104.293C51.7364 106.22 58.3562 102.582 61.2509 96.6199C67.9168 82.8909 78.5888 71.3822 91.9874 63.7002C105.386 56.0182 120.71 52.6225 135.925 53.8058C142.533 54.3197 149.017 50.4447 150.558 43.9989L151.887 38.4352Z" fill="#78F77D"/>
                        </svg>
                        <p class="checklist-final__diagram_percentage">
                            <span class="num">0</span>
                            %
                        </p>
                    </div>
                    <h2 class="checklist-final__title low hidden">
                        <?= $form_options['title_low'] ?>
                    </h2>
                    <h2 class="checklist-final__title medium hidden">
		                <?= $form_options['title_medium'] ?>
                    </h2>
                    <h2 class="checklist-final__title high hidden">
		                <?= $form_options['title_hight'] ?>
                    </h2>
                    <div class="checklist-final__text low hidden">
	                    <?= $form_options['text_low'] ?>
                    </div>
                    <div class="checklist-final__text medium hidden">
		                <?= $form_options['text_medium'] ?>
                    </div>
                    <div class="checklist-final__text high hidden">
		                <?= $form_options['text_hight'] ?>
                    </div>

                    <a href="." class="checklist-final__refresh">
                        <?= __('Пройти ще раз', 'site_checklist') ?>
                    </a>
                </div>
            </div>
		</form>
        <?php endif; ?>
		<?php
		return ob_get_clean();
	}
}
