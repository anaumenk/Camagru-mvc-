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
        old.parent.insertBefore(pattern, old.nextSibling);
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

// function open_image(i) {
//     document.getElementById(i).style.display = 'flex';
// }
//
// function close_image(i) {
//     document.getElementById(i).style.display = 'none';
// }
//
//

// function open_error(text) {
//     var elem = document.getElementById('error');
//
//     elem.style.display = 'inline-flex';
//     var newElem = document.createElement('p');
//     newElem.id = 'p_in_error';
//     newElem.textContent = text;
//     elem.insertBefore(newElem, elem.firstChild);
// }
//
// function clear_error_add_picture() {
//     document.getElementById('p_in_error').remove();
//     document.getElementById('shade').style.display = 'none';
//     document.getElementById('error').style.display = 'none'
// }
//
// function clear_error() {
//     document.getElementById('p_in_error').remove();
//     document.getElementById('error').style.display = 'none'
// }