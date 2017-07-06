<?php 
/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/
date_default_timezone_set( "Africa/Nairobi" );
$dbfile = 'inc/config.php';
if ( !file_exists( $dbfile) ) {
  header( "Location: ./setup.php" );
}

$year = date( "Y" );
$month = date( "m" );
$day = date( "d" );
$directory = "uploads/$year/$month/$day/";

if ( !is_dir( $directory) ) {
  mkdir( $directory, 755, true );
}

include 'inc/config.php';
include 'inc/class.actions.php';
$action = new _hActions;
$action -> connectDB();

if ( isset( $_POST['login'] ) && $_POST['user'] != "" && $_POST['password'] != "" ) {
  call_user_func_array(array($action, 'loginUser'), array());
}

if ( isset( $_POST['create'] ) ) {
  call_user_func_array(array($action, 'registerUser'), array());
}

if ( isset( $_POST['reset'] ) && $_POST['h_password'] !== "" ) {
  call_user_func_array(array($action, 'resetPass'), array());
}

if ( isset( $_GET['q'] ) ) {
  $actions = array( 'login', 'reset', 'register', 'forgot' );

  if ( !is_file( $_GET['q'] ) && !is_dir( $_GET['q'] ) && in_array($_GET['q'], $actions) ) {
    call_user_func_array( array( $action, $_GET['q'] ), array() );
  } else {
    call_user_func_array( array($action, 'fetchPosts' ), array( 'article', $_GET['q'] ) );
  }
} else {
include 'sheader.php'; 
?>
<title>Shop [ <?php showOption( 'name' ); ?> ]</title>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--2-col" style="background: url( <?php _show_( hIMAGES.'tag.png' ); ?> ); background-repeat:repeat; background-size: initial;background-blend-mode: lighten;"></div>
	<div class="input-field mdl-cell mdl-cell--8-col">
        <button class="mdl-button mdl-color--grey-400" id="categories">CATEGORIES <i class="material-icons">keyboard_arrow_down</i></button>
        <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php primaryColor(); ?>" for="categories">
        	<a class="mdl-list__item" href="?product_category=men">Men</a>
        	<a class="mdl-list__item" href="?product_category=women">Women</a>
        	<a class="mdl-list__item" href="?product_category=children">Children</a>
        </ul>

        <button class="mdl-button mdl-color--grey-400" id="categories">PRODUCTS <i class="material-icons">keyboard_arrow_down</i></button>
        <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php primaryColor(); ?>" for="categories">
        	<a class="mdl-list__item" href="?product_category=men">Men</a>
        	<a class="mdl-list__item" href="?product_category=women">Women</a>
        	<a class="mdl-list__item" href="?product_category=children">Children</a>
        </ul>

        <button class="mdl-button mdl-color--grey-400" id="categories">BRANDS <i class="material-icons">keyboard_arrow_down</i></button>
        <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--pink" for="categories">
        	<a class="mdl-list__item" href="?product_category=men">Men</a>
        	<a class="mdl-list__item" href="?product_category=women">Women</a>
        	<a class="mdl-list__item" href="?product_category=children">Children</a>
        </ul>

        <button class="mdl-button mdl-color--grey-400" id="categories">PRICE <i class="material-icons">keyboard_arrow_down</i></button>
        <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--pink" for="categories">
        	<a class="mdl-list__item" href="?product_category=men">Men</a>
        	<a class="mdl-list__item" href="?product_category=women">Women</a>
        	<a class="mdl-list__item" href="?product_category=children">Children</a>
        </ul>

        <button class="mdl-button mdl-color--grey-400 alignright" id="categories"><i class="material-icons">search</i> Search Item</button>

	</div>
	<div class="mdl-cell mdl-cell--2-col" style="background: url( <?php _show_( hIMAGES.'tag.png' ); ?> ); background-repeat:repeat; background-size: initial;background-blend-mode: lighten;"></div>

	<div class=" mdl-color--pink" style="background: url( <?php _show_( hIMAGES.'avatar.svg' ); ?> ); background-repeat:no-repeat; background-size: cover;background-blend-mode: lighten;">
		<style type="text/css">
		@keyframes slidy {
			0% { left: 0%; }
			20% { left: 0%; }
			25% { left: -100%; }
			45% { left: -100%; }
			50% { left: -200%; }
			70% { left: -200%; }
			75% { left: -300%; }
			95% { left: -300%; }
			100% { left: -400%; }
			}

			body { margin: 0; } 
			div#slider { 
				overflow: hidden;
				min-height: 250px;
				max-height: 300px; }
			div#slider figure img { width: 20%; float: left; }
			div#slider figure { 
			  position: relative;
			  width: 500%;
			  margin: 0;
			  left: 0;
			  text-align: left;
			  font-size: 0;
			  animation: 30s slidy infinite; 
			}
			table
    {
    border-collapse:separate;
    border-spacing:10px 0px;
    }
		</style>
		<div id="slider">
		<figure>
		<img src="http://localhost/jabali/inc/assets/images/logo-w.png" alt>
		<img src="http://localhost/jabali/inc/assets/images/marker.png" alt>
		<img src="http://localhost/jabali/inc/assets/images/logo.png" alt>
		</figure>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--2-col" style="background: url( <?php _show_( hIMAGES.'tag.png' ); ?> ); background-repeat:repeat; background-size: initial;background-blend-mode: lighten;"></div>
	<div class="mdl-cell mdl-cell--8-col">

    <div class="card horizontal mdl-shadow--2dp mdl-color-text--black">
      <div class="card-image">
        <img src="<?php _show_( hIMAGES.'logo.png' ); ?>" width="150px;" >
      </div>
      <div class="card-stacked">
        <div class="card-content">
        <h5><b>Product Name</b><span class="alignright"><b>KSh 49021</b></span></h5>Category
        </div>
        <div class="card-action">
        <strong><b>Author</b><br>
        Location</strong>
          <a class="mdl-button mdl-color--pink alignright" href="#">ADD <i class="material-icons">add_shopping_cart</i></a>
        </div>
      </div>
    </div>

    <div class="card horizontal mdl-shadow--2dp mdl-color-text--black">
      <div class="card-image">
        <img src="<?php _show_( hIMAGES.'logo.png' ); ?>" width="150px;" >
      </div>
      <div class="card-stacked">
        <div class="card-content">
        <h5><b>Product Name</b><span class="alignright"><b>KSh 49021</b></span></h5>Category
        </div>
        <div class="card-action">
        <strong><b>Author</b><br>
        Location</strong>
          <a class="mdl-button mdl-color--pink alignright" href="#">ADD <i class="material-icons">add_shopping_cart</i></a>
        </div>
      </div>
    </div>

    <div class="card horizontal mdl-shadow--2dp mdl-color-text--black">
      <div class="card-image">
        <img src="<?php _show_( hIMAGES.'logo.png' ); ?>" width="150px;" >
      </div>
      <div class="card-stacked">
        <div class="card-content">
        <h5><b>Product Name</b><span class="alignright"><b>KSh 49021</b></span></h5>Category
        </div>
        <div class="card-action">
        <strong><b>Author</b><br>
        Location</strong>
          <a class="mdl-button mdl-color--pink alignright" href="#">ADD <i class="material-icons">add_shopping_cart</i></a>
        </div>
      </div>
    </div>
	</div>
	<div class="mdl-cell mdl-cell--2-col" style="background: url( <?php _show_( hIMAGES.'tag.png' ); ?> ); background-repeat:repeat; background-size: initial;background-blend-mode: lighten;"></div>
</div><?php
include 'footer.php'; 
} ?>