# Composer novembre/mvc
*MVC in WP*
> composer require novembre/mvc

Insérer ces lignes dans le fichier functions.php, veuillez à bien instancier l'autoload de Composer en amont.
```
<?php

new Novembre\Mvc\Mvc();

?>
```

C'est maintenant possible d'utiliser les nouvelles fonctionnalités. 

Nous allons tout d'abord créer une classe héritée de App qui nous servira de controller.
``` 
<?php
use Novembre\Mvc\App;

class Home extends App {

    public $model_name = "post";

    public function __construct() {

        $this->setModel($this->model_name);
    }

    public function myFunction() {

        return "im a check";
    }
}
```

Nous allons égalemement créer une classe héritée de Model qui nous servira de model de données.
```
<?php
use Novembre\Mvc\Model;

class Post extends Model {

    public function getPosts() {

        $the_query = new WP_Query( array(
            "post_type" => "post"
        ) );

        if ( $the_query->have_posts() ) {

            while ( $the_query->have_posts() ) {

                $the_query->the_post();

                $posts[] = array(
                    "ID" => get_the_ID(),
                    "title" => get_the_title(),
                    "subtitle" => get_field('subtitle'),
                    "gallery" => $this->getGallery('gallery', get_the_ID())
                );
            }

            wp_reset_postdata();
        }

        return $posts;
    }
}
```

Nous pouvons maintenant nous servir de ces classes dans nos fichiers de vues, ici dans le fichier front-page.php par exemple:
```
<?php
    $home = $app->setController('home');
?>
<?php ob_start(); ?>

	<section role="main">
        <div class="container">

            <div class="columns">
                <div class="column">
    				<h1>Bienvenue sur ExPress</h1>
                </div>
            </div>

            <div class="columns">
                <?php $posts = $home->model->getPosts(); ?>

                <?php foreach($posts as $post) : ?>
                    <div class="column">
                        <h2><?php echo $post["title"]; ?></h2>
                    </div>

                    <?php foreach($post["gallery"] as $img): ?>

                        <div class="column">
                            <img src="<?php echo $img['sizes']['thumbnail']; ?>" />
                        </div>

                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>

        </div>
	</section>

<?php $view = ob_get_contents(); ob_end_clean(); ?>
<?php get_template_part(PATH_VIEWS_LAYOUTS . '/layout', 'default'); ?>
```

`$app` fait référence à notre objet principal et nous pouvons appeler nos méthodes grâce à la méthode `setController('home')`

Pour appeler une méthode de la classe `Home`, il nous suffit d'écrire
```
<?php echo $home->myFunction(); //retourne "im a check" ?>
```

Pour appeler une méthode de la classe `Post`, il nous suffit d'écrire
```
<?php $posts = $home->model->getPosts(); //retourne un tableau de données voulues ?>
```

La class `Model` fournie avec le package comporte des méthodes globales qu'on peut appeler depuis notre propre classe de model. L'exemple ci-dessus utilise la méthode globale getGallery() (basée sur le plugin ACF) de la class `Model`.

Projet récent, des ajustements et/ou améliorations sont à venir.
