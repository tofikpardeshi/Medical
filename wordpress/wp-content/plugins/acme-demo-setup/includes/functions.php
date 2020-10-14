<?php
function acme_demo_setup_get_current_theme_author(){
    $current_theme = wp_get_theme();
    return $current_theme->get('Author');
}
function acme_demo_setup_get_current_theme_slug(){
    $current_theme = wp_get_theme();
    return $current_theme->stylesheet;
}
function acme_demo_setup_get_theme_screenshot(){
    $current_theme = wp_get_theme();
    return $current_theme->get_screenshot();
}
function acme_demo_setup_get_theme_name(){
    $current_theme = wp_get_theme();
    return $current_theme->get('Name');
}

function acme_demo_setup_get_templates_lists( $theme_slug ){
    switch ($theme_slug):
        case "acmeblog":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                    'categories' => array( 'blog' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmeblog/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "acmeblogpro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                    'categories' => array( 'blog' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmeblogpro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                    'categories' => array( 'blog' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmeblogpro/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                    'categories' => array( 'blog' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmeblogpro/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                    'categories' => array( 'blog' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmeblogpro/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "supermag":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/supermag/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-2' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/supermag/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "supermagpro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/supermagpro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-2' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/supermagpro/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-3' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/supermagpro/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-4' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/supermagpro/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "corporate-plus":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'business' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/corporate-plus/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "corporate-plus-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'business' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/corporate-plus-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array(  'demo' ,'demo-2' ),/*Search keyword*/
                    'categories' => array( 'business' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://demo.acmethemes.com/corporate-plus-pro/store-demo/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array(  'demo' ,'demo-3' ),/*Search keyword*/
                    'categories' => array( 'business' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://demo.acmethemes.com/corporate-plus-pro/medical/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "infinite-photography":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/infinite-photography/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      =>__( 'Gutentor','acmethemes' ),
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => __('Breadcrumb NavXT','acmethemes' ),
                            'slug'      => 'breadcrumb-navxt',
                        ),
                        array(
                            'name'      => __( 'Contact Form 7','acmethemes' ),
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "infinite-photography-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/infinite-photography-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      =>__( 'Gutentor','acmethemes' ),
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => __('Breadcrumb NavXT','acmethemes' ),
                            'slug'      => 'breadcrumb-navxt',
                        ),
                        array(
                            'name'      => __( 'Contact Form 7','acmethemes' ),
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-2' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/infinite-photography-pro/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      =>__( 'Gutentor','acmethemes' ),
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => __('Breadcrumb NavXT','acmethemes' ),
                            'slug'      => 'breadcrumb-navxt',
                        ),
                        array(
                            'name'      => __( 'Contact Form 7','acmethemes' ),
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-3' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/infinite-photography-pro/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      =>__( 'Gutentor','acmethemes' ),
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => __('Breadcrumb NavXT','acmethemes' ),
                            'slug'      => 'breadcrumb-navxt',
                        ),
                        array(
                            'name'      => __( 'Contact Form 7','acmethemes' ),
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo 4' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/infinite-photography-pro/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      =>__( 'Gutentor','acmethemes' ),
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => __('Breadcrumb NavXT','acmethemes' ),
                            'slug'      => 'breadcrumb-navxt',
                        ),
                        array(
                            'name'      => __( 'Contact Form 7','acmethemes' ),
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "supernews":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/supernews/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "supernewspro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/supernewspro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-2' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/supernewspro/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-3' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/supernewspro/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-4' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/supernewspro/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "weblog":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/weblog/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "weblogpro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/weblogpro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Easy Twitter Feed Widget Plugin',
                            'slug'      => 'easy-twitter-feed-widget',
                        ),
                        array(
                            'name'      => 'Smash Balloon Social Photo Feed',
                            'slug'      => 'instagram-feed',
                        ),
                        array(
                            'name'      => 'Widget for Social Page Feeds',
                            'slug'      => 'facebook-pagelike-widget',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-2' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/weblogpro/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Easy Twitter Feed Widget Plugin',
                            'slug'      => 'easy-twitter-feed-widget',
                        ),
                        array(
                            'name'      => 'Smash Balloon Social Photo Feed',
                            'slug'      => 'instagram-feed',
                        ),
                        array(
                            'name'      => 'Widget for Social Page Feeds',
                            'slug'      => 'facebook-pagelike-widget',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-3' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/weblogpro/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Easy Twitter Feed Widget Plugin',
                            'slug'      => 'easy-twitter-feed-widget',
                        ),
                        array(
                            'name'      => 'Smash Balloon Social Photo Feed',
                            'slug'      => 'instagram-feed',
                        ),
                        array(
                            'name'      => 'Widget for Social Page Feeds',
                            'slug'      => 'facebook-pagelike-widget',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-4' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/weblogpro/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Easy Twitter Feed Widget Plugin',
                            'slug'      => 'easy-twitter-feed-widget',
                        ),
                        array(
                            'name'      => 'Smash Balloon Social Photo Feed',
                            'slug'      => 'instagram-feed',
                        ),
                        array(
                            'name'      => 'Widget for Social Page Feeds',
                            'slug'      => 'facebook-pagelike-widget',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-5' =>array(
                    'title' => __( 'Demo 5', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-5' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/weblogpro/home-4',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Easy Twitter Feed Widget Plugin',
                            'slug'      => 'easy-twitter-feed-widget',
                        ),
                        array(
                            'name'      => 'Smash Balloon Social Photo Feed',
                            'slug'      => 'instagram-feed',
                        ),
                        array(
                            'name'      => 'Widget for Social Page Feeds',
                            'slug'      => 'facebook-pagelike-widget',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-6' =>array(
                    'title' => __( 'Demo 6', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-5' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-6/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-6/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-6/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-6/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/weblogpro/home-5',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'Easy Twitter Feed Widget Plugin',
                            'slug'      => 'easy-twitter-feed-widget',
                        ),
                        array(
                            'name'      => 'Smash Balloon Social Photo Feed',
                            'slug'      => 'instagram-feed',
                        ),
                        array(
                            'name'      => 'Widget for Social Page Feeds',
                            'slug'      => 'facebook-pagelike-widget',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),

            );
            break;
        case "dupermag":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/dupermag/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "dupermagpro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/dupermagpro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/dupermagpro/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                    )
                ),
            );
            break;
        case "acmephoto":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmephoto/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WordPress Gallery Plugin – NextGEN Gallery',
                            'slug'      => 'nextgen-gallery',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-2' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmephoto/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WordPress Gallery Plugin – NextGEN Gallery',
                            'slug'      => 'nextgen-gallery',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "acmephotopro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmephotopro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WordPress Gallery Plugin – NextGEN Gallery',
                            'slug'      => 'nextgen-gallery',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-2' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmephotopro/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WordPress Gallery Plugin – NextGEN Gallery',
                            'slug'      => 'nextgen-gallery',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-3' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmephotopro/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WordPress Gallery Plugin – NextGEN Gallery',
                            'slug'      => 'nextgen-gallery',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-4' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmephotopro/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WordPress Gallery Plugin – NextGEN Gallery',
                            'slug'      => 'nextgen-gallery',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-5' =>array(
                    'title' => __( 'Demo 5', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-5' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmephotopro/home-4',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-6' =>array(
                    'title' => __( 'Demo 6', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-6' ),/*Search keyword*/
                    'categories' => array( 'photo' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-6/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-6/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-6/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-6/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/acmephotopro/home-5',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WordPress Gallery Plugin – NextGEN Gallery',
                            'slug'      => 'nextgen-gallery',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "mercantile":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'mercantile' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/mercantile/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-2' ),/*Search keyword*/
                    'categories' => array( 'mercantile' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/mercantile/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-3' ),/*Search keyword*/
                    'categories' => array( 'mercantile' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/mercantile/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-3' ),/*Search keyword*/
                    'categories' => array( 'mercantile' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/mercantile/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "mercantilepro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'mercantile' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/mercantilepro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-2' ),/*Search keyword*/
                    'categories' => array( 'mercantile' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/mercantilepro/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-3' ),/*Search keyword*/
                    'categories' => array( 'mercantile' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/mercantilepro/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-4' ),/*Search keyword*/
                    'categories' => array( 'mercantile' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/mercantilepro/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-5' =>array(
                    'title' => __( 'Demo 5', 'acmethemes' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-5' ),/*Search keyword*/
                    'categories' => array( 'mercantile' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/mercantilepro/home-4',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "read-more":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/read-more/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-2' ),/*Search keyword*/
                    'categories' => array( 'woocommerce' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/read-more/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-3' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/read-more/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-4' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/read-more/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "read-more-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes','acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/read-more-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-2' ),/*Search keyword*/
                    'categories' => array( 'woocommerce' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/read-more-pro/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-3' ),/*Search keyword*/
                    'categories' => array( 'magazine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/read-more-pro/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmethemes' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmethemes' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-4' ),/*Search keyword*/
                    'categories' => array( 'personal-blog' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/read-more-pro/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "education-base":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                    'categories' => array( 'education' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/education-base/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                        array(
                            'name'      => 'Honeypot for Contact Form 7',
                            'slug'      => 'contact-form-7-honeypot',
                        ),
                    )
                ),
            );
            break;
        case "education-base-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-2'  ),/*Search keyword*/
                    'categories' => array( 'education' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/education-base-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main','demo', 'demo-2' ),/*Search keyword*/
                    'categories' => array( 'education' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/education-base-pro/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-3' ),/*Search keyword*/
                    'categories' => array( 'multipurpose' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/education-base-pro/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main',  'demo','demo-4'),/*Search keyword*/
                    'categories' => array( 'blog' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/education-base-pro/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                    )
                ),
            );
            break;
        case "prolific":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                    'categories' => array( 'blog' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/prolific/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "prolificpro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                    'categories' => array( 'blog' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/prolificpro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo', 'demo-2'),/*Search keyword*/
                    'categories' => array( 'blog' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/prolificpro/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "medical-circle":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                    'categories' => array( 'medical' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/medical-circle/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "medical-circle-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                    'categories' => array( 'medical' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/medical-circle-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "online-shop":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1'),/*Search keyword*/
                    'categories' => array( 'shop' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/online-shop/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo', 'demo-2' ),/*Search keyword*/
                    'categories' => array( 'shop' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/online-shop/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'YITH WooCommerce Wishlist',
                            'slug'      => 'yith-woocommerce-wishlist'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo', 'demo-3' ),/*Search keyword*/
                    'categories' => array( 'shop' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/online-shop/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'YITH WooCommerce Wishlist',
                            'slug'      => 'yith-woocommerce-wishlist'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo', 'demo-4' ),/*Search keyword*/
                    'categories' => array( 'shop' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/online-shop/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'YITH WooCommerce Wishlist',
                            'slug'      => 'yith-woocommerce-wishlist'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-5' =>array(
                    'title' => __( 'Demo 5 RTL', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo', 'demo-5' ),/*Search keyword*/
                    'categories' => array( 'shop' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/online-shop/home-4',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'YITH WooCommerce Wishlist',
                            'slug'      => 'yith-woocommerce-wishlist'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "online-shop-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo' ,'demo-1'),/*Search keyword*/
                    'categories' => array( 'shop' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/online-shop-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'YITH WooCommerce Wishlist',
                            'slug'      => 'yith-woocommerce-wishlist'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-2' =>array(
                    'title' => __( 'Demo 2', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo', 'demo-2' ),/*Search keyword*/
                    'categories' => array( 'shop' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/online-shop-pro/home-1',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'YITH WooCommerce Wishlist',
                            'slug'      => 'yith-woocommerce-wishlist'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-3' =>array(
                    'title' => __( 'Demo 3', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo', 'demo-3' ),/*Search keyword*/
                    'categories' => array( 'shop' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-3/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/online-shop-pro/home-2',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'YITH WooCommerce Wishlist',
                            'slug'      => 'yith-woocommerce-wishlist'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-4' =>array(
                    'title' => __( 'Demo 4', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo', 'demo-4' ),/*Search keyword*/
                    'categories' => array( 'shop' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-4/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/online-shop-pro/home-3',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'YITH WooCommerce Wishlist',
                            'slug'      => 'yith-woocommerce-wishlist'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
                'demo-5' =>array(
                    'title' => __( 'Demo 5 RTL', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo', 'demo-5' ),/*Search keyword*/
                    'categories' => array( 'shop' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-5/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'https://demo.acmethemes.com/online-shop-pro/rtl-demo/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Acme Fix Images',
                            'slug'      => 'acme-fix-images',
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'YITH WooCommerce Wishlist',
                            'slug'      => 'yith-woocommerce-wishlist'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "event-star-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'event' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/event-star-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "event-star":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'event' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/event-star/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "construction-field-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'construction' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/construction-field-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "construction-field":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'construction' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/construction-field/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "beauty-studio-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'beauty' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/beauty-studio-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
            break;
        case "beauty-studio":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'beauty' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/beauty-studio/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
            break;
        case "lawyer-zone-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'lawyer' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/lawyer-zone-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "lawyer-zone":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'lawyer' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/lawyer-zone/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "travel-way-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'Travel' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/travel-way-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'WPForms Lite',
                            'slug'      => 'wpforms-lite',
                        ),
                    )
                ),
            );
            break;
        case "travel-way":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'travel' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/travel-way/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "fitness-hub-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'Fitness' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/fitness-hub-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "fitness-hub":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'fitness' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/fitness-hub/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "restaurant-recipe-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'restaurant' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/restaurant-recipe-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => __('Breadcrumb NavXT','acmethemes' ),
                            'slug'      => 'breadcrumb-navxt',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "restaurant-recipe":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'restaurant' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/restaurant-recipe/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => __('Breadcrumb NavXT','acmethemes' ),
                            'slug'      => 'breadcrumb-navxt',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "portfolio-web-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'portfolio' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/portfolio-web-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => __('Breadcrumb NavXT','acmethemes' ),
                            'slug'      => 'breadcrumb-navxt',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "portfolio-web":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'portfolio' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/portfolio-web/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => __('Breadcrumb NavXT','acmethemes' ),
                            'slug'      => 'breadcrumb-navxt',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "feminine-style-pro":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => true,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'feminine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/feminine-style-pro/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => __('Breadcrumb NavXT','acmethemes' ),
                            'slug'      => 'breadcrumb-navxt',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        case "feminine-style":
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Demo 1', 'acmeblog' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg gutentor, elementor or other page builders*/
                    'author' => __( 'Acme Themes', 'acmeblog' ),/*Author Name*/
                    'keywords' => array( 'main', 'demo','demo-1'),/*Search keyword*/
                    'categories' => array( 'feminine' ),/*Categories*/
                    'template_url' => array(
                        'content' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => ACME_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.jpg',/*Screenshot of block*/
                    'demo_url' => 'http://www.demo.acmethemes.com/feminine-style/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'Gutentor',
                            'slug'      => 'gutentor',
                        ),
                        array(
                            'name'      => 'Page Builder by SiteOrigin',
                            'slug'      => 'siteorigin-panels'
                        ),
                        array(
                            'name'      => __('Breadcrumb NavXT','acmethemes' ),
                            'slug'      => 'breadcrumb-navxt',
                        ),
                        array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file'      => 'wp-contact-form-7.php',
                        ),
                    )
                ),
            );
            break;
        default:
            $demo_templates_lists = array();
    endswitch;

    return $demo_templates_lists;

}