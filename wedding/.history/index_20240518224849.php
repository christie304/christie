<?php
$errors = [];
$errorMessage = '';
$successMessage = '';

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $guests = $_POST['guests'];

    if (empty($name)) {
        $errors[] = 'Name is empty';
    }
    if (empty($email)) {
        $errors[] = 'Email is empty';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }
    if (empty($guests)) {
        $errors[] = 'Number of guests is empty';
    }

    if (empty($errors)) {
        $toEmail = 'chris@athenablue.dev;emileytrent@gmail.com';
        $emailSubject = 'EmileyAndNoah.com RSVP';
        $headers = ['From' => $email, 'Reply-To' => $email, 'Content-type' => 'text/html; charset=iso-8859-1'];

        $bodyParagraphs = ["Name: {$name}", "Email: {$email}", "Message:", $message];
        $bodyOLD = join(PHP_EOL, $bodyParagraphs);
        $body = "Someone has sent an RSVP on EmileyAndNoah.com<br><br><br>------------------------------------<br>Name: {$name} <br><br>Email: {$email} <br><br>Guests: {$guests}";

        if (mail($toEmail, $emailSubject, $body, $headers)) {
            //header('Location: thank-you.html');
			$toEmiley = 'emileytrent@gmail.com';
			mail($toEmiley, $emailSubject, $body, $headers);
            $successMessage = "<div class='alert alert-success text-center'>Thank you for your RSVP on EmileyAndNoah.com. If there is a change in your RSVP, please contact Emiley.</div>";
        } else {
            $errorMessage = 'Oops, something went wrong. Please try again later.';
            $errorMessage = "<div class='alert alert-danger'>We were unable to send your message. Please try again later.</div>";
        }

        /// email to user

        $toEmail2 = $email;
        $emailSubject2 = 'Thank you for your RSVP on EmileyAndNoah.com';
        $headers2 = ['From' => $email, 'Reply-To' => $email, 'Content-type' => 'text/html; charset=iso-8859-1'];

        $bodyParagraphs = ["Name: {$name}", "Email: {$email}", "Message:", $message];
        $bodyOLD = join(PHP_EOL, $bodyParagraphs);
        $body2 = "If there is a change in your RSVP, please contact Emiley at {$toEmiley}.<br><br>Here's a copy of your RSVP:<br><br>Name: {$name} <br>Email: {$email}<br>Guests: {$guests}<br><br>The wedding is INVITE only and will be held at the Hinton Historical Freight Depot.<br><br><br>Hinton Historical Freight Depot<br>509 Commercial Street<br>Hinton, WV 25951 <br><br><a href='https://www.google.com/maps/dir//509+Commercial+St,+Hinton,+WV+25951/@37.676769,-80.8906277,17z/data=!4m8!4m7!1m0!1m5!1m1!1s0x884e812f85e5f369:0x6f847295a794d6c6!2m2!1d-80.8880528!2d37.676769?entry=ttu'>lick here to get directions.</a>";

        if (mail($toEmail2, $emailSubject2, $body2, $headers2)) {
            //header('Location: thank-you.html');
            //$successMessage = "<div class='alert alert-success text-center'>Thank you for contacting Athena Blue, LLC. Someone will respond to your message within 48 business hours.</div>";
        } else {
            //$errorMessage = 'Oops, something went wrong. Please try again later';
            //$errorMessage = "<div class='alert alert-danger'>We were unable to send your message. Please try again later.</div>";
        }
    } else {
        $allErrors = join('<br/>', $errors);
        $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    }
}
?> 
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Wedding</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
    <meta name="keywords" content="" />
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="fh5co-loader">
   

    </div>
	
	<div id="page">
	
    <!-----
	<nav class="fh5co-nav" role="navigation">
		<div class="container">
			<div class="row">
				<div class="col-xs-2">
					<div id="fh5co-logo"><a href="index.php"></a></div>
				</div>
				<div class="col-xs-10 text-right menu-1">
					<ul>
						<li class="active"><a href="index.php">Home</a></li>
						<li><a href="#fh5co-couple">We're Getting Married</a></li>
						<li><a href="#fh5co-event">Wedding Events</a></li>
                        <li><a href="#fh5co-couple-story">Emiley &amp; Noah</a></li>
                        <li><a href="#fh5co-wedding-party">Wedding Party</a></li>
                        <li><a href="#fh5co-gallery">Gallery</a></li>
                        <li><a href="#fh5co-started">RSVP</a></li>
					</ul>
				</div>
			</div>
			
		</div>
	</nav>
