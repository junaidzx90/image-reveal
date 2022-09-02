<?php
if(isset($_POST['save_image_reveal'])){
    $title = ((isset($_POST['reveal_title'])) ? $_POST['reveal_title']: '');
    $title = sanitize_text_field( $title );
    $title = stripslashes( $title );

    $images = ((isset($_POST['reveal_images']))? $_POST['reveal_images']: []);

    global $wpdb;

    if(isset($_POST['reveal_id']) && $_POST['reveal_id'] !== 'new'){
        $wpdb->update($wpdb->prefix.'image_reveal', array(
            'title' => $title,
            'data' => serialize($images)
        ), array("ID" => $_POST['reveal_id']), array("%s", "%s"), array("%d"));
    }else{
        $wpdb->insert($wpdb->prefix.'image_reveal', array(
            'title' => $title,
            'data' => serialize($images),
            'date' => date("Y-m-d h:i:s a")
        ));
        
        if($wpdb->insert_id){
            wp_safe_redirect( admin_url("admin.php?page=imgreveal-add-new&action=edit&id=".$wpdb->insert_id) );
            exit;
        }
    }
}
?>
<div id="reveal_form">
    <form action="" method="post">
        <?php
        global $wpdb;
        $title = '';
        $images = [];
        if(isset($_GET['id']) && !empty($_GET['id'])){
            echo '<input type="hidden" name="reveal_id" value="'.$_GET['id'].'">';
            $reveal_id = intval($_GET['id']);
            $results = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}image_reveal WHERE ID = $reveal_id");
            if($results){
                $title = $results->title;
                $images = unserialize($results->data);
            }
        }
        ?>
        <div class="img_reveal_field">
            <label for="reveal_title">Title</label>
            <div class="fieldvalue">
                <input required type="text" class="widefat" name="reveal_title" value="<?php echo $title ?>" id="reveal_title">
            </div>
        </div>

        <div class="img_reveal_field">
            <label>Images</label>
            <div class="img_rows">
                <div class="reveal_images">
                    <?php
                    if(is_array($images) && sizeof($images) > 0){
                        foreach($images as $image){
                            ?>
                            <div class="imagebox">
                                <span class="removeImg">+</span>
                                <img src="<?php echo $image ?>">
                                <input type="hidden" value="<?php echo $image ?>" name="reveal_images[]">
                            </div>
                            <?php
                        }
                    }else{
                        echo '<p>No images added!</p>';
                    }
                    ?>
                </div>
                
                <button class="add_image button-secondary">Add Images</button>
            </div>
        </div>

        <input type="submit" class="button-primary" value="Save changes" name="save_image_reveal">
    </form>
</div>