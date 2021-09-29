<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e('Dashboard Widgets', 'smartystudio'); ?>
	</h1>

	<a href="javascript:void(0);" class="add-new-row page-title-action">
		<?php _e('Add new row', 'smartystudio'); ?>
	</a>

	<hr class="wp-header-end">

	<h2 class="screen-reader-text">
		<?php _e('Dashboard Widgets', 'smartystudio'); ?>
	</h2>

	<div class="notice notice-warning">
		<p>
			<?php _e('Customize your WordPress Dashboard to access quickly your posts, pages and custom post types.', 'smartystudio'); ?>
		</p>
		<p>
			<?php _e('You can add new row (access link), edit rows and delete row.', 'smartystudio'); ?>
		</p>
		<p>
			<?php _e('You can choose the icons from WordPress dashicons <a href="https://developer.wordpress.org/resource/dashicons" target="_blank" >on this link.</a>', 'smartystudio'); ?>
		</p>

		<?php if (isset($_POST['data']) && isset($_POST['submit'])) : ?>

			<?php $data = $_POST['data']; ?>

			<?php foreach ($data as $k => $dd) {
				$res2[$k] = $dd['order'];
			} ?>

			<?php asort($res2); ?>

			<?php foreach ($res2 as $k => $val) {
				$sorted[] = $data[$k];
			} ?>

			<?php $data = $sorted; ?>

			<?php update_option('dashboard-widgets', $data); ?>

			<?php $smartystudio_show_another_widgets = (isset($_POST['smartystudio_show_another_widgets']) && $_POST['smartystudio_show_another_widgets'] == 'checked') ? 'checked' : ''; ?>

			<?php update_option('smartystudio_show_another_widgets', $smartystudio_show_another_widgets); ?>

			<div id="message" class="updated notice notice-success is-dismissible">
				<p><?php _e('Saved successfully.', 'smartystudio'); ?></p>
				<button type="button" class="notice-dismiss">
					<span class="screen-reader-text"><?php _e('Close this message.', 'smartystudio'); ?></span>
				</button>
			</div>

		<?php else : ?>

			<?php $data =  get_option('dashboard-widgets'); ?>

			<?php if (empty($data) || isset($_POST['reset_default'])) : ?>

				<?php $data = smartystudio_get_default_data(); ?>

				<?php if (isset($_POST['reset_default'])) update_option('dashboard-widgets', $data); ?>

			<?php endif; ?>

			<?php $smartystudio_show_another_widgets = (get_option('smartystudio_show_another_widgets') == 'checked') ? 'checked' : ''; ?>

		<?php endif; ?>
	</div>

	<form method="post" action="">

		<?php settings_fields('disable-settings-group'); ?>

		<?php do_settings_sections('disable-settings-group'); ?>

		<?php global $wp_roles; ?>

		<?php $all_roles = $wp_roles->roles; ?>
		<?php $all_roles = array_keys($all_roles); ?>

		<table class="widefat responsive-table" cellspacing="0" width="100%">
			<tr>
				<th><?php _e('Title', 'smartystudio'); ?></th>
				<th><?php _e('Dashicon', 'smartystudio'); ?></th>
				<th><?php _e('Link', 'smartystudio'); ?></th>
				<th width="5%"><?php _e('Active', 'smartystudio'); ?></th>

				<?php foreach ($all_roles as $role) : ?>
					<?php $role = str_replace('_', ' ', $role); ?>
					<th><?php _e(ucwords($role), 'smartystudio'); ?></th>
				<?php endforeach; ?>

				<th width="5%"><?php _e('Order', 'smartystudio'); ?></th>
				<th width="5%"><?php _e('Remove', 'smartystudio'); ?></th>
			</tr>

			<?php foreach ($data as $k => $item) : ?>
				<tr data-id="<?= $k ?>">
					<td>
						<input type="text" name="data[<?php echo $k ?>][title]" value="<?php echo $item['title'] ?>" />
					</td>

					<td>
						<input type="text" class="icon-input" name="data[<?= $k ?>][icon]" value="<?php echo $item['icon']; ?>" />
					</td>

					<td>
						<input type="text" name="data[<?php echo $k ?>][link]" value="<?php echo $item['link']  ?>" />
					</td>

					<td>
						<input type="checkbox" name="data[<?php echo $k ?>][status]" value="checked" <?php echo $item['status']; ?> />
					</td>

					<?php foreach ($all_roles as $role) : ?>
						<td><input type="checkbox" name="data[<?php echo $k ?>][<?php echo $role ?>]" value="checked" <?php echo isset($item[$role]) ? $item[$role] : ''; ?> /></td>
					<?php endforeach; ?>

					<td>
						<input type="number" name="data[<?php echo $k ?>][order]" value="<?php echo $k ?>" />
					</td>

					<td class="remove-icon">
						<a href="javascript:void(0);" class="remove-link">
							<i class="fa fa-times"></i>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>

		<p>
			<label for="smartystudio_show_another_widgets">
				<input name="smartystudio_show_another_widgets" type="checkbox" value="checked" <?php echo $smartystudio_show_another_widgets ?> />
				<?php _e('Don\'t hide another WordPress default dashboard widgets.', 'smartystudio'); ?>
			</label>
		</p>

		<?php submit_button(); ?>

		<p class="submit">
			<input type="submit" name="reset_default" class="button button-danger def-button" value="<?php _e('Reset', 'smartystudio'); ?>">
		</p>
	</form>
</div>

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

<script>
	$(document).ready(function() {
		$(".add-new-row").click(function() {

			var key = $(".widefat tr:last-child").data('id');
			key = key + 1;

			var newCol = '<tr data-id="' + key + '"><td><input type="text" name="data[' + key + '][title]" value="Title" /></td>';
			newCol += '<td><input type="text" name="data[' + key + '][icon]" value="fa fa-wordpress" /></td><td><input type="text" name="data[' + key + '][link]" value="Link" /></td>';
			newCol += '<td><input type="checkbox" name="data[' + key + '][status]" value="checked" checked/></td>';

			var index, len;
			var a = [<?php echo '"' . implode('","', $all_roles) . '"' ?>];

			for (index = 0, len = a.length; index < len; ++index) {
				if (a[index] == 'administrator' || a[index] == 'editor') {
					newCol += '<td><input type="checkbox" name="data[' + key + '][' + a[index] + ']" value="checked" checked/></td>';
				} else {
					newCol += '<td><input type="checkbox" name="data[' + key + '][' + a[index] + ']" value="checked"/></td>';
				}
			}

			newCol += '<td><input type="number" name="data[' + key + '][order]" value="' + key + '" /></td>';
			newCol += '<td><a href="javascript:void(0);" class="remove-link"><i class="fa fa-times"></i></a></td></tr>';

			$(".widefat").append(newCol);
		});

		$(".widefat").on('click', '.remove-link', function() {
			$(this).parent().parent().remove();
		});
	});
</script>