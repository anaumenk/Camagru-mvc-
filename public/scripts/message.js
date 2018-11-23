function message(form) {
    event.preventDefault();
    fetch(form.action, {
        method: form.method,
        body: new FormData(form),
    })
        .then((response) => response.json())
        .then((json) => {
            if(json.status === 'img') {
                document.getElementById('user_image_img').src = '/public/images/profile/'+json.message;
            }
            if (json.message) {
                alert(json.status + ' - ' + json.message);
            }
            else if (json.url) {
                window.location = json.url;
            }

    });
}

