<?php 
// in function .php write following code
//Here we gather the files which sent by the HTML forms. and send it to //another function called kv_handle_attachement(). This is a simple function //this will help you to store the files to your wp uploads directory. Add //the following code into your Theme “ functions.php”
//img upload//
function kv_handle_attachment($file_handler,$post_id,$set_thu=false) {
// check to make sure its a successful upload
if ($_FILES[$file_handler][‘error’] !== UPLOAD_ERR_OK) __return_false();

require_once(ABSPATH . “wp-admin” . ‘/includes/image.php’);
require_once(ABSPATH . “wp-admin” . ‘/includes/file.php’);
require_once(ABSPATH . “wp-admin” . ‘/includes/media.php’);

$attach_id = media_handle_upload( $file_handler, $post_id );

// If you want to set a featured image from your uploads.
if ($set_thu) set_post_thumbnail($post_id, $attach_id);
return $attach_id;
}
//New File Upload
add_filter(‘acf/pre_save_post’ , ‘my_pre_save_post’ );
function my_pre_save_post( $post_id ) {
// check if this is to be a new post
if( $post_id != ‘new’ ) {
return $post_id;
}

$field = $_POST[‘fields’];
$post_title = $_POST[‘fullname’];
$post_content = $field[‘edit_test2’];

// Create a new post
require_once(ABSPATH . “wp-admin” . ‘/includes/image.php’);
require_once(ABSPATH . “wp-admin” . ‘/includes/file.php’);
require_once(ABSPATH . “wp-admin” . ‘/includes/media.php’);
$attachment_id = media_handle_upload( ‘my_image_upload’, $post_id );
$post = array(
‘post_status’ => ‘draft’ ,
‘post_title’ => $post_title,
‘post_content’ => $post_content,
‘post_type’ => ‘page’

);
$newpost_id=wp_insert_post($post);
if($newpost_id!=0)
{
add_post_meta($newpost_id, ‘picture’, $attachment_id );

}
}

// for any help in this task i can be contacted , love to help you.
