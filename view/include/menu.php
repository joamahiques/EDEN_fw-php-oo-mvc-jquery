
<div class="menu_block">
				<div class="container_12">
					<div class="grid_12">
						<nav class="horizontal-nav full-width horizontalNav-notprocessed">
							<ul class="sf-menu">
								<!-- <li><a href="index.php?page=home" data-tr="Inicio"></a></li> -->
								<li><a href="<?php amigable('?module=home&function=list_home');$_GET['module'] = 'home'; ?>" data-tr="Inicio"></a></li>								
								
								<!-- <li><a href="index.php?page=favorites" data-tr="Favoritos"></a></li> -->
								<!-- <li><a href="index.php?page=shop"" data-tr="Tienda" id="btnshop"></a></li> -->
								<li><a href="<?php amigable('?module=shop&function=list_shop'); $_GET['module'] = 'shop';?>" data-tr="Tienda"></a></li>
								<li><a href="<?php amigable('?module=contact&function=list_contact'); $_GET['module'] = 'contact';?>" data-tr="Contacto"></a></li>
								<!-- <li><a href="index.php?page=controller-login&op=view" data-tr="Login"></a></li> --> 
								<li><a <?php  $_GET['module'] = 'login';?> data-tr="Login" class="main-nav"></a></li>
								<li><a href="index.php?page=controller-cart&op=view"><i class="fa fa-shopping-cart"><span>0</span></i></a></li>
							</ul>
						</nav>
						<div class="clear"></div>
					</div>
					<!-- <div class="clear"></div> -->
				</div>
			</div>