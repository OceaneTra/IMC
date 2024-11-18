<?php
session_start();

include __DIR__ . '/www/config/db_connect.php';

$messageText="";
if (isset($_SESSION['message'])) {
    $messageText = htmlspecialchars($_SESSION['message']);
    unset($_SESSION['message']);
}

        $sqlForfait = "SELECT * FROM forfaits";
        $stmtF = $connexion->prepare($sqlForfait);
        $stmtF->execute();
        $forfaits = $stmtF->fetchAll(PDO::FETCH_ASSOC);


        $sqlMedecin = "SELECT * FROM medecin";
        $stmtM = $connexion->prepare($sqlMedecin);
        $stmtM->execute();
        $medecins = $stmtM->fetchAll(PDO::FETCH_ASSOC);
        $countM = count($medecins);

        

        $sqlInfirmier = "SELECT * FROM infirmier";
        $stmtI= $connexion->prepare($sqlInfirmier);
        $stmtI->execute();
        $infirmiers = $stmtI->fetchAll(PDO::FETCH_ASSOC);
        $countI = count($infirmiers);

        $sqlSecretaire = "SELECT * FROM secretaire";
        $stmtS = $connexion->prepare($sqlSecretaire);
        $stmtS->execute();
        $secretaires = $stmtS->fetchAll(PDO::FETCH_ASSOC);
        $countS = count($secretaires);

        $sqlCM = "SELECT * FROM centre_medical";
        $stmtCM = $connexion->prepare($sqlCM);
        $stmtCM->execute();
        $CM = $stmtCM->fetchAll(PDO::FETCH_ASSOC);
        $countCM = count($CM);

       if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST)){
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $heure = $_POST['time'];
            $date = $_POST['date'];
            $type_consuatation = $_POST['type_consultation'];

            $sql = "INSERT INTO rdv (date_rdv, heure_rdv, nom_patient, email_patient, type_consultation) 
                        VALUES (?, ?, ?, ?, ?)";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([
                        $date,
                        $heure,
                        $nom,
                        $email,
                       $type_consuatation,
                        
                    ]);
       }

        
?>





<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Ivoire Medical Center - IMC</title>
    <meta name="description" content="IMC est une application permettant une gestion de centre médical efficace, fiable, complètement                                                                              informatisée,
    organisée, et simple grâce à son interface interactive, il peut convenir à tout type de médecins
    généralistes et spécialistes (chirurgien, pneumologue, dermatologue, rhumatologue, neurologue,
    psychiatre...). Ce logiciel simplifiera votre quotidien grâce à sa grande souplesse d’utilisation.">

    <!-- Favicons -->
    <link href="assets/img/logo.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Fichier Vendor CSS  -->
    <link href="assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!--Fichier Main CSS  -->
    <link href="assets/css/main.css" rel="stylesheet">



