<div id="add_photo">

    <div id="photos_form">
        <div id="cam_div">
            <video id="camera" autoplay></video>
            <script>camera();</script>
        </div>
        <div id='pic'><img id="new_img" style="display: none;" src=""></div>

        <div id="buttons">
            <form id="add_picture_form" method="post" enctype="multipart/form-data" onsubmit="message(this);" action="/profile/add_picture">
                <button id="take" onclick="create_img();">Take picture</button>
                <button name="save" onclick="">Save picture</button>
                <div id="download_button">
                    <input type="file" name="upload" id="upload" onchange="preview(this.files[0]);">
                    <button id="download">Download from file</button>
                </div>
            </form>

        </div>
    </div>
    <div id="patterns">
        <div class="pattern_img"><img src="/public/images/site/0111.png"></div>
        <div class="pattern_img"><img src="/public/images/site/0222.png"></div>
        <div class="pattern_img"><img src="/public/images/site/0333.png"></div>
        <div class="pattern_img"><img src="/public/images/site/0555.png"></div>
        <div class="pattern_img"><img src="/public/images/site/0666.png"></div>
        <div class="pattern_img"><img src="/public/images/site/0777.png"></div>
    </div>
<!--    <script>choose_pattern();</script>-->

</div>