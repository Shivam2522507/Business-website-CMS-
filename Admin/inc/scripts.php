<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>

<script>
    function alert(type, msg, position='body') {
       let bs_class = (type == "success") ? "alert-success" : "alert-danger";
        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
                <strong class="me-3">${msg}</strong>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         `;

         if(position=='body'){
             document.body.append(element);
             element.classList.add('custom-alert');
         }
         else{
            document.getElementById(position).appendChild(element);
         }

        setTimeout(remAlert, 2000);
    }
    function remAlert(){
        document.getElementsByClassName('alert')[0].remove();
    }

    function setActive(){
        let navbar = document.getElementById('dashboard-menu');
        let a_tag = navbar.getElementsByTagName('a');
        for(i = 0; i<a_tag.length; i++){
            let file = a_tag[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if(document.location.href.indexOf(file_name) >=0){
                a_tag[i].classList.add('active');
            }
        }
    }
    setActive();
</script>