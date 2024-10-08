<?php
/**
 * Author Box Social link page.
 *
 * @package Author_Box_Social
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class contain detail of user social info
 *
 * Adds social contact information to user profiles and displays it in the author box.
 */
class WPUPA_User_Social_Info {

    /**
     * Constructor.
     */
    public function __construct() {
        add_filter( 'user_contactmethods', [ $this, 'wpupa_add_user_social_contact_info' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'wpupa_enqueue_fontawesome_styles' ] );
        add_filter( 'the_content', [ $this, 'wpupa_author_social_info_box' ] );
        remove_filter( 'pre_user_description', 'wp_filter_kses' );
    }

    /**
     * Add user's social contact information.
     *
     * @param array $user_contact The user contact methods array.
     * @return array Modified user contact methods array.
     */
    public function wpupa_add_user_social_contact_info( $user_contact ) {
        $user_contact['facebook']   = esc_html__( 'Facebook URL','wp-user-profile-avatar' );
        $user_contact['skype']      = esc_html__( 'Skype','wp-user-profile-avatar' );
        $user_contact['twitter']    = esc_html__( 'Twitter','wp-user-profile-avatar' );
        $user_contact['youtube']    = esc_html__( 'Youtube Channel','wp-user-profile-avatar' );
        $user_contact['linkedin']   = esc_html__( 'LinkedIn','wp-user-profile-avatar' );
        $user_contact['googleplus'] = esc_html__( 'Google +','wp-user-profile-avatar' );
        $user_contact['pinterest']  = esc_html__( 'Pinterest','wp-user-profile-avatar' );
        $user_contact['instagram']  = esc_html__( 'Instagram','wp-user-profile-avatar' );
        $user_contact['github']     = esc_html__( 'Github profile','wp-user-profile-avatar' );
        return $user_contact;
    }

    /**
     * Enqueue Font Awesome styles.
     */
    public function wpupa_enqueue_fontawesome_styles() {
        wp_register_style( 'fontawesome', WPUPA_PLUGIN_URL . '/assets/lib/fontawesome/all.css', '', '4.4.0', 'all' );
        wp_enqueue_style( 'fontawesome' );
    }

