# KV Management project documentation

## 1. Project summary

KV Management is a multi-location dry-cleaning franchise operations application. The repository contains an older Laravel 5.2/PHP application for store sales and labor reporting, customer issue tracking, claims/reimbursements, payroll records, supplier ordering, location administration, and reporting. It uses server-rendered Blade pages, Eloquent models, MySQL-compatible persistence, jQuery/Bootstrap, and several legacy reporting/table plugins.

This document describes the checked-in application structure and route definitions. The checked-in Laravel migrations are from 2017 and cover only the initial schema; they do not describe every table used by the current controllers. For a production schema reference, compare this document with the actual database before changing or creating tables.

## 2. Technology and runtime

- Framework: Laravel `5.2.*` (`composer.json`).
- PHP constraint: `>=5.5.9` in Composer metadata. This is a historical constraint, not a recommendation for a modern exposed deployment.
- Database: Laravel connections are configured in `config/database.php`; MySQL is the default, and SQLite/PostgreSQL connection stanzas are present.
- UI: Blade templates under `resources/views`, Bootstrap 3 assets, jQuery, Font Awesome, DataTables, jQuery UI/datepicker, AngularJS (legacy), and chart/report dependencies loaded by individual pages.
- PDF: `elibyy/tcpdf-laravel` is declared for PDF generation.
- Entry points: `public/index.php` is the web entry point; `artisan` is the CLI entry point. `server.php` supports Laravel's legacy development server flow.

## 3. Request and application flow

1. `public/index.php` boots Laravel through `bootstrap/app.php`.
2. `app/Http/Kernel.php` configures the `web` middleware group, including cookies, sessions, shared validation errors, and CSRF verification.
3. `app/Http/routes.php` defines the root/login routes and wraps the operational application routes in the `auth` middleware.
4. Controllers in `app/Http/Controllers` load or update Eloquent models in `app/`, then return Blade views or JSON/PDF responses.
5. Most authenticated Blade screens extend `resources/views/layouts/layout.blade.php`. It loads `layouts/header/header.blade.php`, includes the authenticated header/navigation, and yields page content.
6. The location selection is held in session state (`location_id`, `locationName`, and related values); controllers and location-linked records use it to scope operational data.

### Authentication and location context

- Laravel's `Route::auth()` provides login, logout, password reset, and registration endpoints.
- `/` displays the login screen or redirects an already authenticated user to location selection.
- `/setlocation` is handled by `SetlocationController`; after login it activates the user's previously selected assigned location, then their assigned location field when available, then the first active assigned location. It stores the active location in session and continues to the dashboard. The shared header exposes a location selector on every authenticated page; the selected location is validated against the user's active assignments before it is stored.
- The dashboard aggregates its operational metrics over the signed-in user's active assigned locations. The operational modules continue to use the active location in session, so selecting a location in the shared header changes the scope for those pages.
- `User` includes role and module-access fields. The dashboard filters its menu entries using role/module access. Location assignment is additionally represented by `User_location` and related mapping models.
- The authenticated header presents the active location, notification count/CSR follow-ups, current user, and logout action.

## 4. Functional areas and primary routes

