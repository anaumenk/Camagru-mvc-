<div class='image_view'>
    <div id='header_user'>
        <div>
            <img src='/public/images/profile/<?php echo $user['user_image']; ?>'>
            <p><?php echo $user['user_name']; ?></p>
        </div>
        <i class='far fa-times-circle'></i>
    </div>

    <div id='img_div'><img src='/public/images/users/<?php echo $img['img_src']; ?>'></div>

    <form id='likes_comments' method='post'>
        <div id='likes'>
            <?php if ($likes): ?>
                <i class='fas fa-heart'></i>
            <?php else: ?>
                <i class='far fa-heart'></i>
            <?php endif; ?>
            <button></button>
            <p><?php echo $img['likes']; ?></p>
        </div>
        <div id='comments'>
            <i class='far fa-comment'></i>
            <p><?php echo $img['comments']; ?></p>
        </div>
    </form>

    <div id='comments_form'>
        <form id='new_comment' method='post'>
            <textarea name='comment_text'></textarea>
            <button name='send_comment' type='submit'>Comment</button>
        </form>
        <?php foreach ($comments as $comm): ?>
            <div class='comm'>
                <div style='display: flex'>
                    <img src='/public/images/profile/<?php echo $comm['user_image']; ?>'>
                    <p><?php echo $comm['user_name']; ?></p>
                </div>
                <div style='position: relative;'>
                    <p><?php echo $comm['comment']; ?></p>
                    <?php if ($_SESSION['user'] == $comm['user_id']): ?>
                    <form id='del_comment' method='post'>
                        <input hidden name='comm' value=''>
                        <input type='submit' value='Delete' name='del_comm'>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>