---->
	<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url(images/stars.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
        <div class="row text-center">
        <?php
        if (!empty($_POST)) {
            if($successMessage!=''){
                echo $successMessage;
            }
            if($errorMessage!=''){
                echo $errorMessage;
            }
        }
        ?>
    </div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1>Emiley &amp; Noah</h1>
							<div class="simply-countdown simply-countdown-one"></div>
							<p><a href="#fh5co-started" class="btn btn-default btn-sm">RSVP</a>
								<a href="https://www.amazon.com/wedding/registry/3GV1YAZRSZT33" class="btn btn-default btn-sm">Gift Registry</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div id="fh5co-couple">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<h2>We're getting married!</h2>
					<h3>September 21th, 2024</h3>
				</div>
			</div>
			<div class="couple-wrap animate-box">
				<div class="couple-half">
					<div class="groom">
						<img src="images/bride.jpg" alt="groom" class="img-responsive">
					</div>
					<div class="desc-bride">
						<h3>Emiley Trent</h3>
						<p>The Bride</p>
					</div>
				</div>
				<p class="heart text-center"><i class="icon-heart2"></i></p>
				<div class="couple-half">
					<div class="bride">
						<img src="images/groom.jpg" alt="groom" class="img-responsive">
					</div>
					<div class="desc-groom">
						<h3>Noah Stover</h3>
						<p>The Groom</p>
					</div>
				</div>
			</div>			
		</div>
		<br><br>
			<div class="animate-box text-center px-5 mx-5 p-5 m-5" style="width:85%;margin:auto;">
				Join Emiley and Noah as they celebrate their love for each other on September 21st, 2024. 
				Ceremony and reception will be held at the historic Hinton freight depot. The ceremony will be 
				unplugged. The talented photographer will get all the special moments and will share them on this 
				website once the photos are ready.
				<br><br>
				<div class="container">
					<div class="alert alert-warning text-left">
					"This is a very special day and we ask that you respect our wishes to unplug the phones and live in the moment with us. There will be a moment we allow you to take a picture or two before the ceremony. Once we are pronounce the Stovers you are free to use your phones and take as many pictures as you wish. 
					<br><br>
					We would much rather look out and see all the people we care about and not the phones.” - <em>Emiley & Noah</em>
					</div>
				</div>
			</div>
	</div>

	<div id="fh5co-event" class="fh5co-bg" style="background-image:url(images/railroad-forest.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">					
					<h2>Wedding Events</h2>
					<a href="#fh5co-started" class="btn btn-small btn-warning">RSVP</a>
				</div>
			</div>
			<div class="row">
				<div class="display-t">
					<div class="display-tc">
						<div class="col-md-10 col-md-offset-1">
							<div class="col-md-6 col-sm-6 text-center">
								<div class="event-wrap animate-box">
									<h3>Main Ceremony</h3>
									<div class="event-col">
										<i class="icon-clock"></i>
										<span>3:00 PM</span>
									</div>
									<div class="event-col">
										<i class="icon-calendar"></i>
										<span>Sunday</span>
										<span>September 21, 2024</span>
									</div>
                                    <p>Details in RSVP E-mail.</p>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 text-center">
								<div class="event-wrap animate-box">
									<h3>Reception</h3>
									<div class="event-col">
										<i class="icon-clock"></i>
										<span>Following Ceremony</span>
									</div>
									<div class="event-col">
										<i class="icon-calendar"></i>
										<span>Sunday</span>
										<span>September 21, 2024</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				</div>
				
			</div>
		</div>
	</div>

	<div id="fh5co-couple-story">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<span>Our Story</span>
					<h2>Emiley &amp; Noah</h2>
				</div>
			</div>
			<div class="row row-bottom-padded-md">
				<div class="col-md-12">
					<ul id="fh5co-gallery-list">	
						<!------------					
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/couple-1.jpg); ">
							<a href="images/couple-1.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2></h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/couple-2.jpg); ">
							<a href="images/couple-2.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2></h2>
								</div>
							</a>
						</li>

						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/couple-3.jpg); ">
							<a href="images/couple-3.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2></h2>
								</div>
							</a>
						</li>

						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/couple-4.jpg); ">
							<a href="images/couple-4.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2></h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/couple-5.jpg); ">
							<a href="images/couple-5.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2></h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/couple-6.jpg); ">
							<a href="images/couple-6.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2></h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/couple-7.jpg); ">
							<a href="images/couple-7.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2></h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/couple-8.jpg); ">
							<a href="images/couple-8.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2></h2>
								</div>
							</a>
						</li>
						------------>
						<?php
						for($i=1;$i<=42;$i++){
							echo '<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/couple-'.$i.'.jpg); ">
							<a href="images/couple-'.$i.'.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2></h2>
								</div>
							</a>';
						}
						?>
					</ul>		
				</div>
			</div>
		</div>
	</div><div id="fh5co-wedding-party">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">	
					<span>Meet Our</span>				
					<h2>Wedding Party</h2>
				</div>
			</div>
			<div class="row row-bottom-padded-md">
				<div class="col-md-12">
					<ul id="fh5co-gallery-list">
						
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/wedding-party-1.jpg); ">
							<a href="images/wedding-party-1.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2>Brooke Massey</h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/wedding-party-2.jpg); ">
							<a href="images/wedding-party-2.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2>Cierra Francisco</h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/wedding-party-3.jpg); ">
							<a href="images/wedding-party-3.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2>Allyson Bolen</h2>
								</div>
							</a>
						</li>

						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/wedding-party-4.jpg); ">
							<a href="images/wedding-party-4.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2>Jeff Adkins</h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/wedding-party-5.jpg); ">
							<a href="images/wedding-party-5.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2>Brett Gadomski</h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/wedding-party-6.jpg); ">
							<a href="images/wedding-party-6.jpg">
								<div class="case-studies-summary">
									<span></span>
									<h2>Caleb Bolen</h2>
								</div>
							</a>
						</li>
					</ul>		
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-gallery" class="fh5co-section-gray">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<span>Our Memories</span>
					<h2>Wedding Gallery</h2>
					<p>Come back after the wedding to see the photo gallery.</p>
				</div>
			</div>
			<!----
			<div class="row row-bottom-padded-md">
				<div class="col-md-12">
					<ul id="fh5co-gallery-list">
						
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-1.jpg); "> 
						<a href="images/gallery-1.jpg">
							<div class="case-studies-summary">
								<span>14 Photos</span>
								<h2>Two Glas of Juice</h2>
							</div>
						</a>
					</li>
					<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-2.jpg); ">
						<a href="#" class="color-2">
							<div class="case-studies-summary">
								<span>30 Photos</span>
								<h2>Timer starts now!</h2>
							</div>
						</a>
					</li>


					<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-3.jpg); ">
						<a href="#" class="color-3">
							<div class="case-studies-summary">
								<span>90 Photos</span>
								<h2>Beautiful sunset</h2>
							</div>
						</a>
					</li>
					<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-4.jpg); ">
						<a href="#" class="color-4">
							<div class="case-studies-summary">
								<span>12 Photos</span>
								<h2>Company's Conference Room</h2>
							</div>
						</a>
					</li>

						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-5.jpg); ">
							<a href="#" class="color-3">
								<div class="case-studies-summary">
									<span>50 Photos</span>
									<h2>Useful baskets</h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-6.jpg); ">
							<a href="#" class="color-4">
								<div class="case-studies-summary">
									<span>45 Photos</span>
									<h2>Skater man in the road</h2>
								</div>
							</a>
						</li>

						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-7.jpg); ">
							<a href="#" class="color-4">
								<div class="case-studies-summary">
									<span>35 Photos</span>
									<h2>Two Glas of Juice</h2>
								</div>
							</a>
						</li>

						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-8.jpg); "> 
							<a href="#" class="color-5">
								<div class="case-studies-summary">
									<span>90 Photos</span>
									<h2>Timer starts now!</h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-9.jpg); ">
							<a href="#" class="color-6">
								<div class="case-studies-summary">
									<span>56 Photos</span>
									<h2>Beautiful sunset</h2>
								</div>
							</a>
						</li>
					</ul>		
				</div>
			</div>
			----->
		</div>
	</div>
	<!---
	<div id="fh5co-counter" class="fh5co-bg fh5co-counter" style="background-image:url(images/img_bg_5.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="display-t">
					<div class="display-tc">
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-users"></i>
								</span>

								<span class="counter js-counter" data-from="0" data-to="500" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Estimated Guest</span>

							</div>
						</div>
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-user"></i>
								</span>

								<span class="counter js-counter" data-from="0" data-to="1000" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">We Catter</span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-calendar"></i>
								</span>
								<span class="counter js-counter" data-from="0" data-to="402" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Events Done</span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-clock"></i>
								</span>

								<span class="counter js-counter" data-from="0" data-to="2345" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Hours Spent</span>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-testimonial">
		<div class="container">
			<div class="row">
				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
						<span>Best Wishes</span>
						<h2>Friends Wishes</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 animate-box">
						<div class="wrap-testimony">
							<div class="owl-carousel-fullwidth">
								<div class="item">
									<div class="testimony-slide active text-center">
										<figure>
											<img src="images/couple-1.jpg" alt="user">
										</figure>
										<span>John Doe, via <a href="#" class="twitter">Twitter</a></span>
										<blockquote>
											<p>"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics"</p>
										</blockquote>
									</div>
								</div>
								<div class="item">
									<div class="testimony-slide active text-center">
										<figure>
											<img src="images/couple-2.jpg" alt="user">
										</figure>
										<span>John Doe, via <a href="#" class="twitter">Twitter</a></span>
										<blockquote>
											<p>"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, at the coast of the Semantics, a large language ocean."</p>
										</blockquote>
									</div>
								</div>
								<div class="item">
									<div class="testimony-slide active text-center">
										<figure>
											<img src="images/couple-3.jpg" alt="user">
										</figure>
										<span>John Doe, via <a href="#" class="twitter">Twitter</a></span>
										<blockquote>
											<p>"Far far away, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean."</p>
										</blockquote>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-services" class="fh5co-section-gray">
		<div class="container">
			
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>We Offer Services</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
						<span class="icon">
							<i class="icon-calendar"></i>
						</span>
						<div class="feature-copy">
							<h3>We Organized Events</h3>
							<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						</div>
					</div>

					<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
						<span class="icon">
							<i class="icon-image"></i>
						</span>
						<div class="feature-copy">
							<h3>Photoshoot</h3>
							<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						</div>
					</div>

					<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
						<span class="icon">
							<i class="icon-video"></i>
						</span>
						<div class="feature-copy">
							<h3>Video Editing</h3>
							<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						</div>
					</div>

				</div>

				<div class="col-md-6 animate-box">
					<div class="fh5co-video fh5co-bg" style="background-image: url(images/img_bg_3.jpg); ">
						<a href="https://vimeo.com/channels/staffpicks/93951774" class="popup-vimeo"><i class="icon-video2"></i></a>
						<div class="overlay"></div>
					</div>
				</div>
			</div>

			
		</div>
	</div>

