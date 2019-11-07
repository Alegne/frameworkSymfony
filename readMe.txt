le fichier "gestion_commande_lens.sql.zip" est la base de donnee à restaurer sur phpmyAdmin
$ sudo apt-get update
$ sudo apt-get install build-essential linux-headers-$(uname -r)
$ sudo apt-get install virtualbox-ose-guest-x11

====================================================================

$ sudo apt-get install virtualbox-guest-additions-iso
$ sudo apt-get update 
$ sudo apt-get dist-upgrade
$ sudo apt-get install virtualbox-guest-x11

Gestion de Commande

Terminal 1
$ composer create-project symfony/website-skeleton gestionCommande "4.3"
$ cd gestionCommande
$ php bin/console server:run

Terminal 2
$ composer require stof/doctrine-extensions-bundle
$ composer req --dev make doctrine/doctrine-fixtures-bundle
$ composer req --dev fzaninotto/faker
$ composer req --dev mbezhanov/faker-provider-collection
$ composer require vich/uploader-bundle
$ composer require liip/imagine-bundle
$ composer require knplabs/knp-paginator-bundle
$ composer require friendsofsymfony/user-bundle "~2.0"

$ php bin/console list make

Generer un controller
$ php bin/console make:controller

Creer Base des donnees
$ php bin/console doctrine:database:create

Migration BDD
$ php bin/console make:migration
$ php bin/console doctrine:migrations:migrate

Generer entity
$ php bin/console make:entity
$ php bin/console make:entity --regenerate

Generer CRUD entity
$ php bin/console make:crud Entity

Generer Form entity
$ php bin/console make:form

Lancer Fixtures
$ php bin/console doctrine:fixtures:load --append

