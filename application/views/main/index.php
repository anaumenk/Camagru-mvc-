<?php if ($images): ?>
    <div id='pictures'>
        <?php foreach ($images as $img): ?>
            <a href="/image/<?php echo $img['id_img']; ?>">
                <div class='home_img'>
                    <img src="/public/images/users/<?php echo $img['img_src']; ?>">
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p id="no_photos">No photos yet.</p>
<?php endif; ?>
<?php echo $pagination; ?>

