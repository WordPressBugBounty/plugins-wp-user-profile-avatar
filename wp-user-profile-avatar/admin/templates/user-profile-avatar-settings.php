<?php 

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<h3><?php esc_html_e( 'WP User Profile Avatar', 'wp-user-profile-avatar' ); ?></h3>

<table class="form-table">
    <tr>
        <th>
            <label for="wp-user-profile-avatar"><?php esc_html_e( 'Image', 'wp-user-profile-avatar' ); ?></label>
        </th>
        <td>
            <p>
                <input type="text" name="wpupa-url" id="wpupa-url" class="regular-text code" value="<?php echo esc_url( $wpupa_url ); ?>" placeholder="Enter Image URL">
            </p>

            <p><?php esc_html_e( 'OR Upload Image', 'wp-user-profile-avatar' ); ?></p>

            <p id="wp-user-profile-avatar-add-button-existing">
                <button type="button" class="button" id="wp-user-profile-avatar-add"><?php esc_html_e( 'Choose Image', 'wp-user-profile-avatar' ); ?></button>
                <input type="hidden" name="wpupaattachmentid" id="wpupaattachmentid" value="<?php echo esc_attr( $wpupaattachmentid ); ?>">
            </p>

            <?php
            $class_hide = 'wp-user-profile-avatar-hide';
            if ( ! empty( $wpupaattachmentid ) ) {
                $class_hide = '';
            } elseif ( ! empty( $wpupa_url ) ) {
                $class_hide = '';
            }
            ?>
            <div id="wp-user-profile-avatar-images-existing">
                <p id="wp-user-profile-avatar-preview">
                    <img src="<?php echo ( esc_url( $wpupa_url ) ) ? esc_url( $wpupa_url ) : esc_url( $wpupa_original ); ?>" alt="">
                    <span class="description"><?php esc_html_e( 'Original Size', 'wp-user-profile-avatar' ); ?></span>
                </p>
                <p id="wp-user-profile-avatar-thumbnail">
                    <img src="<?php echo ( esc_url( $wpupa_url ) ) ? esc_url( $wpupa_url ) : esc_url( $wpupa_thumbnail ); ?>" alt="">
                    <span class="description"><?php esc_html_e( 'Thumbnail', 'wp-user-profile-avatar' ); ?></span>
                </p>
                <p id="wp-user-profile-avatar-remove-button" class="<?php echo esc_attr( $class_hide ); ?>">
                    <button type="button" class="button" id="wp-user-profile-avatar-remove"><?php esc_html_e( 'Remove Image', 'wp-user-profile-avatar' ); ?></button>
                </p>
                <p id="wp-user-profile-avatar-undo-button">
                    <button type="button" class="button" id="wp-user-profile-avatar-undo"><?php esc_html_e( 'Undo', 'wp-user-profile-avatar' ); ?></button>
                </p>
            </div>
        </td>
    </tr>
</table>

