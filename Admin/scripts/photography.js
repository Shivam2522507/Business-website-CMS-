let add_photography_form = document.getElementById('add_photography_form');

add_photography_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_photography();
});

function add_photography() {
    let data = new FormData();
    data.append('add_photography', '');
    data.append('title', add_photography_form.elements['title'].value);
    data.append('upper_text', add_photography_form.elements['upper_text'].value);
    data.append('middle_text', add_photography_form.elements['middle_text'].value);

  
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/photography.php", true);


    xhr.onload = function() {
        var myModal = document.getElementById('add-photography');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'New photography Added Successfully!');
            add_photography_form.reset();
            get_all_photography();
        } else {
            alert('error', 'Server Down!');
        }
    }


    xhr.send(data);
}

function get_all_photography() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/photography.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
        document.getElementById('photography-data').innerHTML = this.responseText;
    }


    xhr.send('get_all_photography');
}



let edit_photography_form = document.getElementById('edit_photography_form');

function edit_details(id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/photography.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
        let data = JSON.parse(this.responseText);
        edit_photography_form.elements['title'].value = data.photographydata.title;
        edit_photography_form.elements['upper_text'].value = data.photographydata.upper_text;
        edit_photography_form.elements['middle_text'].value = data.photographydata.middle_text;
        edit_photography_form.elements['photography_id'].value = data.photographydata.id;

        
    }


    xhr.send('get_photography=' + id);
}

edit_photography_form.addEventListener('submit', function(e) {
    e.preventDefault();
    submit_edit_photography();
});


function submit_edit_photography() {
    let data = new FormData();
    data.append('edit_photography', '');
    data.append('photography_id', edit_photography_form.elements['photography_id'].value);
    data.append('title', edit_photography_form.elements['title'].value);
    data.append('upper_text', edit_photography_form.elements['upper_text'].value);
    data.append('middle_text', edit_photography_form.elements['middle_text'].value);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/photography.php", true);


    xhr.onload = function() {
        var myModal = document.getElementById('edit-photography');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'Photography Data Edited Successfully!');
            edit_photography_form.reset();
            get_all_photography();
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
    data.append('photography_id', add_image_form.elements['photography_id'].value);
    data.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/photography.php", true);


    xhr.onload = function() {
       
        if (this.responseText == 'inv_img') {
            alert('error', 'Only JPG, PNG and Webp images are allowed!','image-alert');
        } else if (this.responseText == 'inv_size') {
            alert('error', 'Image size should be less than 1 mb','image-alert');
        } else if (this.responseText == 'upd_failed') {
            alert('error', 'Somthing wents wrong','image-alert');
        } else {
            alert('success', 'New image added Successfully','image-alert');
            photography_images(add_image_form.elements['photography_id'].value,document.querySelector("#photography-images .modal-title").innerText);
            add_image_form.reset();
        }
    }

    xhr.send(data);
}

function photography_images(id,rname){
    document.querySelector("#photography-images .modal-title").innerText = rname;
    add_image_form.elements['photography_id'].value = id;
    add_image_form.elements['image'].value = '';

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/photography.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
      document.getElementById('photography-image-data').innerHTML = this.responseText;
    }


    xhr.send('get_photography_images='+id);

}


function rem_image(img_id,photography_id){
    let data = new FormData();
    data.append('image_id',img_id);
    data.append('photography_id',photography_id);
    data.append('rem_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/photography.php", true);


    xhr.onload = function() {
       
        if (this.responseText == 1) {
            alert('success', 'Image Removed','image-alert');
            photography_images(photography_id,document.querySelector("#photography-images .modal-title").innerText);
        } 
        else {
            alert('error', 'Server Down!','image-alert');
        }
    }

    xhr.send(data);
}

function thumb_image(img_id,photography_id){
    let data = new FormData();
    data.append('image_id',img_id);
    data.append('photography_id',photography_id);
    data.append('thumb_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/photography.php", true);


    xhr.onload = function() {
       
        if (this.responseText == 1) {
            alert('success', 'Image Thumbnail Changed','image-alert');
            photography_images(photography_id,document.querySelector("#photography-images .modal-title").innerText);
        } 
        else {
            alert('error', 'Server Down!','image-alert');
        }
    }

    xhr.send(data);
}

function remove_photography(photography_id){
    if(confirm("Are you sure, You want to delete this photography")){

        let data = new FormData();
        data.append('photography_id',photography_id);
        data.append('remove_photography', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/photography.php", true);


        xhr.onload = function() {
           
            if (this.responseText == 1) {
                alert('success', 'photography Removed');
                get_all_photography();
            } 
            else {
                alert('error', 'Server Down!');
            }
        }

        xhr.send(data);
    }
}



window.onload = function() {
    get_all_photography();
}