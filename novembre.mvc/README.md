# Composer novembre/mvc
*MVC in WP*
> composer require novembre/mvc

Insérer ces lignes dans le fichier functions.php, veuillez à bien instancier l'autoload de Composer en amont.
Veuillez indiquer l'espace de nom associé à votre architecture.
```
<?php

new Novembre\Mvc\Mvc(array(
    "namespace" => "App"
));

?>
```

C'est maintenant possible d'utiliser les nouvelles fonctionnalités. 

Nous allons tout d'abord créer une classe héritée de App qui nous servira de controller.
``` 
<?php namespace App\Controllers; //namespace configured

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
<?php namespace App\Models; //namespace configured

use Novembre\Mvc\Model;
use WP_Query; // include WP_Query from WP

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
                    "gallery" => $this->getAcfGallery('gallery', get_the_ID())
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
    $posts = $home->model->getPosts(); ?>

    <?php foreach($posts as $post) : ?>
        <h2><?php echo $post["title"]; ?></h2>

        <?php foreach($post["gallery"] as $img): ?>

            <img src="<?php echo $img['sizes']['thumbnail']; ?>" />

        <?php endforeach; ?>
    <?php endforeach; ?>

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

La class `Model` fournie avec le package comporte des méthodes globales qu'on peut appeler depuis notre propre classe de model. L'exemple ci-dessus utilise la méthode globale getAcfGallery() (basée sur le plugin ACF) de la class `Model`.
