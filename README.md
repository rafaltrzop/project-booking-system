# Project booking system

## Set up

1. Clone repository and install the needed dependencies:

  ```
  $ cd project-booking-system
  $ npm install
  $ bower install
  ```

2. Create MySQL database:

  ```
  $ mysql -u USERNAME -pPASSWORD

  mysql> CREATE DATABASE db_name
      -> DEFAULT CHARACTER SET utf8
      -> DEFAULT COLLATE utf8_general_ci;
  ```

3. Create tables:

  ```
  $ mysql DB_NAME -u USERNAME -pPASSWORD < database_tables.sql
  ```

4. Optionally import sample data:

  ```
  $ mysql DB_NAME -u USERNAME -pPASSWORD < database_data.sql
  ```

5. Create and update your credentials file:

  ```
  $ cp database_credentials.php.example database_credentials.php
  $ vim database_credentials.php
  ```

## Development

Run `npm start` to run the Sass compiler. It will re-run every time you save a Sass file. Happy coding!