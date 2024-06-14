<?php

class Site_Checklist_Settings {

	public static function add_admin_menu() {
		add_options_page('Site Checklist Settings', 'Site Checklist', 'manage_options', 'site_checklist', [self::class, 'options_page']);
	}

	public static function settings_init() {
		register_setting('site_checklist_settings_group', 'site_checklist_settings');

		add_settings_section(
			'site_checklist_settings_section',
			__('Settings', 'site_checklist'),
			[self::class, 'settings_section_callback'],
			'site_checklist'
		);

		add_settings_field(
			'site_checklist_field_example',
			__('Example Field', 'site_checklist'),
			[self::class, 'field_example_render'],
			'site_checklist',
			'site_checklist_settings_section'
		);
	}

	public static function field_example_render() {
		$options = get_option('site_checklist_settings');
		?>
		<input type='text' name='site_checklist_settings[site_checklist_field_example]' value='<?php echo $options['site_checklist_field_example']; ?>'>
		<?php
	}

	public static function settings_section_callback() {
		echo __('Adjust your settings here.', 'site_checklist');
	}

	public static function options_page() {
		?>
		<form action='options.php' method='post'>
			<h2>Site Checklist Settings</h2>
			<?php
			settings_fields('site_checklist_settings_group');
			do_settings_sections('site_checklist');
			submit_button();
			?>
		</form>
		<?php
	}

    public static function add_acf_fields() {
	    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		    return;
	    }

