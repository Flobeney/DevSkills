<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Balises meta -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>DevSkills</title>
    <meta content="Site de tutoriels informatiques" name="description">

    <!-- Début CSS -->
    <?php include 'inc/templateCSS.inc.php'; ?>
    <!-- Fin CSS -->

    <!-- Logo de la page -->
    <link rel="shortcut icon" href="img/logoDevSkills.png">

    <!-- =======================================================
    Theme Name: Folio
    Theme URL: https://bootstrapmade.com/folio-bootstrap-portfolio-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
    ======================================================= -->
</head>

<body>

    <!-- Début barre de navigation -->
    <?php include 'inc/navbar.inc.php'; ?>
    <!-- Fin barre de navigation -->

    <!-- Début section header -->
    <div class="home">
        <div class="container">
            <div class="header-content">
                <h1>DevSkills</h1>
                <p>Site de tutoriels informatiques</p>
            </div>
        </div>
    </div>
    <!-- Fin section header -->

    <!-- Début section avec image -->
    <div id="about" class="paddsection">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-lg-4 ">
                    <div class="div-img-bg">
                        <div class="about-img">
                            <img src="img/me.jpg" class="img-responsive" alt="me">
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="about-descr">

                        <p class="p-heading">I'm a ux /ui designer austin based who loves clean, simple & unique design. i also enjoy crafting brand identities, icons, & ilustration work. </p>
                        <p class="separator">To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family.English person.</p>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fin section avec image -->

    <!-- Début section sans image -->
    <div id="about" class="paddsection">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-lg-12">
                    <div class="about-descr">

                        <p class="p-heading">I'm a ux /ui designer austin based who loves clean, simple & unique design. i also enjoy crafting brand identities, icons, & ilustration work. </p>
                        <p class="separator">To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family.English person.</p>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fin section sans image -->

    <!-- Début section avec carousel -->
    <div id="services">
        <div class="container">

            <div class="services-carousel owl-theme">

                <div class="services-block">
                    <i class="ion-ios-browsers-outline"></i>
                    <span>UI/UX DESIGN</span>
                    <p class="separator">To an English person, it will seem like simplified English,told me what </p>
                </div>

                <div class="services-block">
                    <i class="ion-ios-lightbulb-outline"></i>
                    <span>BRAND IDENTITY</span>
                    <p class="separator">To an English person, it will seem like simplified English,told me what </p>
                </div>

                <div class="services-block">
                    <i class="ion-ios-color-wand-outline"></i>
                    <span>WEB DESIGN</span>
                    <p class="separator">To an English person, it will seem like simplified English,told me what </p>
                </div>

                <div class="services-block">
                    <i class="ion-social-android-outline"></i>
                    <span>MOBILE APPS</span>
                    <p class="separator">To an English person, it will seem like simplified English,told me what </p>
                </div>

                <div class="services-block">
                    <i class="ion-ios-analytics-outline"></i>
                    <span>Analytics</span>
                    <p class="separator">To an English person, it will seem like simplified English,told me what </p>
                </div>

                <div class="services-block">
                    <i class="ion-ios-camera-outline"></i>
                    <span>PHOTOGRAPHY</span>
                    <p class="separator">To an English person, it will seem like simplified English,told me what </p>
                </div>

            </div>

        </div>
    </div>
    <!-- Fin section avec carousel -->

    <!-- Début section portfolio -->
    <div id="portfolio" class="text-center paddsection">

        <div class="container">
            <div class="section-title text-center">
                <h2>My Portfolio</h2>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="portfolio-list">
                        <ul class="nav list-unstyled" id="portfolio-flters">
                            <li class="filter filter-active" data-filter=".all">all</li>
                            <li class="filter" data-filter=".branding">branding</li>
                            <li class="filter" data-filter=".mockups">mockups</li>
                            <li class="filter" data-filter=".uikits">ui kits</li>
                            <li class="filter" data-filter=".webdesign">web design</li>
                            <li class="filter" data-filter=".photography">photography</li>
                        </ul>
                    </div>

                    <div class="portfolio-container">

                        <div class="col-lg-4 col-md-6 portfolio-thumbnail all branding uikits webdesign">
                            <a href="test.php">
                                <img src="img/portfolio/1.jpg" alt="img">
                                <p>Titre 1</p>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-6 portfolio-thumbnail all mockups uikits photography">
                            <a href="test.php">
                                <img src="img/portfolio/2.jpg" alt="img">
                                <p>Titre 2</p>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-6 portfolio-thumbnail all branding webdesig photographyn">
                            <a href="test.php">
                                <img src="img/portfolio/3.jpg" alt="img">
                                <p>Titre 3</p>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-6 portfolio-thumbnail all mockups webdesign photography">
                            <a href="test.php">
                                <img src="img/portfolio/4.jpg" alt="img">
                                <p>Titre 4</p>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-6 portfolio-thumbnail all branding uikits photography">
                            <a href="test.php">
                                <img src="img/portfolio/5.jpg" alt="img">
                                <p>Titre 5</p>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-6 portfolio-thumbnail all mockups uikits webdesign">
                            <a href="test.php">
                                <img src="img/portfolio/6.jpg" alt="img">
                                <p>Titre 6</p>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Fin section portfolio -->

    <!-- Début section journal -->
    <div id="journal" class="text-left paddsection">

        <div class="container">
            <div class="section-title text-center">
                <h2>journal</h2>
            </div>
        </div>

        <div class="container">
            <div class="journal-block">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="journal-info">

                            <a href="blog-single.php"><img src="img/blog-post-1.jpg" class="img-responsive" alt="img"></a>

                            <div class="journal-txt">

                                <h4><a href="blog-single.php">SO LETS MAKE THE MOST IS BEAUTIFUL</a></h4>
                                <p class="separator">To an English person, it will seem like simplified English
                                </p>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="journal-info">

                            <a href="blog-single.php"><img src="img/blog-post-2.jpg" class="img-responsive" alt="img"></a>

                            <div class="journal-txt">

                                <h4><a href="blog-single.php">WE'RE GONA MAKE DREAMS COMES</a></h4>
                                <p class="separator">To an English person, it will seem like simplified English
                                </p>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="journal-info">

                            <a href="blog-single.php"><img src="img/blog-post-3.jpg" class="img-responsive" alt="img"></a>

                            <div class="journal-txt">

                                <h4><a href="blog-single.php">NEW LIFE CIVILIZATIONS TO BOLDLY</a></h4>
                                <p class="separator">To an English person, it will seem like simplified English
                                </p>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- Fin section journal -->

    <!-- Début section contact -->
    <div id="contact" class="paddsection">
        <div class="container">
            <div class="contact-block1">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="contact-contact">

                            <h2 class="mb-30">GET IN TOUCH</h2>

                            <ul class="contact-details">
                                <li><span>23 Main, Street</span></li>
                                <li><span>New York, United States</span></li>
                                <li><span>+88 01912704287</span></li>
                                <li><span>example@example.com</span></li>
                            </ul>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <form action="" method="post" role="form" class="contactForm">
                            <div class="row">

                                <div id="sendmessage">Your message has been sent. Thank you!</div>
                                <div id="errormessage"></div>

                                <div class="col-lg-6">
                                    <div class="form-group contact-block1">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                        <div class="validation"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                        <div class="validation"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                        <div class="validation"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" rows="12" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                        <div class="validation"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-defeault btn-send" value="Send message">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin section contact -->

    <!-- Début section contact -->
    <div id="contact" class="paddsection">
        <div class="container">
            <div class="contact-block1">
                <div class="row">

                    <div class="col-lg-12">
                        <form action="" method="post" role="form" class="contactForm">
                            <div class="row">

                                <div id="sendmessage">Your message has been sent. Thank you!</div>
                                <div id="errormessage"></div>

                                <div class="col-lg-6">
                                    <div class="form-group contact-block1">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                        <div class="validation"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                        <div class="validation"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                        <div class="validation"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" rows="12" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                        <div class="validation"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-defeault btn-send" value="Send message">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin section contact -->

    <!-- Début pied de page -->
    <?php include 'inc/footer.inc.php'; ?>
    <!-- Fin pied de page -->

    <!-- Début JS -->
    <?php include 'inc/templateJS.inc.php'; ?>
    <!-- Fin JS -->

</body>

</html>
