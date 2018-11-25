<!doctype html>
<!--[if IE 8 ]>    <html dir="ltr" lang="en-US" class="no-js ie8 oldie ie"> <![endif]-->
<!--[if IE 9 ]>    <html dir="ltr" lang="en-US" class="no-js ie9 oldie ie"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brandname</title>
    <link href="<?php echo base_url()?>site/images//favicon.ico" rel="icon">
    <link href="<?php echo  base_url()?>design/fontpage/css/bootstrap.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.<?php echo  base_url()?>design/fontpage/js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="<?php echo  base_url()?>design/fontpage/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo  base_url()?>design/fontpage/css/style.css" rel="stylesheet">
    <link href="<?php echo  base_url()?>design/fontpage/css/responsive.css" rel="stylesheet">
    <link href="<?php echo  base_url()?>design/fontpage/css/animate.css" rel="stylesheet">
    <link href="<?php echo  base_url()?>design/fontpage/css/stroke-gap-icons.css" rel="stylesheet">
    <link href="<?php echo  base_url()?>design/fontpage/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo  base_url()?>design/fontpage/css/owl.theme.css" rel="stylesheet">
    <script src="<?php echo  base_url()?>design/fontpage/js/jquery.js"></script>
    <script src="<?php echo  base_url()?>design/fontpage/js/bootstrap.js"></script>
    <script src="<?php echo  base_url()?>design/fontpage/js/owl.carousel.js"></script>
    <script src="<?php echo  base_url()?>design/fontpage/js/wow.js"></script>
    <script type="text/javascript">
        $(document).ready(function(e) {

      if ($('html').hasClass('ie')) {
      $('*').hasClass('wow').removeClass('wow');
    }

                      wow = new WOW(
        {
          boxClass:     'wow',      // default
          animateClass: 'animated', // default
          offset:       200,          // default
          mobile:       true,       // default
          live:         true,        // default
          callback:     function(box) {
              console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
            }
        }
      )
      wow.init();
      if ($('html').hasClass('ie')) {
      $('*').hasClass('wow').removeClass('wow');
    }
        });
    </script>
    <script src="<?php echo  base_url()?>design/fontpage/js/function.js"></script>
    
    
</head>

<body>

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <a href="index.html" class="logo"><img alt="" src="<?php echo base_url()?>site/images//logo.png"></a>
                </div>

                <!-- end col-md-6 -->

                <div class="col-md-9 col-sm-6">
                    <div class="navigation">
                        <div class="navbar-header navbar-default">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        </div>
                        <!-- end navbar-header -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                            <ul class="nav navbar-nav navbar-right">
                                <li> <a data-toggle="modal" data-target="#guest-login-modal" href="">Sign in</a> </li>
                                <li> <a href="#how">How It Works</a> </li>
                                <li> <a href="roomate-register.html">Become a roommate</a> </li>
                                <li class="focus"> <a href="listing-register.html">List a room for free</a> </li>

                            </ul>
                        </div>
                        <!-- end collapse -->
                    </div>
                    <!-- end navigation -->
                </div>
                <!-- end col-md-9 -->
                <!-- end row -->
            </div>
        </div>
    </div>
    <!-- end header -->

    <div id="sliderCon">

        <!-- start filter -->

        <div class="container">
            <div class="tabla">
                <div class="fi-titl">
                    <h2 class="fil-title">Find the best rooms for rent in your area</h2>
                    <p>No more intermidiaries. Contact owners direcly.</p>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter your destination...">
                            <span class="input-group-addon"><i class="fa fa-search"></i> Search</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- end filter -->

    </div>




    <!-- start section 1 -->
    <div class="section-1" id="how">
        <div class="container">
            <div class="title-wrapper">

                <span class=" title">
               <h2>HOW IT <span class="orangy">WORKS</span></h2>
                <span class="line">
                    <span class="box"><i></i></span>
                </span>
                </span>
            </div>


            <div class="row">
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="fbox-icon"><i class="fa fa-search"></i></div>
                    <h3 class="padding-16">Search for the best rooms for free</h3>
                    <p>Find a room that fully corresponds to your needs. Apply filters to recieve the most accurate results.</p>
                </div>
                <!-- end this col -->
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="fbox-icon"><i class="fa fa-envelope-o"></i></div>
                    <h3 class="padding-16">Chat with potential roommates </h3>
                    <p>Use out secure platform to chat with room owners directly. Send messages to introduce yourself to your future roommate.</p>
                </div>
                <!-- end this col -->
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="fbox-icon"><i class="fa fa-suitcase"></i></div>
                    <h3 class="padding-16">Move in and feel <br> like at home</h3>
                    <p>Make a payment for the first month of rent through our safe platform, move in and relax and feel like at home.</p>
                </div>
                <!-- end this col -->
            </div>
            <div class="text-center">
                <!--<a href="" class="morea pull-right"> learn more </a>-->
                <a class="btn padding-large wide findaroomnow reverse" href="#">LEARN MORE</a>
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end section-1 -->



	<div class="section-1 text-center stripped">
        <div class="container">

            <div class="row">
                
                <!-- end this col -->
                <div class="col-md-12 wow fadeInUp" data-wow-delay="0.2s">
                 <div class="title-wrapper margin-top-large">
                 <span class="title ">
                <h2 class="text-left">OUR <span class="orangy">MISSION</span></h2>
                <span class="line">
                <span class="box"><i></i></span>
                </span>
                </span>
                 </div>

                    <h4 class="margin-bottom-large"><mark>"We are online platform #1 for those who need <br />&nbsp;to  
