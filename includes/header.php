<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 d-flex align-items-center" href="./index.php">
            <img src="./images/AFLogo.png" alt="Logo" class="d-inline-block align-text-center">
            
        </a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link me-2" href="./index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="./photography.php">PHOTOGRAPHY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="./cgi.php">CGI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="./Films.php">FILMS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="./index.php#clientSec">CLIENTS</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link me-2" href="./about.php">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="./services.php">SERVICES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" role='button'  data-bs-toggle="modal" data-bs-target="#contact">CONTACT</a>
                </li>
                

            </ul>
        </div>
    </div>
</nav>
<div class="modal fade" id="contact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h3 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-rolodex fs-3 me-2"></i>CONTACT US
                    </h3>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">FIRST NAME</label>
                        <input type="text" name="first_name" class="form-control shadow-none" placeholder="FIRST NAME" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">LAST NAME</label>
                        <input type="text" name="last_name" class="form-control shadow-none" placeholder="LAST NAME">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PHONE No</label>
                        <input type="number" name="phone" class="form-control shadow-none" placeholder="PHONE" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">EMAIL</label>
                        <input type="email" name="email" class="form-control shadow-none" placeholder="EMAIL" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">MESSAGE</label>
                        <textarea class="form-control shadow-none" name="message" rows="1"></textarea>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <button type="submit" name="mess_send" class="btn btn-dark">SEND</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>