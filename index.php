<!DOCTYPE html>

<?php
    function sanitize_output($buffer) {
            $search = array(
                '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
                '/[^\S ]+\</s',     // strip whitespaces before tags, except space
                '/(\s)+/s',         // shorten multiple whitespace sequences
                '/<!--(.|\s)*?-->/' // Remove HTML comments
            );
            $replace = array(
                '>',
                '<',
                '\\1',
                ''
            );
            $buffer = preg_replace($search, $replace, $buffer);

            return $buffer;
    }

    ob_start("sanitize_output");
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--meta http-equiv="Cache-Control" content="public" /-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Закажи окна у производителя">
    <meta name="author" content="Завод Steko">
    <title>Steko | Закажи окна у производителя </title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <link rel="alternate" hreflang="x-default" href="http://online.steko.com.ua/index.php" />
    <!--link rel="icon" href="favicon.ico" type="image/x-icon" /-->
<!-- Bootstrap Core CSS -->
<style>
	/* fallback */
	@font-face {
	  font-family: 'Material Icons';
	  font-style: normal;
	  font-weight: 400;
	  src: local('Material Icons'), local('MaterialIcons-Regular'), url(https://fonts.gstatic.com/s/materialicons/v21/2fcrYFNaTjcS6g4U3t-Y5ZjZjT5FdEJ140U2DJYC3mY.woff2) format('woff2');
	}

	.material-icons {
	  font-family: 'Material Icons';
	  font-weight: normal;
	  font-style: normal;
	  font-size: 24px;
	  line-height: 1;
	  letter-spacing: normal;
	  text-transform: none;
	  display: inline-block;
	  white-space: nowrap;
	  word-wrap: normal;
	  direction: ltr;
	  -webkit-font-feature-settings: 'liga';
	  -webkit-font-smoothing: antialiased;
	}
</style>
<script src="js/jquery.js?r1"></script>

<!-- STEKO PRELOADER ANIMATION & SCRIPTS-CHANGER START -->
<!-- PRELOADER ANIMATION END -->


<!-- Custom CSS -->
<!--link rel="stylesheet" type='text/css' href="css/animate.min.css" /-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<?php include ("controller/geo/index.php"); ?>
<!--div id="loading">
	<div id="loading-center">
		<div id="loading-center-absolute">
			<div class="object" id="object_four"></div>
			<div class="object" id="object_three"></div>
			<div class="object" id="object_two"></div>
			<div style="" class="object" id="object_one">
				<img src="http://online.steko.com.ua/images/logo_SS.png" style="width: 26px;display: inline-block;position: absolute;margin-left: -13px;margin-right: -13px;right: 50%;top: 3px;" />
			</div>
		</div>
	</div>
</div-->

<!--ФОРМА ЗАМЕРА START -->
    <div class="hidden-sm" id="fixedContainer">

		<div data-toggle="tooltip" data-placement="left" title="Вызов замерщика"  class="fixed_item" id="fixed_zamer">
			<img alt="заказ замера Steko" title="вызов замерщика Steko" src="http://online.steko.com.ua/images/zamer_slide_icon.png" />
		</div>

		<div data-toggle="tooltip" data-placement="left" title="Заказ звонка"  class="fixed_item" id="fixed_call">
			<a data-toggle="modal" href="#popup_main">
				<img alt="заказ звонка Steko" src="http://online.steko.com.ua/images/phone_slide_icon.png" />
			</a>
		</div>

		<div data-toggle="tooltip" data-placement="left" title="Iнша мова"  class="fixed_item" id="fixed_lang">
			<a style="display: block; color:white;" href="http://online.steko.com.ua/ua/">UA</a>
		</div>

    </div>
<!--ФОРМА ЗАМЕРА END -->

    <div id="fixedForm" style="display: none;">
        <div class="close_form"><i class="fa fa-times" aria-hidden="true"></i></div>

        <form onSubmit="ga('send', 'event', 'form_submit', 'action', 'zamer');" id="zamer_slideform" method="POST">
            <p>Отправте заявку на замер</p>

<!--service fields -->
				<input type='hidden' class='form-control' name='type_code' value="tc_1" />
				<input type='hidden' class='form-control' name='label' value="На замер" />
<!--service fields -->

            <span class="wrap_input_user">
                <input id="zamer_name" name="field_1" class=""  placeholder="Имя">
            </span>

            <span class="wrap_input_phone_popup">
				<i class="material-icons">&#xE0B0;</i>
                <input id="zamer_tel"  name="field_2"  class=""  placeholder="Телефон">
            </span>

            <span class="wrap_input_city">
                <input id="zamer_city" name="zamer_city" class=""  placeholder="Город">
            </span>

            <button class="btn btn-block md-trigger" id="put_zamer" value="putData" name="putData" type="submit">Отправить</button>
        </form>

    </div>
<!--ФОРМА ЗАМЕРА END -->
<!--MODALS START-->
    <div id="myModal" class="modal fade">
		<div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></button>
                    <p class="text-center">Просчитай свою экономию за месяц</p>
                </div>
                <div class="modal-body">

                    <form id="ekonom_form" role="form">
                        <div class="row">
                            <div class="col-xs-6 col-md-6 col-lg-6">
                                    <label for="S" class="control-label s_label">Площадь помещения, м<sup>2</sup>: </label>
                                    <input type="text" value="45" class="calc_input form-control" id="S">
                            </div>

                            <div class="col-xs-6 col-md-6 col-lg-6">
                                    <label for="G" class="control-label gaz_label">Стоимость газа, грн/м<sup>3</sup>: </label>
                                    <input type="text" class="calc_input form-control" id="G" value="6.9">
                                    <span class="gaz_description">*Средняя стоимость газа за м<sup>3</sup></span>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                    <span>С обычными окнами<br> Вы заплатите: </span>
                                <div class="input-group">
                                    <span id="shit_windows" type="text"  ></span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6">
                                    <span>С энергосберегающими окнами Steko Вы заплатите: </span>
                                <div class="input-group">
                                    <span id="steko_windows" type="text"   ></span>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <div class="row text-center">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="bordered_ekonom">
                                <span class="ekonom_final">С окнами STEKO Вы сэкономите: </span>
                                  <span class="raznica_wrap">
                                    <span id="raznica_val"> </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<div id="popup_main" class="modal fade in" style="display:none; padding-right:0 !important;">
        <div class="modal-dialog">
                <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">        ×  </button>
				<img title="Отправь заявку и получи окна Steko"
                alt="Отправь заявку и получи окна Steko" src="images/main_form_bg.png" />
                <form onSubmit="ga('send', 'event', 'form_submit', 'action', 'popup_order');" id="popup_main_form" role="form">
                <div class="form_wrap">
				<!--service fields -->
					<input type='hidden' class='form-control' name='type_code' value="tc_1" />
					<input type='hidden' class='form-control' name='label' value="На просчет popup" />
					<input type='hidden' class='form-control' name='zamer_city' value="<?php echo $geo_city; ?>" />
				<!--service fields -->
					<span class="text-center order_text">Отправь заявку и получи  бесплатную консультацию</span>
					<i class="material-icons">&#xE7FD;</i>
						<input class="form-control num_zakaz_popup" autocomplete="off" id="num_zakaz_popup" name="field_1" placeholder="Имя"  type="text">
					<i class="material-icons">&#xE0B0;</i>
						<input class="form-control num_zakaz" id="phone_popup" type="tel" name="field_2" placeholder="Телефон"  type="phone">
					<button class="btn-block md-trigger" id="put_zakaz_popup" name="putData" value="putData" type="submit">ОТПРАВИТЬ</button>
                    </div>

                </form>

                </div>


            </div>
</div>


<div class="modal fade in" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">        ×  </button>
        <img src="" class="imagepreview" style="" >
      </div>
    </div>
  </div>
</div>

<!--MODALS END-->




    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <!--button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button-->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <!--div class="hamburger hamburger--spring">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div-->
                <div class="hamburger hamburger--collapse">
                        <div class="hamburger-box">
                          <div class="hamburger-inner"></div>
                        </div>
                </div>
            </button>
                <a title="Steko Online" class="navbar-brand page-scroll" target="_blank" href="http://steko.com.ua/">
                	<img src="images/logo_test.png" alt="Steko" title="Steko Online" />
                </a>

		<div class="tel_menu_mobile hidden-md hidden-lg hidden-sm">
			<span style="color:white;display: block;" id="zakazhi_new">Закажи окна у производителя</span>
			<a href="tel:+380500505500 " id="tel_head" style="color: white;">(050) 050-55-00</a>
		</div>

        </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <div id="hide_mobile_menu">
                <ul style="float: left !important;" class="nav navbar-nav navbar-right desktop_nav">
					<li class="hidden">
                        <a class="page-scroll" href="#landing"></a>
                    </li>
                    <li>
                        <a class="page-scroll " data-index="1" href="#">Акции</a>
                    </li>
                    <li id="hide_nav">
                        <a class="page-scroll" data-index="2" href="#"></a>
                    </li>
                    <li>
                        <a class="page-scroll" data-index="3" data-attr-scroll="economics">Экономия</a>
                    </li>

                    <li>
                        <a class="page-scroll" data-index="4" href="#">Монтаж</a>
                    </li>
                    <li id="hide_nav">
                        <a class="page-scroll" data-index="5" href="#">Про Steko</a>
                    </li>
                    <li id="hide_nav">
                        <a class="page-scroll" data-index="6" href="#">Про Steko</a>
                    </li>
                    <li id="hide_nav">
                        <a class="page-scroll" data-index="7" href="#"></a>
                    </li>
                    <li>
                        <a class="page-scroll" data-index="8" href="#">Профиль Steko</a>
                    </li>
                    <li id="hide_nav">
                        <a class="page-scroll" data-index="10" href="#"></a>
                    </li>
                    <li>
                        <a class="page-scroll" data-index="10" href="#">Фурнитура</a>
                    </li>
                    <li>
                        <a class="page-scroll" data-index="11" href="#">Отзывы</a>
                    </li>
                    <li id="hide_nav">
                        <a class="page-scroll" data-index="12" href="#"></a>
                    </li>
                    <li>
                        <a class="page-scroll" data-index="13" href="#">Контакты</a>
                    </li>
                    <li id="telephone_menu" class="hidden-xs">
                        <a class="" href="tel:+380500505500"><i class="material-icons">&#xE0B0;</i>050 050 55 00</a>
                    </li>
                    <li id="call_menu" class="">
                        <a data-toggle="modal" href="#popup_main" class="phone_menu" href="#">ЗАКАЗАТЬ ЗВОНОК</a>
                    </li>
					</ul>
					</div>
                    <div id="get_mobile_menu">
						<ul style="" class="nav navbar-nav">
							<li>
								<a class="scroll_mobile"  href="#imageGallery">Акции</a>
							</li>
							<li>
								<a class="scroll_mobile"  href="#economics_i">Экономия</a>
							</li>
							<li>
								<a class="scroll_mobile"  href="#rigger">Монтаж</a>
							</li>
							<li>
								<a class="scroll_mobile" href="#profile_steko">Профиль Steko</a>
							</li>
							<li>
								<a class="scroll_mobile" href="#footer_steko">Контакты</a>
							</li>
							<li id="telephone_menu" class="hidden-xs">
								<a class="" href="tel:+380500505500"><i class="material-icons">&#xE0B0;</i>050 050 55 00</a>
							</li>
							<li id="call_menu" class="">
								<a data-toggle="modal" href="#popup_main" class="phone_menu" href="#">ЗАКАЗАТЬ ЗВОНОК</a>
							</li>
						</ul>
					</div>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<div id="landing">
        <!-- Intro Section -->
<section id="intro" class="intro-section">
            <div class="container">
                <div style="position:relative;" class="row">
<!--ФОРМА ЗАКАЗА ДЛЯ ДЕСКТОПОВ START-->
					<div id="form_main">

                    <h1 class="mainform_title">
                        <span class="pokup_text">Покупай</span>
                        <span class="energy_text">энергосберегающие</span>
					    <img src="images/pokupay.png" class="img-responsive" />
                        <span class="dostavka_text">c доставкой и монтажом</span>
                        <span class="regional_text">по УКРАИНЕ</span>
                    </h1>

                            <div class="col-md-12">

                                <form onSubmit="ga('send', 'event', 'form_submit', 'action', 'main_order');" id="first_slide_form" method="post">
                                    <div class="form_wrap">
                                        <span class="text-center free_order">
                                            <span class="free_text">БЕСПЛАТНЫЙ</span>
                                            <span class="order_text">расчет</span>
                                        </span>

										<!--service fields -->
											<input type='hidden' class='form-control' name='type_code' value="tc_1">
											<input type='hidden' class='form-control' name='zamer_city' value="<?php echo $geo_city; ?>" />
											<input type='hidden' class='form-control' name='label' value="На просчет">
										<!--service fields -->

                                        <span class="wrap_input_user">
                                             <input class="form-control num_zakaz" id="name" name="field_1" placeholder="Имя"  type="text">
                                        </span>
                                        <span class="wrap_input_phone">
                                            <input class="form-control num_zakaz" id="phone" type="tel" name="field_2" placeholder="Телефон"  type="phone">
                                        </span>
                                        <button class="btn btn-block md-trigger" id="put_zakaz" value="putData" name="putData" type="submit">ПРОСЧИТАТЬ</button>
                                    </div>
                                </form>

                                <div class="social_form">
                                    <span style="display:block;" class="text-center">Мы в социальных сетях:</span>
                                    <a href="https://www.facebook.com/steko.okna" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="https://www.youtube.com/user/stekoua" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                                    <a href="https://vk.com/zavodsteko" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
                                    <a href="https://instagram.com/steko_windows/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                </div>

                            </div>
                    </div>
<!--ФОРМА ЗАКАЗА ДЛЯ ДЕСКТОПОВ END-->
                    <ul id="imageGallery">
                    
                      <li data-thumb="http://online.steko.com.ua/images/slider/thumb_12.jpg">
                        <img data-toggle="modal" href="#popup_main" src="http://online.steko.com.ua/images/slider/STEKO-12_920.jpg" /><span class="slider_title">Steko All Inclusive</span>
                      </li>                      
					  
					  <li data-thumb="http://online.steko.com.ua/images/slider/thumb_0.jpg">
                        <img data-toggle="modal" href="#popup_main" src="http://online.steko.com.ua/images/slider/STEKO-11_920.jpg" /><span class="slider_title">Максимальная скидка</span>
                      </li>

                      <li data-thumb="http://online.steko.com.ua/images/slider/thumb_5.jpg">
                        <img data-toggle="modal" href="#popup_main" src="http://online.steko.com.ua/images/slider/STEKO-5_920.jpg" /><span class="slider_title">Компенсация стоимсоти -35%</span>
                      </li>

                      <li data-thumb="http://online.steko.com.ua/images/slider/thumb_1.jpg">
                        <img data-toggle="modal" href="#popup_main" src="http://online.steko.com.ua/images/slider/STEKO-1_920.jpg" /><span class="slider_title">Фурнитура Steko plus</span>
                      </li>

                      <li data-thumb="http://online.steko.com.ua/images/preview_3.jpg">
                        <img data-toggle="modal" href="#popup_main" src="http://online.steko.com.ua/images/slider/STEKO-3_920.jpg" /><span class="slider_title">Double Silver Steko</span>
                      </li>

                      <li data-thumb="http://online.steko.com.ua/images/slider/thumb_10.jpg">
                        <img data-toggle="modal" href="#popup_main" src="http://online.steko.com.ua/images/slider/STEKO-10_920.jpg" /><span class="slider_title">Эко сертификат Steko</span>
                      </li>

                      <li data-thumb="http://online.steko.com.ua/images/slider/thumb_9.jpg">
                        <img data-toggle="modal" href="#popup_main" src="http://online.steko.com.ua/images/slider/STEKO-9_920.jpg" /><span class="slider_title">Народная премия</span>
                      </li>
                    </ul>

<!--MOBILE FORM START -->
	<div class="visible-xs mobile_form">
		<div class="container">
			<h1 class="mainform_title">
				<img src="images/eko_mobile_logo.png" class="img-responsive" />
				<span class="dostavka_text">c доставкой и монтажом</span>
				<span class="regional_text">по УКРАИНЕ</span>
			</h1>

				<form onSubmit="ga('send', 'event', 'form_submit', 'action', 'main_order_mobile');" id="first_mobile_form" method="post">
					<!--service fields -->
											<input type='hidden' class='form-control' name='type_code' value="tc_1" />
											<input type='hidden' class='form-control' name='label' value="На просчет mobile" />
											<input type='hidden' class='form-control' name='zamer_city' value="<?php echo $geo_city; ?>" />

					<!--service fields -->
					<div class="form_wrap">
						<span class="text-center free_order">
							<span class="free_text">БЕСПЛАТНЫЙ</span><span class="order_text">расчет</span>
						</span>
						<span class="wrap_input_user">
							 <input class="form-control num_zakaz" id="name" name="field_1" placeholder="Имя"  type="text">
						</span>
						<span class="wrap_input_phone">
							 <input class="form-control num_zakaz" id="phone"  name="field_2" type="tel" placeholder="Телефон"  type="phone">
						</span>
						<button class="btn btn-block md-trigger" id="put_zakaz" value="putData" name="putData" type="submit">ПРОСЧИТАТЬ</button>
					</div>
				</form>
		</div>
	</div>
<!--MOBILE FORM END -->

</div>

</section>

        <!-- About Section -->
        <section id="economics" data-anchor-offset="200" class="">
            <div  class="container">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 pain_img">
                            <img class="" src="images/window_water_block.png" />
                            <!--img loop="infinite" src="http://online.steko.com.ua/images/wind_gif.gif"-->
                        </div>

                        <div class="col-md-6">
                            <h2>Пришло время менять окна!</h2>
                            <ul class="water_ul">
	                            <li>Шокированы новыми коммунальными тарифами?</li>
	                            <li> Не успели утеплиться?</li>
	                            <li>Вас страшат холода?</li>
	                            <li> Хотите снизить счета за отопление или сэкономить деньги на кондиционировании? </li>
                            </ul>
							<p>
								<br>
								Воспользуйтесь нашим энергосберегающим предложением.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="economics_i" class="i_seconom">
		<!--h2 class="text-center">Расчет экономии на отоплении за счет сокращения потерь тепла</h2-->
                    <div data-toggle="modal" href="#myModal" class="ekonom_img has-ripple">
					<h2 class="text-center white_title visible-xs hidden-lg hidden-md hidden-sm">Хотите сэкономить на отоплении ?</h2>
						<div class="row">
							<!--img src="images/eko_mobile.jpg" class="hidden-md hidden-lg block_img img-responsive" /-->
							<div class="i_eco_icon">
							</div>
						</div>
					<span class="white_eco_mobile hidden-lg hidden-md hidden-sm">кликни и узнай <br> экономию с новыми окнами </span>
						<div class="ekonom_bottom">
							<div class="row">
								<div class="col-md-6 lefted">
									<div class="home_title">Стандартная квартира площадью 60 м<sup>2</sup></div>
									<div class="home_descr">(3 окна и балконный блок)</div>
									<div class="ekonom_title">Экономия за сезон</div><span class="ekonom_price">2400 грн.</span>
								</div>
								<div class="col-md-6 righted">
									<div class="home_title">Частный дом площадью 120 м<sup>2</sup></div>
									<div class="home_descr">(10 окон)</div>
									<div class="ekonom_title">Экономия за сезон</div><span class="ekonom_price">4680 грн.</span>
								</div>
							</div>
						</div>

					</div>
        </section>

        <!-- Services Section -->
        <section id="rigger" class="">
            <div class="rigger_80">
                <div class="rigger_main">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xs-12 pull-right-not-xs ">
                                <h2 class="">Монтаж</h2>
                                <p class="rigger_text">
									Качественный монтаж — залог эффективности любого окна.
									Наши монтажники — это опытные специалисты, прошедшие профильное обучение и получившие сертификаты Steko.
									<br>Они:

                                        <span class="rigger_item_text">
											Произведут точные замеры, необходимые для создания нового окна.
                                        </span>
                                        <span class="rigger_item_text">
											Осуществят грамотный и добросовестный монтаж.
                                        </span>
                                        <span class="rigger_item_text">
											Воспользуются при монтаже только проверенными расходными материалами от авторитетных производителей.
                                        </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rigger_20">
                <div class="rigger_second">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-12">
                                <h2 class="text-center">Качественный монтаж начинается с правильного замера</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 phone_number">
                                <span class="rigger_links"><!--i class="fa fa-mobile" aria-hidden="true"></i--><a class="rigger_phone" href="tel:+380500505500">+38 050 050 55 00</a></span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 zamer_number">
                                <span class="rigger_links">
									<a lang="ru" hreflang="ru" class="callback_land rigger_callback" href="#">ЗАКАЗАТЬ ЗАМЕР</a>
								</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about_steko" class="">
            <div class="banner_about">
                <!--img src="images/pochemu_steko.png" /-->
            </div>

            <div class="banner_advant container">
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <div class="service-item">
                            <img src="images/25_percent.png" title="25 процентов рынка украины" alt="25 процентов рынка украины" class="pochemu_img" />
                            <h3 class="red_title">ВСЕХ ОКОН В УКРАИНЕ</h3>
                            <p>
								В октябре 2016 года компания Steko изготовила 25% от общего числа окон, производимых в Украине.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-12">
                        <div class="service-item">
                            <img src="images/10_years.png" title="10 лет гарантии Steko" alt="10 лет гарантии Steko" class="pochemu_img" />
                            <h3 class="red_title">10 ЛЕТ ГАРАНТИИ</h3>
                            <p>
								Будучи твердо уверенными в качестве своих изделий, мы даем на них 10-летнюю гарантию.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-12">
                        <div class="service-item">
                            <img src="images/loyalnost_steko.png" title="программа лояльности Steko" alt="программа лояльности Steko" class="pochemu_img" />
                            <h3 class="red_title">ОГРОМНАЯ ТОРГОВАЯ СЕТЬ</h3>
                            <p>
								3000 — таковым было число наших дилеров в 2016 году. И с каждым днем наша торговая сеть становится все больше.
					      </p>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-12">
                        <div class="service-item">
                            <img style="max-width: 233px;height: 110px;" src="images/dostavka_steko.png" title="доставка Steko" alt="доставка Steko" class="pochemu_img" />
                            <h3 class="red_title">АДРЕСНАЯ ДОСТАВКА</h3>
                            <p>
								Бесплатная доставка с заносом в квартиру в <strong>28</strong> крупных городах Украины.
							</p>
                        </div>
                    </div>
                </div>
            </div>


           <div class="pochemu_second">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                            <h2 style="margin-bottom: 0;" class="h2_descr">Статус заказа онлайн</h2>
                            <p class="small_descr">
								Просто введите номер заказа — и узнайте, на каком этапе выполнения он находится.
                            </p>
                        </div>

<!--ФОРМА ТРЕКИНГА ЗАКАЗА START-->
                        <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                            <div class="row">
                                <div id="status_tracking">
                                    <form  id="num_zakaz_form">
                                    <div class="tracking_wrapper">
                                        <i class="fa fa-hashtag" aria-hidden="true"></i>
                                        <input class="form-control" pattern="[0-9]{6}" class="num_zakaz" id="num_zakaz" name="num_zakaz"
                                               placeholder="Введите номер заказа (6 цифр)" autocomplete="off"   style="" type="tel">
                                    </div>
                                    </form>
                                    <button class="btn btn-block md-trigger" id="put_zakaz">Узнать</button>


                                </div>
                            </div>
                        </div>
<!--ФОРМА ТРЕКИНГА ЗАКАЗА EDND-->
                    </div>
                </div>
            </div>
        </section>

<!--БЛОК ФУРНИТУРЫ ДЛЯ МОБИЛЬНЫХ УСТРОЙСТВ START -->
		<div class="furni_mobile visible-xs hidden-lg hidden-md hidden-sm">
			<h2 class="text-center blue_title">Фурнитура Steko</h2>
			<div class="">
			  <div class="bs-example">
				<div class="panel-group" id="accordion">
				  <div class="panel panel-default">
					<div class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
						  <span class="fur_icon_wrapp"><img class="furni_icons" src="http://online.steko.com.ua/images/provetr_icon.png" /></span>ПРОВЕТРИВАНИЕ</a>
					  </h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse">
					  <div class="panel-body">
						  <img src="http://online.steko.com.ua/images/pov_otkidnoe.png" class="img-responsive" />
						  <span class="furniture_title">Поворотно-откидная  створка</span>
						  <p>
							Поворотно-откидная створка: бюджетное решение, позволяющее распахнуть окно настежь или установить его на режим проветривания.
						  </p>

						  <img src="http://online.steko.com.ua/images/mikroshelevoe.png"   class="img-responsive" />
						  <span class="furniture_title">Микрощелевое  проветривание</span>
						  <p>
							Микрощелевое проветривание — специальный режим, находясь в котором замки остаются закрытыми, а створка не прижимается к раме.
						  </p>

						  <img src="http://online.steko.com.ua/images/steps_provetr.png" class="img-responsive" />
						  <span class="furniture_title">Пошаговое  проветривание</span>
						  <p>
							Позволяет регулировать интенсивность поступления свежего воздуха в помещение. Диапазон открытия ступенчатого проветривания — от 12 до 20 миллиметров.
						  </p>
							<a class="close_mobile_furni" data-toggle="" data-parent="#accordion" href="#">
								<i class="fa fa-chevron-up" aria-hidden="true"></i>
							</a>
					  </div>
					</div>
				  </div>
				  <div class="panel panel-default">
					<div style="background: #068f3d;" class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="fur_icon_wrapp"><img class="furni_icons" src="http://online.steko.com.ua/images/ruchka_icon.png" /></span>РУЧКИ</a>
					  </h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse">
					  <div class="panel-body">
						<img src="http://online.steko.com.ua/images/ruchka_white.png" class="img-responsive">
						  <span class="furniture_title">Обычная ручка</span>
						  <p>

			Качественное исполнение ручек от украинского производителя AXOR и немецкого бренда Roto обеспечивает удобную и длительную эксплуатацию данного элемента.
						  </p>

						<img src="http://online.steko.com.ua/images/ruchka_color.png" class="img-responsive">
						  <span class="furniture_title">Обычная ручка в цвете</span>
						  <p>
			Широкая цветовая палитра ручек AXOR и Roto  позволяет подобрать ручку под цвет оконного профиля.

						  </p>


						<img src="http://online.steko.com.ua/images/ruchka_zamok.png" class="img-responsive">
						  <span class="furniture_title">Ручка с замком</span>
						  <p>

			Ручка с замком позволяет одним поворотом ключа в замочной скважине полностью заблокировать работу окна, сделав открывание створки невозможным.

						  </p>
							<a class="close_mobile_furni" data-toggle="" data-parent="#accordion" href="#">
								<i class="fa fa-chevron-up" aria-hidden="true"></i>
							</a>

					  </div>
					</div>
				  </div>
				  <div class="panel panel-default">
					<div  style="    background: #057733;" class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="fur_icon_wrapp"><img class="furni_icons" src="http://online.steko.com.ua/images/security_icon.png" /></span>БЕЗОПАСНОСТЬ</a>
					  </h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse">
					  <div class="panel-body">
						<img src="http://online.steko.com.ua/images/kluch.png" class="img-responsive">
						  <span class="furniture_title">Безопасные детские замки</span>
						  <p>

						Хитрый миниатюрный девайс, который не даст малышу распахнуть окно настежь. Максимум, что ребенок сможет сделать с окном, — установить створку на проветривание
						  </p>


						<img src="http://online.steko.com.ua/images/protivozlom.png" class="img-responsive">
						  <span class="furniture_title">Противовзломная фурнитура</span>
						  <p>
						Противовзломная фурнитура в значительной мере повышает устойчивость оконной конструкции ко взлому и защищает ваш дом от проникновения извне.

						  </p>

						<img src="http://online.steko.com.ua/images/knopka_zamok.png" class="img-responsive">
						  <span class="furniture_title">Ручка с кнопкой или замком</span>
						  <p>
						Специальная система позволяет осуществить максимально точную настройку ширины открывания створки для проветривания.
						  </p>
							<a class="close_mobile_furni" data-toggle="" data-parent="#accordion" href="#">
								<i class="fa fa-chevron-up" aria-hidden="true"></i>
							</a>
					  </div>
					</div>
				  </div>
				  <div class="panel panel-default">
					<div style="    background: #035d27;" class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="fur_icon_wrapp"><img class="furni_icons" src="http://online.steko.com.ua/images/podokonnik_icon.png" /></span>ПОДОКОННИКИ</a>
					  </h4>
					</div>
					<div id="collapseFour" class="panel-collapse collapse">
					  <div class="panel-body">
					  <img src="http://online.steko.com.ua/images/podokonnik_inner.png" class="img-responsive">
									 <span class="furniture_title">Подоконники</span>
									 <p>
							   Подоконник — неотъемлемый атрибут любого окна.
							   Подоконник из пластика обладает рядом преимуществ перед своим деревянным собратом:
							 </p>

							 <ul class="water_ul">
							   <li>экологическая безопасность</li>
							   <li>эстетичный внешний вид</li>
							   <li>повышенная термостойкость</li>
							   <li>практичность и простота в уходе</li>
							   <li>широкий выбор дизайнерских решений</li>
							 </ul>

							 <p>
							   Steko предлагает покупателю подоконники от лучших национальных и
							   европейских производителей: RIF, DANKE, Plastolit, Элизиум и STANDARD.
							 </p>
							<a class="close_mobile_furni" data-toggle="" data-parent="#accordion" href="#">
								<i class="fa fa-chevron-up" aria-hidden="true"></i>
							</a>
					  </div>
					</div>
				  </div>
				  <div class="panel panel-default">
					<div style="    background: #03431d;" class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"><span class="fur_icon_wrapp"><img class="furni_icons" src="http://online.steko.com.ua/images/otkoss_icon.png" /></span>ТЕПЛЫЕ ОТКОСЫ</a>
					  </h4>
					</div>
					<div id="collapseFive" class="panel-collapse collapse">
					  <div class="panel-body">
					  <img src="http://online.steko.com.ua/images/otkos_inner.png" class="img-responsive">
						<span class="furniture_title">Теплые откосы</span>
						<p>
					  Теплые откосы — выгодная альтернатива откосам из гипсокартона и штукатурки.
					  Основные преимущества откосов из термопанелей:
					  </p>
					  <ul class="water_ul">
					  <li>привлекательный внешний вид</li>
					  <li>высокий уровень теплоизоляции</li>
					  <li>высокие показатели шумоизоляции</li>
					  <li>повышенная устойчивость перед биологическими факторами (плесень, грибок)</li>
					  <li>легкий и быстрый монтаж</li>
					  <li>простой уход</li>
					  </ul>
							<a class="close_mobile_furni" data-toggle="" data-parent="#accordion" href="#">
								<i class="fa fa-chevron-up" aria-hidden="true"></i>
							</a>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
				</div>
		</div>
<!--БЛОК ФУРНИТУРЫ ДЛЯ МОБИЛЬНЫХ УСТРОЙСТВ END -->

<!--БЛОК АССОРТИМЕНТ ТОЛЬКО ДЛЯ ДЕСКТОПОВ START -->
	<section id="assortiment" class="hidden-xs visible-md visible-lg visible-sm">
			<div class="container">
				<h2 class="text-center white_title">Ассортимент Steko</h2>
				<p class="rigger_text">Компания Steko  — это два завода в городе Днепр и один завод во Львове. Мы стремимся к расширению и шагаем в ногу со временем:  Steko  всегда в производственном тренде. Поэтому мы предлагаем своим клиентам широкий ассортимент продукции собственного производства и производства компаний, с которыми мы поддерживаем крепкие партнерские отношения.
				</p>
			</div>

			<div class="container psv_items">
				<div class="assort_wrapper">
				<div class="row">
					<div class="col-md-2 col-lg-2 col-sm-3 col-xs-6 centered">
						<div class="thumbnail">
							<a href="http://www.steko.com.ua/ru/steko/made/metalloplastikovyie-okna-steko.html" target="_blank" title="Перейти..">
								<img class="img-responsive" src="images/assort_1.jpg" >
								<p>
									Окна
								</p>
							</a>
						</div>
					</div>

					<div class="col-md-2 col-lg-2 col-sm-3 col-xs-6 centered">
						<div class="thumbnail">
							<a href="http://www.steko.com.ua/ru/steko/made/metalloplastikovyie-dveri-steko.html" target="_blank" title="Перейти..">
								<img class="img-responsive" src="images/assort_2.jpg" >
								<p>
									Двери
								</p>
							</a>
						</div>
					</div>

					<div class="col-md-2 col-lg-2 col-sm-3 col-xs-6 centered">
						<div class="thumbnail">
							<a href="http://www.steko.com.ua/ru/steko/made/razdvizhnyie-sistemyi-steko.html" target="_blank" title="Перейти..">
								<img class="img-responsive" src="images/assort_3.jpg" >
								<p>
									Раздвижные системы
								</p>
							</a>
						</div>
					</div>

					<div class="col-md-2 col-lg-2 col-sm-3 col-xs-6 centered">
						<div class="thumbnail">
							<a href="http://www.steko.com.ua/ru/steko/made/fasadnyie-konstruktsii-steko.html" target="_blank" title="Перейти..">
								<img class="img-responsive" src="images/assort_4.jpg" >
								<p>
									Алюминиевые фасады
								</p>
							</a>
						</div>
					</div>

					<div class="col-md-2 col-lg-2 col-sm-3 col-xs-6 centered">
						<div class="thumbnail">
							<a href="http://www.steko.com.ua/ru/steko/made/zaschitnyie-rolletyi-steko.html" target="_blank" title="Перейти..">
								<img class="img-responsive" src="images/assort_5.jpg" >
								<p>
									Роллеты
								</p>
							</a>
						</div>
					</div>

					<div class="col-md-2 col-lg-2 col-sm-3 col-xs-6 centered">
						<div class="thumbnail">
							<a href="http://www.steko.com.ua/ru/steko/made/sektsionnyie-raspashnyie-otkatnyie-vorota-steko.html" target="_blank" title="Перейти..">
								<img class="img-responsive" src="images/assort_6.jpg" >
								<p>
									Ворота
								</p>
							</a>
						</div>
					</div>
				</div>

				<a id="link_to_more" href="#">
					<img class="img-responsive" src="http://online.steko.com.ua/images/more_link.png" />
				</a>

				</div>
			</div>

	</section>


        <section id="steps_steko" class="">

            <div class="container">
			<h2>Как мы работаем: 3 простых шага </h2>
			<div class="steps_first">
                <div class="row centered">
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
                        <img class="steps_img" src="images/step_1.png" title="3 шага для заказа окон Steko" alt="3 шага для заказа окон Steko" />
                        <h3>1</h3>
                        <span class="steps_title text-center">Замер</span><br><span class="steps_title text-center">и просчет</span>
                        <p class="text-center">Расчет стоимости конструкции согласно сделанным замерам</p>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
                        <img class="steps_img" src="images/step_2.png" title="3 шага для заказа окон Steko" alt="3 шага для заказа окон Steko" />
                        <h3>2</h3>
                        <span class="steps_title text-center">Оплата</span> <br><span class="steps_title text-center">и производство</span>
                        <p class="text-center">Оплата конструкции и ее изготовление.</p>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                        <img class="steps_img" src="images/step_3.png" title="3 шага для заказа окон Steko" alt="3 шага для заказа окон Steko" />
                        <h3>3</h3>
                        <span class="steps_title text-center">Доставка</span> <br><span class="steps_title text-center">&nbsp; и монтаж &nbsp;</span>
                        <p class="text-center">Бесплатная доставка по Украине. Профессиональный монтаж.</p>
                    </div>
				</div>
            </div>
		</div>

				<div class="steps_second fixed_social">
					<div class="container">
							<div style="width:100%;" class="col-lg-12">
								<div class="row">
									<h2 class="text-center">Мы в социальных сетях </h2>
									<p id="head_socials">
										<a title="Steko Соцсети перейти..." href="https://www.facebook.com/steko.okna" target="_blank">
									       <i class="fa fa-facebook" aria-hidden="true"></i>
										</a>

										<a title="Steko Соцсети перейти..." href="https://www.youtube.com/user/stekoua" target="_blank">
									       <i class="fa fa-youtube" aria-hidden="true"></i>
										</a>

										<a title="Steko Соцсети перейти..." href="https://vk.com/zavodsteko" target="_blank">
									       <i class="fa fa-vk" aria-hidden="true"></i>
										</a>

										<a title="Steko Соцсети перейти..." href="https://instagram.com/steko_windows/" target="_blank">
									       <i class="fa fa-instagram" aria-hidden="true"></i>
										</a>
									</p>
							</div>
						</div>
					</div>
                </div>
        </section>

        <!--section id="calculator" class="wolverine">
            <div class="section_wrap">
                <div class="row row_fixed">
                    <div class="media col-xs-12">
                      <div class="media-body media-middle">
                        <div class="container-half">
                            <p class="calc_title">
								Подобрать окно и мгновенно узнать о его стоимости и ценности поможет наш инновационный продукт —
								<strong>Steko Calculator</strong>
                            </p>
                            <hr class="col-md-8 col-xs-8" style="background:white;color:white;height: 2px;">
                            <a href="http://steko.com.ua/calculator/" target="_blank" id="calc_init" class="">
                            <img loop=infinite src="http://online.steko.com.ua/images/calcu_icon.gif" /></a>
                        </div>
                    </div>

                    <div class="media-right media-middle">
                       <div class="media-object video_wrapper">
                         <video class="fillWidth" height="inherit" autoplay="autoplay"  loop="loop">
				<source src="images/calc_movie.webm" type='video/webm; codecs="vp8, vorbis"'>
                         </video>
                    </div>  </div>
                    </div>

                </div>
            </div>
        </section-->
<!--picture>
    <source srcset="smaller_landscape.jpg" media="(max-width: 40em) and (orientation: landscape)">
    <source srcset="smaller_portrait.jpg" media="(max-width: 40em) and (orientation: portrait)">
    <source srcset="default_landscape.jpg" media="(min-width: 40em) and (orientation: landscape)">
    <source srcset="default_portrait.jpg" media="(min-width: 40em) and (orientation: portrait)">
    <img srcset="default_landscape.jpg" alt="My default image">
</picture-->

        <section id="profile_steko" class="">
            <div class="container">
                <div class="row">
                <h2 class="text-center blue_title">Профильные системы Steko</h2>
                <p class="text-center">
					Профиль — главный элемент любого окна. От него зависит качество и долговечность металлопластиковой конструкции. На первый взгляд кажется, что все профили одинаковы, но это не так. Профили Steko производятся из украинского и европейского сырья. Они экологически безопасны и долговечны. Не желтеют и не лопаются с течением времени.
                </p>
                <div class="cd-pricing-container cd-has-margins">
                        <div class="cd-pricing-switcher">
                            <p class="fieldset">
                                <input type="radio" name="duration-2" value="monthly" id="monthly-2" checked="">
                                <label for="monthly-2">Украина</label>
                                <input type="radio" name="duration-2" value="yearly" id="yearly-2">
                                <label for="yearly-2">Европа</label>
                                <span class="cd-switch"></span>
                            </p>
                        </div> <!-- .cd-pricing-switcher -->

                        <ul class="cd-pricing-list cd-bounce-invert">
                            <li class="price_li">
                                <ul class="cd-pricing-wrapper">
                                    <li data-type="monthly" class="is-ended is-visible">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/S400.png" title="Steko S400 Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>

                                    <li data-type="yearly" class="is-ended is-hidden">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/R300.png" title="Steko R300 Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>
                                </ul> <!-- .cd-pricing-wrapper -->
                            </li>

                            <li class="cd-popular price_li">
                                <ul class="cd-pricing-wrapper">
                                    <li data-type="monthly" class="is-ended is-visible">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/S500.png" title="Steko S500 Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>

                                    <li data-type="yearly" class="is-ended is-hidden">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/R500.png" title="Steko R500 Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>
                                </ul> <!-- .cd-pricing-wrapper -->
                            </li>

                            <li class="price_li">
                                <ul class="cd-pricing-wrapper">
                                    <li data-type="monthly" class="is-ended is-visible">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/innovation.png" title="Steko innovation Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>

                                    <li data-type="yearly" class="is-ended is-hidden">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/R600.png" title="Steko R600 Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>
                                </ul> <!-- .cd-pricing-wrapper -->
                            </li>

                            <li class="price_li">
                                <ul class="cd-pricing-wrapper">
                                    <!--li data-type="monthly" class="is-ended is-visible">
                                        <div class="cd-pricing-body">
                                            <img src="images/innovation.png" title="Steko innovation Профиль" />
                                        </div>

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>
                                    </li-->

                                    <li data-type="yearly" class="is-ended is-hidden">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/R700.png" title="Steko R700 Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>
                                </ul> <!-- .cd-pricing-wrapper -->
                            </li>
                        </ul> <!-- .cd-pricing-list -->
                    </div>
                </div>
            </div>
        </section>

        <section id="steklopaket_steko" class="">
            <div class="container">
                <div class="row">
                <h2 class="text-center blue_title">Стеклопакеты Steko</h2>
                <p class="text-center">
                Двухкамерные <strong>стеклопакеты Steko</strong> — это конструкция из трёх высококачественных стекол с серебряным напылением. Заключенные в дистанционную рамку итальянского производства такие стеклопакеты препятствуют утечке тепла и заметно сокращают ваши расходы на отопление.
                </p>
                <div class="cd-pricing-container cd-has-margins">
                        <div class="cd-pricing-switcher">
                            <p class="fieldset">
                                <input type="radio" name="duration-2" value="monthly2" id="monthly-22" checked="">
                                <label for="monthly-22">1 камера</label>
                                <input type="radio" name="duration-2" value="yearly2" id="yearly-22">
                                <label for="yearly-22">2 камеры</label>
                                <span class="cd-switch"></span>
                            </p>
                        </div> <!-- .cd-pricing-switcher -->

                        <ul class="cd-pricing-list cd-bounce-invert">
                            <li>
                                <ul class="cd-pricing-wrapper">
                                    <li data-type="monthly2" class="is-ended is-visible">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/ds-1.png" title="Steko S400 Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>

                                    <li data-type="yearly2" class="is-ended is-hidden">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/ds.png" title="Steko R300 Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>
                                </ul> <!-- .cd-pricing-wrapper -->
                            </li>

                            <li class="cd-popular">
                                <ul class="cd-pricing-wrapper">
                                    <li data-type="monthly2" class="is-ended is-visible">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/i-1.png" title="Steko S500 Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>

                                    <li data-type="yearly2" class="is-ended is-hidden">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/i.png" title="Steko R500 Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>
                                </ul> <!-- .cd-pricing-wrapper -->
                            </li>

                            <li>
                                <ul class="cd-pricing-wrapper">
                                    <li data-type="monthly2" class="is-ended is-visible">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/argon-1.png" title="Steko innovation Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>

                                    <li data-type="yearly2" class="is-ended is-hidden">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/ar.png" title="Steko R700 Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>
                                </ul> <!-- .cd-pricing-wrapper -->
                            </li>
                            <li>
                                <ul class="cd-pricing-wrapper">
                                    <li style="background: #a4a6a7;" data-type="monthly2" class="is-ended is-visible">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/flat-1.png" title="Steko innovation Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>

                                    <li style="background: #a4a6a7;" data-type="yearly2" class="is-ended is-hidden">
                                        <div data-toggle="modal" href="#popup_main" class="cd-pricing-body">
                                            <img class="img_click" src="images/ct.png" title="Steko R700 Профиль" />
                                        </div> <!-- .cd-pricing-body -->

                                        <footer class="cd-pricing-footer">
                                            <a class="cd-select" data-toggle="modal" href="#popup_main">Подробнее</a>
                                        </footer>  <!-- .cd-pricing-footer -->
                                    </li>
                                </ul> <!-- .cd-pricing-wrapper -->
                            </li>
                        </ul> <!-- .cd-pricing-list -->
                    </div>
                </div>
            </div>
        </section>

<section id="furniture">
    <h2 class="text-center blue_title">Фурнитура Steko</h2>
    <div class="furni_wrap">
	    <div class="container">
                <div class="furniture_start">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 no-padding">
                        <div class="furniture start_list">
                            <ul class="furniture_nav">
                                <li class="furniture_wind"><a> ПРОВЕТРИВАНИЕ</a></li>
                                <li class="furniture_ruchki"><a>РУЧКИ</a></li>
                                <li class="furniture_security"><a>БЕЗОПАСНОСТЬ</a></li>
                                <li class="furniture_sill"><a>ПОДОКОННИКИ</a></li>
                                <li class="furniture_otkos"><a>ТЕПЛЫЕ ОТКОСЫ</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="image_start">
                        <img src="images/window_main.png" class="img-responsive" />
                        <div id="" class="i_furn furniture_wind"><i class="fa fa-info"></i></div>
                        <div id="" class="i_furn furniture_ruchki"><i class="fa fa-info"></i></div>
                        <div id="" class="i_furn furniture_security"><i class="fa fa-info"></i></div>
                        <div id="" class="i_furn furniture_sill"><i class="fa fa-info"></i></div>
                        <div id="" class="i_furn furniture_otkos"><i class="fa fa-info"></i></div>
                    </div>
                </div>

                <div id="inner_furniture_blocks" class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
<!--ПРОВЕТРИВАНИЕ START -->
                    <div id="furniture_wind_inner" style="display:none;" class="single_content">
                        <div data-img="http://online.steko.com.ua/images/pov_otkidnoe.png" class="single_item">
                            <span class="furniture_title">Поворотно-откидная  створка</span>
                            <p>
								Поворотно-откидная створка: бюджетное решение, позволяющее распахнуть окно настежь или установить его на режим проветривания.
                            </p>
                        </div>

                        <div data-img="http://online.steko.com.ua/images/mikroshelevoe.png"   class="single_item">
                            <span class="furniture_title">Микрощелевое  проветривание</span>
                            <p>
								Микрощелевое проветривание — специальный режим, находясь в котором замки остаются закрытыми, а створка не прижимается к раме.
                            </p>
                        </div>

                        <div data-img="http://online.steko.com.ua/images/steps_provetr.png" class="single_item">
                            <span class="furniture_title">Пошаговое  проветривание</span>
                            <p>
								Позволяет регулировать интенсивность поступления свежего воздуха в помещение. Диапазон открытия ступенчатого проветривания — от 12 до 20 миллиметров.
                            </p>
                        </div>
                    </div>
<!--ПРОВЕТРИВАНИЕ END -->


<!--РУЧКИ START -->
                <div id="furniture_ruchki_inner" style="display:none;" class="single_content">
                        <div data-img="http://online.steko.com.ua/images/ruchka_white.png" class="single_item">
                            <span class="furniture_title">Обычная ручка</span>
                            <p>

Качественное исполнение ручек от украинского производителя AXOR и немецкого бренда Roto обеспечивает удобную и длительную эксплуатацию данного элемента.
                            </p>
                        </div>

                        <div data-img="http://online.steko.com.ua/images/ruchka_color.png" class="single_item">
                            <span class="furniture_title">Обычная ручка в цвете</span>
                            <p>
Широкая цветовая палитра ручек AXOR и Roto  позволяет подобрать ручку под цвет оконного профиля.

                            </p>
                        </div>

                        <div data-img="http://online.steko.com.ua/images/ruchka_zamok.png" class="single_item">
                            <span class="furniture_title">Ручка с замком</span>
                            <p>

Ручка с замком позволяет одним поворотом ключа в замочной скважине полностью заблокировать работу окна, сделав открывание створки невозможным.

                            </p>
                        </div>
                </div>

<!--РУЧКИ END -->




<!--БЕЗОПАСНОСТЬ START -->
                <div id="furniture_security_inner" style="display:none;" class="single_content">
                        <div data-img="http://online.steko.com.ua/images/kluch.png" class="single_item">
                            <span class="furniture_title">Безопасные детские замки</span>
                            <p>

Хитрый миниатюрный девайс, который не даст малышу распахнуть окно настежь. Максимум, что ребенок сможет сделать с окном, — установить створку на проветривание
                            </p>
                        </div>

                        <div data-img="http://online.steko.com.ua/images/protivozlom.png" class="single_item">
                            <span class="furniture_title">Противовзломная фурнитура</span>
                            <p>
Противовзломная фурнитура в значительной мере повышает устойчивость оконной конструкции ко взлому и защищает ваш дом от проникновения извне.

                            </p>
                        </div>
                        <div data-img="http://online.steko.com.ua/images/knopka_zamok.png" class="single_item">
                            <span class="furniture_title">Ручка с кнопкой или замком</span>
                            <p>
Специальная система позволяет осуществить максимально точную настройку ширины открывания створки для проветривания.
                            </p>
                        </div>
                </div>

<!--БЕЗОПАСНОСТЬ END -->

<!--ПОДОКОННИКИ START -->
                <div id="furniture_sill_inner" style="display:none;" class="single_content">
                        <div data-img="http://online.steko.com.ua/images/podokonnik_inner.png" class="single_item">
                            <span class="furniture_title">Подоконники</span>
                            <p>
								Подоконник — неотъемлемый атрибут любого окна.
								Подоконник из пластика обладает рядом преимуществ перед своим деревянным собратом:
							</p>

							<ul class="water_ul">
								<li>экологическая безопасность</li>
								<li>эстетичный внешний вид</li>
								<li>повышенная термостойкость</li>
								<li>практичность и простота в уходе</li>
								<li>широкий выбор дизайнерских решений</li>
							</ul>

							<p>
								Steko предлагает покупателю подоконники от лучших национальных и
								европейских производителей: RIF, DANKE, Plastolit, Элизиум и STANDARD.
							</p>
                        </div>
                </div>

<!--ПОДОКОННИКИ END -->

<!--ОТКОСЫ START -->
                <div id="furniture_otkos_inner" style="display:none;" class="single_content">
                        <div data-img="http://online.steko.com.ua/images/otkos_inner.png" class="single_item">
                            <span class="furniture_title">Теплые откосы</span>
                            <p>
								Теплые откосы — выгодная альтернатива откосам из гипсокартона и штукатурки.
								Основные преимущества откосов из термопанелей:
							</p>
								<ul class="water_ul">
									<li>привлекательный внешний вид</li>
									<li>высокий уровень теплоизоляции</li>
									<li>высокие показатели шумоизоляции</li>
									<li>повышенная устойчивость перед биологическими факторами (плесень, грибок)</li>
									<li>легкий и быстрый монтаж</li>
									<li>простой уход</li>
								</ul>
                        </div>
                </div>

<!--ОТКОСЫ END -->
    </div>

                <div id="image_furnitures" class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <div class="row">
                    <div id="single_img" > </div>
                    </div>
                </div>

                <div id="image_small" style="" >
					<img  src="http://online.steko.com.ua/images/window_small.png" alt="Комплектующие Steko" />
				</div>

    </div>
</section>

<section id="testimonials_steko" class="unicorn">
    <div class="container">
        <h2 class="text-center blue_title">Отзывы клиентов Steko</h2>
            <div class="row">
            <div class="feedb_wrap">
	            <div class="gallery_feedb">
		              <ul>
		                <li><img src="http://online.steko.com.ua/images/feedback_steko_1.png" alt="Отзыв клиента Steko окна" title="Отзыв клиента Steko окна" /></li>
		                <li><img src="http://online.steko.com.ua/images/feedback_steko_2.png" alt="Отзыв клиента Steko окна" title="Отзыв клиента Steko окна" /></li>
		                <li><img src="http://online.steko.com.ua/images/feedback_steko_3.png" alt="Отзыв клиента Steko окна" title="Отзыв клиента Steko окна" /></li>
		                <li><img src="http://online.steko.com.ua/images/feedback_steko_4.png" alt="Отзыв клиента Steko окна" title="Отзыв клиента Steko окна" /></li>
		                <li><img src="http://online.steko.com.ua/images/feedback_steko_5.png" alt="Отзыв клиента Steko окна" title="Отзыв клиента Steko окна" /></li>
		                <li><img src="http://online.steko.com.ua/images/feedback_steko_6.png" alt="Отзыв клиента Steko окна" title="Отзыв клиента Steko окна" /></li>
		              </ul>
	            </div>            
	          </div>            
            </div>

				<div class="feedback_wrapper">            
		            <div class="col-md-12 feed_form">
		            	<h3 class="feedback_title">Оставте свой отзыв</h3>
					            	<div class="feadback_user">
					            		<form onSubmit="ga('send', 'event', 'form_submit', 'action', 'feedback');" method="POST" id="feedback_form">
											<div class="col-md-6 col-lg-6 col-xs-12 ">
												<div class="form_elements">
												<input class="form-control"  id="name_feedback" name="name_feedback" placeholder="Имя"  type="text" />
												<input class="form-control"  id="phone_feedback" type="tel" name="phone_feedback" placeholder="Телефон"
													 type="text" />
													<button class="btn-block" id="feedback_btn" name="feedback_btn" type="submit">ОТПРАВИТЬ</button>
												</div>
											</div>

											<div class="col-md-6 col-lg-6 col-xs-12 ">
												<div class="row">
										<textarea name="comment_feedback" class="form-control" placeholder="Отзыв" rows="6" id="comment_feedback"></textarea>
												</div>
											</div>
										</form>
					            	</div>
		            </div>
				</div>
    </div>
</section>


<section id="furnutura_old" class="">
<h2 class="text-center blue_title">Комплектующие Steko</h2>
<div id="furnutura_old_block" class="col-md-12 col-lg-12" style="text-align: center;">
<div class="container">

    <div id="myCarousel" class="carousel slide" data-ride="carousel">

      <!-- Wrapper for slides -->
      <div class="carousel-inner">

        <div class="item active">
			<div class="col-md-6 text_side">
				<div class="komplekts_text">
					<h3>Средства по уходу за окнами</h3>
					<p>
					После замены старых окон на новые пластиковые важно помнить о необходимости ухода за оконными конструкциями.
					<br> Steko предлагает своим клиентам эксклюзивную линию средств по уходу за окнами, в которую входят:
					средство по уходу за профилем,
					средство по уходу за уплотнителем,
					средство по уходу за фурнитурой.
					Использование таких средств  продлит жизнь оконной фурнитуре и пролонгирует срок службы оконной конструкции.
					</p>
				</div>
			</div>

			<div class="col-md-6">
			          <img src="images/1_test.jpg">
			</div>
        </div><!-- End Item -->

         <div class="item">
			<div class="col-md-6 text_side">
				<div class="komplekts_text">
					<h3>Ламинация</h3>
					<p>
					Любите яркие краски и сочные цвета?<br> Хотите, чтобы ваши окна отличались и выделялись на фоне остальных? <br>
					В нашем ассортименте более 20 цветов ламинации! <br>
					Профиль, на который наносится ламинация, может быть классическим белым или коричневым “в массе”.
					</p>
				</div>
			</div>

			<div class="col-md-6">
			          <img src="images/3_test.jpg">
			</div>
		</div><!-- End Item -->


         <div class="item">
			<div class="col-md-6 text_side">
				<div class="komplekts_text">
					<h3>Роллеты</h3>
					<p>
					Главная функция роллет — защитная. <br> В ваше отсутствие роллеты обеспечивают безопасность отдельных помещений, сохраняют ваше имущество,
					защищают целостность окон вашего дома или офиса от случайно брошенных бутылок или камней, а также препятствуют проникновению злоумышленников.
					</p>
				</div>
			</div>

			<div class="col-md-6">
			          <img src="images/2_test.jpg">
			</div>
		</div><!-- End Item -->

         <div class="item">
			<div class="col-md-6 text_side">
				<div class="komplekts_text">
					<h3>Отливы</h3>
					<p>
					Отлив — это подоконник, расположенный с внешней стороны окна. <br>
					Его основная задача — защищать стену от влаги путем отвода воды. <br>
					Оцинкованные металлические отливы могут иметь практически любой цвет и даже повторять структуру дерева.
					</p>
				</div>
			</div>

			<div class="col-md-6">
			          <img src="images/otliv_kmplkt.jpg">
			</div>
		</div><!-- End Item -->

		<div class="item">
			<div class="col-md-6 text_side">
				<div class="komplekts_text">
					<h3>Москитные сетки</h3>
					<p>
						Москитная сетка — самый экономичный безвредный и эффективный способ борьбы с насекомыми и другими природными раздражителями (пыль, пыльца, тополиный пух).
					</p>
				</div>
			</div>

			<div class="col-md-6">
			          <img src="images/mosquito.jpg">
			</div>
		</div><!-- End Item -->



      </div><!-- End Carousel Inner -->


    <ul class="list-group col-sm-1 col-xs-2">
      <li data-target="#myCarousel" data-slide-to="0" class="list-group-item active"><img class="komplekts_icons" src="images/sredstva_icon.png" /><h4>средства</h4>
      </li>
      <li data-target="#myCarousel" data-slide-to="1" class="list-group-item"><img class="komplekts_icons" src="images/lamination_icon.png"/><h4>ламинация</h4></li>
      <li data-target="#myCarousel" data-slide-to="2" class="list-group-item"><img class="komplekts_icons" src="images/rolleti_icon.png" /><h4>ролеты</h4></li>
      <li data-target="#myCarousel" data-slide-to="3" class="list-group-item"><img class="komplekts_icons" src="images/steklos_icon.png" /><h4>отливы</h4></li>
      <li data-target="#myCarousel" data-slide-to="4" class="list-group-item"><img class="komplekts_icons" src="images/furnitura_icons.png" /><h4>москитка</h4></li>
    </ul>

      <!-- Controls -->
      <div class="carousel-controls">
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
      </div>

    </div><!-- End Carousel -->

<h2 class="poluchite_text_form text-center blue_title" style="font-size: 23px;color: #203f49; margin-bottom:0; " >Получите бесплатную консультацию</h2>
<div class="form_kompl_wrapper">

	<form onSubmit="ga('send', 'event', 'form_submit', 'action', 'consult');" id="komplekts_form" class="form-horizontal" method="POST">
	<!--service fields -->
					<input type='hidden' class='form-control' name='type_code' value="tc_1" />
					<input type='hidden' class='form-control' name='label' value="Получите консультацию" />
					<input type='hidden' class='form-control' name='zamer_city' value="<?php echo $geo_city; ?>" />

	<!--service fields -->
		<fieldset>
		<div class="row">
		  <div class="col-md-6 col-xs-12">
			<i class="material-icons">&#xE7FD;</i>
				<input class="form-control kompl_name" id="kompl_name" name="field_1" placeholder="Имя"  type="text">
			</div>
		  <div class="col-md-6 col-xs-12">
			<i class="material-icons">&#xE0B0;</i>
				<input class="form-control kompl_tel" id="kompl_tel" name="field_2" placeholder="Телефон"  type="text">
		  </div>
		</div>
		  <button class="btn-block md-trigger" id="put_zakaz_kompl" value="putData" name="putData" type="submit">ПОЛУЧИТЬ</button>
		</fieldset>
	</form>

</div>
</div>

</div>

</section>


<section id="footer_steko" class="">
<!--img class="footer_test" src="images/footer_fast.jpg" /-->
    <div class="container">
        <div class="row">
            <div class="col-md-4  text-center">
                <span class="footer_text">г.Днепр ул. Артельная, 11 </span>
            </div>
            <div class="col-md-4 text-center">
                <span class="footer_text footer_center">Наши контакты</span>
            </div>
            <div class="col-md-4 text-center">
                <span class="footer_text">+38 050 050 55 00 <br> <a style="color:white;" title="Отправить письмо" href="mailto:om9@stekomail.com">om9@stekomail.com</a></span>
            </div>
        </div>
    </div>

          <div class="footer_form_wrapper">

            <div class="footer_form">
            <h3 class="feedback_title">Остались вопросы? Свяжитесь с нами</h3>
            <hr/>
            <span class="footer_form_text">Закажите обратный звонок и мы свяжемся с Вами в ближайшее время</span>
                <form onSubmit="ga('send', 'event', 'form_submit', 'action', 'footer_order');" id="footer_contact_form">
<!--service fields -->
						<input type='hidden' class='form-control' name='type_code' value="tc_1" />
						<input type='hidden' class='form-control' name='label' value="Звонок футер" />
						<input type='hidden' class='form-control' name='zamer_city' value="<?php echo $geo_city; ?>" />

<!--service fields -->
                    <div class="form_elements">
                    <i class="material-icons">&#xE7FD;</i>
						<input class="form-control"  id="footer_name" autocomplete="name" name="field_1" placeholder="Имя"  type="text" />
                    <i class="material-icons">&#xE0B0;</i>
						<input class="form-control"  id="footer_phone" autocomplete="tel" name="field_2" placeholder="Телефон"  type="text" />
						<button class="btn-block" id="feedback_footer_btn" name="putData" value="putData" type="submit">ЗАКАЗАТЬ</button>
                    </div>

                </form>
            </div>

          </div>

        <div id="google_map"></div>

		<div class="steps_second visible-xs hidden-lg hidden-md hidden-sm">
					<div class="container">
							<div style="width:100%;" class="col-lg-12">
								<div class="row">
									<h2 class="text-center">Мы в социальных сетях </h2>
									<p id="head_socials">
										<a title="Steko Соцсети перейти..." href="https://www.facebook.com/steko.okna" target="_blank">
									       <i class="fa fa-facebook" aria-hidden="true"></i>
										</a>

										<a title="Steko Соцсети перейти..." href="https://www.youtube.com/user/stekoua" target="_blank">
									       <i class="fa fa-youtube" aria-hidden="true"></i>
										</a>

										<a title="Steko Соцсети перейти..." href="https://vk.com/zavodsteko" target="_blank">
									       <i class="fa fa-vk" aria-hidden="true"></i>
										</a>

										<a title="Steko Соцсети перейти..." href="https://instagram.com/steko_windows/" target="_blank">
									       <i class="fa fa-instagram" aria-hidden="true"></i>
										</a>
									</p>
							</div>
						</div>
					</div>
        </div>


	<div class="container">
	        <div class="row">
	        <img class="img-responsive steko_footer" alt="Steko логотип" src="images/steko_logotip.png" />
	            <div class="col-md-6  text-center">
					<div class="footer_text_bottom">
						<i class="fa fa-map-marker" aria-hidden="true"></i>
						<span class="wrapper_footer">
							<span class="city_name">г.Днепр:</span>
							ул. Артельная, 11
						</span>
					</div>
					<div class="footer_text_bottom">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
						<span class="wrapper_footer">
							<span class="city_name">г.Львов:</span>
							пгт.Надычи
						</span>
					</div>
	            </div>

	            <div class="col-md-6  text-center">
				<div class="footer_text_bottom">
					<span class="footer_phone">
						<i class="material-icons">&#xE0B0;</i>
						<span class="footer_number">+38 050 050 55 00</span>
					</span>
				</div>

					<span class="footer_site text-center">
						<i class="fa fa-link" aria-hidden="true"></i>
						<span class="footer_sitelink">
							<a href="http://steko.com.ua" title="Перейти на сайт Steko" target="_blank">www.steko.com.ua</a>
						</span>
                      	<div class="social-icon">
							<a href="https://www.facebook.com/steko.okna" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
							<a href="https://www.youtube.com/user/stekoua" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
							<a href="https://vk.com/zavodsteko" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
							<a href="https://instagram.com/steko_windows/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </div>
					</span>
	            </div>

	        </div>
	    </div>
</section>

<link type="text/css" rel="stylesheet" href="css/lightslider.min.css?r1" />
<link href="css/hamburgers.min.css?r1" rel="stylesheet" type='text/css'>
<link href="css/bootstrap.min.css?r1" rel="stylesheet">
<link href='css/custom.css?r1' rel='stylesheet' type='text/css' />
<link href='css/media_queries.css?r1' rel='stylesheet' type='text/css'>
<!---JScripts includes START -->
	<link rel='stylesheet prefetch' href='css/component.css' />
	<link href="css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
	<!--link href="css/scrolling-nav.css" rel="stylesheet"-->
	<link href="css/font-awesome.min.css?r1" media="all" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css?r1">
        <script src="js/modernizr.js?r1"></script>
        <script src="js/bootstrap.min.js?r1"></script>
        <!--script src="js/jquery.easing.min.js"></script-->
        <script src="js/jquery.maskedinput.min.js?r1"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDWT9s7dLQ3tOfThgj-xlYbwjmGn4Lwrg"></script>
        <script src="js/lightslider.min.js?r1"></script>
        <!--script src="js/jquery.onepage-scroll.min.js"></script-->
	    <script src="js/sweetalert.min.js?r1"></script>
        <script src="js/index.js?r1"></script>
<!---JScripts includes END  -->
<!---ANALYTICS script includes START-->
<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-45617472-3', 'auto');
			ga('send', 'pageview');
</script>

<script type="text/javascript">
			(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
			try {
			w.yaCounter42101314 = new Ya.Metrika({
			id:42101314,
			clickmap:true,
			trackLinks:true,
			accurateTrackBounce:true,
			webvisor:true
			});
			} catch(e) { }
			});

				var n = d.getElementsByTagName("script")[0],
					s = d.createElement("script"),
					f = function () { n.parentNode.insertBefore(s, n); };
				s.type = "text/javascript";
				s.async = true;
				s.src = "http://online.steko.com.ua/js/watch_download.js";

				if (w.opera == "[object Opera]") {
					d.addEventListener("DOMContentLoaded", f, false);
				} else { f(); }
			})(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
			<div><img src="https://mc.yandex.ru/watch/42101314" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>

<!--Facebook Pixel Code -->
<script>
				!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
				n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
				n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
				t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
				document,'script','http://online.steko.com.ua/js/fbevents_download.js?r1');
				fbq('init', '1687585528153456'); // Insert your pixel ID here.
				fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1687585528153456&ev=PageView&noscript=1"/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
