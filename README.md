# AnyBox to Static Marks Bookmarker Helper - Laravel

AnyBox to Static Marks Bookmarker Helper is a Laravel application that converts bookmarks exported in AnyBox JSON format to Static Marks YAML format. This allows you to import your bookmarks into the Static Marks bookmark manager.

## Prerequisites
To use Bookmarker Helper, you will need the following:

- PHP 8.0 or later
- Laravel 8.x or later
- AnyBox JSON format export of your bookmarks
- static-marks 2 or later

## Installation
To get started, follow these steps:

- Clone this repository and navigate to the project directory.
- Install dependencies by running composer install.
- Edit .env file and set the database connection details
- Create a database and run migrations by running `php artisan migrate`.
- Export your bookmarks from AnyBox as JSON.
- Move the exported file to the storage folder and rename it to anybox.json.
- Run `php artisan json:yaml` to generate a output.yml file in the storage folder.
- Import the generated output.yml file into Static Marks using the command `static-marks build storage/output.yml > public/bookmarks.html`
- Static Marks will create a bookmarks.html file in the public directory.
- Start the local server by running php artisan serve.
- Open https://127.0.0.1:8000/bookmarks.html in your browser to view your imported bookmarks (or run scripts, import back into AnyBox etc).

## References

- https://anybox.app
- https://github.com/darekkay/static-marks
- https://darekkay.com/static-marks/#file-format