-->
<br><br><br>
    
    
<form class="form-inline" action="index.php" method="POST">
    <input type="hidden" name="action" value="testing">
	<div id="fh5co-started" class="fh5co-bg" style="background-image:url(images/img_bg_4.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row ">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Are You Attending?</h2>
					<p>RSVP by July 20th. Wedding is INVITE only. Location and directions will be sent to attendees who have RSVPed.</p>
				</div>
			</div>
			<div class="row ">
				<div class="col-md-10 col-md-offset-1">					
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="name" class="sr-only">Name</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Name">
							</div>
						</div>
                        <div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="name" class="sr-only">Guests</label>
								<input type="text" class="form-control" id="guests" name="guests" placeholder="Number of Guests">
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="email" class="sr-only">Email</label>
								<input type="text" class="form-control" id="email" name="email" placeholder="Email">
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<input type="submit" class="btn btn-default btn-block" value="I am Attending">
						</div>					
				</div>
			</div>
		</div>
	</div>
    </form>


	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>

	<!-- Stellar -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>

	<!-- // <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.js"></script> -->
	<script src="js/simplyCountdown.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	<script>
    var d = new Date(new Date().getTime() + 200 * 120 * 120 * 2000);
	var d = new Date("2024-09-21 13:00");

    // default example
    simplyCountdown('.simply-countdown-one', {
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate()
    });

    //jQuery example
    $('#simply-countdown-losange').simplyCountdown({
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate(),
        enableUtc: false
    });
</script>

	</body>
</html>

