<?php
/**
 * Checks for a correct comments implementation:
 *
 * Comments listing via wp_list_comments().
 * Comments pagination via paginate_comments_links() or next_comments_link() and previous_comments_link().
 */

class CommentsCheck extends BaseCheck {

	function check( $files ) {

		$result = true;
		$php = $this->merge_files( $files, 'php' );

		/**
		 * Comments listing.
		 */
		$this->increment_check_count();
		if ( false === strpos( $php, 'wp_list_comments' ) ) {
			$this->add_error(
				'comments-wp-list-comments',
				"The theme doesn't have a call to <code>wp_list_comments()</code> in it.",
				Basescanner::LEVEL_BLOCKER
			);
			$result = false;
		}

		/**
		 * Comments pagination.
		 */
		$this->increment_check_count();
		if ( false === strpos( $php, 'paginate_comments_links' ) && ( false === strpos( $php, 'previous_comments_link' ) || false === strpos( $php, 'next_comments_link' ) ) ) {
			$this->add_error(
				'comments',
				"The theme doesn't have comment pagination code in it. Use <code>paginate_comments_links()</code> or <code>next_comments_link()</code> and <code>previous_comments_link()</code> to add comment pagination.",
				Basescanner::LEVEL_BLOCKER
			);
			$result = false;
		}

		return $result;
	}
}