The resource routes are declared in `app/Http/routes.php`. Resource routes follow Laravel 5 conventions (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`) where implemented by the controller.

| Area | Main route(s) | Controller | What the area supports |
| --- | --- | --- | --- |
| Dashboard and menu | `GET /dashboard`, `/menu` | `MenuController` | Location-enabled operational menu and dashboard entry points |
| Location selection/admin | `/setlocation`, `/location` | `SetlocationController`, `LocationController` | Choose a store; manage and archive locations; assign users and modules |
| Users | `/user` | `UserController` | User records, roles, claims, location assignments, and module access |
| Supply ordering | `/order`, `/vendor`, `/seller`, `/product`, `/category` | `OrderController`, `VendorController`, `SellerController`, `ProductController`, `CategoryController` | Vendor/supplier catalog, products/categories, order cart, order placement and resend flows |
| Customer problem reports | `/report` | `Customer_problemController` | Create/update store/customer problem reports, garment details and report search |
| Customer communications | `/service` | `Customer_serviceController` | Customer-service follow-ups, details, notifications, and PDF output |
| Claims/reimbursements | `/reimbursement` | `ReimbursementController` | Claims, described items, filtering, approvals, and PDF output |
| Sales intake | `/sale`, `/discount`, `/adjustment`, `/receipt` | Corresponding controllers | Weekly sales values, discounts, adjustments, receipts, archive and location handling |
| Weekly sales reports | `/salesection` | `SalesectionController` | Store-week sales reporting, dynamic fields/comments, data save and print views |
| Labor reports | `/laboursection`, `/history`, `/labor_report/{id}` | `LaboursectionController` | Weekly employee hours, department breakdowns, history, employee edits, date/week helpers |
| Payroll setup/history | `/payrollcategory`, `/payrolldepartment`, `/payrollemployee`, `/payrollsetting` | Payroll controllers | Payroll categories, departments, employees, location assignment and settings |
| Sales/report settings | `/salessetting` | `SaleSettingController` | Sales/reporting configuration |
| Reports and analytics | `/reportingsection` | `ReportingsectionController` | Date range and location filters, chart/table data, exports/print output |

### Important non-resource endpoints

The routes file also registers AJAX and workflow endpoints used by existing pages. Examples include order cart operations (`addToCart`, `changeCart`, `saveOrder`, `showOrder`), report search/detail operations (`searchReport`, `searchGarments`, `reportDetails`), sales/labor weekly data save/fetch endpoints (`weekData`, `dataSaveSales`, `dataSave`, `getWeekRangeByDate`), chart feeds (`chartData`, `linechartData`, `viewReportingData`), archive/reset endpoints, and PDF/print routes (`cprpdf`, `pdf/{pdf}`, `rembursementPdf`, `printReportData`). Their HTTP methods and controller mappings are defined in `app/Http/routes.php`; callers in Blade/JavaScript depend on those names and paths.

## 5. Code map

### Application code

- `app/Http/Controllers/`: request handling and workflows. The unsuffixed controller file is generally the route target; files with suffixes such as dated names, `_bk`, or numbered versions are historical copies and are not automatically active.
- `app/Http/Requests/`: validation request classes used by some controller actions.
- `app/Http/Middleware/`: authentication, guest redirects, cookies, and CSRF behavior.
- `app/Models` are not separated into a Models folder: Eloquent models are directly under `app/`.
- `app/Http/helpers.php`: project helper functions loaded by Composer autoload.
- `app/Console/Kernel.php`: scheduled/console command registration point.
- `app/Jobs`, `app/Events`, `app/Providers`: Laravel extension points and service providers.

### Data model groups (from checked-in model classes)

- Identity and access: `User`, `Location`, `User_location`, `User_email_location`, `Menu`, `MenuLocation`.
- Purchasing/catalog: `Vendor`, `Seller`, `Product`, `Category`, `Order`, `Order_item`, `Cart`, `Cart_item`, `Brand`, `Color`, `Material`, `Size`, `Type`, `SellerDeliveryDays`.
- Sales: `Sale`, `Sale_location`, `Salesection`, `Discount`, `Discount_location`, `Adjustment`, `Adjustment_location`, `Receipt`, `Receipt_location`, `Payment`, `Subtraction`.
- Labor/payroll: `Laboursection`, `Laborheadersections`, `Employee`, `Track_employees`, `PayrollCategory`, `PayrollCategory_location`, `PayrollDepartment`, `PayrollDepartment_location`, `PayrollEmployee`, `PayrollEmployee_location`, `PayrollEmployee_department`.
- Customer service: `Customer_problem`, `ProblemReportLogs`, `Garment_description`, `Search_result`, `Customer_service`, `Customer_servicefollow`, `Customer_notified`.
- Claims: `Reimbursement`, `Reimbursement_describe_item`.

The model inventory is based on PHP model files, not on a verified live database schema. Several feature tables have no migration in this repository.

### Views and assets

- `resources/views/`: Blade pages grouped by feature, plus authentication, email, error and shared layout templates.
- `resources/views/layouts/layout.blade.php`: shared page shell.
- `resources/views/layouts/header/`: common `<head>` dependencies and authenticated top navigation.
- `css/`, `js/`, `plugins/`, `fonts/`, `img/`: legacy front-end assets. `uikit/` and `public/uikit/` are component/demo files.
- `database/migrations/`: the initial location, category, product, vendor, order, order item, user, user-location, and password-reset schema history.
- `database/seeds/`, `database/factories/`: seed/factory entry points.
- `tests/`: minimal legacy PHPUnit scaffold (`TestCase.php`, `ExampleTest.php`).
- `storage/`: application logs, cache, sessions, and compiled Blade templates; these are runtime artifacts rather than source views.

## Weekly sales and location scope notes

- Weekly sales list totals are grouped by location and actual Saturday-to-Friday period, producing one row per calendar week. The displayed report date is selected deterministically as the latest recorded sales date in that period.
- The list's edit link uses an explicit `record-<id>` value so a database row ID cannot be confused with a numeric store-week number. The edit action resolves that row inside the active location, then loads sales, discounts, adjustments, and receipts for the same Saturday-to-Friday date period. Legacy numeric links continue to mean store week and are location-scoped.
- Weekly sales edit screens discard temporary new-report search/preview data held in session before loading the persisted store week. This prevents a previous preview from overriding the report selected from the list.
- Weekly gross sales sum all `salesections.amount` rows marked `nameDep = sale` for the location and Saturday-to-Friday period. Net sales use receipts (`nameDep = rec`) less the configured sales-tax adjustment (adjustment ID 9) for that same location and period. Calendar periods are the grouping key because legacy records may have more than one `storeNo` inside the same date period. Labor ratio uses the location's matching labor report total divided by net sales. Existing helper definitions are in `app/Http/helpers.php`.
- Dashboard aggregates are restricted to active locations assigned to the authenticated user. Detailed operational pages remain single-location views controlled by the header selector.

## 6. Database and migration notes

The checked-in migrations create the initial tables for locations, categories, products, vendors, orders, order items, users, user locations, and password resets. The user-location migration history adds and later removes/re-adds a location relation on users. Initial order/product foreign keys are also present.

Current models and controllers use many additional tables and columns absent from those migrations (sales, labor, payroll, claims, customer reports, menus, settings, and others). The deployed database therefore likely includes schema changes maintained outside the checked-in migrations. Do not assume `php artisan migrate` alone recreates a working production database. Obtain a sanitized schema export and deployment-specific seed data before attempting a fresh install.

## 7. Local setup (legacy application)

1. Install a PHP runtime compatible with Laravel 5.2 and the extensions required by the project and database driver.
2. Install Composer dependencies from `composer.json`/`composer.lock`.
3. Create a local `.env` from a safe local template and configure `APP_KEY`, database, mail, and filesystem settings. Never copy production secrets into documentation or source control.
4. Configure a database whose schema matches the full deployed application, not just the old migrations.
5. Point the web server document root at `public/` and ensure Laravel's `storage/` and `bootstrap/cache/` directories are writable by the application process.
6. For a disposable compatible local database only, inspect migrations first and then use the project's Laravel 5.2 Artisan migration/seeding commands as appropriate.

The repository currently contains a `.env` file. Treat it as environment-specific and do not publish its contents. The repo's old PHP/Laravel dependencies may not install on current PHP versions without a dedicated compatibility plan.

## 8. Front-end design structure

Authenticated screens extend the shared layout and share a horizontal navigation shell. The navigation targets existing module endpoints; it does not change controller, route, session, form, or AJAX behavior. Page-specific scripts and styles remain in their existing Blade pages. The shared visual overrides live in `css/kv-redesign.css`, loaded after the existing legacy stylesheets by `layouts/header/header.blade.php`.

When updating a page, preserve its existing form names, IDs, route targets, CSRF fields, JavaScript selectors, and data attributes unless a behavior change is explicitly intended. Print/PDF screens may use their own layout constraints and should be checked separately from normal app pages.

## 9. Operational and maintenance guidance

- Inspect the active route mapping before changing an endpoint: `app/Http/routes.php`.
- Check the matching controller and current Blade template before editing a screen. Keep dated/backup files untouched unless the route explicitly references them.
- For feature changes that affect persistence, first verify the live schema because the repository's migration history is incomplete.
- Keep location scoping and role/module access conditions intact; these govern which operational data and dashboard links a user receives.
- Keep AJAX URLs, JSON field names, and form field names aligned between Blade JavaScript and controller methods.
- Avoid using compiled files under `storage/framework/views` as source; Laravel regenerates them from Blade templates.
- The `public/pages/` and root PHP files are separate legacy utilities; confirm whether any are deployed/linked before modifying or removing them.

## 10. Repository limitations observed during documentation

- The README is the upstream Laravel framework boilerplate and is not documentation for this application.
- The migration set is incomplete relative to application models/controllers.
- Numerous dated and backup controller/view variants exist; route definitions identify the currently active targets.
- External URLs and remote CDN assets occur in legacy views. Their availability is outside the repository's control.
- Existing automated tests are only a small legacy scaffold and do not document full business rules.
