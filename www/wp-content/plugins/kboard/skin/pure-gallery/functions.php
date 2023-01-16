<?php
if(!defined('ABSPATH')) exit;

global $pure_gallery_skin_dir_name;
$pure_gallery_skin_dir_name = basename(dirname(__FILE__));

add_filter("kboard_{$pure_gallery_skin_dir_name}_extends_setting", 'kboard_pure_gallery_extends_setting', 10, 3);
if(!function_exists('kboard_pure_gallery_extends_setting')){
	function kboard_pure_gallery_extends_setting($html, $meta, $board_id){
		$board = new KBoard($board_id);
		$fadein = $board->meta->fadein ? $board->meta->fadein : '';
		$page_rpp = $board->meta->mobile_page_rpp ? $board->meta->mobile_page_rpp : '';
		
		ob_start();
		?>
		<h3>KBoard 퓨어 갤러리 스킨 : 기본 설정</h3>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row" style="width: 210px;"><label for="fadein">페이드인(Fade In)</label></th>
					<td>
						<select name="fadein" id="fadein">
							<option value="">활성화</option>
							<option value="1"<?php if($fadein):?> selected<?php endif?>>비활성화</option>
						</select>
						<p class="description">게시판 목록 페이지와 본문 페이지에서 페이드인(Fade In) 효과를 설정합니다.</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" style="width: 210px;"><label for="mobile_page_rpp">모바일 게시글 표시 수</label></th>
					<td>
						<select name="mobile_page_rpp" id="mobile_page_rpp">
							<?php if(!$board->meta->mobile_page_rpp) $board->meta->mobile_page_rpp=10;?>
							<option value="1"<?php if($board->meta->mobile_page_rpp == 1):?> selected<?php endif?>>1개</option>
							<option value="2"<?php if($board->meta->mobile_page_rpp == 2):?> selected<?php endif?>>2개</option>
							<option value="3"<?php if($board->meta->mobile_page_rpp == 3):?> selected<?php endif?>>3개</option>
							<option value="4"<?php if($board->meta->mobile_page_rpp == 4):?> selected<?php endif?>>4개</option>
							<option value="5"<?php if($board->meta->mobile_page_rpp == 5):?> selected<?php endif?>>5개</option>
							<option value="6"<?php if($board->meta->mobile_page_rpp == 6):?> selected<?php endif?>>6개</option>
							<option value="7"<?php if($board->meta->mobile_page_rpp == 7):?> selected<?php endif?>>7개</option>
							<option value="8"<?php if($board->meta->mobile_page_rpp == 8):?> selected<?php endif?>>8개</option>
							<option value="9"<?php if($board->meta->mobile_page_rpp == 9):?> selected<?php endif?>>9개</option>
							<option value="10"<?php if($board->meta->mobile_page_rpp == 10):?> selected<?php endif?>>10개</option>
							<option value="11"<?php if($board->meta->mobile_page_rpp == 11):?> selected<?php endif?>>11개</option>
							<option value="12"<?php if($board->meta->mobile_page_rpp == 12):?> selected<?php endif?>>12개</option>
							<option value="13"<?php if($board->meta->mobile_page_rpp == 13):?> selected<?php endif?>>13개</option>
							<option value="14"<?php if($board->meta->mobile_page_rpp == 14):?> selected<?php endif?>>14개</option>
							<option value="15"<?php if($board->meta->mobile_page_rpp == 15):?> selected<?php endif?>>15개</option>
							<option value="16"<?php if($board->meta->mobile_page_rpp == 16):?> selected<?php endif?>>16개</option>
							<option value="17"<?php if($board->meta->mobile_page_rpp == 17):?> selected<?php endif?>>17개</option>
							<option value="18"<?php if($board->meta->mobile_page_rpp == 18):?> selected<?php endif?>>18개</option>
							<option value="19"<?php if($board->meta->mobile_page_rpp == 19):?> selected<?php endif?>>19개</option>
							<option value="20"<?php if($board->meta->mobile_page_rpp == 20):?> selected<?php endif?>>20개</option>
							<option value="21"<?php if($board->meta->mobile_page_rpp == 21):?> selected<?php endif?>>21개</option>
							<option value="22"<?php if($board->meta->mobile_page_rpp == 22):?> selected<?php endif?>>22개</option>
							<option value="23"<?php if($board->meta->mobile_page_rpp == 23):?> selected<?php endif?>>23개</option>
							<option value="24"<?php if($board->meta->mobile_page_rpp == 24):?> selected<?php endif?>>24개</option>
							<option value="25"<?php if($board->meta->mobile_page_rpp == 25):?> selected<?php endif?>>25개</option>
							<option value="26"<?php if($board->meta->mobile_page_rpp == 26):?> selected<?php endif?>>26개</option>
							<option value="27"<?php if($board->meta->mobile_page_rpp == 27):?> selected<?php endif?>>27개</option>
							<option value="28"<?php if($board->meta->mobile_page_rpp == 28):?> selected<?php endif?>>28개</option>
							<option value="29"<?php if($board->meta->mobile_page_rpp == 29):?> selected<?php endif?>>29개</option>
							<option value="30"<?php if($board->meta->mobile_page_rpp == 30):?> selected<?php endif?>>30개</option>
							<option value="40"<?php if($board->meta->mobile_page_rpp == 40):?> selected<?php endif?>>40개</option>
							<option value="50"<?php if($board->meta->mobile_page_rpp == 50):?> selected<?php endif?>>50개</option>
							<option value="60"<?php if($board->meta->mobile_page_rpp == 60):?> selected<?php endif?>>60개</option>
							<option value="70"<?php if($board->meta->mobile_page_rpp == 70):?> selected<?php endif?>>70개</option>
							<option value="80"<?php if($board->meta->mobile_page_rpp == 80):?> selected<?php endif?>>80개</option>
							<option value="90"<?php if($board->meta->mobile_page_rpp == 90):?> selected<?php endif?>>90개</option>
							<option value="100"<?php if($board->meta->mobile_page_rpp == 100):?> selected<?php endif?>>100개</option>
						</select>
						<p class="description">모바일에서 한 페이지에 보여지는 게시글 개수를 정합니다.</p>
						<p class="description">PC는 <a href="#tab-kboard-setting-0" onclick="kboard_setting_tab_chnage(0);">기본설정</a> <span style="font-weight:bold">게시글 표시 수</span>로 설정하실 수 있습니다.</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" style="width: 210px;"><label for="pc_row">PC 한 줄에 표시할 게시글 수</label></th>
					<td>
						<select name="pc_row" id="pc_row">
							<option value="">자동</option>
							<option value="mw600"<?php if($board->meta->pc_row == 'mw600'):?> selected<?php endif?>>1개</option>
							<option value="mw800"<?php if($board->meta->pc_row == 'mw800'):?> selected<?php endif?>>2개</option>
							<option value="mw1000"<?php if($board->meta->pc_row == 'mw1000'):?> selected<?php endif?>>3개</option>
							<option value="mw1200"<?php if($board->meta->pc_row == 'mw1200'):?> selected<?php endif?>>4개</option>
							<option value="mw1400"<?php if($board->meta->pc_row == 'mw1400'):?> selected<?php endif?>>5개</option>
						</select>
						<p class="description">자동으로 설정할 경우 게시판 너비에 따라 한 줄에 표시되는 게시글의 수가 설정됩니다.</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" style="width: 210px;"><label for="mobile_row">모바일 한 줄에 표시할 게시글 수</label></th>
					<td>
						<select name="mobile_row" id="mobile_row">
							<option value="">자동</option>
							<option value="mw600"<?php if($board->meta->mobile_row == 'mw600'):?> selected<?php endif?>>1개</option>
							<option value="mw800"<?php if($board->meta->mobile_row == 'mw800'):?> selected<?php endif?>>2개</option>
							<option value="mw1000"<?php if($board->meta->mobile_row == 'mw1000'):?> selected<?php endif?>>3개</option>
							<option value="mw1200"<?php if($board->meta->mobile_row == 'mw1200'):?> selected<?php endif?>>4개</option>
							<option value="mw1400"<?php if($board->meta->mobile_row == 'mw1400'):?> selected<?php endif?>>5개</option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" style="width: 210px;"><label for="title_line">게시글 제목</label></th>
					<td>
						<select name="title_line" id="title_line">
							<option value="">1줄</option>
							<option value="2"<?php if($board->meta->title_line == '2'):?> selected<?php endif?>>2줄</option>
							<option value="3"<?php if($board->meta->title_line == '3'):?> selected<?php endif?>>3줄</option>
						</select>
						<p class="description">게시판 목록 페이지에서 표시할 게시글 제목의 줄 수를 설정합니다.</p>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
		$html = ob_get_clean();
		return $html;
	}
}

