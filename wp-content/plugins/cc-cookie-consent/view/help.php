<?php
/**
 * @Package: CC Cookie Consent (Silktide)
 * @View: Help Page
 */
?>

<div class="wrap">
    <h1><?php _e('Cookie Consent Help & Information'); ?></h1>
    <h3><?php _e('What is this?'); ?></h3>
    <p>
        The <b>CC Cookie Consent</b> plugin is an unofficial WordPress plugin version of the <b><a href="https://silktide.com/tools/cookie-consent/" title="Silktide Cookie Consent" target="_blank">Silktide Cookie Consent</a></b>.
        The most popular solution to the EU Cookie Law.
    </p>
    <h3><?php _e('Who developed this plugin?'); ?></h3>
    <p>This plugin developed by WebPositive from Hungary. <a href="https://progweb.hu" target="_blank">Click here for more information</a></p>
    <div class="updated"><p><?php _e('Wow! Your plugin is ready! Would you like support the development? <a target="_blank" href="https://progweb.hu/cc?utm_soure=plugin_admin">Click here</a>!'); ?></p></div>
    <hr />
    <h3><?php _e('Why required this plugin for my site?'); ?></h3>
    <p>From October 2015 a new privacy law came into effect across the EU. The law requires that websites ask visitors for consent to use most web cookies.<br/> More information please read this: <a href="http://ec.europa.eu/ipg/basics/legal/cookies/index_en.htm" target="_blank" title="EU Cookies Law">EU Cookies Law</a></p>
    <h3><?php _e('Why Cookie Consent?'); ?></h3>
        <p><b>Free & open source</b></p>
        <p>You're forever free to copy, modify and even sell Cookie Consent.</p>
        <p><b>Lightweight</b></p>
        <p>Just 3.5k when minified, and you don't need JQuery or anything else.</p>
        <p><b>Customisable</b></p>
        <p>Choose from one of our built-in themes or build your own with CSS.</p>
    <hr />
    <h3><?php _e('Default Settings'); ?></h3>
    <p>The plugin includes the following default configuration:</p>
    <ul class="plugin-data">
        <li>
            <b>Headline text:</b> "Hello! This website uses cookies to ensure you get the best experience on our website"
        </li>
        <li>
            <b>Accept button:</b> "Got it!"
        </li>
        <li>
            <b>Read more button:</b> "More information"
        </li>
    </ul>
    <p><b>Theme settings</b></p>
    <img class="img-responsive" src="<?php echo plugins_url(); ?>/cc-cookie-consent/assets/img/theme_docs.png" alt="Theme settings" />
    <p><a class="button" href="admin.php?page=cookie-consent">You can change settings here</a></p>
    <p><a class="button" href="https://silktide.com/tools/cookie-consent/docs/" target="_blank">Silktide Cookie Consent documentation</a></p>
    <hr />
    <h3><?php _e('Contribute'); ?></h3>
    <p>Contributing code is both an important and effective way to improve the CC Cookie Consent project and its capabilities.</p>
    <p>If you would like contribute, <a href="https://github.com/progcode/WPCookieConsent" title="Repo">go to the official Github repo</a>. You can fork the plugin <a href="https://github.com/progcode/WPCookieConsent/issues">or open a new issue / feature request</a>.</p>
    <hr />
    <h3><?php _e('Version'); ?></h3>
    <ul class="plugin-data">
        <li>
            <b>Plugin version:</b> <?php echo CC_VERSION; ?>
        </li>
        <li>
            <b>Plugin Build date:</b> <?php echo CC_BUILD_DATE; ?>
        </li>
    </ul>
</div>
