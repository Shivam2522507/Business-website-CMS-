let CGI_carousel_form = document.getElementById('CGI_carousel_form');
let CGI_carousel_picture_inp = document.getElementById('CGI_carousel_picture_inp');


// function to prevent default function of form and call update function
CGI_carousel_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_image();
})

function add_image() {
    let data = new FormData();
    data.append('picture', CGI_carousel_picture_inp .files[0]);
    data.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cgi_carousel.php", true);


    xhr.onload = function() {
        var myModal = document.getElementById('CGI-carousel-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        if (this.responseText == 'inv_img') {
            alert('error', 'Only JPG, PNG, SVG and Webp images are allowed!');
        } else if (this.responseText == 'inv_size') {
            alert('error', 'Image size should be less than 1 mb');
        } else if (this.responseText == 'upd_failed') {
            alert('error', 'Somthing wents wrong');
        } else {
            alert('success', 'Image uploaded Successfully');
            CGI_carousel_picture_inp .value = '';
            get_images();

        }
    }

    xhr.send(data);
}

// function to get images
function get_images() {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cgi_carousel.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
    document.getElementById('CGI-carousel-data').innerHTML = this.responseText;

    }

    xhr.send('get_images');
}

// function to delete the image
function rem_image(val){

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cgi_carousel.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if(this.responseText == 1){
            alert('success','image removed!');
            get_images();
        }
        else{
            alert('error','Server down!');
        }

    }


    xhr.send('rem_image='+val);
}

window.onload = function() {
    get_images();
}
