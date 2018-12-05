function open_menu() {
    document.getElementById('open_menu').style.display = 'none';
    document.getElementById("close_menu").style.display = "unset";

    for (item of document.getElementsByClassName('menu')) {
        item.style.display = 'block';
    }
}

function close_menu() {
    document.getElementById("close_menu").style.display = "none";
    document.getElementById('open_menu').style.display = 'unset';

    for (item of document.getElementsByClassName('menu')) {
        item.style.display = 'none';
    }
}

function lighter_log() {
    document.getElementById('log_in').style.backgroundColor = "#6f535e";
}

function darker_log() {
    document.getElementById('log_in').style.backgroundColor = "#937782";
}

function lighter_sign() {
    document.getElementById('sign_up').style.backgroundColor = "#6f535e";
}

function darker_sign() {
    document.getElementById('sign_up').style.backgroundColor = "#937782";
}

function camera() {
    let player = document.querySelector('video');

    navigator.getMedia = ( navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia);

    navigator.getMedia({
            video: true,
            audio: false
        },
        function(stream) {
            player.srcObject = stream;
            player.play();
            is_video = true;
        },
        function(err) {
            is_video = false;
            captureButton.disabled = true;
        }
    );
}

function preview(file) {
    if ( file.type.match(/image.*/) ) {
        let reader = new FileReader(),
            img = document.getElementById('new_img');

        reader.addEventListener('load', e =>  {
            img.src = e.target.result;
            img.style.display = 'unset';
        });
        reader.readAsDataURL(file);
    }
}

function choose_pattern(pattern) {

    let old = {
        parent: document.getElementById('patterns'),
        nextSibling: pattern.nextSibling,
        position: pattern.position || '',
        left: pattern.left || '',
        top: pattern.top || '',
        zIndex: pattern.zIndex || '',
    };
    pattern.style.position = 'absolute';
    pattern.className = 'pattern_div draggable';
    document.body.appendChild(pattern);
    pattern.style.zIndex = 1000;

    moveAt(event);

    function moveAt(e) {
        pattern.style.left = e.pageX - pattern.offsetWidth / 2 + 'px';
        pattern.style.top = e.pageY - pattern.offsetHeight / 2 + 'px';
    }

    pattern.rollback = () => {
        old.parent.appendChild(pattern);
        pattern.style.position = old.position;
        pattern.style.left = old.left;
        pattern.style.top = old.top;
        pattern.style.zIndex = old.zIndex;
        pattern.className = 'pattern_div';
    };

    document.onmousemove = e => {
        moveAt(e);
    };

    pattern.onmouseup = () => {
        let element = document.elementsFromPoint(event.clientX, event.clientY);
        document.onmousemove = null;
        pattern.onmouseup = null;
        if (element[2].tagName !== 'VIDEO') {
            pattern.rollback();
        }
    };

    pattern.ondragstart = () => {
        return false;
    };
}

function getCoords(elem) {
    let box = elem.getBoundingClientRect();

    return {
        top: box.top + pageYOffset,
        left: box.left + pageXOffset
    };

}

// function open_image(id) {
//     let json = take_info(page, id),
//         image_view = document.createElement('div'),
//         header_user = document.createElement('div'),
//         div = document.createElement('div'),
//         header_user_img = document.createElement('img'),
//         p_login = document.createElement('p'),
//         i_close = document.createElement('i'),
//         img_div = document.createElement('div'),
//         img_div_img = document.createElement('img'),
//         likes_comments = document.createElement('form'),
//         likes = document.createElement('div'),
//         likes_button = document.createElement('button'),
//         i_like = document.createElement('i'),
//         p_likes = document.createElement('p'),
//         comments = document.createElement('div'),
//         i_comm = document.createElement('i'),
//         p_comm = document.createElement('p'),
//         comments_form = document.createElement('div'),
//         new_comment = document.createElement('form'),
//         comment_text = document.createElement('textarea'),
//         new_comment_button = document.createElement('button'),
//         comm = document.createElement('div'),
//         comm_div_first = document.createElement('div'),
//         comm_img = document.createElement('img'),
//         comm_p = document.createElement('p'),
//         comm_div_second = document.createElement('div'),
//         comm_div_second_p = document.createElement('p'),
//         del_comment = document.createElement('form'),
//         input_comm = document.createElement('input'),
//         input_submit = document.createElement('input');
//
//
//     image_view.className = 'image_view';
//     document.body.appendChild(image_view);
//
//     header_user.id = 'header_user';
//     image_view.appendChild(header_user);
//
//     header_user.appendChild(div);
//
//     header_user_img.src = 'public/images/profile/90.png';
//     div.appendChild(header_user_img);
//     p_login.innerText = 'login';
//     div.appendChild(p_login);
//
//     i_close.className = 'far fa-times-circle';
//     header_user.appendChild(i_close);
//
//     img_div.id = 'img_div';
//     image_view.appendChild(img_div);
//
//     img_div_img.src = 'public/images/users/01.jpg';
//     img_div.appendChild(img_div_img);
//
//     likes_comments.method = 'post';
//     likes_comments.id = 'likes_comments';
//     image_view.appendChild(likes_comments);
//
//     likes.id = 'likes';
//     likes_comments.appendChild(likes);
//
//     i_like.className = 'fas fa-heart';
//     likes.appendChild(i_like);
//     likes_button.name = 'set_like';
//     likes.appendChild(likes_button);
//     p_likes.innerText = '0';
//     likes.appendChild(p_likes);
//
//     comments.id = 'comments';
//     likes_comments.appendChild(comments);
//
//     i_comm.className = 'far fa-comment';
//     comments.appendChild(i_comm);
//     p_comm.innerText = '0';
//     comments.appendChild(p_comm);
//
//     comments_form.id = 'comments_form';
//     image_view.appendChild(comments_form);
//
//     new_comment.id = 'new_comment';
//     new_comment.method = 'post';
//     comments_form.appendChild(new_comment);
//
//     comment_text.name = 'comment_text';
//     new_comment.appendChild(comment_text);
//
//     new_comment_button.name = 'send_comment';
//     new_comment_button.type = 'submit';
//     new_comment_button.innerText = 'Comment';
//     new_comment.appendChild(new_comment_button);
//
//     comm.className = 'comm';
//     comments_form.appendChild(comm);
//
//     comm_div_first.style.display = 'flex';
//     comm.appendChild(comm_div_first);
//
//     comm_img.src = 'public/images/profile/90.png';
//     comm_div_first.appendChild(comm_img);
//
//     comm_p.innerText = 'login';
//     comm_div_first.appendChild(comm_p);
//
//     comm_div_second.style.position = 'relative';
//     comm.appendChild(comm_div_second);
//
//     comm_div_second_p.innerText = 'comment';
//     comm_div_second.appendChild(comm_div_second_p);
//
//     del_comment.id = 'del_comment';
//     del_comment.method = 'post';
//     comm_div_second.appendChild(del_comment);
//
//     input_comm.hidden = true;
//     input_comm.name = 'comm';
//     del_comment.appendChild(input_comm);
//
//     input_submit.type = 'submit';
//     input_submit.value = 'Delete';
//     input_submit.name = 'del_comm';
//     del_comment.appendChild(input_submit);
// }