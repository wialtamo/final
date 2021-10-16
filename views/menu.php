<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="../css/menu.css">
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script><script  src="../js/menu.js"></script>
  <link rel="icon" href="../img/favicon.png">
</head>
<body>

<!-- partial:index.partial.html -->
<header>
	<section id="desktop-menu" class="desktop-menu">
		<nav class="sidebar flex-column-nowrap">
			<a class="sidebar__logo" href="#">
				<abbr class="logo">SII</abbr>
			</a>
			<ul class="sidebar__nav-list flex-column-nowrap" role="menubar" aria-label="Main desktop menu">
			<li class="nav-list__item skills fake-button flex-column-nowrap" role="menuitem">
					<a class="flex-row-wrap" href="cotizacion.php" tabindex="0">
            <img src="../img/delivery.svg" height="38.095242" width="40" alt="Cotizador">
						<span class="u-uppercase">Cotizador</span>
					</a>
				</li>
				<li class="nav-list__item my-work fake-button flex-column-nowrap" role="menuitem">
					<a class="flex-row-wrap" href="cobert.php" tabindex="0">
						<img src="../img/seguro.svg" height="38.095242" width="40" alt="Coberturas">
						<span class="u-uppercase">Coberturas</span>
					</a>
				</li>
        <?php
            include '../models/config.php';
            $id=$_SESSION['id_usuario'];

            $sql= $link->query("SELECT perfil FROM usuarios WHERE idusuario='$id'");
            while($row4=mysqli_fetch_array($sql))
            {
              $perfil=$row4['perfil'];

            }
            $href="service_view.php";
            if ($perfil=="admin")
            {
              echo "<li class='nav-list__item my-work fake-button flex-column-nowrap' role='menuitem'>
                <a class='flex-row-wrap' href='contr_usu.php' tabindex='0'>
                  <img src='../img/jefe.png' height='38.095242' width='40' alt='agregar usuario'>
                  <span class='u-uppercase'>Admin. </br> Usuarios</span>
                </a>
              </li>
              <li class='nav-list__item my-work fake-button flex-column-nowrap' role='menuitem'>
                <a class='flex-row-wrap' href='tabla_soat.php' tabindex='0'>
                  <img src='../img/taxes.svg' height='38.095242' width='40' alt='agregar usuario'>
                  <span class='u-uppercase'>Actualr. </br> Tarifas</span>
                </a>
              </li>
              ";
              $href="service_full.php";
            }
           $link->close();
         ?>
         <li class="nav-list__item my-work fake-button flex-column-nowrap" role="menuitem">
          <a class="flex-row-wrap" href="<?php echo  $href;?>" tabindex="0">
            <img src="../img/carsure.png" height="38.095242" width="40" alt="servicios">
            <span class="u-uppercase">Servicios</span>
          </a>
        </li>
				<li class="nav-list__item contact fake-button flex-column-nowrap" role="menuitem">
					<a class="flex-row-wrap" href="contacto.php" tabindex="0">
						<img src="../img/email.svg" height="38.095242" width="40" alt="Contacto">
						<span class="u-uppercase">Contacto</span>
					</a>
				</li>
        <li class="nav-list__item contact fake-button flex-column-nowrap" role="menuitem">
					<a class="flex-row-wrap" href="login/salir.php" tabindex="0">
						<img src="../img/logout.svg" height="38.095242" width="40" alt="Salir">
						<span class="u-uppercase">Salir</span>
					</a>
				</li>
			</ul>
      <ul class="sidebar__extra-content" role="menu">
				<li class="extra-content__language" role="menuitem">
          <svg height="5" width="5" viewBox="0 0 0 0" role="img" aria-labelledby="Language"></svg><svg height="17.021526" width="9.999999" viewBox="0 0 2.6094522 16.356756"><g transform="matrix(0.03324517,0,0,0.03324517,-3.3736534,0)" id="g6"><path style="fill:#c6c6c6" id="path2" d="M 382.678,226.804 163.73,7.86 C 158.666,2.792 151.906,0 144.698,0 137.49,0 130.73,2.792 125.666,7.86 l -16.124,16.12 c -10.492,10.504 -10.492,27.576 0,38.064 L 293.398,245.9 109.338,429.96 c -5.064,5.068 -7.86,11.824 -7.86,19.028 0,7.212 2.796,13.968 7.86,19.04 l 16.124,16.116 c 5.068,5.068 11.824,7.86 19.032,7.86 7.208,0 13.968,-2.792 19.032,-7.86 L 382.678,265 c 5.076,-5.084 7.864,-11.872 7.848,-19.088 0.016,-7.244 -2.772,-14.028 -7.848,-19.108 z" /></g></svg>
          <img src="../img/user.svg" height="38.095242" width="40" alt="Perfil">
          <span class="u-uppercase">Perfil</span>
					<ul class="extra-content__language-selector flex-column-nowrap" aria-label="submenu" aria-hidden="true" aria-expanded="false" aria-haspopup="true">
						<li class="language-selector__item u-uppercase ca" role="menuitem">
							<a href="updat_pass.php" tabindex="-1">
                <img src="../img/password.svg" height="20.000011" width="20" alt="password">
								<span class="u-lowercase">Cambiar contraseña</span>
							</a>
						</li>
						<li class="language-selector__item u-uppercase es" role="menuitem">
							<a href="ver_info.php" tabindex="-1">
                <img src="../img/info.svg" height="20.000011" width="20" alt="password">
                <span class="u-lowercase">Ver Info.</span>
							</a>
						</li>
					</ul>
        </ul>


