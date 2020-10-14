<?php
/**
 * Display Basic Info
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return void
 */

if ( !function_exists('medical_circle_basic_info') ) :

	function medical_circle_basic_info( $number = 4, $column = 4 ) {
		global $medical_circle_customizer_all_values;
		$medical_circle_basic_info_data = array();
		
		$medical_circle_first_info_icon = $medical_circle_customizer_all_values['medical-circle-first-info-icon'] ;
		$medical_circle_first_info_title = $medical_circle_customizer_all_values['medical-circle-first-info-title'];
		$medical_circle_first_info_desc = $medical_circle_customizer_all_values['medical-circle-first-info-desc'];
		$medical_circle_basic_info_data[] = array(
			"icon" => $medical_circle_first_info_icon,
			"title" => $medical_circle_first_info_title,
			"desc" => $medical_circle_first_info_desc
		);
			
		$medical_circle_second_info_icon = $medical_circle_customizer_all_values['medical-circle-second-info-icon'] ;
		$medical_circle_second_info_title = $medical_circle_customizer_all_values['medical-circle-second-info-title'];
		$medical_circle_second_info_desc = $medical_circle_customizer_all_values['medical-circle-second-info-desc'];
		$medical_circle_basic_info_data[] = array(
			"icon" => $medical_circle_second_info_icon,
			"title" => $medical_circle_second_info_title,
			"desc" => $medical_circle_second_info_desc
		);
		$medical_circle_third_info_icon = $medical_circle_customizer_all_values['medical-circle-third-info-icon'] ;
		$medical_circle_third_info_title = $medical_circle_customizer_all_values['medical-circle-third-info-title'];
		$medical_circle_third_info_desc = $medical_circle_customizer_all_values['medical-circle-third-info-desc'];
		$medical_circle_basic_info_data[] = array(
			"icon" => $medical_circle_third_info_icon,
			"title" => $medical_circle_third_info_title,
			"desc" => $medical_circle_third_info_desc
		);
		
		$medical_circle_forth_info_icon = $medical_circle_customizer_all_values['medical-circle-forth-info-icon'] ;
		$medical_circle_forth_info_title = $medical_circle_customizer_all_values['medical-circle-forth-info-title'];
		$medical_circle_forth_info_desc = $medical_circle_customizer_all_values['medical-circle-forth-info-desc'];
		$medical_circle_basic_info_data[] = array(
			"icon" => $medical_circle_forth_info_icon,
			"title" => $medical_circle_forth_info_title,
			"desc" => $medical_circle_forth_info_desc
		);

		if( $column == 1 ){
			$col= "col-md-12";
		}
		elseif( $column == 2 ){
			$col= "col-md-6";
		}
		elseif( $column == 3 ){
			$col= "col-md-4";
		}
		else{
			$col= "col-md-3";
		}
		$i=0;
		echo "<div class='row'>";
		foreach ( $medical_circle_basic_info_data as $base_basic_info_data) {
			if( $i >= $number ){
				break;
			}
			?>
			<div class="info-icon-box <?php echo $col;?>">
				<?php
				if( !empty( $base_basic_info_data['icon'])){
					?>
					<div class="info-icon">
						<i class="fa <?php echo esc_attr( $base_basic_info_data['icon'] );?>"></i>
					</div>
					<?php
				}
				if( !empty( $base_basic_info_data['title']) || !empty( $base_basic_info_data['desc']) ){
					?>
					<div class="info-icon-details">
						<?php
						if( !empty( $base_basic_info_data['title']) ){
							echo '<h6 class="icon-title">'.$base_basic_info_data['title'].'</h6>';
						}
						if( !empty( $base_basic_info_data['desc']) ){
							echo '<span class="icon-desc">'.$base_basic_info_data['desc'].'</span>';
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
			<?php
			$i++;
		}
		echo "</div>";
	}
endif;
add_action( 'medical_circle_action_basic_info', 'medical_circle_basic_info', 10, 2 );