let add_cgi_form = document.getElementById('add_cgi_form');

add_cgi_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_cgi();
});

function add_cgi() {
    let data = new FormData();
    data.append('add_cgi', '');
    data.append('title', add_cgi_form.elements['title'].value);
    data.append('upper_text', add_cgi_form.elements['upper_text'].value);
    data.append('middle_text', add_cgi_form.elements['middle_text'].value);

  
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cgi.php", true);


    xhr.onload = function() {
        var myModal = document.getElementById('add-cgi');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'New cgi Added Successfully!');
            add_cgi_form.reset();
            get_all_cgi();
        } else {
            alert('error', 'Server Down!');
        }
    }


    xhr.send(data);
}

function get_all_cgi() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cgi.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
        document.getElementById('cgi-data').innerHTML = this.responseText;
    }


    xhr.send('get_all_cgi');
}



let edit_cgi_form = document.getElementById('edit_cgi_form');

function edit_details(id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cgi.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
        let data = JSON.parse(this.responseText);
        edit_cgi_form.elements['title'].value = data.cgidata.title;
        edit_cgi_form.elements['upper_text'].value = data.cgidata.upper_text;
        edit_cgi_form.elements['middle_text'].value = data.cgidata.middle_text;
        edit_cgi_form.elements['cgi_id'].value = data.cgidata.id;

        
    }


    xhr.send('get_cgi=' + id);
}

edit_cgi_form.addEventListener('submit', function(e) {
    e.preventDefault();
    submit_edit_cgi();
});


function submit_edit_cgi() {
    let data = new FormData();
    data.append('edit_cgi', '');
    data.append('cgi_id', edit_cgi_form.elements['cgi_id'].value);
    data.append('title', edit_cgi_form.elements['title'].value);
    data.append('upper_text', edit_cgi_form.elements['upper_text'].value);
    data.append('middle_text', edit_cgi_form.elements['middle_text'].value);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cgi.php", true);


    xhr.onload = function() {
        var myModal = document.getElementById('edit-cgi');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'cgi Data Edited Successfully!');
            edit_cgi_form.reset();
            get_all_cgi();
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
    data.append('cgi_id', add_image_form.elements['cgi_id'].value);
    data.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cgi.php", true);


    xhr.onload = function() {
       
        if (this.responseText == 'inv_img') {
            alert('error', 'Only JPG, PNG and Webp images are allowed!','image-alert');
        } else if (this.responseText == 'inv_size') {
            alert('error', 'Image size should be less than 1 mb','image-alert');
        } else if (this.responseText == 'upd_failed') {
            alert('error', 'Somthing wents wrong','image-alert');
        } else {
            alert('success', 'New image added Successfully','image-alert');
            cgi_images(add_image_form.elements['cgi_id'].value,document.querySelector("#cgi-images .modal-title").innerText);
            add_image_form.reset();
        }
    }

    xhr.send(data);
}

function cgi_images(id,rname){
    document.querySelector("#cgi-images .modal-title").innerText = rname;
    add_image_form.elements['cgi_id'].value = id;
    add_image_form.elements['image'].value = '';

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cgi.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
      document.getElementById('cgi-image-data').innerHTML = this.responseText;
    }


    xhr.send('get_cgi_images='+id);

}


function rem_image(img_id,cgi_id){
    let data = new FormData();
    data.append('image_id',img_id);
    data.append('cgi_id',cgi_id);
    data.append('rem_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cgi.php", true);


    xhr.onload = function() {
       
        if (this.responseText == 1) {
            alert('success', 'Image Removed','image-alert');
            cgi_images(cgi_id,document.querySelector("#cgi-images .modal-title").innerText);
        } 
        else {
            alert('error', 'Server Down!','image-alert');
        }
    }

    xhr.send(data);
}

function thumb_image(img_id,cgi_id){
    let data = new FormData();
    data.append('image_id',img_id);
    data.append('cgi_id',cgi_id);
    data.append('thumb_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cgi.php", true);


    xhr.onload = function() {
       
        if (this.responseText == 1) {
            alert('success', 'Image Thumbnail Changed','image-alert');
            cgi_images(cgi_id,document.querySelector("#cgi-images .modal-title").innerText);
        } 
        else {
            alert('error', 'Server Down!','image-alert');
        }
    }

    xhr.send(data);
}

function remove_cgi(cgi_id){
    if(confirm("Are you sure, You want to delete this cgi")){

        let data = new FormData();
        data.append('cgi_id',cgi_id);
        data.append('remove_cgi', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/cgi.php", true);


        xhr.onload = function() {
           
            if (this.responseText == 1) {
                alert('success', 'cgi Removed');
                get_all_cgi();
            } 
            else {
                alert('error', 'Server Down!');
            }
        }

        xhr.send(data);
    }
}



window.onload = function() {
    get_all_cgi();
}