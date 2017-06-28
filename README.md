# Composer novembre/monorepo
*by Novembre Communication*

Inclure le monorepo dans le fichier `composer.json`:

```
"require": {
    "novembre/monorepo": "dev-master"
},
"repositories": [
    {
        "type": "vcs",
        "url":  "git@github.com:gitnovembre/composer.git"
    }
]
```
Charger l'autoloader du monorepo dans `functions.php`

```
require_once get_template_directory() . '/vendor/novembre/monorepo/vendor/autoload.php';
```
