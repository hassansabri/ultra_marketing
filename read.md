# Ultra Marketing

Ultra Marketing is a PHP web application for managing orders, shops, catalog items, stock, users, and reports. The interface strings in `application/language/english/eng_lang.php` name the product “Ultra Marketing.” The code is a CodeIgniter 3.1.13 application (`system/core/CodeIgniter.php`). `readme.rst` and `license.txt` are the stock CodeIgniter framework readme and MIT license; they do not describe this application.

There is no database schema or seed data in the repository, so a fresh checkout cannot create the tables the app queries.

## What it does

The front controller is `index.php`. With an empty URL, `application/config/routes.php` loads the `login` controller. A successful login sets a session (`website` = `ultra_marketing`) and redirects to `users/allusers`. Most other controllers redirect to `login` when `logged_in` is not set. Several actions also call helpers in `application/helpers/permission_helper.php` (roles, modules, and permission types).

Controllers under `application/controllers/` cover:

- **Login and users** — `login`, `users` (users, passwords, profiles, permissions)
- **Orders** — `orders` (draft, completed, and cancelled orders, order review, invoices, a shop ledger) and `orders_reports` (sales, shop, item, date-range, and payment reports, plus export and PDF)
- **Shops** — `shops` (shops, suppliers, crediters, ledger)
- **Catalog** — `items`, `categories`, `attributes`, `brands`, `models`, `colours`, `sizes`, `grades`, `types`, `units`
- **Stock** — `stocks`, `packing_stocks`
- **Packing options** — `packing_options` (see `PACKING_OPTIONS_FEATURE.md`)
- **Other admin screens** — `permissions`, `countries` (countries, states, cities), `profile`, `faq`

`application/libraries/Pdf.php` generates PDFs with Dompdf when `vendor/autoload.php` can load it, and falls back to HTML otherwise.

Models for surveys, departments, and reports (`m_survey.php`, `m_survey_bak.php`, `m_survey_result.php`, `m_departments.php`, `m_reports.php`) sit in `application/models/`. No controller in this checkout loads them, so whether they are still used is unclear.

## How the code is organized

| Path | Role |
| --- | --- |
| `index.php` | Front controller. `ENVIRONMENT` comes from the `CI_ENV` server variable, or `development` if unset. System path is `system`, application path is `application`. |
| `system/` | CodeIgniter framework. |
| `application/controllers/` | Request handlers. One class per file, routed as `/index.php/<controller>/<method>`. |
| `application/models/` | Database access, mostly grouped in subdirectories (`orders/`, `users/`, `shops/`, `items/`, `attributes/`, and others). |
| `application/views/` | PHP views matching those areas, plus `common/` and `login/`. |
| `application/config/` | Routes, database, autoload, sessions, and other CodeIgniter settings. |
| `application/helpers/` | `general_helper.php` and `permission_helper.php`, both autoloaded. |
| `application/libraries/` | `Pdf.php`, plus bundled Dompdf copies under `Dompdf/` and `dompdf--/`. |
| `application/language/` | `english/eng_lang.php` (autoloaded) and `arabic/ar_lang.php`. |
| `application/hooks/` | Hook config file only; no hooks are registered. |
| `assets/` | Static CSS, JavaScript, images, CKEditor, and a template. |
| `images/` | Uploaded or generated images (`user/`, `graphs/`). |
| `script/timthumb.php` | Image thumbnail script. |
| `vendor/` | Composer packages, including `dompdf/dompdf`. Already present in the tree. |
| `nbproject/` | NetBeans PHP project metadata. The project name in `project.xml` is `framework`. |
| `.vscode/launch.json` | PHP Debug launch configs, including a built-in server on port 8000. |
| `ultra_marketing.zip` | A zip archive of an `ultra_marketing/` tree. Not used by the running app. |
| `PACKING_OPTIONS_FEATURE.md` | Notes for the packing-options screens and the `packing_options` / order columns they expect. |

`application/.htaccess` denies direct HTTP access to the application directory. The root `.htaccess` sends requests that are not real files or directories to `index.php`.

## Setup and run

Documented requirements:

- PHP `>= 5.3.7` (`composer.json`). `readme.rst` recommends PHP 5.6 or newer.
- MySQL through the `mysqli` driver.

`application/config/database.php` connects to database `ultra_marketing` on `localhost` as user `root` with an empty password. `application/config/config.php` sets `base_url` to `http://localhost/ultra_marketing/` and `index_page` to `index.php`, so generated links include `index.php` unless that setting is changed.

Dependencies are declared in `composer.json` (`dompdf/dompdf`, and dev packages `phpunit/phpunit` and `mikey179/vfsstream`). `config['composer_autoload']` is `FALSE`. The PDF library loads `vendor/autoload.php` itself. `vendor/` is already committed. `composer install` / `composer update` also run a `sed` command against `vfsstream` (see `composer.json` scripts).

This repo does not include SQL that creates `ultra_marketing`. `PACKING_OPTIONS_FEATURE.md` tells you to run `packing_options.sql`, but that file is not in the checkout. How the rest of the schema is created is not documented here.

There is no project start script. The app expects a PHP web server with the project directory as the document root (the root `.htaccess` rewrite is written for Apache). `.vscode/launch.json` can start PHP’s built-in server with `php -S localhost:8000 -t .`. That serves the project at `http://localhost:8000/`, which does not match the configured `base_url`.

## Configuration, tests, and constraints

Autoloaded on every request (`application/config/autoload.php`): the `database`, `session`, `form_validation`, and `pdf` libraries; the `url`, `general`, `permission`, and `form` helpers; and the `eng` language file.

Sessions use the file driver, cookie name `ci_session`, and a 7200-second lifetime. CSRF protection is off (`csrf_protection` = `FALSE`). The encryption key is a short literal in `application/config/config.php`.

`composer.json` defines `test:coverage`, which runs PHPUnit with `tests/travis/sqlite.phpunit.xml`. That path is not in this repository, and there is no application test suite. PHPUnit config files that do exist belong to the bundled Dompdf copies.

`.gitignore` only ignores `/nbproject/private/`.