    /**
     * Display author's social information in the author box.
     *
     * @param string $content The post content.
     * @return string Modified post content.
     */
    public function wpupa_author_social_info_box( $content ) {
        global $post;

        if ( is_single() && isset( $post->post_author ) ) {

            $display_name = esc_attr( get_the_author_meta( 'first_name', $post->post_author ) );

            if ( empty( $display_name ) ) {
                $display_name = esc_attr( get_the_author_meta( 'nickname', $post->post_author ) );
            }

            $user_description = wp_kses_post( get_the_author_meta( 'user_description', $post->post_author ) );
            $user_email = esc_html( get_the_author_meta( 'email', $post->post_author ) );
            $user_facebook = esc_url( get_the_author_meta( 'facebook', $post->post_author ) );
            $user_skype = esc_url( get_the_author_meta( 'skype', $post->post_author ) );
            $user_twitter = esc_url( get_the_author_meta( 'twitter', $post->post_author ) );
            $user_linkedin = esc_url( get_the_author_meta( 'linkedin', $post->post_author ) );
            $user_youtube = esc_url( get_the_author_meta( 'youtube', $post->post_author ) );
            $user_googleplus = esc_url( get_the_author_meta( 'googleplus', $post->post_author ) );
            $user_pinterest = esc_url( get_the_author_meta( 'pinterest', $post->post_author ) );
            $user_instagram = esc_url( get_the_author_meta( 'instagram', $post->post_author ) );
            $user_github = esc_url( get_the_author_meta( 'github', $post->post_author ) );

            $user_meta = get_user_meta( get_the_author_meta( 'ID' ) );
            $user_link_avatar = get_the_author_meta( '_wpupa_url' );
            $user_option_id = get_option( 'wpupa_attachment_id' );
            $user_avatar = get_option( 'avatar_default' );

            if ( $user_avatar == 'gravatar_default' ) {
                $user_avatar = '&';
            } elseif ( $user_avatar != 'wp_user_profile_avatar' ) {
                $user_avatar = "&d=$user_avatar&";
            }

            if ( $user_link_avatar ) {
                $user_image = '<img src="' . esc_url( get_the_author_meta( '_wpupa_url' ) ) . '" />';
            } elseif ( isset( $user_meta['_wpupa_attachment_id'][0] ) && $user_meta['_wpupa_attachment_id'][0] != 0 ) {
                $user_image = wp_get_attachment_image( $user_meta['_wpupa_attachment_id'][0], array( '90', '90' ) );
            } elseif ( $user_option_id ) {
                $user_image = wp_get_attachment_image( $user_option_id, array( '90', '90' ) );
            } elseif ( $user_avatar == 'wp_user_profile_avatar' ) {
                $user_image = '<img src="' . WPUPA_PLUGIN_URL . '/assets/images/wp-user-thumbnail.png" />';
            } else {
                $user_image = '<img src="http://2.gravatar.com/avatar/?s=32' . $user_avatar . 'r=g&forcedefault=1" />';
            }

            $user_posts = esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ) ) );

            if ( ! empty( $display_name ) ) {
                $author_details = '<div class="author-flex">';
            }

            $author_details .= '<div class="author-image">' . $user_image . '</div>';
            $author_details .= '<div class="author-info">';
            $author_details .= '<div class="author-name"><strong>' . esc_attr( get_the_author_meta( 'display_name' ) ) . '</strong></div>';
            $author_details .= '<p class="author-bio">' . esc_attr( get_the_author_meta( 'description' ) ) . '</p>';
            $author_details .= '</div> </div>';
            $author_details .= '<div class="authorbox-social-icons">';

            $author_details .= ' <a href="' . esc_url( 'mailto:' . $user_email ) . '" target="_blank" rel="nofollow" title="E-mail" class="tooltip"><i class="fa fa-envelope-square fa-2x"></i> </a>';

            if ( ! empty( $user_facebook ) ) {
                $author_details .= ' <a href="' . esc_url( $user_facebook ) . '" target="_blank" rel="nofollow" title="Facebook" class="tooltip"><i class="fa-brands fa-facebook fa-2x"></i> </a>';
            }

            if ( ! empty( $user_skype ) ) {
                $author_details .= ' <a href="' . esc_url( $user_skype ) . '" target="_blank" rel="nofollow" title="Username paaljoachim Skype" class="tooltip"><i class="fa-brands fa-skype fa-2x"></i> </a>';
            }

            if ( ! empty( $user_twitter ) ) {
                $author_details .= ' <a href="' . esc_url( $user_twitter ) . '" target="_blank" rel="nofollow" title="Twitter" class="tooltip"><i class="fa-brands fa-twitter-square fa-2x"></i> </a>';
            }

            if ( ! empty( $user_linkedin ) ) {
                $author_details .= ' <a href="' . esc_url( $user_linkedin ) . '" target="_blank" rel="nofollow" title="LinkedIn" class="tooltip"><i class="fa-brands fa-linkedin fa-2x"></i> </a>';
            }

            if ( ! empty( $user_youtube ) ) {
                $author_details .= ' <a href="' . esc_url( $user_youtube ) . '" target="_blank" rel="nofollow" title="Youtube" class="tooltip"><i class="fa-brands fa-youtube-square fa-2x"></i> </a>';
            }

            if ( ! empty( $user_googleplus ) ) {
                $author_details .= ' <a href="' . esc_url( $user_googleplus ) . '" target="_blank" rel="nofollow" title="Google+" class="tooltip"><i class="fa-brands fa-google-plus-square fa-2x"></i> </a>';
            }

            if ( ! empty( $user_pinterest ) ) {
                $author_details .= ' <a href="' . esc_url( $user_pinterest ) . '" target="_blank" rel="nofollow" title="Pinterest" class="tooltip"><i class="fa-brands fa-pinterest-square fa-2x"></i> </a>';
            }

            if ( ! empty( $user_instagram ) ) {
                $author_details .= ' <a href="' . esc_url( $user_instagram ) . '" target="_blank" rel="nofollow" title="instagram" class="tooltip"><i class="fa-brands fa-instagram fa-2x"></i> </a>';
            }

            if ( ! empty( $user_github ) ) {
                $author_details .= ' <a href="' . esc_url( $user_github ) . '" target="_blank" rel="nofollow" title="Github" class="tooltip"><i class="fa-brands fa-github-square fa-2x"></i> </a>';
            }

            $author_details .= '</div>';

            $wpupa_hide_post_option = get_option( 'wpupa_hide_post_option' );

            if ( $wpupa_hide_post_option == '' ) {
                $content = $content . '<footer class="author-bio-section" >' . wp_kses_post( $author_details ) . '</footer>';
            }
        }
        return $content;
    }
}

new WPUPA_User_Social_Info();
