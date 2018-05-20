<?php

/**
* add product cat top text meta box
*/

// add_action('product_cat_add_form_fields','add_cat_text_field', 10, 1);
add_action('product_cat_edit_form_fields','add_cat_text_field', 10, 1);
function add_cat_text_field($term) {
		$term_id = $term->term_id;
		$top_descr = get_term_meta($term_id, 'top_descr', true);
	?>
	<tr class="form-field top-description-wrap">
				<th scope="row"><label for="top_descr">Дополнительное описание</label></th>
				<td>
					<textarea name="top_descr" id="top_descr" rows="5" cols="50" class="large-text"><?php echo esc_attr($top_descr) ? esc_attr($top_descr) : ''; ?></textarea>
					<p class="description">Описание сверху страницы категории</p>
				</td>
			</tr>
	<?php
}

/**
* add product cat special event meta checkbox
*/

// add_action('product_cat_add_form_fields','add_cat_text_field', 10, 1);
add_action('product_cat_edit_form_fields','add_cat_checkbox', 10, 1);
function add_cat_checkbox($term) {
		$term_id = $term->term_id;
		$is_special = get_term_meta($term_id, 'is_special', true);
	?>
	<tr class="form-field top-description-wrap">
				<th scope="row"><label for="is_special">Акция</label></th>
				<td>
					<!-- <textarea name="top_descr" id="top_descr" rows="5" cols="50" class="large-text"><?php echo esc_attr($top_descr) ? esc_attr($top_descr) : ''; ?></textarea> -->
          <input type="checkbox" name="is_special" id="is_special" <?php echo $is_special ? 'checked' : ''; ?>/>
					<span class="description">Отметьте для специальной акции, например "Черная пятница" или "Распродажа"</span>
				</td>
			</tr>
	<?php
}

/**
 * save new meta fields
 */
add_action('edited_product_cat', 'save_taxonomy_custom_meta', 10, 1);
add_action('create_product_cat', 'save_taxonomy_custom_meta', 10, 1);
function save_taxonomy_custom_meta($term_id) {
    $top_descr = filter_input(INPUT_POST, 'top_descr');
    update_term_meta($term_id, 'top_descr', $top_descr);

    $is_special = filter_input(INPUT_POST, 'is_special');
    update_term_meta($term_id, 'is_special', $is_special);
}
