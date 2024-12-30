<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;  
            background: linear-gradient(to bottom, #90CAF9, #E3F2FD);
            height: 100vh;
            margin: 0;
        }

        .box-area {
            width: 750px;
        }

        .right-box {
            padding: 40px 30px 40px 40px;
        }


        ::placeholder {
            font-size: 16px;
        }

        .rounded-4 {
            border-radius: 20px;
        }

        .rounded-5 {
            border-radius: 30px;
        }

        .clear-text {
            cursor: pointer;
            text-decoration: underline;
            color: #000000;
            background: none;
            border: none;
            padding: 0;
            font-size: 12px;
            display: none;
        }

        .clear-text:hover {
            text-decoration: none;
        }

        .text-center-flex {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 shadow box-area" style="background: #FFFF;">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-3">                   
                    <img src="<?=base_url()?>assets/dist/img/sips.png" class="img-fluid" style="width: 150px;">
                </div>
               <div class="text-center">
               <h5>Sistem Informasi <br>Penyimpanan Dan Stok</h5>
               </div>
            </div>

            <div class="form-group col-md-6 right-box">
                <div class="row align-items-center mt-5">
                <form action="<?=site_url('auth/process')?>" method="post">
                        <div class="input-group mb-3">
                            <div class="col-2 d-flex justify-content-center align-items-center bg-dark">
                                <span><i class="bi bi-person fs-3 text-white"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Username" value="<?php echo set_value('username') ?>">
                        </div>
                        <span class="text-danger"><?php echo form_error('username') ?></span>

                        <div class="input-group mb-1">
                            <div class="col-2 d-flex justify-content-center align-items-center bg-dark">
                                <span><i class="bi bi-key-fill fs-3 text-white"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Password" value="<?php echo set_value('password') ?>">
                            <button class="btn bg-light" type="button" id="btn-pw">
                                <i id="eye" class="bi bi-eye-fill fs-5 text-dark"></i>
                            </button>
                        </div>
                        <span class="text-danger"><?php echo form_error('password') ?></span>

                        <div class="text-center-flex">
                            <button type="button" class="clear-text" id="clearForm">Clear Input</button>
                        </div>

                        <div class="input-group mb-3 p-3">
                            <button name="login" class="btn btn-lg btn-dark w-100 fs-6">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        const passwordInput = document.querySelector('input[name="password"]');
        const eyeIcon = document.getElementById('eye');
        const showPasswordButton = document.getElementById('btn-pw');

        showPasswordButton.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove("bi-eye-fill");
                eyeIcon.classList.add("bi-eye-slash-fill");
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove("bi-eye-slash-fill");
                eyeIcon.classList.add("bi-eye-fill");
            }
        });

        const form = document.getElementById('loginForm');
        const clearButton = document.getElementById('clearForm');
        const inputs = form.querySelectorAll('input');

        function checkInputs() {
            let hasValue = false;
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    hasValue = true;
                }
            });
            clearButton.style.display = hasValue ? 'inline' : 'none'; // Tampilkan atau sembunyikan tombol
        }

        // Tambahkan event listener pada setiap input
        inputs.forEach(input => {
            input.addEventListener('input', checkInputs);
        });

        // Tambahkan event listener untuk tombol Clear
        clearButton.addEventListener('click', function () {
            inputs.forEach(input => input.value = ''); // Kosongkan semua input
            clearButton.style.display = 'none'; // Sembunyikan tombol setelah reset
        });
    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php if ($this->session->flashdata('pesan_sukses')): ?>
        <script>
            swal("Sukses!", "<?php echo $this->session->flashdata('pesan_sukses'); ?>", "success");
        </script>
    <?php endif ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php if ($this->session->flashdata('pesan_gagal')): ?>
        <script>
            swal("Gagal!", "<?php echo $this->session->flashdata('pesan_gagal'); ?>", "error");
        </script>
    <?php endif ?>
</body>

</html>