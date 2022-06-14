<?php

class Component {

    public function getHeadHtml($title = 'PAINEL DASHBOARD') {
        return '
        <!DOCTYPE html>
        <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
                <!-- Google fonts-->
                <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
                <!-- Core theme CSS (includes Bootstrap)-->
                <link href="' . BASE . '/assets/css/styles.css" rel="stylesheet" />
                <title> '. $title .'</title>
            </head>
            <body>
        ';
    }

    public function getFooter() {
        return '
                <footer class="footer bg-light">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                                <ul class="list-inline mb-2">
                                    <li class="list-inline-item"><a href="#!">About</a></li>
                                    <li class="list-inline-item">⋅</li>
                                    <li class="list-inline-item"><a href="#!">Contact</a></li>
                                    <li class="list-inline-item">⋅</li>
                                    <li class="list-inline-item"><a href="#!">Terms of Use</a></li>
                                    <li class="list-inline-item">⋅</li>
                                    <li class="list-inline-item"><a href="#!">Privacy Policy</a></li>
                                </ul>
                                <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2022. All Rights Reserved.</p>
                            </div>
                            <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-4">
                                        <a href="#!"><i class="bi-facebook fs-3"></i></a>
                                    </li>
                                    <li class="list-inline-item me-4">
                                        <a href="#!"><i class="bi-twitter fs-3"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#!"><i class="bi-instagram fs-3"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
            <script src="'. BASE .'/js/scripts.js"></script>
            <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
            </body>
        </html>
        ';
    }
}
