<?php if ($images): ?>
    <div id='pictures'>
        <?php foreach ($images as $img): ?>
            <div class='home_img'><img  src="/public/images/users/<?php echo $img['img_src']; ?>"></div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p id='no_photos'>You have no photos yet.</p>
<?php endif; ?>
<?php echo $pagination; ?>
