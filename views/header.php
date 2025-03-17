<!-- Header: -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();  // Démarre la session si elle n'est pas déjà démarrée
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/421fcfdcfb.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Tribunal</title>
</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">Association Laval</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#about">Qui sommes-nous</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Evenements&action=displayEvenementsAction">Événements</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Partenaire&action=displayPartenaireAction">Partenaires</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">La juridiction</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Utilisateurs&action=formConnect"><i class="fa-solid fa-user"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="toggle">
            <input type="checkbox" class="checkbox" id="darkMode">
            <label for="darkMode" class="label">
                <span class="moon">&#9790;</span>
                <span class="sun">&#9788;</span>
                <div class="circle"></div>
            </label>
        </div>
    </div>
    <!-- Flèche remontante -->
    <div id="scrollToTop" class="scroll-to-top">
        &#8679;
    </div>

    </nav>
    <main>