if(!function_exists('kboard_pure_gallery_skin_header')){
	add_action('kboard_skin_header', 'kboard_pure_gallery_skin_header', 10, 1);
	function kboard_pure_gallery_skin_header($builder){
		global $pure_gallery_skin_dir_name;

		$board = $builder->board;
		if($board->skin == $pure_gallery_skin_dir_name){ // 실제 게시판 id로 적용해주세요.
			if(wp_is_mobile() && $board->meta->mobile_page_rpp){
				$builder->rpp = $board->meta->mobile_page_rpp; // 모바일에서 표시할 게시글의 수
			}
		}
	}
}

add_filter("kboard_{$pure_gallery_skin_dir_name}_extends_setting_update", 'kboard_pure_gallery_extends_setting_update', 10, 2);
if(!function_exists('kboard_pure_gallery_extends_setting_update')){
	function kboard_pure_gallery_extends_setting_update($board_meta, $board_id){
		$board_meta->fadein			 = isset($_POST['fadein'])			? sanitize_textarea_field($_POST['fadein'])			 : '';
		$board_meta->mobile_page_rpp = isset($_POST['mobile_page_rpp'])	? sanitize_textarea_field($_POST['mobile_page_rpp']) : '';
		$board_meta->pc_row			 = isset($_POST['pc_row'])			? sanitize_textarea_field($_POST['pc_row'])			 : '';
		$board_meta->mobile_row		 = isset($_POST['mobile_row'])		? sanitize_textarea_field($_POST['mobile_row'])		 : '';
		$board_meta->title_line		 = isset($_POST['title_line'])		? sanitize_textarea_field($_POST['title_line'])		 : '';
	}
}

