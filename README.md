Yii2-form-generator
==========

Backend user & password:
Login: `admin`
Password: `qwe1234`

Installation and getting started:
---------------------------------

If you do not have Composer, you may install it by following the instructions at getcomposer.org.

1. Run the following command: `php composer.phar create-project --stability=dev funson86/yii2-adminlte yii2-adminlte` to install Yii2-Adminlte.
2. Run command: `cd /my/path/to/yii2-adminlte/` and go to main application directory.
3. Run command: `php requirements.php` and check the requirements.
4. Run command: `php init` to initialize the application with a specific environment.
5. Create a new database and adjust it configuration in `common/config/main-local.php` accordingly.
6. Run command: `yii migrate` to apply migrations with console commands:
   - m140608_201405_user_init : user table
   - m140608_201406_rbac_init : rabc 4 tables of auth_assignment, auth_item, auth_item_child, auth_rule. same to yiisoft/yii2/rbac/migrations/schema-mysql.sql
7. This will create tables needed for the application to work.
8. You also can use database dump from `my/path/to/yii2-adminlte/tests/yii2-adminlte.sql`, but however I recommend to use migrations.


Usage
-----
- Use the URL `http://yii2-adminlte.domain` point to `yii2-adminlte/frontend/web/` to access application frontend.
- Use the URL `http://backend.yii2-adminlte.domain` point to `yii2-adminlte/backend/web/` to access application backend.


Advanced Rbac
-------------
- Run command: `yii migrate --migrationPath=@console/migrations/rbac` to add permission, add more rbac file here while your project growing.
- To check weather show on top menu or side bar, add `'visible' => Yii::$app->user->can('readPost'),` in top-menu.php or sidebar-menu.php.
- To check could run action. add `if(!Yii::$app->user->can('createPost')) throw new HttpException(401, 'No Auth');` in actionIndex, actionCreate, actionUpdate in XXXController.php file.

Notes:
------

By default will be created one super admin user with login `admin` and password `qwe1234`, you can use this data to sing in application frontend and backend.

Themes:
-------
- Application backend it's based on "AdminLTE" template. More detail about this nice template you can find [here](http://www.bootstrapstage.com/admin-lte/).
- Application frontend with default Yii2 advanced frontend page.


Preview:
-------
![Yii2-Adminlte](tests/yii2-adminlte-preview.jpg)


Related:
-------
- [Yii2-Gii](https://github.com/funson86/yii2-gii) : Gii for Yii2-Adminlte
- [Yii2-Setting](https://github.com/funson86/yii2-Setting) : Common Setting for Yii2
- [Yii2-Blog](https://github.com/funson86/yii2-blog) : A Blog extension for Yii2
- [Yii2-Cms](https://github.com/funson86/yii2-cms) : A Cms extension for Yii2

