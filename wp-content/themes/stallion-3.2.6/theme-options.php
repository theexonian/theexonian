<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'site',
        'title'       => 'Site customization'
      ),
      array(
        'id'          => 'hp',
        'title'       => 'Home page customization'
      ),
      array(
        'id'          => 'bg',
        'title'       => 'Background settings'
      ),
      array(
        'id'          => 'breaking',
        'title'       => 'Breaking news'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'logo_file',
        'label'       => 'Logo graphic',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'site',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'colorize_dark',
        'label'       => 'Colorize -- dark',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'site',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'colorize_light',
        'label'       => 'Colorize -- light',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'site',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'pbj_link',
        'label'       => 'PBJ -- Banner link location',
        'desc'        => 'The Project for Better Journalism includes a small banner with a link to the PBJ homepage or designated PBJ landing page for your school. Set the URL here; leave it blank to disable the banner.',
        'std'         => 'http://betterjournalism.org',
        'type'        => 'text',
        'section'     => 'site',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'pbj_disable_full',
        'label'       => 'PBJ -- Disable all branding',
        'desc'        => 'The Project for Better Journalism includes various branding elements; PBJ members are required to display this branding. You should not disable this unless you know what you\'re doing. For third-party/non-member sites, disable PBJ association here.',
        'std'         => 'enable',
        'type'        => 'radio',
        'section'     => 'site',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enable',
            'label'       => 'Enable PBJ branding',
            'src'         => ''
          ),
          array(
            'value'       => 'disable',
            'label'       => 'Disable PBJ branding',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'tracking_code',
        'label'       => 'PBJ -- Footer code elements',
        'desc'        => 'PBJ Technical Services uses this field to set various code elements, including our universal tracking code for analytics access. Don\'t edit this field.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'site',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hp_feature',
        'label'       => 'Feature element display',
        'desc'        => 'The feature element (first featured article) can be displayed in multiple ways.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'vertical',
            'label'       => 'Rectangular -- vertical photo on left',
            'src'         => ''
          ),
          array(
            'value'       => 'horizontal',
            'label'       => 'Rectangular -- horizontal photo',
            'src'         => ''
          ),
          array(
            'value'       => 'breaking',
            'label'       => 'Large/breaking spread -- wide photo',
            'src'         => ''
          ),
          array(
            'value'       => 'breakingnotext',
            'label'       => 'Large/breaking spread (no text) -- hide all text',
            'src'         => ''
          ),
          array(
            'value'       => 'textonly',
            'label'       => 'Text only -- force no photo',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hp_newsticker_swap',
        'label'       => 'News ticker position',
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => 'News ticker is on the right (default)',
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => 'News ticker is on the left',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hp_featured_cat',
        'label'       => 'Featured category',
        'desc'        => 'Select the category designated as featured. Articles from this category will show on the exposition section of the home page, and are excluded from the news ticker.',
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hp_exclusive_cat',
        'label'       => 'Online/web exclusive category',
        'desc'        => 'Select the category designated as online or web exclusive. Articles from this category will be tagged with an icon and special color to indicate that they are unique.',
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hp_box_a1',
        'label'       => 'Box #A1 category',
        'desc'        => '',
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hp_box_a2',
        'label'       => 'Box #A2 category',
        'desc'        => '',
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hp_box_a3',
        'label'       => 'Box #A3 category',
        'desc'        => '',
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hp_box_a4',
        'label'       => 'Box #A4 category',
        'desc'        => '',
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hp_box_b1_title',
        'label'       => 'Box #B1 title',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hp_box_b1_content',
        'label'       => 'Box #B1 content',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hp_box_b2',
        'label'       => 'Box #B2 category',
        'desc'        => '',
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hp_box_b3',
        'label'       => 'Box #B3 category',
        'desc'        => '',
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hp_box_b3_content',
        'label'       => 'Box #B3 custom override',
        'desc'        => 'You can choose to override box #B3 with custom code &mdash; to display an advertisement or for more information, for example. Adding any content to this field will override the category selected above.<br />Note: Usable width 188px&mdash;resize photos to less than this width. Please only use paragraphs, headings, and images in this field.<br />Running advertisements? <a href="http://betterjournalism.org/i/legal/adpolicy/">Read the Project\'s policy towards ads.</a>',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hp_box_b4_fburl',
        'label'       => 'Box #B4 Facebook page name',
        'desc'        => 'If Stallion is running in non-PBJ mode, the PBJ box is replaced with a Facebook "photomash". Designate the page name to use here (note: does not apply to PBJ member sites)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'hp',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'bg_file',
        'label'       => 'Background file',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'bg',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'bg_desc',
        'label'       => 'Background description',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'bg',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'bg_link',
        'label'       => 'Background link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'bg',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'breaking_activate',
        'label'       => 'Are we in breaking news mode?',
        'desc'        => 'In Breaking News mode, a "breaking" banner will display across all pages.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'breaking',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'In breaking news mode',
            'src'         => ''
          ),
          array(
            'value'       => 'false',
            'label'       => 'Do not display breaking news banner',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'breaking_text',
        'label'       => 'Breaking news text',
        'desc'        => 'This should be a full sentence.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'breaking',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'breaking_link_enable',
        'label'       => 'Breaking news link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'breaking',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Enable link',
            'src'         => ''
          ),
          array(
            'value'       => 'false',
            'label'       => 'Disable link',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'breaking_link_href',
        'label'       => 'Breaking news link location',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'breaking',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'breaking_link',
        'label'       => 'Breaking news link text',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'breaking',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}