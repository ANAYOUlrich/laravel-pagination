# Personnalisation de la pagination dans Laravel
---

## Style 1
Voici une illustration de mon projet :

![Template de personnalisation de la pagination Laravel avec Bootstrap 5](./Style1/image1.png)

## Installation && Utilisation
Pour personnaliser les vues de pagination, vous devez les exporter vers votre répertoire `resources/views/vendor` en utilisant la commande `vendor:publish` :

```shell
php artisan vendor:publish --tag=laravel-pagination
```

Si vous souhaitez désigner un fichier différent comme vue de pagination par défaut, vous pouvez utiliser les méthodes `defaultView` et `defaultSimpleView` du paginateur dans la méthode `boot` de votre classe `App\Providers\AppServiceProvider` :

```php
<?php
 
namespace App\Providers;
 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.custom-bootstrap-5');
 
        Paginator::defaultSimpleView('vendor.pagination.custom-simple-bootstrap-5');
    }
}
```
Ensuite, vous pouvez simplement téléverser le fichier `custom-bootstrap-5` et `custom-simple-bootstrap-5` dans le dossier  `views/vendor/pagination `.

Dans votre contrôleur, voici comment vous pouvez l'utiliser :
```php
    $ligne = $request->input('ligne', 10);
    $users = User::paginate($ligne)->withQueryString();
```

Merci !