
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="QUOTE - Request a quote for every type of companies">
    <meta name="author" content="Ansonika">
    <title>Innovation Social SAFI</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/icon_fonts/css/all_icons_min.css" rel="stylesheet">
    <link href="css/magnific-popup.min.css" rel="stylesheet">
    <link href="css/skins/square/yellow.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

</head>

<body>
    
    <div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /Loader_form -->

    <header>
         <?php require_once('views/header.php'); ?>
    </header><!-- /header -->

    <div class="intro_txt animated fadeInUp">
        <h2>Innovation Social SAFI</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui voluptatum enim est deserunt assumenda, aspernatur quam aperiam!</p>
    </div><!-- /intro_txt -->
    
    <video id="my-video" class="video" loop muted autoplay playsinline>
      <source src="media/demo.mp4" type="video/mp4">
      <source src="media/demo.ogv" type="video/ogg">
      <source src="media/demo.webm" type="video/webm">
	</video><!-- /video -->
    <div class="video_fallback"></div>

    <div class="layer"></div><!-- /mask -->

    <div id="main_container">
       
        <div id="header_in">
            <a href="#0" class="close_in "><i class="pe-7s-close-circle"></i></a>
        </div>

        <div class="wrapper_in">
			
            <div class="container-fluid">
                <div class="tab-content">
                    <div class="tab-pane fade" id="tab_1">                                               
                        <div class="subheader" id="quote"></div>
                        <?php require_once('views/inscription.php'); ?>
                    </div><!-- /TAB 1:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
                    
                    <div class="tab-pane fade" id="tab_2">
                       <?php require_once('views/login.php');?>
                    </div><!-- /TAB 2:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
                    
                    <div class="tab-pane fade" id="tab_3">
                        
                        <div id="map_contact"></div><!-- /map -->
                        
                        <div id="contact_info">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="box_contact">
                                        <i class="pe-7s-map-marker"></i>
                                        <h4>Address</h4>
                                        <p>Duo magna vocibus electram ad. Sit an amet aeque legimus, paulo mnesarchum et mea, et pri quodsi singulis.</p>
                                        <p>11 Fifth Ave - New York, 45 001238 - USA</p>
										<a href="https://www.google.com/maps/dir//11+5th+Ave,+New+York,+NY+10003,+Stati+Uniti/@40.7322935,-73.9981148,17z/data=!4m9!4m8!1m0!1m5!1m1!1s0x89c25990b3af8bb9:0x854ae1d3553155!2m2!1d-73.9959261!2d40.7322935!3e0" class="btn_1" target="_blank">Get directions</a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="box_contact">
                                        <i class="pe-7s-mail-open-file"></i>
                                        <h4>Email and website</h4>
                                        <p>Duo magna vocibus electram ad. Sit an amet aeque legimus, paulo mnesarchum et mea, et pri quodsi singulis.</p>
                                        <p>
                                            <strong>Email:</strong> <a href="#0"><span class="__cf_email__" data-cfemail="0e7d7b7e7e617c7a4e6a61636f6760206d6163">[email&#160;protected]</span></a><br>
                                            <strong>Website:</strong> <a href="#0">www.quote.com</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="box_contact">
                                        <i class="pe-7s-call"></i>
                                        <h4>Telephone</h4>
                                        <p>Duo magna vocibus electram ad. Sit an amet aeque legimus, paulo mnesarchum et mea, et pri quodsi singulis.</p>
                                        <p>
                                        	<strong>Tel:</strong> <a href="#0">+44 543 53433</a><br>
                                            <strong>Fax:</strong> <a href="#0">+44 543 5322</a>
                                        </p>
                                    </div>
                                </div>
                            </div><!-- / row-->
                            <hr>
                            <div id="social">
                                <ul>
                                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                                    <li><a href="#"><i class="icon-google"></i></a></li>
                                    <li><a href="#"><i class="icon-linkedin"></i></a></li>
                                </ul>
                            </div><!-- /social -->
                        </div>
                    </div><!-- /TAB 3:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->

                </div><!-- /tab content -->
            </div><!-- /container-fluid -->
        </div><!-- /wrapper_in -->
    </div><!-- /main_container -->

    <div id="additional_links">
        <ul>
            <li>© 2018 Quote</li>
            <li><a href="https://goo.gl/iSDJf3" class="animated_link">Purchase this template</a></li>
            <li><a href="index_2.html" class="animated_link">Demo Slider</a></li>
			<li><a href="#0" class="animated_link">With UPLOAD</a></li>
            <li><a href="index_4.html" class="animated_link">With Branch</a></li>
            <li><a href="index_5.html" class="animated_link">Full Page View</a></li>
            <li><a href="shortcodes.html" class="animated_link">Shortcodes</a></li>
        </ul>
    </div><!-- /add links -->

    <!-- Modal terms -->
    <div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms and conditions</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn_1" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

	<!-- SCRIPTS -->
    <!-- Jquery-->
    <script data-cfasync="false" src="js/email-decode.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Common script -->
    <script src="js/common_scripts_min.js"></script>
    <!-- Theme script -->
	<script src="js/file-validator.js"></script>
	<script src="js/functions_with_upload.js"></script>

    <!-- Google map -->
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="js/mapmarker.jquery.js"></script>
    <script src="js/mapmarker_func.jquery.js"></script>

    <script src="controlleurs/addNewPerson.js"></script>
    
</body>

</html>