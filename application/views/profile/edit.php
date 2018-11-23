<div id="shade"></div>
<div id="entering">
    <div id="edit_profile">
        <a id="close" href="/"><i class="fas fa-times"></i></a>
        <form id="user_image" method="post" action="/profile/edit" onchange="message(this);">
            <input type="file" id="new_user_image" name="new_user_image" accept="image/jpg, image/png">
            <img id="user_image_img" src="/public/images/profile/<?php echo $user['user_image'] ? $user['user_image'] : 'user_image.png'; ?>"/>
        </form>
        <div id="fields">
            <form method="post" onsubmit="message(this)" class="text_fields" action="/profile/edit">
                <div id="text_fields">
                    <input type="text" name="login" value="<?php echo $user['user_name']; ?>">
                    <input type="email" name="email" value="<?php echo $user['email']; ?>">
                    <div>
                        <input type='checkbox' name="checkbox" <?php echo $user['comments'] == 1 ? 'checked' : '' ?> />
                        <label>Send me email when there is new comment.</label>
                    </div>
                </div>
                <button name="change_text_fields">Save</button>
            </form>

            <form method="post" onsubmit="message(this); this.reset();" class="password_fields" action="/profile/edit">
                <div id="password_fields">
                    <input type="password" placeholder="old password" name="old_pass">
                    <input type="password" placeholder="new password" name="new_pass">
                    <input type="password" placeholder="repeat new password" name="rep_pass">
                </div>
                <button name="change_password">Save</button>
            </form>
    </form>

</div>