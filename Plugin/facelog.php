<?php
/**
 * Plugin Name: FaceLog Plugin
 * Plugin URI: http://boscdelacoma.cat
 * Description: Pràctica MP07.
 * Version: 3.1
 * Author: BernatPujolriu
 * Author URI:  http://boscdelacoma.cat
 **/

 require_once __DIR__ . '/includes/db.php';
 require_once __DIR__ . '/includes/custom-pages.php';

 const FACELOG_DB_VERSION = '1.0';
 const FACELOG_VERSION= '1.0';
 
 // Allow subscribers to see Private posts and pages
 $subRole = get_role( 'subscriber' );
 $subRole->add_cap( 'read_private_posts' );
 $subRole->add_cap( 'read_private_pages' );
 

//Funció que crea la pàgina del facelog
function crearPaginaPujarFotos()
{
  //Crea un objecte post
  $my_post = array(
    'post_title'    => wp_strip_all_tags('faceLog'),
    'post_content'  => '[facelog]',//Insertem el shortcode a la pàgina 
    'post_status'   => 'publish',
    'post_author'   => 1,
    'post_type'     => 'page',
  );

  wp_insert_post($my_post);
}

//Funció que crea la pàgina de la galeria
function crearPaginaGaleria()
{
  //Crea un objecte post
  $my_post = array(
    'post_title'    => wp_strip_all_tags('galeria'),
    'post_content'  => '[galeria]',//Insertem el shortcode a la pàgina 
    'post_status'   => 'private',
    'post_author'   => 1,
    'post_type'     => 'page'
  );

  wp_insert_post($my_post);
}

//Funció que borra la pàgina de la galeria
function borrarPaginaGaleria()
{
  // Obté la pàgina pel títol
  $pagina = get_page_by_title('Galeria');

  // Borra la pàgina de la base de dades pàgina
  wp_delete_post($pagina->ID);
}


//Funció que borra la pàgina del facelog
function borrarPaginaPujarFotos() {

  $pagina = get_page_by_title('FaceLog');

  wp_delete_post($pagina->ID);
}


//Funció per borrar imatges de la carpeta tmp
function borrarImatgesGaleria() {
  $folder = plugin_dir_path( __FILE__ ) . '/uploads/tmp';
  //Borra totes les imatges de la carpeta
  array_map('unlink', glob("$folder/*.*"));
}



//Funció que carrega una fulla d'estils a wordpress
function carregarCss() {
  $plugin_url = plugin_dir_url( __FILE__ );
  wp_enqueue_style( 'style', $plugin_url . 'assets/css/style.css' );
}


//Funció que es crida abans de crear-se un pàgina a wordpress
add_action( 'wp_enqueue_scripts', 'carregarCss' );


//Funció que crida la funció en activar el plugin
register_activation_hook(__FILE__, 'crearPaginaPujarFotos');
register_activation_hook(__FILE__, 'crearPaginaGaleria');
register_activation_hook(__FILE__, 'crearTaula');


//Funció que crida la funció en desactivar el plugin
register_deactivation_hook(__FILE__, 'borrarTaula');
register_deactivation_hook(__FILE__, 'borrarPaginaPujarFotos');
register_deactivation_hook(__FILE__, 'borrarPaginaGaleria');
register_deactivation_hook( __FILE__, 'borrarImatgesGaleria' );

//Es creen els shortcodes que cridaran les funcions de crea les pàgines web
add_shortcode('galeria', 'facelog_gallery');
add_shortcode('facelog', 'facelog_addlog');

