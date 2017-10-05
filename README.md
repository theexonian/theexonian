# The Exonian
In the future please commit and push to this repo rather than using Wordpress's
online file editor. It's a lot cleaner this way. Any changes should automatically
deploy to the site in seconds, so there's no need to modify anything directly.

## Admins
- Chief Digital Editor: [Stuart Rucker](https://github.com/StuartRucker)
- Technical Director: [Carson Fleming](https://github.com/cflems)

## Installation Instructions
1. Install Git on your computer if you don't already have it.
    Downloads and instructions can be found at [The Git Website](https://git-scm.com/download/).

2. Set up keys so GitHub knows who you are.
    - Use [this guide](https://help.github.com/articles/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent/)
      to generate an SSH keypair. Use the links for your particular platform under the article header.
      You don't have to do the part that starts with `Adding your SSH key to the ssh-agent`. Remember or
      write down everything you enter while creating the key.
    - Following this guide will generate a two key files encrypted with a password of your choice. Don't
      share this password with anyone. You will need it in order to use git with The Exonian. If you lose
      the password, it's easy to generate new keys, so it's worthwhile to choose a strong one, within reason.
    - Use [this one](https://help.github.com/articles/adding-a-new-ssh-key-to-your-github-account/) to
      associate the keypair with your account. Again, use the link for whatever OS you're running.

3. Clone this repository into some local folder.
    If you're running Windows, your installation of Git should have come with something called
    Git Terminal. If so, use that. Otherwise, open the terminal app on your computer and type:
    ```shell
    git clone git@github.com:theexonian/theexonian.git ./wherever
    ```
    where `./wherever` is some folder where you want your test installation to live.

2. Set up PHP, MySQL, and a web server. This part is your preference.
    Point these to the folder you cloned the repo into. It doesn't have to
    be the root directory or anywhere special, just remember where you put
    it.

    - Here is a good all-in-one package if you have no idea what you're
      doing: [XAMPP](https://www.apachefriends.org/) (The lite version
      should work fine.)
    - If you're setting up a server or virtual environment, this guide
      is also pretty stellar:
      [Digital Ocean: LAMP on Ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)

    If you have any questions after combing these sites, feel free to ask
    or message one of the admins for help.

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
