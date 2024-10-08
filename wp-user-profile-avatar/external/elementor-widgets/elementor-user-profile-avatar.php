<?php

namespace WPUserProfileAvatar\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Elementor Meeting Detail
 *
 * Elementor widget for meeting detail
 */
class Elementor_WPUPA extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'wp-user-profile-avatar';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'WP User Profile Avatar', 'wp-user-profile-avatar' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve shortcode widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fa fa-user';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return array( 'wp-user-profile-avatar', 'code' );
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return array( 'wp-user-profile-avatar-categories' );
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_shortcode',
            array(
                'label' => esc_html__( 'Wp User Profile Avatar', 'wp-user-profile-avatar' ),
            )
        );

        $user_id = get_current_user_id();

        $users_list = array();

        if ( ! empty( get_users() ) ) {

            foreach ( get_users() as $key => $user ) {
                $users_list[ $user->ID ] = $user->display_name;
            }
        }

        $this->add_control(
            'user_id',
            array(
                'label'   => esc_html__( 'User Name', 'wp-user-profile-avatar' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => $users_list,
            )
        );

        $this->add_control(
            'size',
            array(
                'label'   => esc_html__( 'Avatar Size', 'wp-user-profile-avatar' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'thumbnail',
                'options' => wpupa_get_image_sizes(),
            )
        );

        $this->add_control(
            'align',
            array(
                'label'   => esc_html__( 'Avatar Alignment', 'wp-user-profile-avatar' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'aligncenter',
                'options' => wpupa_get_image_alignment(),
            )
        );

        $this->add_control(
            'link',
            array(
                'label'   => esc_html__( 'Avatar Link To', 'wp-user-profile-avatar' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => wpupa_get_image_link_to(),
            )
        );

        $this->add_control(
            'custom_link',
            array(
                'label'   => esc_html__( 'Custom URL', 'wp-user-profile-avatar' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
				'condition' => array(
                    'link' => 'custom',
                ),
            )
        );

        $this->add_control(
            'target',
            array(
                'label'        => esc_html__( 'Open link in a new window', 'wp-user-profile-avatar' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'wp-user-profile-avatar' ),
                'label_off'    => esc_html__( 'Hide', 'wp-user-profile-avatar' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'content',
            array(
                'label'   => esc_html__( 'Caption', 'wp-user-profile-avatar' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
            )
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( isset( $settings['target'] ) && $settings['target'] == 'yes' ) {
            $target = '_blank';
        } else {
            $target = '_self';
        }
        if ( $settings['link'] == 'custom' ){
			$settings['link'] = $settings['custom_link'];
		}
        echo '<div class="elementor-user-profile-avatar-widget">';
        echo do_shortcode( '[user_profile_avatar user_id="' . $settings['user_id'] . '" size="' . $settings['size'] . '" align="' . $settings['align'] . '" link="' . $settings['link'] . '" target="' . $target . '"]' . $settings['content'] . '[/user_profile_avatar]' );
        echo '</div>';
    }

}