if(!function_exists('kboard_pure_gallery_skin_fields')){
	add_filter('kboard_skin_fields', 'kboard_pure_gallery_skin_fields', 10, 2);
	function kboard_pure_gallery_skin_fields($fields, $board){
		if($board->skin == 'pure-gallery'){
			if(!isset($fields['over_image'])){
				$fields['over_image'] = array(
					'field_type' => 'over_image',
					'field_label' => '오버레이',
					'class' => '',
					'hidden' => '',
					'meta_key' => '',
					'field_name' => '',
					'permission' => '',
					'roles' => '',
					'default_value' => '',
					'placeholder' => '',
					'required' => '',
					'show_document' => '',
					'description' => '',
					'close_button' => 'yes'
				);
			}
		}
		
		return $fields;
	}
}

if(!function_exists('kboard_pure_gallery_get_template_field_html')){
	add_filter('kboard_get_template_field_html', 'kboard_pure_gallery_get_template_field_html', 10, 4);
	function kboard_pure_gallery_get_template_field_html($field_html, $field, $content, $board){
		if($field['field_type'] == 'over_image'){
			$url = new KBUrl();
			
			ob_start();
			?>
			<div class="kboard-attr-row kboard-attr-over-image">
				<label class="attr-name" for="kboard_attach_over_image">오버레이</label>
				<div class="attr-value">
					<?php if(isset($content->attach->over_image)):?><?php echo $content->attach->over_image[1]?> - <a href="<?php echo $url->getDeleteURLWithAttach($content->uid, 'over_image');?>" onclick="return confirm('<?php echo __('Are you sure you want to delete?', 'kboard')?>');"><?php echo __('Delete file', 'kboard')?></a><?php endif?>
					<input type="file" id="kboard_attach_over_image" name="kboard_attach_over_image" accept="image/*">
					<div class="description">※ 오버레이 이미지는 리스트의 썸네일에 마우스 오버시 보여지는 이미지입니다.</div>
				</div>
			</div>
			<?php
			$field_html = ob_get_clean();
		}
		
		return $field_html;
	}
}

if(!function_exists('kboard_pure_gallery_list')){
	function kboard_pure_gallery_list($board){
		$classes = array();
		if(!$board->meta->fadein){
			$classes[] = 'active-fadein';
		}
		if(!wp_is_mobile() && $board->meta->pc_row){
			$classes[] = "pure-gallery-row {$board->meta->pc_row}";
		}
		if(wp_is_mobile() && $board->meta->mobile_row){
			$classes[] = "pure-gallery-row {$board->meta->mobile_row}";
		}
		
		$classes = implode(' ', $classes);
		
		return $classes;
	}
}

if(!function_exists('kboard_pure_gallery_title_line')){
	function kboard_pure_gallery_title_line($board){
		$classes = '';
		if($board->meta->title_line == '2'){
			$classes = 'two-line';
		}
		else if($board->meta->title_line == '3'){
			$classes = 'three-line';
		}
		
		return $classes;
	}
}