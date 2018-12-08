function message(form) {
    event.preventDefault();
    fetch(form.action, {
        method: form.method,
        body: new FormData(form),
    })
        .then(response => response.json())
        .then(json => {
            if(json.status && json.status === 'img') {
                document.getElementById('user_image_img').src = '/public/images/profile/'+json.message;
            }
            else if (json.message === 'Like') {
                setLike();
            }
            else if (json.message === 'Unlike') {
                setUnlike();
            }
            else if (json.message) {
                alert(json.status + ' - ' + json.message);
            }
            else if (json.url) {
                window.location = json.url;
            }

    });
}


function save_img() {
    event.preventDefault();
    let img = document.querySelector('#new_img'),
        params = `save=${img.src}`;
    if (img.style.display !== 'none') {
        fetch('/profile/add_picture', {
            method: 'POST',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            body: params,
        })
            .then(response => response.json())
            .then(json => {
                let parent = document.getElementById('prev_photos'),
                    div = document.createElement('div'),
                    img = document.createElement('img');
                div.className = 'prev_img';
                img.src = `/public/images/users/${json.message}`;
                div.appendChild(img);
                parent.insertBefore(div, parent.firstChild);
            })
    }
}

function create_img() {
    event.preventDefault();

    const video = document.querySelector('#camera'),
        canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);

    let draggable = document.getElementsByClassName('draggable'),
        patterns = [],
        img = canvas.toDataURL('image/png');
    for (element of draggable) {
        let coords = getCoords(element);
        console.log('pattern: ', coords);
        patterns.push({ "src": element.firstChild.src, "top": coords.top, "left": coords.left});
    }

    if (patterns.length !== 0) {
        let coords = getCoords(video),
            params = `img=${img}&top=${coords.top}&left=${coords.left}&patterns=${JSON.stringify(patterns)}`;
        fetch('/profile/add_picture', {
            method: 'POST',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            body: params,
        })
            .then(response => response.json())
            .then(json => {
                let photo = document.querySelector('#new_img');
                photo.src = json.message;
                photo.style.display = 'unset';
            })
    }
}


function newComment(form, login, avatar) {
    event.preventDefault();
    fetch(form.action, {
        method: form.method,
        body: new FormData(form),
    })
        .then(response => response.json())
        .then(json => {
            if(json.status === 'success') {
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
                    button = document.createElement('button');
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
                del_comment.onclick = () => {
                    message(this);
                };
                comment.appendChild(del_comment);
                del_comment_input.name = 'del_comm';
                del_comment_input.value = json.message;
                del_comment.appendChild(del_comment_input);
                button.innerText = 'Delete';
                del_comment.appendChild(button);
                textarea.value = '';
                console.log(json.message);
            }
        });
}