	    acf_add_local_field_group( array(
		    'key' => 'group_665740931634e',
		    'title' => 'Form builder',
		    'fields' => array(
			    array(
				    'key' => 'field_66574093aae08',
				    'label' => 'Builder',
				    'name' => 'builder',
				    'aria-label' => '',
				    'type' => 'flexible_content',
				    'instructions' => '',
				    'required' => 0,
				    'conditional_logic' => 0,
				    'wrapper' => array(
					    'width' => '',
					    'class' => '',
					    'id' => '',
				    ),
				    'layouts' => array(
					    'layout_665740bdbead8' => array(
						    'key' => 'layout_665740bdbead8',
						    'name' => 'baner',
						    'label' => 'Baner',
						    'display' => 'block',
						    'sub_fields' => array(
							    array(
								    'key' => 'field_665740d4aae09',
								    'label' => 'Baner',
								    'name' => 'baner',
								    'aria-label' => '',
								    'type' => 'group',
								    'instructions' => '',
								    'required' => 0,
								    'conditional_logic' => 0,
								    'wrapper' => array(
									    'width' => '',
									    'class' => '',
									    'id' => '',
								    ),
								    'layout' => 'block',
								    'sub_fields' => array(
									    array(
										    'key' => 'field_665740e6aae0a',
										    'label' => 'Title',
										    'name' => 'title',
										    'aria-label' => '',
										    'type' => 'text',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'maxlength' => '',
										    'placeholder' => '',
										    'prepend' => '',
										    'append' => '',
									    ),
									    array(
										    'key' => 'field_665740efaae0b',
										    'label' => 'Logo',
										    'name' => 'logo',
										    'aria-label' => '',
										    'type' => 'image',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'return_format' => 'array',
										    'library' => 'all',
										    'min_width' => '',
										    'min_height' => '',
										    'min_size' => '',
										    'max_width' => '',
										    'max_height' => '',
										    'max_size' => '',
										    'mime_types' => '',
										    'preview_size' => 'medium',
									    ),
									    array(
										    'key' => 'field_66574117aae0c',
										    'label' => 'Form text',
										    'name' => 'form_text',
										    'aria-label' => '',
										    'type' => 'textarea',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'maxlength' => '',
										    'rows' => '',
										    'placeholder' => '',
										    'new_lines' => 'br',
									    ),
									    array(
										    'key' => 'field_6657414caae0d',
										    'label' => 'Loading text',
										    'name' => 'loading_text',
										    'aria-label' => '',
										    'type' => 'textarea',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'maxlength' => '',
										    'rows' => '',
										    'placeholder' => '',
										    'new_lines' => 'br',
									    ),
									    array(
										    'key' => 'field_6657415aaae0e',
										    'label' => 'Final text',
										    'name' => 'final_text',
										    'aria-label' => '',
										    'type' => 'textarea',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'maxlength' => '',
										    'rows' => '',
										    'placeholder' => '',
										    'new_lines' => 'br',
									    ),
								    ),
							    ),
						    ),
						    'min' => '',
						    'max' => '',
					    ),
					    'layout_665741a3aae11' => array(
						    'key' => 'layout_665741a3aae11',
						    'name' => 'step_start',
						    'label' => 'Step start',
						    'display' => 'block',
						    'sub_fields' => array(
							    array(
								    'key' => 'field_665741c9aae13',
								    'label' => 'Step start',
								    'name' => 'step_start',
								    'aria-label' => '',
								    'type' => 'group',
								    'instructions' => '',
								    'required' => 0,
								    'conditional_logic' => 0,
								    'wrapper' => array(
									    'width' => '',
									    'class' => '',
									    'id' => '',
								    ),
								    'layout' => 'block',
								    'sub_fields' => array(
									    array(
										    'key' => 'field_6657434caae14',
										    'label' => 'Step name',
										    'name' => 'step_name',
										    'aria-label' => '',
										    'type' => 'text',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'maxlength' => '',
										    'placeholder' => '',
										    'prepend' => '',
										    'append' => '',
									    ),
								    ),
							    ),
						    ),
						    'min' => '',
						    'max' => '',
					    ),
					    'layout_66574364aae17' => array(
						    'key' => 'layout_66574364aae17',
						    'name' => 'step_end',
						    'label' => 'Step end',
						    'display' => 'block',
						    'sub_fields' => array(
							    array(
								    'key' => 'field_66574364aae18',
								    'label' => 'Step end',
								    'name' => 'step_end',
								    'aria-label' => '',
								    'type' => 'group',
								    'instructions' => '',
								    'required' => 0,
								    'conditional_logic' => 0,
								    'wrapper' => array(
									    'width' => '',
									    'class' => '',
									    'id' => '',
								    ),
								    'layout' => 'block',
								    'sub_fields' => array(
									    array(
										    'key' => 'field_66574422aae1b',
										    'label' => 'Button next text',
										    'name' => 'button_next_text',
										    'aria-label' => '',
										    'type' => 'text',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'maxlength' => '',
										    'placeholder' => '',
										    'prepend' => '',
										    'append' => '',
									    ),
									    array(
										    'key' => 'field_6657443baae1c',
										    'label' => 'Button prev text',
										    'name' => 'button_prev_text',
										    'aria-label' => '',
										    'type' => 'text',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'maxlength' => '',
										    'placeholder' => '',
										    'prepend' => '',
										    'append' => '',
									    ),
									    array(
										    'key' => 'field_66603b902e2a6',
										    'label' => 'Is final?',
										    'name' => 'is_final',
										    'aria-label' => '',
										    'type' => 'true_false',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'message' => '',
										    'default_value' => 0,
										    'ui' => 0,
										    'ui_on_text' => '',
										    'ui_off_text' => '',
									    ),
								    ),
							    ),
						    ),
						    'min' => '',
						    'max' => '',
					    ),
					    'layout_66574453aae1d' => array(
						    'key' => 'layout_66574453aae1d',
						    'name' => 'text_fields_block',
						    'label' => 'Text fields block',
						    'display' => 'block',
						    'sub_fields' => array(
							    array(
								    'key' => 'field_66574462aae1f',
								    'label' => 'Text fields block',
								    'name' => 'text_fields_block',
								    'aria-label' => '',
								    'type' => 'group',
								    'instructions' => '',
								    'required' => 0,
								    'conditional_logic' => 0,
								    'wrapper' => array(
									    'width' => '',
									    'class' => '',
									    'id' => '',
								    ),
								    'layout' => '',
								    'sub_fields' => array(
									    array(
										    'key' => 'field_6657446baae20',
										    'label' => 'Title',
										    'name' => 'title',
										    'aria-label' => '',
										    'type' => 'text',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'maxlength' => '',
										    'placeholder' => '',
										    'prepend' => '',
										    'append' => '',
									    ),
									    array(
										    'key' => 'field_66574471aae21',
										    'label' => 'Description',
										    'name' => 'description',
										    'aria-label' => '',
										    'type' => 'wysiwyg',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'tabs' => 'all',
										    'toolbar' => 'basic',
										    'media_upload' => 0,
										    'delay' => 0,
									    ),
									    array(
										    'key' => 'field_66574486aae22',
										    'label' => 'Description placement',
										    'name' => 'description_placement',
										    'aria-label' => '',
										    'type' => 'select',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'choices' => array(
											    'top' => 'top',
											    'bottom' => 'bottom',
										    ),
										    'default_value' => false,
										    'return_format' => '',
										    'multiple' => 0,
										    'allow_null' => 0,
										    'ui' => 0,
										    'ajax' => 0,
										    'placeholder' => '',
									    ),
									    array(
										    'key' => 'field_665744feaae26',
										    'label' => 'Block weight',
										    'name' => 'block_weight',
										    'aria-label' => '',
										    'type' => 'number',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'min' => '',
										    'max' => '',
										    'placeholder' => '',
										    'step' => '',
										    'prepend' => '',
										    'append' => '',
									    ),
									    array(
										    'key' => 'field_665744a3aae23',
										    'label' => 'Fields',
										    'name' => 'fields',
										    'aria-label' => '',
										    'type' => 'repeater',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'layout' => 'block',
										    'pagination' => 0,
										    'min' => 0,
										    'max' => 0,
										    'collapsed' => '',
										    'button_label' => 'Додати рядок',
										    'rows_per_page' => 20,
										    'sub_fields' => array(
											    array(
												    'key' => 'field_665744e4aae24',
												    'label' => 'Title',
												    'name' => 'title',
												    'aria-label' => '',
												    'type' => 'text',
												    'instructions' => '',
												    'required' => 0,
												    'conditional_logic' => 0,
												    'wrapper' => array(
													    'width' => '',
													    'class' => '',
													    'id' => '',
												    ),
												    'default_value' => '',
												    'maxlength' => '',
												    'placeholder' => '',
												    'prepend' => '',
												    'append' => '',
												    'parent_repeater' => 'field_665744a3aae23',
											    ),
											    array(
												    'key' => 'field_665744f2aae25',
												    'label' => 'Weight',
												    'name' => 'weight',
												    'aria-label' => '',
												    'type' => 'number',
												    'instructions' => '',
												    'required' => 0,
												    'conditional_logic' => 0,
												    'wrapper' => array(
													    'width' => '',
													    'class' => '',
													    'id' => '',
												    ),
												    'default_value' => '',
												    'min' => '',
												    'max' => '',
												    'placeholder' => '',
												    'step' => '',
												    'prepend' => '',
												    'append' => '',
												    'parent_repeater' => 'field_665744a3aae23',
											    ),
											    array(
												    'key' => 'field_666046206eb61',
												    'label' => 'Name',
												    'name' => 'name',
												    'aria-label' => '',
												    'type' => 'text',
												    'instructions' => '',
												    'required' => 0,
												    'conditional_logic' => 0,
												    'wrapper' => array(
													    'width' => '',
													    'class' => '',
													    'id' => '',
												    ),
												    'default_value' => '',
												    'maxlength' => '',
												    'placeholder' => '',
												    'prepend' => '',
												    'append' => '',
												    'parent_repeater' => 'field_665744a3aae23',
											    ),
										    ),
									    ),
								    ),
							    ),
						    ),
						    'min' => '',
						    'max' => '',
					    ),
					    'layout_66574511aae27' => array(
						    'key' => 'layout_66574511aae27',
						    'name' => 'choices__block',
						    'label' => 'Choices	block',
						    'display' => 'block',
						    'sub_fields' => array(
							    array(
								    'key' => 'field_66574511aae28',
								    'label' => 'Choices	block',
								    'name' => 'choices_block',
								    'aria-label' => '',
								    'type' => 'group',
								    'instructions' => '',
								    'required' => 0,
								    'conditional_logic' => 0,
								    'wrapper' => array(
									    'width' => '',
									    'class' => '',
									    'id' => '',
								    ),
								    'layout' => 'block',
								    'sub_fields' => array(
									    array(
										    'key' => 'field_66574584aae30',
										    'label' => 'Choices type',
										    'name' => 'choices_type',
										    'aria-label' => '',
										    'type' => 'select',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'choices' => array(
											    'checkbox' => 'checkbox',
											    'radio' => 'radio',
										    ),
										    'default_value' => false,
										    'return_format' => 'value',
										    'multiple' => 0,
										    'allow_null' => 0,
										    'ui' => 0,
										    'ajax' => 0,
										    'placeholder' => '',
									    ),
									    array(
										    'key' => 'field_66574511aae29',
										    'label' => 'Title',
										    'name' => 'title',
										    'aria-label' => '',
										    'type' => 'text',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'maxlength' => '',
										    'placeholder' => '',
										    'prepend' => '',
										    'append' => '',
									    ),
									    array(
										    'key' => 'field_66574511aae2a',
										    'label' => 'Description',
										    'name' => 'description',
										    'aria-label' => '',
										    'type' => 'wysiwyg',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'tabs' => 'all',
										    'toolbar' => 'basic',
										    'media_upload' => 0,
										    'delay' => 0,
									    ),
									    array(
										    'key' => 'field_66574511aae2b',
										    'label' => 'Description placement',
										    'name' => 'description_placement',
										    'aria-label' => '',
										    'type' => 'select',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'choices' => array(
											    'top' => 'top',
											    'bottom' => 'bottom',
										    ),
										    'default_value' => false,
										    'return_format' => 'value',
										    'multiple' => 0,
										    'allow_null' => 0,
										    'ui' => 0,
										    'ajax' => 0,
										    'placeholder' => '',
									    ),
									    array(
										    'key' => 'field_66574511aae2c',
										    'label' => 'Block weight',
										    'name' => 'block_weight',
										    'aria-label' => '',
										    'type' => 'number',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'default_value' => '',
										    'min' => '',
										    'max' => '',
										    'placeholder' => '',
										    'step' => '',
										    'prepend' => '',
										    'append' => '',
									    ),
									    array(
										    'key' => 'field_66574511aae2d',
										    'label' => 'Choises',
										    'name' => 'choices',
										    'aria-label' => '',
										    'type' => 'repeater',
										    'instructions' => '',
										    'required' => 0,
										    'conditional_logic' => 0,
										    'wrapper' => array(
											    'width' => '',
											    'class' => '',
											    'id' => '',
										    ),
										    'layout' => 'block',
										    'pagination' => 0,
										    'min' => 0,
										    'max' => 0,
										    'collapsed' => '',
										    'button_label' => 'Додати рядок',
										    'rows_per_page' => 20,
										    'sub_fields' => array(
											    array(
												    'key' => 'field_66574511aae2e',
												    'label' => 'Title',
												    'name' => 'title',
												    'aria-label' => '',
												    'type' => 'text',
												    'instructions' => '',
												    'required' => 0,
												    'conditional_logic' => 0,
												    'wrapper' => array(
													    'width' => '',
													    'class' => '',
													    'id' => '',
												    ),
												    'default_value' => '',
												    'maxlength' => '',
												    'placeholder' => '',
												    'prepend' => '',
												    'append' => '',
												    'parent_repeater' => 'field_66574511aae2d',
											    ),
											    array(
												    'key' => 'field_66574511aae2f',
												    'label' => 'Weight',
												    'name' => 'weight',
												    'aria-label' => '',
												    'type' => 'number',
												    'instructions' => '',
												    'required' => 0,
												    'conditional_logic' => 0,
												    'wrapper' => array(
													    'width' => '',
													    'class' => '',
													    'id' => '',
												    ),
												    'default_value' => '',
												    'min' => '',
												    'max' => '',
												    'placeholder' => '',
												    'step' => '',
												    'prepend' => '',
												    'append' => '',
												    'parent_repeater' => 'field_66574511aae2d',
											    ),
											    array(
												    'key' => 'field_666046496eb62',
												    'label' => 'Name',
												    'name' => 'name',
												    'aria-label' => '',
												    'type' => 'text',
												    'instructions' => '',
												    'required' => 0,
												    'conditional_logic' => 0,
												    'wrapper' => array(
													    'width' => '',
													    'class' => '',
													    'id' => '',
												    ),
												    'default_value' => '',
												    'maxlength' => '',
												    'placeholder' => '',
												    'prepend' => '',
												    'append' => '',
												    'parent_repeater' => 'field_66574511aae2d',
											    ),
										    ),
									    ),
								    ),
							    ),
						    ),
						    'min' => '',
						    'max' => '',
					    ),
				    ),
				    'min' => '',
				    'max' => '',
				    'button_label' => 'Додати рядок',
			    ),
			    array(
				    'key' => 'field_666c30e60afac',
				    'label' => 'Form options',
				    'name' => 'form_options',
				    'aria-label' => '',
				    'type' => 'group',
				    'instructions' => '',
				    'required' => 0,
				    'conditional_logic' => 0,
				    'wrapper' => array(
					    'width' => '',
					    'class' => '',
					    'id' => '',
				    ),
				    'layout' => 'block',
				    'sub_fields' => array(
					    array(
						    'key' => 'field_666c30f10afad',
						    'label' => 'Title Low result',
						    'name' => 'title_low',
						    'aria-label' => '',
						    'type' => 'text',
						    'instructions' => '',
						    'required' => 0,
						    'conditional_logic' => 0,
						    'wrapper' => array(
							    'width' => '',
							    'class' => '',
							    'id' => '',
						    ),
						    'default_value' => '',
						    'maxlength' => '',
						    'placeholder' => '',
						    'prepend' => '',
						    'append' => '',
					    ),
					    array(
						    'key' => 'field_666c31320afb0',
						    'label' => 'Text Low result',
						    'name' => 'text_low',
						    'aria-label' => '',
						    'type' => 'wysiwyg',
						    'instructions' => '',
						    'required' => 0,
						    'conditional_logic' => 0,
						    'wrapper' => array(
							    'width' => '',
							    'class' => '',
							    'id' => '',
						    ),
						    'default_value' => '',
						    'tabs' => 'all',
						    'toolbar' => 'basic',
						    'media_upload' => 0,
						    'delay' => 0,
					    ),
					    array(
						    'key' => 'field_666c31040afae',
						    'label' => 'Title Medium result',
						    'name' => 'title_medium',
						    'aria-label' => '',
						    'type' => 'text',
						    'instructions' => '',
						    'required' => 0,
						    'conditional_logic' => 0,
						    'wrapper' => array(
							    'width' => '',
							    'class' => '',
							    'id' => '',
						    ),
						    'default_value' => '',
						    'maxlength' => '',
						    'placeholder' => '',
						    'prepend' => '',
						    'append' => '',
					    ),
					    array(
						    'key' => 'field_666c31570afb2',
						    'label' => 'Text Medium	result',
						    'name' => 'text_medium',
						    'aria-label' => '',
						    'type' => 'wysiwyg',
						    'instructions' => '',
						    'required' => 0,
						    'conditional_logic' => 0,
						    'wrapper' => array(
							    'width' => '',
							    'class' => '',
							    'id' => '',
						    ),
						    'default_value' => '',
						    'tabs' => 'all',
						    'toolbar' => 'basic',
						    'media_upload' => 0,
						    'delay' => 0,
					    ),
					    array(
						    'key' => 'field_666c311d0afaf',
						    'label' => 'Title Hight result',
						    'name' => 'title_hight',
						    'aria-label' => '',
						    'type' => 'text',
						    'instructions' => '',
						    'required' => 0,
						    'conditional_logic' => 0,
						    'wrapper' => array(
							    'width' => '',
							    'class' => '',
							    'id' => '',
						    ),
						    'default_value' => '',
						    'maxlength' => '',
						    'placeholder' => '',
						    'prepend' => '',
						    'append' => '',
					    ),
					    array(
						    'key' => 'field_666c31690afb3',
						    'label' => 'Text Hight result',
						    'name' => 'text_hight',
						    'aria-label' => '',
						    'type' => 'wysiwyg',
						    'instructions' => '',
						    'required' => 0,
						    'conditional_logic' => 0,
						    'wrapper' => array(
							    'width' => '',
							    'class' => '',
							    'id' => '',
						    ),
						    'default_value' => '',
						    'tabs' => 'all',
						    'toolbar' => 'basic',
						    'media_upload' => 0,
						    'delay' => 0,
					    ),
				    ),
			    ),
		    ),
		    'location' => array(
			    array(
				    array(
					    'param' => 'post_type',
					    'operator' => '==',
					    'value' => 'forms',
				    ),
			    ),
		    ),
		    'menu_order' => 0,
		    'position' => 'normal',
		    'style' => 'default',
		    'label_placement' => 'top',
		    'instruction_placement' => 'label',
		    'hide_on_screen' => '',
		    'active' => true,
		    'description' => '',
		    'show_in_rest' => 0,
	    ) );
    }
}
?>