find a room for rent and those who are ready to share their free <br /> &nbsp;space with
adorable roommates. Unlike the oldschool methods, <br /> &nbsp;we make this process safe
and profitable, <br /> &nbsp;for both roommates and owners." </mark></h4>

                </div>
               
            </div>
            
        </div>
        <!-- end container -->
    </div>



    <!-- start section 2 -->
    <div class="section-2">
        <div class="container">
            <div class="title-wrapper">

                <span class=" title">
               <h2>EXPLORE OUR POPULAR <span class="orangy">LOCATIONS</span></h2>
                <span class="line">
                    <span class="box"><i></i></span>
                </span>
                </span>

            </div>

            <div class="features">

                <div class="row">

                    <div class="col-md-3 col-sm-3">
                        <figure class="snip1584"><img src="<?php echo base_url()?>site/images//four.jpg" alt="sample87" />
                            <figcaption>
                                <h3>NEW YORK</h3>
                            </figcaption>
                            <a href=""></a>
                        </figure>
                    </div>
                    <!-- end this col -->
                    <div class="col-md-3 col-sm-3">
                        <figure class="snip1584"><img src="<?php echo base_url()?>site/images//nine.jpg" alt="sample87" />
                            <figcaption>
                                <h3>HELSINKI</h3>
                            </figcaption>
                            <a href=""></a>
                        </figure>
                    </div>
                    <!-- end this col -->
                    <div class="col-md-3 col-sm-3">
                        <figure class="snip1584"><img src="<?php echo base_url()?>site/images//six.jpg" alt="sample87" />
                            <figcaption>
                                <h3>PRAGUE </h3>
                            </figcaption>
                            <a href=""></a>
                        </figure>
                    </div>
                    <!-- end this col -->

                    <div class="col-md-3 col-sm-3">
                        <figure class="snip1584"><img src="<?php echo base_url()?>site/images//seven.jpg" alt="sample87" />
                            <figcaption>
                                <h3>FLORENCE </h3>
                            </figcaption>
                            <a href=""></a>
                        </figure>
                    </div>
                    <!-- end this col -->
                    <div class="col-md-3 col-sm-3">
                        <figure class="snip1584"><img src="<?php echo base_url()?>site/images//rome.jpg" alt="sample87" />
                            <figcaption>
                                <h3>rome</h3>
                            </figcaption>
                            <a href=""></a>
                        </figure>
                    </div>
                    <!-- end this col -->
                    <div class="col-md-3 col-sm-3">
                        <figure class="snip1584"><img src="<?php echo base_url()?>site/images//two.jpg" alt="sample87" />
                            <figcaption>
                                <h3>Paris</h3>
                            </figcaption>
                            <a href=""></a>
                        </figure>
                    </div>
                    <!-- end this col -->
                    <div class="col-md-3 col-sm-3">
                        <figure class="snip1584"><img src="<?php echo base_url()?>site/images//three.jpg" alt="sample87" />
                            <figcaption>
                                <h3>London</h3>
                            </figcaption>
                            <a href=""></a>
                        </figure>
                    </div>
                    <!-- end this col -->
                    <div class="col-md-3 col-sm-3">
                        <figure class="snip1584"><img src="<?php echo base_url()?>site/images//one.jpg" alt="sample87" />
                            <figcaption>
                                <h3>Madrid</h3>
                            </figcaption>
                            <a href=""></a>
                        </figure>
                    </div>
                    <!-- end this col -->


                </div>
                <!-- end row -->

            </div>

            <div class="text-center">
                <!--<a href="" class="morea pull-right"> learn more </a>-->
                <a class="btn padding-large wide findaroomnow">FIND A ROOM NOW</a>
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end section-2 -->
    <!-- start section 3 -->
    <div class="parallax">
        <div class="container">
            <h2>UNLOCK THE OPPORTUNITY OF ROOM SHARING</h2>