<!---ANALYTICS script includes END-->
<script type="text/javascript">
document.getElementById('feedback_form').addEventListener('submit', function(evt)
    {
      var http = new XMLHttpRequest(), f = this;
      evt.preventDefault();
      if (f.name_feedback.value == '' || f.name_feedback.value == f.defaultValue || f.phone_feedback.value =='' || f.phone_feedback.value == f.defaultValue)
          {
            alert("Данные не были переданы!", "Пожалуйста, Заполните все поля !", "error");
          }
      else
          {
             
            http.open("POST", "http://online.steko.com.ua/controller/feedback_form.php", true);
            http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            http.send("feedName=" + f.name_feedback.value + "&feedPhone=" + f.phone_feedback.value + "&feedMsg=" + f.comment_feedback.value);
            http.onreadystatechange = function() 
            {
                if (http.readyState == 4 && http.status == 200) 
                    {
                          swal("Спасибо за оставленный отзыв!", "Вы помогаете нам становиться ещё лучше!", "success");
                          f.name_feedback.value='';
                          f.phone_feedback.value='';
                          f.comment_feedback.value='';
                            /*
                              $("#fixedForm").hide("slow");
                              $(".call_conv").removeClass("activated");
                              $("#fixedSuccess").show("slow");
                              $('#myModalHorizontal').modal('hide');
                              $('.modal-backdrop').hide();
                            */                        
                    }
            }
            http.onerror = function() {
                alert('Извините, данные не были переданы');
            }
          }
    }, false);    
</script>

<link rel="stylesheet" href="css/jquery.flipster.min.css">
<script src="js/jquery.flipster.min.js"></script>


<script type="text/javascript">
$(document).ready(function() {

/*---TESTIMONIALS 3D START---*/
	$(".gallery_feedb").flipster({
	            itemContainer: "ul",
	            itemSelector: "li",
	            style: "carousel",
	            loop: true,
	            spacing: -0.5,
	            scrollwheel: false, 
	            autoplay: 6000,
	            pauseOnHover: true,                       
	            touch: true,                        
	            buttons: true,            
	            start: "center",
	});
/*---TESTIMONIALS 3D END---*/

});      
</script>

</body>
</html>html>