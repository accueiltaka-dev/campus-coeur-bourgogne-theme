<?php
// Sécurité : empêcher l'accès direct
if ( !defined( 'ABSPATH' ) ) exit;

// Charger les styles du thème
function campus_enqueue_styles() {
    wp_enqueue_style('campus-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'campus_enqueue_styles');

// Déclaration du menu principal
function campus_register_menus() {
    register_nav_menus(array(
        'main-menu' => __('Menu Principal', 'campus-coeur-bourgogne')
    ));
}
add_action('init', 'campus_register_menus');

// Support images mises en avant
add_theme_support('post-thumbnails');

// Création automatique des pages principales à l’activation du thème
function campus_create_demo_pages() {
    $pages = array(
        'Accueil' => "Bienvenue au Campus Cœur de Bourgogne !",
        'Formations' => "Découvrez nos formations : CAP, BTS, Bachelor, Titres pros, Executive MBA, Executive Certificate.",
        'Admissions' => "Étapes d’admission : candidature en ligne, entretien, confirmation.",
        'Vie Étudiante' => "Découvrez le BDE, le logement étudiant et la vie associative.",
        'Actualités' => "Suivez nos actualités et événements récents.",
        'Contact' => "Contactez-nous : adresse, email et téléphone."
    );

    foreach ($pages as $title => $content) {
        if (!get_page_by_title($title)) {
            wp_insert_post(array(
                'post_title' => $title,
                'post_content' => $content,
                'post_status' => 'publish',
                'post_type' => 'page'
            ));
        }
    }
}
add_action('after_switch_theme', 'campus_create_demo_pages');

// Compatibilité One Click Demo Import
function campus_import_files() {
    return array(
        array(
            'import_file_name' => 'Demo Campus',
            'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/demo-content.xml',
            'import_notice' => __('Importez ce contenu pour obtenir la démo complète du site.', 'campus-coeur-bourgogne'),
        ),
    );
}
add_filter('ocdi/import_files', 'campus_import_files');

function campus_after_import_setup() {
    // Assigner le menu principal
    $main_menu = get_term_by('name', 'Menu Principal', 'nav_menu');
    if ($main_menu) {
        set_theme_mod('nav_menu_locations', array(
            'main-menu' => $main_menu->term_id
        ));
    }

    // Définir la page d’accueil statique
    $home = get_page_by_title('Accueil');
    if ($home) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home->ID);
    }
}
add_action('ocdi/after_import', 'campus_after_import_setup');
