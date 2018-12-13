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

function return_back() {
    window.history.back();
}

function setLike() {
    let likes = document.getElementById('likes');
    likes.children[0].name = 'unlike';
    likes.children[1].className = 'fas fa-heart';
    likes.children[2].innerHTML = parseInt(likes.children[2].innerHTML) + 1;
}

function setUnlike() {
    let likes = document.getElementById('likes');
    likes.children[0].name = 'like';
    likes.children[1].className = 'far fa-heart';
    likes.children[2].innerHTML = parseInt(likes.children[2].innerHTML) - 1;
}

function createComment(login, avatar, message) {
    let comments = document.getElementById('comments_form'),
        comm = document.createElement('div'),
        user = document.createElement('div'),
        comment = document.createElement('div'),
        img = document.createElement('img'),
        p = document.createElement('p'),
        p_comm = document.createElement('p'),
        textarea = document.getElementById('new_comment').children[0],
        del_comment = document.createElement('form'),
        del_comment_input = document.createElement('input'),
        button = document.createElement('button'),
        number_of_comments = document.getElementById('comments');
    comm.className = 'comm';
    comments.appendChild(comm);
    user.style.display = 'flex';
    user.style.marginBottom = '5px';
    comm.appendChild(user);
    comment.style.position = 'relative';
    comm.appendChild(comment);
    img.src = '/public/images/profile/' + avatar;
    user.appendChild(img);
    p.innerText = login;
    user.appendChild(p);
    p_comm.innerText = textarea.value;
    comment.appendChild(p_comm);
    del_comment.id = 'del_comment';
    del_comment.method = 'post';
    del_comment.onsubmit = e => {
        delComment(e.target);
    };
    comment.appendChild(del_comment);
    del_comment_input.name = 'del_comm';
    del_comment_input.value = message;
    del_comment.appendChild(del_comment_input);
    button.innerText = 'Delete';
    del_comment.appendChild(button);
    number_of_comments.children[1].innerHTML = parseInt(number_of_comments.children[1].innerHTML) + 1;
    number_of_comments.children[0].className = 'fas fa-comment';
    textarea.value = '';
}