<p><i>Share your free space whenever you want to whoever you want</i></p>          
            <div class="text-center">
                <!--<a href="" class="morea pull-right"> learn more </a>-->
                <a class="btn btnList fill" href="#">Share your room</a>
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end section-3 -->

    <!-- start section 4 -->
    <div class="section-1">
        <div class="container">
            <div class="title-wrapper">

                <span class=" title">
               <h2>GET FAMILIAR WITH <span class="orangy">Our Roommates</span></h2>
                <span class="line">
                    <span class="box"><i></i></span>
                </span>
                </span>

            </div>
            <!---->
            <div class="col-md-8 col-md-offset-2">
            <div id="owl-demo3">
                <div class="item news">
                    <div class="img-hol"><img src="<?php echo base_url()?>site/images//1.jpg" alt=""></div>
                    <h4>TOM <span>Dnipro</span></h4>
                </div>
                <div class="item news">
                    <div class="img-hol"><img src="<?php echo base_url()?>site/images//2.jpg" alt=""></div>
                    <h4>KATE <span>Kharkiv</span></h4>
                </div>
                <div class="item news">
                    <div class="img-hol"><img src="<?php echo base_url()?>site/images//3.jpg" alt=""></div>
                    <h4>JEFF <span>Lviv</span></h4>
                </div>
                <div class="item news">
                    <div class="img-hol"><img src="<?php echo base_url()?>site/images//4.jpg" alt=""></div>
                    <h4>Jil <span>Odessa</span></h4>
                </div>
                <div class="item news">
                    <div class="img-hol"><img src="<?php echo base_url()?>site/images//5.jpg" alt=""></div>
                    <h4>Maria <span>Mykolaiv</span></h4>
                </div>
            </div>
            <!-- end owl -->
                </div>



        </div>
        <!-- end container -->
    </div>
    <!-- end section-4 -->
    
    
    <!-- start section 3 -->
    <div class="section-4">
        <div class="container">
                <!--<table class="mytable">
				 <tr>
                 <td class="mytd">
                 <h4 class="newp"><span  class="label2">OUR MISSION</span>is to deliver you</h4></td>
				 <td id="demo" class="wordy"><h4 >Confidence.</h4></td>
				 </tr>
				 </table>-->
                 
                 <div class="text">
                  <p><span class="label">Our mission</span>is to deliver you</p>
                  <p>
                    <span class="word">confidence.</span></span>
                    <span class="word">safety.</span>
                    <span class="word">innovativeness.</span>
                    <span class="word">usability.</span>
                    <span class="word">convenience.</span>
                  </p>
                </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end section-3 -->
    <div class="footer">

        <div class="container">
            <div class="row">

                <div class="col-md-6"> 
                    <div class="row">

                        <div class="col-md-6">
                            <ul>
                                <li><a href="#">How it works</a></li>
                                <li><a href="about.html">About us</a></li>
                                <li><a href="roomate-register.html">Become a roommate</a></li>
								<li><a href="listing-register.html">List a property</a></li>
                            </ul>
                        </div>
                        <!---->

                        <div class="col-md-6">
                            <ul>
                                <li><a href="">Our blog</a></li>
                                <li><a href="">Privacy Policy</a> </li>
                                <li><a href="">Terms of Service</a></li>                                
                                
                                <li><a href="contact.html">Contact us</a></li>
                            </ul>
                        </div>
                        <!---->

                    </div>
                    <!---->


                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <h3><i class="fa fa-envelope"></i>SUBSCRIBE FOR OUR NEWSLETTER</h3>
                    <div class="mail-section">

                        <h3>Join our fastly growing community. Keep in touch to get news and special offers directly on your email.</h3>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter your email">
                            <span class="input-group-btn"><button class="btn btn-default" type="button">SUBSCRIBE</button></span>
                        </div>
                        <!-- /input-group -->
                    </div>
                </div>
                <!-- end col -->
            </div>
            
            <!---->




        </div>
        <!---->
        <!---->
        <div class="fabs">
            <div class="chat">
                <div class="chat_header">
                    <div class="chat_option">
                        <span id="chat_head">Contact us</span>
                        <span id="chat_fullscreen_loader" class="chat_fullscreen_loader"><i class="fa fa-envelope-open"></i></span>

                    </div>

                </div>
                <div class="chat_body chat_login">
                    <p>How can we help you?</p>
                    <div class="forma">
                    <div class="form-group">
                      <input type="text" class="form-control effect-9" placeholder="Your name">
                        <span class="focus-border"><i></i></span>
                    </div>
                        <div class="form-group">
                      <input type="email" class="form-control effect-9" placeholder="Your email adress">
                            <span class="focus-border"><i></i></span>
                    </div>
                        <div class="form-group">
                            <select class="form-control ">
                                <option>Feedback</option>
                                <option>Complaint</option>
                                <option>Inquery</option>
                            </select>
                        <span class="focus-border"><i></i></span>
                    </div>
                        <div class="form-group">
                      <textarea class="form-control effect-9" rows="5" placeholder="Enter your message.."></textarea>
                            <span class="focus-border"><i></i></span>
                    </div>
                  </div>
                </div>


                <div class="fab_field">
                    <a class="btn padding-large wide findaroomnow">Submit</a>
                </div>
            </div>
            <a id="prime" class="fab"><i class="prime fa fa-envelope-o"></i></a>
        </div>
        <!---->
    </div>

    <div class="text-center">


        <div class="social_icons">
            <a class="btn_facebook"><i class="fa fa-facebook"></i><i class="fa fa-facebook"></i></a>
            <a class="btn_twitter"><i class="fa fa-twitter"></i><i class="fa fa-twitter"></i></a>
            <a class="btn_linkedin"><i class="fa fa-linkedin"></i><i class="fa fa-linkedin"></i></a>
            <a class="btn_odnoklassniki"><i class="fa fa-odnoklassniki"></i><i class="fa fa-odnoklassniki"></i></a>
            <a class="btn_google"><i class="fa fa-google"></i><i class="fa fa-google"></i></a>
        </div>

    </div>

    <div class="footer-area">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p>Use of this website constitutes acceptance of the <a href="#"><strong>Terms of Service</strong></a> and <a href="#"><strong>Privacy Policy</strong></a>.</p>
                    <p>copyright at Brandname <span>©</span> 2017</p>
                </div>

            </div>
        </div>
    </div>



    <div aria-hidden="true" aria-labelledby="myModalLabel" class="login-modal modal fade js-no-history" id="guest-login-modal" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><button aria-hidden="true" class="close" data-dismiss="modal" type="button"></button>
                    <h3 class="text-center">Log in</h3>
                </div>
                <div class="modal-body">
                    <div class="guest">
                        <div id="guest-login-form">
                            <div class="guest-form">
                                <a class="border-button social facebook wide" href="" id="sign_in"><i class="fa fa-facebook-square"></i>Log in with Facebook</a>
                                <a class="border-button social google wide" href="" id="sign_in"><i class="fa fa-google-plus-square"></i>Log in with Google</a>
                                <div class="hr_text"><span>or</span></div>
                                <form accept-charset="UTF-8" action="/login" data-remote="true" method="post">
                                    <input class="redirect_url" id="redirect_url" name="redirect_url" type="hidden" />
                                    <input id="login_as_host" name="login_as_host" type="hidden" />
                                    <div class="form-group">
                                        <input class="form-control effect-9" id="email" name="email" placeholder="Email" type="text" />
                                        <span class="focus-border"><i></i></span>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control effect-9" id="password" name="password" placeholder="Password" type="password" />
                                        <span class="focus-border"><i></i></span>
                                    </div>
                                    <p class="password"><a href="" target="_blank">Forgot password ?</a></p>
                                    <a class="btn padding-large wide findaroomnow">Log In</a>
                                </form>
                                <div class="foote">
                                    <p>Don't have an account? <a data-guest-signup="true" href="#">Sign Up</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!---->
    <script src="<?php echo  base_url()?>design/fontpage/js/words.js"></script>


</body>

</html>