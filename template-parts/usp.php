<?php
/**
 * Toecaps Template - USP.
 *
 * This template will display the USPs as set in admin settings.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

use BigupWeb\Toecaps\Helpers;

$tc_settings   = get_option( 'tc_theme_array' ); // Serialized array of all options.
$tc_usp_1_text = ( isset( $tc_settings['tc_usp_1_text'] ) ) ? $tc_settings['tc_usp_1_text'] : '';
$tc_usp_1_url  = ( isset( $tc_settings['tc_usp_1_url'] ) ) ? $tc_settings['tc_usp_1_url'] : '';
$tc_usp_1_icon = ( isset( $tc_settings['tc_usp_1_icon'] ) ) ? $tc_settings['tc_usp_1_icon'] : '';
$tc_usp_2_text = ( isset( $tc_settings['tc_usp_2_text']	) ) ? $tc_settings['tc_usp_2_text'] : '';
$tc_usp_2_url  = ( isset( $tc_settings['tc_usp_2_url'] ) ) ? $tc_settings['tc_usp_2_url'] : '';
$tc_usp_2_icon = ( isset( $tc_settings['tc_usp_2_icon'] ) ) ? $tc_settings['tc_usp_2_icon'] : '';
$tc_usp_3_text = ( isset( $tc_settings['tc_usp_3_text']	) ) ? $tc_settings['tc_usp_3_text'] : '';
$tc_usp_3_url  = ( isset( $tc_settings['tc_usp_3_url'] ) ) ? $tc_settings['tc_usp_3_url'] : '';
$tc_usp_3_icon = ( isset( $tc_settings['tc_usp_3_icon'] ) ) ? $tc_settings['tc_usp_3_icon'] : '';
$tc_usp_4_text = ( isset( $tc_settings['tc_usp_4_text']	) ) ? $tc_settings['tc_usp_4_text'] : '';
$tc_usp_4_url  = ( isset( $tc_settings['tc_usp_4_url'] ) ) ? $tc_settings['tc_usp_4_url'] : '';
$tc_usp_4_icon = ( isset( $tc_settings['tc_usp_4_icon'] ) ) ? $tc_settings['tc_usp_4_icon'] : '';

?>

<div class="USPBar">
	<div class="container">
		<?php
		if ( $tc_usp_1_text ) {
			?>
			<div class="USPBar_item">
				<a class="USPBar_link" title="<?php echo esc_html( $tc_usp_1_text ); ?>" href="<?php echo esc_url( $tc_usp_1_url ); ?>">
					<i class="<?php echo esc_attr( $tc_usp_1_icon ); ?>"></i>
					<span>
						<?php echo esc_html( $tc_usp_1_text ); ?>
					</span>
				</a>
			</div>
			<?php
		}
		if ( $tc_usp_2_text ) {
			?>
			<div class="USPBar_item">
				<a class="USPBar_link" title="<?php echo esc_html( $tc_usp_2_text ); ?>" href="<?php echo esc_url( $tc_usp_2_url ); ?>">
					<i class="<?php echo esc_attr( $tc_usp_2_icon ); ?>"></i>
					<span>
						<?php echo esc_html( $tc_usp_2_text ); ?>
					</span>
				</a>
			</div>
			<?php
		}
		if ( $tc_usp_3_text ) {
			?>
			<div class="USPBar_item">
				<a class="USPBar_link" title="<?php echo esc_html( $tc_usp_3_text ); ?>" href="<?php echo esc_url( $tc_usp_3_url ); ?>">
					<i class="<?php echo esc_attr( $tc_usp_3_icon ); ?>"></i>
					<span>
						<?php echo esc_html( $tc_usp_3_text ); ?>
					</span>
				</a>
			</div>
			<?php
		}
		if ( $tc_usp_4_text ) {
			?>
			<div class="USPBar_item">
				<a class="USPBar_link" title="<?php echo esc_html( $tc_usp_4_text ); ?>" href="<?php echo esc_url( $tc_usp_4_url ); ?>">
					<i class="<?php echo esc_attr( $tc_usp_4_icon ); ?>"></i>
					<span>
						<?php echo esc_html( $tc_usp_4_text ); ?>
					</span>
				</a>
			</div>
			<?php
		}
		?>
	</div>
</div>