</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">Ivoire Medical Center</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Accueil</a></li>
                    <li><a href="#apropos">A propos</a></li>
                    <li><a href="#avantages">Avantages</a></li>
                    <li><a href="#fonctionnalites">Fonctionnalités</a></li>
                    <li><a href="#tarif">Tarifs</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <ul id="dropdown" class="dropdown  mt-3 mx-2">

                        <li><a href="/Ivoire_Medical_Center-main/admin_CM/index.php">Connexion</a></li>
                        <li>
                            <!-- Button trigger modal -->
                            <button type="button" class="m-2 btn btn-primary" data-toggle="modal"
                                data-target="#RDVModalCenter">
                                Prendre rendez-vous
                            </button>
                        </li>

                    </ul>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <ul id="dropdown" class="dropdown  mt-3 mx-2">
                <a href="#" class="mx-3 "><span class="text-center mx-2 btn-getstarted rounded-circle py-2 px-2">
                        <i class="bi bi-chevron-down toggle-dropdown"></i></span>
                </a>
                <ul>
                    <li><a href="/Ivoire_Medical_Center-main/admin_CM/index.php">Connexion</a></li>
                    <li>
                        <!-- Button trigger modal -->
                        <button type="button" class="m-2 btn btn-primary" data-toggle="modal"
                            data-target="#RDVModalCenter">
                            Prendre rendez-vous
                        </button>
                    </li>
                </ul>
            </ul>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">


                            <h1 class="mb-4">
                                Ivoire Medical <br>
                                <span class="accent-text">Center</span>
                            </h1>

                            <p class="mb-4 mb-md-5">
                                Opter pour une application de gestion de centre médical pratique et innovante qui
                                s'adapte à votre
                                activité : Dossier patient informatisé, gestion des rendez-vous, consultations,
                                ordonnances et
                                prescriptions médicales, comptes rendus, facturation et gestion des documents.
                            </p>

                            <div class="hero-buttons">
                                <a href="#tarif" class="btn btn-primary me-0 me-sm-2 mx-1">Commencer</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="hero-image position-relative" data-aos="zoom-out" data-aos-delay="300">
                            <img src="assets/img/illustration-1.png" alt="Hero Image" class="img-fluid ">
                        </div>
                    </div>
                </div>

                <div class="row stats-row" data-aos="fade-up" data-aos-delay="500">
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                            <div class="stat-content">
                                <h4>Edition</h4>
                                <p class="mb-0">Développer par des ivoiriens</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div class="stat-content">
                                <h4>50 employés</h4>
                                <p class="mb-0">Qui travaillent avec nous</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-house"></i>
                            </div>
                            <div class="stat-content">
                                <h4>1 succursale</h4>
                                <p class="mb-0">Basé à Abidjan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-award"></i>
                            </div>
                            <div class="stat-content">
                                <h4>Certification</h4>
                                <p class="mb-0">Reconnus par l'État</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Hero Section -->

        <!-- apropos Section -->
        <section id="apropos" class="apropos section">
            <!-- Section Title -->
            <div class="container section-title text-center" data-aos="fade-up">
                <h2 class="text-center">A propos de nous</h2>
            </div><!-- End Section Title -->
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 align-items-center justify-content-between">

                    <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">

                        <h2 class="apropos-title">Ivoire Medical Center</h2>
                        <p class="apropos-description">C'est une application permettant une gestion de centre médical
                            efficace, fiable, complètement informatisée, organisée, et simple grâce à son interface
                            interactive, il peut convenir à tout type de médecins généralistes et spécialistes
                            (chirurgien, pneumologue, dermatologue, rhumatologue, neurologue, psychiatre...). Cette
                            aplication simplifiera votre quotidien grâce à sa grande souplesse d’utilisation.</p>


                    </div>

                    <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="image-wrapper">
                            <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                                <img src="assets/img/apropos-1.jpg" alt="Business Meeting"
                                    class="img-fluid main-image rounded-4">
                                <img src="assets/img/apropos-2.jpg" alt="Team Discussion"
                                    class="img-fluid small-image rounded-4">
                            </div>
                            <div class="experience-badge floating">
                                <h3>15+ <span>Centres médicaux</span></h3>
                                <p>Affiliés à l'application.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /apropos Section -->

        <!-- avantages Section -->
        <section id="avantages" class="avantages section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Avantages</h2>
                <p>Ivoire Medical Center est la solution informatique qui vise à faciliter votre quotidien.</p>
            </div><!-- End Section Title -->

        </section><!-- /avantages Section -->

        <!-- avantages Cards Section -->
        <section id="avantages-cards" class="avantages-cards section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="fonctionnalite-box orange">
                            <i class="bi bi-award"></i>
                            <h4>Soins</h4>
                            <p>Efficacité des soins optimisées.</p>
                        </div>
                    </div><!-- End fonctionnalite Borx-->

                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="fonctionnalite-box blue">
                            <i class="bi bi-patch-check"></i>
                            <h4>Maintenance</h4>
                            <p>Notre service de maintenance est
                                disponible pour vous.</p>
                        </div>
                    </div><!-- End fonctionnalite Borx-->

                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="fonctionnalite-box green">
                            <i class="bi bi-sunrise"></i>
                            <h4>Application intuitive</h4>
                            <p>Design élégant et interface facile d'utilisation.</p>
                        </div>
                    </div><!-- End fonctionnalite Borx-->

                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="fonctionnalite-box red">
                            <i class="bi bi-shield-check"></i>
                            <h4>Confidentialité</h4>
                            <p>Vos informations sont confidentielles et sécurisées.</p>
                        </div>
                    </div><!-- End fonctionnalite Borx-->

                </div>

            </div>

        </section><!-- /avantages Cards Section -->

        <!-- avantages 2 Section -->
        <section id="avantages-2" class="avantages-2 section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">

                    <div class="col-lg-4">

                        <div class="fonctionnalite-item text-end mb-5" data-aos="fade-right" data-aos-delay="200">
                            <div class="d-flex align-items-center justify-content-end gap-4">
                                <div class="fonctionnalite-content">
                                    <h3>Rappels automatisés</h3>
                                    <p>Envoi automatique de rappels de rendez-vous aux patients par e-mail,
                                        réduisant les absences et optimisant l'agenda des praticiens.</p>
                                </div>
                                <div class="fonctionnalite-icon flex-shrink-0">
                                    <i class="bi bi-bell"></i>
                                </div>
                            </div>
                        </div><!-- End .fonctionnalite-item -->

                        <div class="fonctionnalite-item text-end mb-5" data-aos="fade-right" data-aos-delay="300">
                            <div class="d-flex align-items-center justify-content-end gap-4">
                                <div class="fonctionnalite-content">
                                    <h3>Accès à distance aux dossiers patients</h3>
                                    <p>Les professionnels de santé peuvent accéder aux informations des patients de
                                        manière sécurisée depuis n'importe quel endroit, ce qui facilite les
                                        consultations à distance et le suivi des patients en dehors du centre médical.
                                    </p>
                                </div>
                                <div class="fonctionnalite-icon flex-shrink-0">
                                    <i class="bi bi-browser-chrome"></i>
                                </div>
                            </div>
                        </div><!-- End .fonctionnalite-item -->

                        <div class="fonctionnalite-item text-end" data-aos="fade-right" data-aos-delay="400">
                            <div class="d-flex align-items-center justify-content-end gap-4">
                                <div class="fonctionnalite-content">
                                    <h3>Amélioration de la communication</h3>
                                    <p>Outils intégrés pour faciliter la communication entre les patients et les
                                        professionnels de santé, ainsi qu'entre les membres de l'équipe, assurant une
                                        meilleure prise en charge et suivi des patients.</p>
                                </div>
                                <div class="fonctionnalite-icon flex-shrink-0">
                                    <i class="bi bi-chat-dots"></i>
                                </div>
                            </div>
                        </div><!-- End .fonctionnalite-item -->

                    </div>

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                        <div class="app-screen text-center">
                            <img src="assets/img/app-screen.png" alt="App screen" class="img-fluid">
                        </div>
                    </div><!-- End app screen -->

                    <div class="col-lg-4">

                        <div class="fonctionnalite-item mb-5" data-aos="fade-left" data-aos-delay="200">
                            <div class="d-flex align-items-center justify-content-end gap-4">
                                <div class="fonctionnalite-icon flex-shrink-0">
                                    <i class="bi bi-file-earmark-zip"></i>
                                </div>
                                <div class="fonctionnalite-content">
                                    <h3>Efficacité administrative accrue</h3>
                                    <p>Simplification des tâches administratives telles que la prise de rendez-vous, la
                                        facturation et la gestion des dossiers patients, permettant de gagner du temps
                                        et de réduire les erreurs.</p>
                                </div>
                            </div>
                        </div><!-- End .fonctionnalite-item -->

                        <div class="fonctionnalite-item mb-5" data-aos="fade-left" data-aos-delay="300">
                            <div class="d-flex align-items-center gap-4">
                                <div class="fonctionnalite-icon flex-shrink-0">
                                    <i class="bi bi-bag-plus"></i>
                                </div>
                                <div class="fonctionnalite-content">
                                    <h3>Amélioration de la coordination des soins</h3>
                                    <p>Grâce à une base de données centralisée, tous les membres de l'équipe médicale
                                        ont accès aux informations à jour des patients, facilitant la coordination des
                                        soins.</p>
                                </div>
                            </div>
                        </div><!-- End .fonctionnalite-item -->

                        <div class="fonctionnalite-item" data-aos="fade-left" data-aos-delay="400">
                            <div class="d-flex align-items-center gap-4">
                                <div class="fonctionnalite-icon flex-shrink-0">
                                    <i class="bi bi-eye"></i>
                                </div>
                                <div class="fonctionnalite-content">
                                    <h3>Accès sécurisé aux données</h3>
                                    <p>Protection des données sensibles des patients grâce à des mesures de sécurité
                                        avancées, garantissant la confidentialité et la conformité aux réglementations.
                                    </p>
                                </div>
                            </div>
                        </div><!-- End .fonctionnalite-item -->

                    </div>
                </div>

            </div>

        </section>
        <!-- /avantages 2 Section -->

        <!-- Bannière Section -->
        <section id="banniere" class="banniere section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row content justify-content-center align-items-center position-relative">
                    <div class="col-lg-10  text-center">
                        <img src="assets/img/BanniereIMC.png" alt="" class="w-75 z-1">
                    </div>

                    <!-- Abstract Background Elements -->
                    <div class="shape shape-1 z-3">
                        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M47.1,-57.1C59.9,-45.6,68.5,-28.9,71.4,-10.9C74.2,7.1,71.3,26.3,61.5,41.1C51.7,55.9,35,66.2,16.9,69.2C-1.3,72.2,-21,67.8,-36.9,57.9C-52.8,48,-64.9,32.6,-69.1,15.1C-73.3,-2.4,-69.5,-22,-59.4,-37.1C-49.3,-52.2,-32.8,-62.9,-15.7,-64.9C1.5,-67,34.3,-68.5,47.1,-57.1Z"
                                transform="translate(100 100)"></path>
                        </svg>
                    </div>

                    <div class="shape shape-2 z-3">
                        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M41.3,-49.1C54.4,-39.3,66.6,-27.2,71.1,-12.1C75.6,3,72.4,20.9,63.3,34.4C54.2,47.9,39.2,56.9,23.2,62.3C7.1,67.7,-10,69.4,-24.8,64.1C-39.7,58.8,-52.3,46.5,-60.1,31.5C-67.9,16.4,-70.9,-1.4,-66.3,-16.6C-61.8,-31.8,-49.7,-44.3,-36.3,-54C-22.9,-63.7,-8.2,-70.6,3.6,-75.1C15.4,-79.6,28.2,-58.9,41.3,-49.1Z"
                                transform="translate(100 100)"></path>
                        </svg>
                    </div>

                    <!-- Dot Pattern Groups -->
                    <div class="dots dots-1 z-3">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <pattern id="dot-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                            </pattern>
                            <rect width="100" height="100" fill="url(#dot-pattern)"></rect>
                        </svg>
                    </div>

                    <div class="dots dots-2 z-3">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <pattern id="dot-pattern-2" x="0" y="0" width="20" height="20"
                                patternUnits="userSpaceOnUse">
                                <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                            </pattern>
                            <rect width="100" height="100" fill="url(#dot-pattern-2)"></rect>
                        </svg>
                    </div>

                    <div class="shape shape-3 z-3">
                        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M43.3,-57.1C57.4,-46.5,71.1,-32.6,75.3,-16.2C79.5,0.2,74.2,19.1,65.1,35.3C56,51.5,43.1,65,27.4,71.7C11.7,78.4,-6.8,78.3,-23.9,72.4C-41,66.5,-56.7,54.8,-65.4,39.2C-74.1,23.6,-75.8,4,-71.7,-13.2C-67.6,-30.4,-57.7,-45.2,-44.3,-56.1C-30.9,-67,-15.5,-74,0.7,-74.9C16.8,-75.8,33.7,-70.7,43.3,-57.1Z"
                                transform="translate(100 100)"></path>
                        </svg>
                    </div>
                </div>

            </div>

        </section><!-- /Bannière Section -->

        <!-- Clients Section -->
        <section id="clients" class="clients section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 2,
                                "spaceBetween": 40
                            },
                            "480": {
                                "slidesPerView": 3,
                                "spaceBetween": 60
                            },
                            "640": {
                                "slidesPerView": 4,
                                "spaceBetween": 80
                            },
                            "992": {
                                "slidesPerView": 6,
                                "spaceBetween": 120
                            }
                        }
                    }
                    </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Clients Section -->

        <!-- avis Section -->
        <section id="avis" class="avis section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Avis</h2>
                <p>Les professionnels de la santé et du corps administratif parle de notre application.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row g-5">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="avis-item">
                            <img src="assets/img/avis/avis-1.jpg" class="avis-img" alt="">
                            <h3>Sarah Koffi</h3>
                            <h4>Médecin</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Ivoire Medical Center a révolutionné ma manière de travailler. Elle
                                    permet de centraliser toutes les informations des patients et de gérer facilement
                                    les consultations, les prescriptions et les suivis. En
                                    tant que médecin, je gagne un temps précieux que je peux consacrer à mes
                                    patients.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End avis item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="avis-item">
                            <img src="assets/img/avis/avis-2.jpg" class="avis-img" alt="">
                            <h3>Mathieu N'guessan</h3>
                            <h4>Médecin</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Depuis que nous avons intégré Ivoire Medical Center, notre cabinet
                                    fonctionne de manière beaucoup plus fluide. La prise de rendez-vous est simplifiée
                                    et les dossiers des patients sont facilement accessibles. Cela nous permet de
                                    consacrer plus de temps aux soins et moins aux tâches administratives.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End avis item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="avis-item">
                            <img src="assets/img/avis/avis-3.jpg" class="avis-img" alt="">
                            <h3>Jena Soro</h3>
                            <h4>Infirmière</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Je trouve cette application très intuitive et pratique. Elle facilite la
                                    coordination des soins et permet de suivre les traitements des patients de manière
                                    efficace.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End avis item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="avis-item">
                            <img src="assets/img/avis/avis-4.jpg" class="avis-img" alt="">
                            <h3>Julie Ano</h3>
                            <h4>Secrétaire</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Utiliser Ivoire Medical Center a considérablement allégé mon travail. La gestion
                                    des
                                    rendez-vous, la facturation et les contacts avec les patients sont désormais
                                    beaucoup plus rapides et simples. C'est un véritable gain de temps et de
                                    productivité.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End avis item -->

                </div>

            </div>

        </section><!-- /avis Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo $countCM ?>"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Centres médicaux</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo $countM ?>"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Médecins</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo $countI ?>"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Infirmiers</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo $countS ?>"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Secrétaires</p>
                        </div>
                    </div><!-- End Stats Item -->

                </div>

            </div>

        </section><!-- /Stats Section -->

        <!-- fonctionnalites Section -->
        <section id="fonctionnalites" class="fonctionnalites section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Fonctionnalités</h2>
                <p>Notre solution informatique répond à l'ensemble des besoins de gestion de votre centre médicale avec
                    une large souplesse d'utilisation. Son développement a été soigneusement conçu en tenant compte des
                    différentes préoccupations des médecins.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="fonctionnalite-card d-flex">
                            <div class="icon flex-shrink-0">
                                <i class="bi bi-calendar4"></i>
                            </div>
                            <div>
                                <h3>Gestion de RDV</h3>
                                <p>Gestion des disponibilités en temps réel lors des prises des rendez-vous avec email
                                    de
                                    rappel pour vos patients.</p>
                            </div>
                        </div>
                    </div><!-- End fonctionnalite Card -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="fonctionnalite-card d-flex">
                            <div class="icon flex-shrink-0">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <h3>Gestion des Consultations</h3>
                                <p>Constitution du dossier patient informatisé , historique, suivi des actes effectués.
                                </p>

                            </div>
                        </div>
                    </div><!-- End fonctionnalite Card -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="fonctionnalite-card d-flex">
                            <div class="icon flex-shrink-0">
                                <i class="bi bi-bar-chart"></i>
                            </div>
                            <div>
                                <h3>Statistiques détaillées</h3>
                                <p>Statistiques détaillés de votre activité avec un tableau de bord détaillé.</p>

                            </div>
                        </div>
                    </div><!-- End fonctionnalite Card -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="fonctionnalite-card d-flex">
                            <div class="icon flex-shrink-0">
                                <i class="bi bi-calculator"></i>
                            </div>
                            <div>
                                <h3>Facturation et Ordonnances</h3>
                                <p>Suivi de la facturation de vos prestations et encaissement des recettes. Gestion et
                                    impression de vos documents médicaux: ordonnances, dossiers médicaux.</p>

                            </div>
                        </div>
                    </div><!-- End fonctionnalite Card -->

                </div>

            </div>

        </section><!-- /fonctionnalites Section -->

        <!-- Tarif Section -->
        <section id="tarif" class="tarif section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tarifs</h2>
                <p>Nos plans tarifaires fournissent les fonctionnalités et les ressources
                    nécessaires pour soutenir la
                    continuité de votre site Web.
                    expansion et succès.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4 justify-content-center">

                    <?php 
                 
                 foreach ($forfaits as $row){

                    ?>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="tarif-card">
                            <h3><?php echo $row['type_forfait']?></h3>
                            <div class="price">
                                <span class="currency">fcfa</span>
                                <span class="amount"><?php echo $row['prix_forfait']?></span>
                                <span class="period">/ mois</span>
                            </div>
                            <p class="description"><?php echo $row['description_forfait']?></p>
                            <hr>

                            <h4>Fonctionnalités inclus :</h4>
                            <ul class="avantages-list">

                                <?php 
                                     $fonctionnalites = $row["fonctionnalites"]; 
                                     $lines = explode("\n", $fonctionnalites);
                                   
                                foreach ($lines as $line) {
                                    ?> <i class="bi bi-check-circle-fill icone"></i>
                                <?php
                                if (!empty(trim($line))) {
                                echo htmlspecialchars($line) . '<br> <br>'; }
                                }

                                ?>



                            </ul>

                            <a href="" class="btn btn-primary">
                                commander
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <?php   }

                    ?>




                </div>

            </div>

        </section><!-- /Tarif Section -->

        <!-- Faq Section -->
        <section class="faq-9 faq section light-background" id="faq">

            <div class="container">
                <div class="row">

                    <div class="col-lg-5" data-aos="fade-up">
                        <h2 class="faq-title">Avez-vous une question ? Checker notre FAQ</h2>
                        <p class="faq-description">Nous sommes très appréciez par les médecins, nous sommes leur unique
                            interlocuteur pour toute question matérielle ou logicielle.</p>
                        <div class="faq-arrow d-none d-lg-block" data-aos="fade-up" data-aos-delay="200">
                            <svg class="faq-arrow" width="200" height="211" viewBox="0 0 200 211" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M198.804 194.488C189.279 189.596 179.529 185.52 169.407 182.07L169.384 182.049C169.227 181.994 169.07 181.939 168.912 181.884C166.669 181.139 165.906 184.546 167.669 185.615C174.053 189.473 182.761 191.837 189.146 195.695C156.603 195.912 119.781 196.591 91.266 179.049C62.5221 161.368 48.1094 130.695 56.934 98.891C84.5539 98.7247 112.556 84.0176 129.508 62.667C136.396 53.9724 146.193 35.1448 129.773 30.2717C114.292 25.6624 93.7109 41.8875 83.1971 51.3147C70.1109 63.039 59.63 78.433 54.2039 95.0087C52.1221 94.9842 50.0776 94.8683 48.0703 94.6608C30.1803 92.8027 11.2197 83.6338 5.44902 65.1074C-1.88449 41.5699 14.4994 19.0183 27.9202 1.56641C28.6411 0.625793 27.2862 -0.561638 26.5419 0.358501C13.4588 16.4098 -0.221091 34.5242 0.896608 56.5659C1.8218 74.6941 14.221 87.9401 30.4121 94.2058C37.7076 97.0203 45.3454 98.5003 53.0334 98.8449C47.8679 117.532 49.2961 137.487 60.7729 155.283C87.7615 197.081 139.616 201.147 184.786 201.155L174.332 206.827C172.119 208.033 174.345 211.287 176.537 210.105C182.06 207.125 187.582 204.122 193.084 201.144C193.346 201.147 195.161 199.887 195.423 199.868C197.08 198.548 193.084 201.144 195.528 199.81C196.688 199.192 197.846 198.552 199.006 197.935C200.397 197.167 200.007 195.087 198.804 194.488ZM60.8213 88.0427C67.6894 72.648 78.8538 59.1566 92.1207 49.0388C98.8475 43.9065 106.334 39.2953 114.188 36.1439C117.295 34.8947 120.798 33.6609 124.168 33.635C134.365 33.5511 136.354 42.9911 132.638 51.031C120.47 77.4222 86.8639 93.9837 58.0983 94.9666C58.8971 92.6666 59.783 90.3603 60.8213 88.0427Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="300">
                        <div class="faq-container">

                            <div class="faq-item faq-active">
                                <h3>Qu'est-ce que Ivoire Medical Center?</h3>
                                <div class="faq-content">
                                    <p> <span class="accent-text">Ivoire Medical Center</span> est une solution
                                        informatique de gestion multi-cabinets et multi-utilisateurs. Elle
                                        a été conçue et développée pour des professionnels de la santé,
                                        cabinets médicaux et cliniques.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Comment ça fonctionne ?</h3>
                                <div class="faq-content">
                                    <p>C'est une application qui fonctionne sur un navigateur via une adresse web
                                        accessible
                                        sur internet ou sur le réseau local du centre médical. Il s'installe sur un
                                        serveur web configuré à cet effet.
                                        Un simple ordinateur, tablette ou téléphone mobile connecté suffisent pour le
                                        fonctionnement de notre solution. L’accès au système se fait sur la base d’un
                                        login et d’un mot de passe en fonction des droits attribués à chaque
                                        utilisateur.
                                        Dans un centre médical par exemple la secrétaire gère les RDV, saisi les
                                        informations des patients, envoi de email, scanner les documents…
                                        le médecin se connecte au système informatique pour le suivi des patients, la
                                        gestion des documents (Prescriptions, ordonnances, facturation…)</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>J'utilise l'application, dois-je faire des sauvegardes?</h3>
                                <div class="faq-content">
                                    <p>Les sauvegardes se font via une base de données.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Combien coûte notre application ?</h3>
                                <div class="faq-content">
                                    <p>Les tarifs appliqués varient en fonction de la dimension de votre établissement
                                        en terme d'utilisateurs ainsi que le mode de connexion au système informatique
                                        IMC. Avec éventuellement une offre pour la maintenance.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- /Faq Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contactez-nous</h2>
                <p>Gardons le contact pour une meilleure communication.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4 g-lg-5">
                    <div class="col-lg-5">
                        <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                            <h3>Informations</h3>
                            <p>Vous avez ci-dessous toutes les informations nécessaires pour nous contacter.</p>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="content">
                                    <h4>Localisation</h4>
                                    <p>Cestia 2-ep</p>
                                    <p>Abidjan, Côte d'Ivoire</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div class="content">
                                    <h4>Téléphone</h4>
                                    <p>+255 07 59 39 58 41</p>
                                    <p>+225 07 59 39 58 42</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                                <div class="icon-box">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="content">
                                    <h4>Adresse email</h4>
                                    <p>info@imc.com</p>
                                    <p>contact@imc.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                            <h3>Apportez votre touche</h3>
                            <p>Veuillez nous laisser un message concernant l'utilisation de l'application et de
                                potentielles fonctionnalités à ajouter afin de vous apportez une expérience utilisateur
                                hors du
                                commun.</p>

                            <form action="traitement/traitement_message.php" method="post" class="php-email-form"
                                data-aos="fade-up" data-aos-delay="200">
                                <div class="row gy-4">

                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" placeholder="Votre Nom"
                                            required="">
                                    </div>

                                    <div class="col-md-6 ">
                                        <input type="email" class="form-control" name="email" placeholder="Votre Email"
                                            required="">
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form-control" name="objet" placeholder="Objet"
                                            required="">
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" name="message" rows="6" placeholder="Message"
                                            required=""></textarea>
                                    </div>

                                    <div class="col-12 text-center">

                                        <div class="messageText mb-4 "> <span class="accent-text "><?php
                                                if(!empty($messageText)) {
                                                 echo $messageText;}?></span>
                                        </div>


                                        <input type="submit" class="btn" value="Envoyer un message"
                                            name="messageSubmit">
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </section>
        <!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-apropos">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Ivoire Medical Center</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Avenue Cestia 2-ep</p>
                        <p>Abidjan, Côte d'Ivoire</p>
                        <p class="mt-3"><strong>Téléphone:</strong> <span>+225 07 59 39 58 41</span></p>
                        <p><strong>Email:</strong> <span>info@imc.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-5 col-md-3 text-center ">
                    <p class="text-center fs-5 mt-5">
                        Notre solution informatique répond à l'ensemble des <span class="accent-text fw-bold">besoins
                            de
                            gestion</span>
                        de
                        votre centre médical avec une <span class="accent-text fw-bold"> large souplesse
                            d'utilisation.</span>
                    </p>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Liens utiles</h4>
                    <ul>
                        <li><a href="#hero">Présentation</a></li>
                        <li><a href="#apropos">A propos de nous</a></li>
                        <li><a href="#fonctionnalites">Fonctionnalités</a></li>
                        <li><a href="#tarif">Tarifs</a></li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Ivoire Medical Center</strong> <span>Tous droits
                    réservés.</span>
            </p>
            <div class="credits">
                Equipe Ivoire Medical Center
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!--Fichier Vendor JS -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></script>

    <!--Fichier Main JS  -->
    <script src="assets/js/main.js"></script>



    <!-- Modal -->
    <div class="modal fade modal-lg" id="RDVModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="RDVModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="" class="modal-content" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="RDVModalLongTitle">Prise de rendez-vous</h5>
                    <button type="button" class="close position-absolute end-0 m-3 btn fs-4 border-0"
                        data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex gap-3">


                    <!---Ecrit le code du calendrier ici-->

                    <!--Le calendrier-->
                    <div class="calendrier-container rounded-4 shadow w-50">
                        <div class="calendrier-header">
                            <button onclick="prevMonth()"><span class="fas fa-chevron-left"></span></button>
                            <h2 id="month-year"></h2>
                            <button onclick="nextMonth()"><span class="fas fa-chevron-right"></span></button>
                        </div>

                        <!--Les jours de la semaine-->
                        <div class="calendrier-days">
                            <div>Dim</div>
                            <div>Lun</div>
                            <div>Mar</div>
                            <div>Mer</div>
                            <div>Jeu</div>
                            <div>Ven</div>
                            <div>Sam</div>
                        </div>

                        <!--La grille des jours-->
                        <div class="calendrier-grid" id="calendrier-grid"></div>
                    </div>
                    <!--La fenetre modale-->

                    <div id="timeModal" class="timeModal modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content d-flex flex-column gap-4 ">
                                <div class="modal-header">
                                    <span style="cursor:pointer;" class="close fs-3 mx-3" onclick="closeModal()">&times;</span>
                                    <h5>Choississez une heure pour le rendez-vous</h5>
                                </div>
                                <div class="modal-body">
                                    <input name="time" type="time" id="appointment-time" class="mx-3 " required>
                                </div>

                                <div class="modal-footer">
                                    <button onclick="confirmAppointment()" class="mx-3 btn btn-primary"
                                        data-dismiss="timeModal">Confirmer</button>
                                </div>


                            </div>

                        </div>

                    </div>


                    <div class="informations-patient w-50">
                        <div class="form-group d-flex flex-column gap-4 justify-content-center w-100">
                            <input type="text" name="nom" placeholder="Votre nom" required
                                class="rounded-3  p-2 text-sm-start mx-3">
                            <input type="email" name="email" placeholder="Exemple : email@exemple.com" required
                                class="rounded-3  p-2 text-sm-start mx-3 ">
                            <input type="text" name="type_consultation"
                                placeholder="type de consultaion ex : Cardiologie" required
                                class="rounded-3  p-2 text-sm-start mx-3 ">
                            <input type="date" name="date" id="date" value="">
                        </div>
                        <div id="appointment-summary">
                            <span id="appointment-summary-title mt-4">Recapitulatif de rendez-vous :</span>
                            <p id="summary"></p>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary border-0" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn">Prendre rendez-vous</button>
                </div>



            </form>
        </div>
    </div>
    <script>
    const calendarGrid = document.getElementById("calendrier-grid");
    const monthYearDisplay = document.getElementById("month-year");
    const summary = document.getElementById("summary");
    const timeModal = document.getElementById("timeModal");
    const selectDateHeader = document.querySelector(".fade-in"); // Sélectionne l'élément <h1>
    const appointmentSummaryHeader = document.getElementById(
        "appointment-summary-title"); // Sélectionne le <h5> du récapitulatif
    let selectedDate = null;
    let currentDate = new Date();

    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        monthYearDisplay.textContent = currentDate.toLocaleDateString("fr-FR", {
            month: "long",
            year: "numeric"
        });

        calendarGrid.innerHTML = ""; // Réinitialise le calendrier

        // Remplir les cases vides avant le premier jour du mois
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement("div");
            emptyCell.classList.add("empty-cell");
            calendarGrid.appendChild(emptyCell);
        }

        // Remplir les cases avec les jours du mois
        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement("div");
            dayCell.classList.add("day-cell");
            dayCell.textContent = day;

            dayCell.addEventListener("click", () => {
                selectedDate = `${year}-${month + 1}-${day}`;
                openModal();
            });

            calendarGrid.appendChild(dayCell);
        }
    }

    function prevMonth() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    }

    function nextMonth() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    }

    function openModal() {
        timeModal.style.display = "flex";
    }

    function closeModal() {
        timeModal.style.display = "none";
    }


    function confirmAppointment() {
        const time = document.getElementById("appointment-time").value;
        if (time) {


            summary.textContent = `Votre rendez-vous est programmé le ${selectedDate} à ${time}`;
            const dateRDV = document.getElementById("date");
            dateRDV.setAttribute("value", selectedDate);


            // Afficher le récapitulatif et masquer l'en-tête
            appointmentSummaryHeader.style.display = "block"; // Affiche le titre "Recapitulatif de rendez-vous"
            summary.style.display = "block"; // Affiche le recapitulatif
            selectDateHeader.style.display = "none"; // Cache le <h1> de sélection de la date

            // Fermer uniquement la modal imbriquée
            document.querySelector('[data-dismiss="timeModal"]').addEventListener('click', function() {
                $('#timeModal').modal('hide');
            });


        } else {
            alert("Veuillez sélectionner une heure.");
        }
    }

    renderCalendar(); // Affiche le mois en cours au chargement
    </script>
</body>

</html>