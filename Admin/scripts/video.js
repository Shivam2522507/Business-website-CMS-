let add_video_form = document.getElementById('add_video_form');

add_video_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_video();
});

function add_video() {
    let data = new FormData();
    data.append('add_video', '');
    data.append('link', add_video_form.elements['link'].value);
 
  
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/video.php", true);


    xhr.onload = function() {
        var myModal = document.getElementById('add-video');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'New video Added Successfully!');
            add_video_form.reset();
            get_all_video();
        } else {
            alert('error', 'Server Down!');
        }
    }


    xhr.send(data);
}

function get_all_video() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/video.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
        document.getElementById('video-data').innerHTML = this.responseText;
    }


    xhr.send('get_all_video');
}



let edit_video_form = document.getElementById('edit_video_form');

function edit_details(id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/video.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
        let data = JSON.parse(this.responseText);
        edit_video_form.elements['link'].value = data.videodata.link;
        edit_video_form.elements['video_id'].value = data.videodata.id;

        
    }


    xhr.send('get_video=' + id);
}

edit_video_form.addEventListener('submit', function(e) {
    e.preventDefault();
    submit_edit_video();
});


function submit_edit_video() {
    let data = new FormData();
    data.append('edit_video', '');
    data.append('video_id', edit_video_form.elements['video_id'].value);
    data.append('link', edit_video_form.elements['link'].value);
 

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/video.php", true);


    xhr.onload = function() {
        var myModal = document.getElementById('edit-video');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'video Data Edited Successfully!');
            edit_video_form.reset();
            get_all_video();
        } else {
            alert('error', 'Server Down!');
        }
    }


    xhr.send(data);
}



let add_image_form = document.getElementById('add_image_form');
add_image_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_image();
})

function add_image() {
    let data = new FormData();
    data.append('image', add_image_form.elements['image'].files[0]);
    data.append('video_id', add_image_form.elements['video_id'].value);
    data.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/video.php", true);


    xhr.onload = function() {
       
        if (this.responseText == 'inv_img') {
            alert('error', 'Only JPG, PNG and Webp images are allowed!','image-alert');
        } else if (this.responseText == 'inv_size') {
            alert('error', 'Image size should be less than 1 mb','image-alert');
        } else if (this.responseText == 'upd_failed') {
            alert('error', 'Somthing wents wrong','image-alert');
        } else {
            alert('success', 'New image added Successfully','image-alert');
            video_images(add_image_form.elements['video_id'].value,document.querySelector("#video-images .modal-title").innerText);
            add_image_form.reset();
        }
    }

    xhr.send(data);
}

function video_images(id,rname){
    document.querySelector("#video-images .modal-title").innerText = rname;
    add_image_form.elements['video_id'].value = id;
    add_image_form.elements['image'].value = '';

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/video.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
      document.getElementById('video-image-data').innerHTML = this.responseText;
    }


    xhr.send('get_video_images='+id);

}


function rem_image(img_id,video_id){
    let data = new FormData();
    data.append('image_id',img_id);
    data.append('video_id',video_id);
    data.append('rem_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/video.php", true);


    xhr.onload = function() {
       
        if (this.responseText == 1) {
            alert('success', 'Image Removed','image-alert');
            video_images(video_id,document.querySelector("#video-images .modal-title").innerText);
        } 
        else {
            alert('error', 'Server Down!','image-alert');
        }
    }

    xhr.send(data);
}

function thumb_image(img_id,video_id){
    let data = new FormData();
    data.append('image_id',img_id);
    data.append('video_id',video_id);
    data.append('thumb_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/video.php", true);


    xhr.onload = function() {
       
        if (this.responseText == 1) {
            alert('success', 'Image Thumbnail Changed','image-alert');
            video_images(video_id,document.querySelector("#video-images .modal-title").innerText);
        } 
        else {
            alert('error', 'Server Down!','image-alert');
        }
    }

    xhr.send(data);
}

function remove_video(video_id){
    if(confirm("Are you sure, You want to delete this video")){

        let data = new FormData();
        data.append('video_id',video_id);
        data.append('remove_video', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/video.php", true);


        xhr.onload = function() {
           
            if (this.responseText == 1) {
                alert('success', 'video Removed');
                get_all_video();
            } 
            else {
                alert('error', 'Server Down!');
            }
        }

        xhr.send(data);
    }
}



window.onload = function() {
    get_all_video();
}