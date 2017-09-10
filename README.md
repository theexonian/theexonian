# The Exonian
In the future please commit and push to this repo rather than using Wordpress's
online file editor. It's a lot cleaner this way. Any changes should automatically
deploy to the site in seconds, so there's no need to modify anything directly.

## Admins
- Chief Digital Editor: [Stuart Rucker](https://github.com/StuartRucker)
- Technical Director: [Carson Fleming](https://github.com/cflems)

## Installation Instructions
1. Clone this repository into some local folder
    ### Mac/Linux/Git Terminal:
    ```shell
    git clone git@github.com:theexonian/theexonian.git ./wherever
    ```
    ### Windows:
    Install git at: [Download Git](https://git-scm.com/download/)
    Then follow the Mac/Linux instructions.

2. Set up PHP, MySQL, and a web server. This part is your preference.
    Point these to the folder you cloned the repo into. It doesn't have to be
    the root directory or anywhere special, just remember where you put it.

3. Create a database `theexoni_wp395` and a user that can access it.
    SQL code:
    ```sql
    CREATE DATABASE theexoni_wp395;
    CREATE USER 'youruser'@'localhost' IDENTIFIED BY 'yourpassword';
    GRANT ALL PRIVILEGES ON theexoni_wp395.* TO 'youruser'@'localhost';
    ```
    Try using the database with your new user. If it doesn't work, try:
    ```sql
    GRANT ALL PRIVILEGES ON theexoni_wp395.* TO 'youruser'@'localhost' IDENTIFIED BY 'yourpassword';
    ```

4. Import install.sql. This file contains a dump of Exonian data, but it
    won't be the current data.
    The easiest way, for Mac/Linux is:
    ```shell
    sudo mysql -u root -p <install.sql
    ```

5. Correct the site urls. (These are the `home` and `siteurl` options.)
    Change `http://localhost/theexonian` to your site URL. No trailing slash.
    ```sql
    USE theexoni_wp395;
    UPDATE wp_options SET option_value = 'http://localhost/theexonian' WHERE option_id = 1 OR option_id = 36;
    ```

6. Fix user passwords. They've been deleted for security reasons.
    Generate a hash for the password you want to use at this link:
    [WordPress Password Hash](https://cflems.github.io/wp-hash/)
    ```sql
    USE theexoni_wp395;
    UPDATE wp_users SET user_pass = 'your hash value' WHERE user_login = 'cflems';
    ```
    This will allow you to log in to the `cflems` administrator account with
    your password. You can also hijack other users on your local installation
    for testing use if you want.

7. Generate the `wp-config.php` file.
    This can be done by navigating to your dev site and following the instructions provided.
    Be sure to supply the database, MySQL user, and password you created in step 3. 

8. Use your testing site.
    If you have trouble reading articles, go into your local admin panel
    (http://wherever/wp-admin) and set permalinks to "Plain" 
    (under Settings > Permalinks).

## To-Do List By Priority
1. Shrink install.sql
    - Install The Exonian + PHPMyAdmin fresh
    - Delete a bunch of posts (Like everything <2015/16?)
    - Export the database with PHPMyAdmin into install.sql
    - Reset whatever password you hijack to empty in install.sql
