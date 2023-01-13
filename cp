
CodeIgniter v4.2.7 Command Line Tool - Server Time: 2022-10-25 21:00:31 UTC-05:00

Cache
  cache:clear        Clears the current system caches.
  cache:info         Shows file cache information in the current system.

CodeIgniter
  env                Retrieves the current environment, or set a new one.
  help               Displays basic usage information.
  list               Lists the available commands.
  namespaces         Verifies your namespaces are setup correctly.
  publish            Discovers and executes all predefined Publisher classes.
  routes             Displays all routes.
  serve              Launches the CodeIgniter PHP-Development Server.

Database
  db:create          Create a new database schema.
  db:seed            Runs the specified seeder to populate known data into the database.
  db:table           Retrieves information on the selected table.
  migrate            Locates and runs all new migrations against the database.
  migrate:refresh    Does a rollback followed by a latest to refresh the current state of the database.
  migrate:rollback   Runs the "down" method for all migrations in the last batch.
  migrate:status     Displays a list of all migrations and whether they've been run or not.

Encryption
  key:generate       Generates a new encryption key and writes it in an `.env` file.

Generators
  make:command       Generates a new spark command.
  make:config        Generates a new config file.
  make:controller    Generates a new controller file.
  make:entity        Generates a new entity file.
  make:filter        Generates a new filter file.
  make:migration     Generates a new migration file.
  make:model         Generates a new model file.
  make:scaffold      Generates a complete set of scaffold files.
  make:seeder        Generates a new seeder file.
  make:validation    Generates a new validation file.
  migrate:create     [DEPRECATED] Creates a new migration file. Please use "make:migration" instead.
  session:migration  [DEPRECATED] Generates the migration file for database sessions, Please use  "make:migration
                     --session" instead.

Housekeeping
  debugbar:clear     Clears all debugbar JSON files.
  logs:clear         Clears all log files.