<!--
			<ul class="sidebar__extra-content" role="menu">
				<li class="extra-content__language" role="menuitem">
					<svg height="39.999043" width="40.000126" viewBox="0 0 1.1718787 1.1718469" role="img" aria-labelledby="Language"><path d="M 1.1704687,0.546847 C 1.15125,0.254347 0.9175,0.020519 0.625,0.0013 V 0 H 0.5859375 0.546875 V 0.0013 C 0.254375,0.020519 0.02054688,0.254347 0.00132813,0.546847 H 0 v 0.03906 0.03906 H 0.00132813 C 0.02054688,0.917467 0.254375,1.151217 0.546875,1.170436 v 0.00141 H 0.5859375 0.625 v -0.0014 C 0.9175,1.151227 1.15125,0.917478 1.1704687,0.624978 h 0.00141 V 0.58591 0.546847 Z M 0.36679688,0.127706 c -0.0377344,0.05016 -0.0690625,0.113047 -0.091875,0.184766 H 0.15789063 C 0.20882813,0.233022 0.28117188,0.168722 0.36679688,0.127706 Z M 0.11703125,0.390597 H 0.254375 C 0.2439062,0.439967 0.2372656,0.492394 0.2351562,0.546847 H 0.07960937 C 0.08375,0.491847 0.09671875,0.439269 0.11703125,0.390597 Z M 0.07960937,0.624972 h 0.15554688 c 0.002109,0.05445 0.00875,0.106875 0.0192188,0.15625 H 0.11703125 C 0.09671875,0.73255 0.08375,0.679972 0.07960937,0.624972 Z m 0.07828126,0.234375 h 0.11695312 c 0.0228125,0.07172 0.0541406,0.134609 0.0919531,0.184766 C 0.28117188,1.003097 0.20882813,0.938878 0.15789063,0.859347 Z M 0.546875,1.088722 C 0.4665625,1.067238 0.39742188,0.980988 0.35546875,0.859347 H 0.546875 Z m 0,-0.3075 H 0.33351562 C 0.3225,0.73255 0.31554688,0.679972 0.31328125,0.624972 H 0.546875 Z m 0,-0.234375 H 0.31328125 c 0.002266,-0.055 0.009219,-0.107578 0.0202344,-0.15625 H 0.546875 Z m 0,-0.234375 H 0.35546875 C 0.39742188,0.190831 0.4665625,0.104581 0.546875,0.083175 Z m 0.4671094,0 H 0.89710938 C 0.87421878,0.240752 0.84296878,0.177863 0.80507808,0.127706 0.89062498,0.168726 0.96304683,0.233019 1.0139844,0.312472 Z M 0.625,0.083175 c 0.0802344,0.02141 0.14945312,0.107656 0.19140625,0.229297 H 0.625 Z m 0,0.307422 h 0.21328125 c 0.0110938,0.048672 0.0178906,0.10125 0.0203125,0.15625 H 0.625 Z m 0,0.234375 h 0.23359375 c -0.002266,0.055 -0.009219,0.107578 -0.0203125,0.15625 H 0.625 Z m 0,0.46375 V 0.859347 H 0.81640625 C 0.77445312,0.980988 0.70523437,1.067238 0.625,1.088722 Z m 0.18007812,-0.04461 c 0.0377344,-0.05023 0.0691406,-0.113047 0.0920313,-0.184766 H 1.0139844 C 0.9630469,0.938876 0.890625,1.003096 0.80507812,1.044112 Z M 1.0548437,0.781222 H 0.9175 C 0.9279688,0.731852 0.9346094,0.679425 0.9367188,0.624972 h 0.1554687 c -0.00406,0.055 -0.017031,0.107578 -0.037344,0.15625 z M 0.93671875,0.546847 c -0.002109,-0.05445 -0.00875,-0.106875 -0.0192188,-0.15625 H 1.0548436 c 0.020312,0.04867 0.033281,0.10125 0.037422,0.15625 z" id="path2" style="fill:#c6c6c6;stroke-width:0.078125" /></svg><svg height="17.021526" width="9.999999" viewBox="0 0 9.6094522 16.356756"><g transform="matrix(0.03324517,0,0,0.03324517,-3.3736534,0)" id="g6"><path style="fill:#c6c6c6" id="path2" d="M 382.678,226.804 163.73,7.86 C 158.666,2.792 151.906,0 144.698,0 137.49,0 130.73,2.792 125.666,7.86 l -16.124,16.12 c -10.492,10.504 -10.492,27.576 0,38.064 L 293.398,245.9 109.338,429.96 c -5.064,5.068 -7.86,11.824 -7.86,19.028 0,7.212 2.796,13.968 7.86,19.04 l 16.124,16.116 c 5.068,5.068 11.824,7.86 19.032,7.86 7.208,0 13.968,-2.792 19.032,-7.86 L 382.678,265 c 5.076,-5.084 7.864,-11.872 7.848,-19.088 0.016,-7.244 -2.772,-14.028 -7.848,-19.108 z" /></g></svg>
					<span class="u-uppercase">Language</span>
					<ul class="extra-content__language-selector flex-column-nowrap" aria-label="submenu" aria-hidden="true" aria-expanded="false" aria-haspopup="true">
						<li class="language-selector__item u-uppercase ca" role="menuitem">
							<a href="#" tabindex="-1">
								<svg viewBox="0 0 20 20.000012" height="20.000011" width="20" role="img" aria-labelledby="Catalan"><g transform="matrix(1.3333333,0,0,1.3333333,0,-3.9999884)" id="g4506"><path d="M 13.751667,6.36 H 1.2483333 A 7.4641667,7.4641667 0 0 0 0.4325,8.0083333 H 14.566667 A 7.425,7.425 0 0 0 13.751667,6.36 Z M 7.5,3 A 7.4683333,7.4683333 0 0 0 2.7308333,4.7116667 H 12.269167 A 7.4683333,7.4683333 0 0 0 7.5,3 Z" id="path2" style="fill:#ffeb00;stroke-width:0.83333331" /><path d="M 12.269167,4.7116667 H 2.7308333 A 7.5291667,7.5291667 0 0 0 1.2483333,6.36 H 13.750833 A 7.505,7.505 0 0 0 12.269167,4.7116667 Z" id="path4" style="fill:#d81016;stroke-width:0.83333331" /><path d="M 15,10.5 C 15,10.214167 14.980833,9.9341667 14.95,9.6566667 H 0.05 C 0.01916667,9.9341667 0,10.214167 0,10.5 c 0,0.2725 0.01666667,0.54 0.04416667,0.805 H 14.955 C 14.984167,11.04 15,10.7725 15,10.5 Z" id="path6" style="fill:#ffeb00;stroke-width:0.83333331" /><path d="M 14.5675,8.0083333 H 0.4325 A 7.465,7.465 0 0 0 0.05,9.6566667 h 14.9 A 7.465,7.465 0 0 0 14.5675,8.0083333 Z M 13.775,14.601667 H 1.225 A 7.5,7.5 0 0 0 2.6883333,16.25 H 12.311667 A 7.5433333,7.5433333 0 0 0 13.775,14.601667 Z" id="path8" style="fill:#d81016;stroke-width:0.83333331" /><path d="M 2.6883333,16.25 C 3.9908333,17.340833 5.6675,18 7.5,18 c 1.8325,0 3.509167,-0.659167 4.811667,-1.75 z" id="path10" style="fill:#ffeb00;stroke-width:0.83333331" /><path d="M 14.955833,11.305 H 0.04416667 C 0.105,11.8775 0.23583333,12.4275 0.41833333,12.953333 H 14.580833 a 7.4766667,7.4766667 0 0 0 0.375,-1.648333 z" id="path12" style="fill:#d81016;stroke-width:0.83333331" /><path d="M 14.580833,12.953333 H 0.41916667 c 0.2025,0.585834 0.4725,1.139167 0.80666663,1.648334 H 13.775833 a 7.4833333,7.4833333 0 0 0 0.805,-1.648334 z" id="path14" style="fill:#ffeb00;stroke-width:0.83333331" /></g></svg>
								<span class="u-uppercase">CAT</span>
							</a>
						</li>
						<li class="language-selector__item u-uppercase es" role="menuitem">
							<a href="#" tabindex="-1">
								<svg height="20" width="20" viewBox="0 0 20 20" role="img" aria-labelledby="Spanish"><g transform="translate(0,-492)" id="g4527"><path style="fill:#ffda44;stroke-width:0.0390625" d="m 0,502 c 0,1.2232 0.22003906,2.39492 0.62199219,3.47824 L 10,506.34781 19.378008,505.47824 C 19.779961,504.39492 20,503.2232 20,502 c 0,-1.2232 -0.220039,-2.39492 -0.621992,-3.47824 L 10,497.65219 0.62199219,498.52176 C 0.22003906,499.60508 0,500.7768 0,502 Z" id="path2" /><path id="path4" d="M 19.378008,498.52176 C 17.965078,494.71379 14.299648,492 10,492 c -4.2996484,0 -7.9650781,2.71379 -9.37800781,6.52176 z" style="fill:#d80027;stroke-width:0.0390625" /><path id="path6" d="M 0.62199219,505.47824 C 2.0349219,509.28621 5.7003516,512 10,512 c 4.299648,0 7.965078,-2.71379 9.378008,-6.52176 z" style="fill:#d80027;stroke-width:0.0390625" /></g></svg>
								<span class="u-uppercase">ES</span>
							</a>
						</li>
						<li class="language-selector__item u-uppercase eng is-selected" role="menuitem">
							<a href="#" tabindex="-1">
								<svg height="20" width="20" viewBox="0 0 20 20" role="img" aria-labelledby="English"><circle id="circle2" r="10" cy="10" cx="10" style="fill:#f0f0f0;stroke-width:0.0390625" role="presentation" /><g transform="scale(0.0390625)" id="g20"><path id="path4" d="M 52.92,100.142 C 32.811,126.305 17.648,156.46 8.819,189.219 h 133.178 z" style="fill:#0052b4" /><path id="path6" d="m 503.181,189.219 c -8.829,-32.758 -23.993,-62.913 -44.101,-89.076 l -89.075,89.076 z" style="fill:#0052b4" /><path id="path8" d="m 8.819,322.784 c 8.83,32.758 23.993,62.913 44.101,89.075 l 89.074,-89.075 z" style="fill:#0052b4" /><path id="path10" d="M 411.858,52.921 C 385.695,32.812 355.541,17.649 322.782,8.819 v 133.177 z" style="fill:#0052b4" /><path id="path12" d="m 100.142,459.079 c 26.163,20.109 56.318,35.272 89.076,44.102 V 370.005 Z" style="fill:#0052b4" /><path id="path14" d="m 189.217,8.819 c -32.758,8.83 -62.913,23.993 -89.075,44.101 l 89.075,89.075 z" style="fill:#0052b4" /><path id="path16" d="m 322.783,503.181 c 32.758,-8.83 62.913,-23.993 89.075,-44.101 l -89.075,-89.075 z" style="fill:#0052b4" /><path id="path18" d="m 370.005,322.784 89.075,89.076 c 20.108,-26.162 35.272,-56.318 44.101,-89.076 z" style="fill:#0052b4" /></g><g transform="scale(0.0390625)" id="g32"><path id="path22" d="m 509.833,222.609 h -220.44 -10e-4 V 2.167 C 278.461,0.744 267.317,0 256,0 244.681,0 233.539,0.744 222.609,2.167 v 220.44 0.001 H 2.167 C 0.744,233.539 0,244.683 0,256 c 0,11.319 0.744,22.461 2.167,33.391 h 220.44 0.001 V 509.833 C 233.539,511.256 244.681,512 256,512 c 11.317,0 22.461,-0.743 33.391,-2.167 v -220.44 -10e-4 H 509.833 C 511.256,278.461 512,267.319 512,256 c 0,-11.317 -0.744,-22.461 -2.167,-33.391 z" style="fill:#d80027" /><path id="path24" d="m 322.783,322.784 v 0 L 437.019,437.02 c 5.254,-5.252 10.266,-10.743 15.048,-16.435 l -97.802,-97.802 h -31.482 z" style="fill:#d80027" /><path id="path26" d="m 189.217,322.784 h -0.002 L 74.98,437.019 c 5.252,5.254 10.743,10.266 16.435,15.048 l 97.802,-97.804 z" style="fill:#d80027" /><path id="path28" d="m 189.217,189.219 v -0.002 L 74.981,74.98 C 69.727,80.232 64.715,85.723 59.933,91.415 l 97.803,97.803 h 31.481 z" style="fill:#d80027" /><path id="path30" d="m 322.783,189.219 v 0 L 437.02,74.981 C 431.768,69.727 426.277,64.715 420.585,59.934 l -97.802,97.803 z" style="fill:#d80027" /></g></svg>
								<span class="u-uppercase">ENG</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="extra-content__share fake-button flex-row-wrap" role="menuitem">
					<a href="#" tabindex="0">
						<svg height="40" width="40" viewBox="0 0 4.53125 4.53125"><g transform="scale(0.078125)" id="g4530"><path style="fill:#c6c6c6;stroke-width:2;stroke:#c6c6c6" id="path2" d="M 54.319,37.839 C 54.762,35.918 55,33.96 55,32 55,22.905 50.369,14.623 42.611,9.847 42.138,9.557 41.524,9.704 41.235,10.174 40.945,10.645 41.092,11.26 41.562,11.55 48.724,15.96 53,23.604 53,32 53,33.726 52.8,35.451 52.427,37.147 51.966,37.051 51.489,37 51,37 c -3.86,0 -7,3.141 -7,7 0,3.859 3.14,7 7,7 3.86,0 7,-3.141 7,-7 0,-2.659 -1.491,-4.976 -3.681,-6.161 z M 51,49 c -2.757,0 -5,-2.243 -5,-5 0,-2.757 2.243,-5 5,-5 2.757,0 5,2.243 5,5 0,2.757 -2.243,5 -5,5 z" /><path style="fill:#c6c6c6;stroke-width:2;stroke:#c6c6c6;" id="path4" d="M 38.171,54.182 C 35.256,55.388 32.171,56 29,56 22.615,56 16.473,53.425 11.983,48.908 13.229,47.643 14,45.911 14,44 c 0,-3.859 -3.14,-7 -7,-7 -3.86,0 -7,3.141 -7,7 0,3.859 3.14,7 7,7 1.226,0 2.378,-0.319 3.381,-0.875 C 15.26,55.136 21.994,58 29,58 c 3.435,0 6.778,-0.663 9.936,-1.971 0.51,-0.211 0.753,-0.796 0.542,-1.307 -0.211,-0.509 -0.797,-0.751 -1.307,-0.54 z M 2,44 c 0,-2.757 2.243,-5 5,-5 2.757,0 5,2.243 5,5 0,2.757 -2.243,5 -5,5 -2.757,0 -5,-2.243 -5,-5 z" /><path style="fill:#c6c6c6;stroke-width:2;stroke:#c6c6c6" id="path6" d="m 4,31.213 c 0.024,0.002 0.048,0.003 0.071,0.003 0.521,0 0.959,-0.402 0.997,-0.93 C 5.78,20.197 12.654,11.766 22.288,8.972 23.142,11.874 25.825,14 29,14 32.86,14 36,10.859 36,7 36,3.141 32.86,0 29,0 25.149,0 22.015,3.127 22.001,6.975 11.42,9.922 3.851,19.12 3.073,30.146 3.034,30.696 3.449,31.175 4,31.213 Z M 29,2 c 2.757,0 5,2.243 5,5 0,2.757 -2.243,5 -5,5 -2.757,0 -5,-2.243 -5,-5 0,-2.757 2.243,-5 5,-5 z" /></g></svg>
						<span class="u-uppercase">Share</span>
					</a>
				</li>
			</ul>!-->
		</nav>
	</section>
    <!-- Version Mobile -->
  <section id="mobile-menu" class="mobile-menu navbar flex-row-wrap">
    <a class="navbar__logo" href="#">
      <span class="logo">SII</span>
    </a>
    <div class="navbar__mobile-menu">
      <div class="menu">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <nav class="navbar__mobile-menu__nav" aria-label="Main mobile menu" aria-hidden="true">
      <ul class="navbar__mobile-menu__list flex-column-nowrap" role="menu">
        <li class="navbar__mobile-menu__item flex-row-wrap about-me u-uppercase fake-button active" role="menuitem">
          <a href="cotizacion.php" tabindex="-1">Cotizador</a>
            <img src="../img/delivery.svg" height="38.095242" width="30" alt="Perfil">
        </li>
        <li class="navbar__mobile-menu__item flex-row-wrap about-me u-uppercase fake-button active" role="menuitem">
          <a href="cobert.php" tabindex="-1">Coberturas</a>
            <img src="../img/seguro.svg" height="38.095242" width="30" alt="Perfil">
        </li>
        <li class="navbar__mobile-menu__item flex-row-wrap about-me u-uppercase fake-button active" role="menuitem">
          <a href="service_view.php" tabindex="-1">Servicios</a>
            <img src="../img/carsure.png" height="38.095242" width="30" alt="Perfil">
        </li>
        <li class="navbar__mobile-menu__item flex-row-wrap about-me u-uppercase fake-button active" role="menuitem">
          <a href="contacto.php" tabindex="-1">Contacto</a>
            <img src="../img/email.svg" height="38.095242" width="30" alt="Perfil">
        </li>
        <li class="navbar__mobile-menu__item flex-row-wrap language u-uppercase fake-button" role="menuitem" aria-haspopup="true" aria-expanded="false">
          <a class="flex-row-nowrap">
            <span>Perfil</span>
            <svg class="arrow-icon" height="17.021526" width="9.999999" viewBox="0 0 9.6094522 16.356756"><g transform="matrix(0.03324517,0,0,0.03324517,-3.3736534,0)" id="g6"><path style="fill:#c6c6c6" id="path2" d="M 382.678,226.804 163.73,7.86 C 158.666,2.792 151.906,0 144.698,0 137.49,0 130.73,2.792 125.666,7.86 l -16.124,16.12 c -10.492,10.504 -10.492,27.576 0,38.064 L 293.398,245.9 109.338,429.96 c -5.064,5.068 -7.86,11.824 -7.86,19.028 0,7.212 2.796,13.968 7.86,19.04 l 16.124,16.116 c 5.068,5.068 11.824,7.86 19.032,7.86 7.208,0 13.968,-2.792 19.032,-7.86 L 382.678,265 c 5.076,-5.084 7.864,-11.872 7.848,-19.088 0.016,-7.244 -2.772,-14.028 -7.848,-19.108 z"></path></g></svg>
          </a>
          <ul class="language__list flex-row-nowrap" role="submenu" aria-hidden="true" aria-expanded="false">
            <li class="language__item ca" role="menuitem">
              <a class="flex-row-nowrap" href="updat_pass.php" tabindex="-2">
                <img src="../img/password.svg" height="38.095242" width="30" alt="Perfil">
                <span>Camb.Contr</span>
              </a>
            </li>
            <li class="language__item es" role="menuitem">
              <a class="flex-row-nowrap" href="ver_info.php" tabindex="-2">
                <img src="../img/info.svg" height="38.095242" width="30" alt="Perfil">
                <span>Ver. Info</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="navbar__mobile-menu__item flex-row-wrap about-me u-uppercase fake-button active" role="menuitem">
          <a href="login/salir.php" tabindex="-1">Salir</a>
            <img src="../img/logout.svg" height="38.095242" width="30" alt="Perfil">
        </li>
      </ul>
    </nav>
  </section>
</header>
<!-- partial -->

</body>
</html>
