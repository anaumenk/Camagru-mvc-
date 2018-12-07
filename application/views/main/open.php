<div class='image_view'>
    <div id='header_user'>
        <div>
            <img src='/public/images/profile/<?php echo $user['user_image']; ?>'>
            <p><?php echo $user['user_name']; ?></p>
        </div>
        <i class='far fa-times-circle' onclick="return_back();"></i>
    </div>

    <div id='img_div'><img src='/public/images/users/<?php echo $img['img_src']; ?>'></div>

    <form id='likes_comments' method='post' onclick="message(this)">
        <div id='likes'>
            <?php if ($isLike): ?>
                <input name="unlike" />
                <i class='fas fa-heart'></i>
            <?php else: ?>
                <input name="like" />
                <i class='far fa-heart'></i>
            <?php endif; ?>
<!--            <input name="setLike" />-->
            <p><?php echo $img['likes']; ?></p>
        </div>
        <div id='comments'>
            <?php if ($comments): ?>
                <i class="fas fa-comment"></i>
            <?php else: ?>
                <i class='far fa-comment'></i>
            <?php endif; ?>
            <p><?php echo $img['comments']; ?></p>
        </div>
    </form>

    <div id='comments_form'>
        <form id='new_comment' method='post' onclick="message(this)">
            <textarea name='comment_text'></textarea>
            <button>Comment</button>
        </form>
        <?php foreach ($comments as $comm): ?>
            <div class='comm'>
                <div style='display: flex; margin-bottom: 5px;'>
                    <img src='/public/images/profile/<?php echo $comm['user_image']; ?>'>
                    <p><?php echo $comm['user_name']; ?></p>
                </div>
                <div style='position: relative;'>
                    <p><?php echo $comm['comment']; ?></p>
                    <?php if ($_SESSION['user'] == $comm['user_id']): ?>
                        <form id='del_comment' method='post' onclick="message(this)">
                            <input name="del_comm" value="<?php echo $comm['comment_id']?>">
                            <button>Delete</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>