<pre>
                     ▄████████  ▄██████▄     ▄████████  ▄████████   ▄▄▄▄███▄▄▄▄    ▄██████▄  ███▄▄▄▄
                    ███    ███ ███    ███   ███    ███ ███    ███ ▄██▀▀▀███▀▀▀██▄ ███    ███ ███▀▀▀██▄
                    ███    █▀  ███    ███   ███    ███ ███    █▀  ███   ███   ███ ███    ███ ███   ███
                    ███        ███    ███  ▄███▄▄▄▄██▀ ███        ███   ███   ███ ███    ███ ███   ███
                  ▀███████████ ███    ███ ▀▀███▀▀▀▀▀   ███        ███   ███   ███ ███    ███ ███   ███
                           ███ ███    ███ ▀███████████ ███    █▄  ███   ███   ███ ███    ███ ███   ███
                     ▄█    ███ ███    ███   ███    ███ ███    ███ ███   ███   ███ ███    ███ ███   ███
                   ▄████████▀   ▀██████▀    ███    ███ ████████▀   ▀█   ███   █▀   ▀██████▀   ▀█   █▀
                                            ███    ███
                                            Sorc Lab server monitoring tools. - Mackenzie Fisher


*  *  *  *
DISCLAIMER:
    sorcmon uses PHPMailer to send the results of its monitoring tools. Please
    take note and reference the separate licenses associated with each project.


    /** TODO: Test TLS encryption (run w/ debug output enabled to see XOAUTH2) ---- */
    /** TODO: Create setup.php for config.json config ----------------------------- */
    /** TODO: Auto-detect daemons and add them to monitor ------------------------- */


    https://github.com/PHPMailer/PHPMailer
    https://github.com/PHPMailer/PHPMailer/wiki/Using-Gmail-with-XOAUTH2
    Keep this for later reference:
        https://developers.google.com/identity/protocols/OAuth2WebServer

    /** Require Gmail OAUTH2 as package dependency ================================ */
    composer require phpmailer/phpmailer
    composer require league/oauth2-client, if composer.json is empty, but i've added
    composer require league/oauth2-google
    to repo.
    NOTE: Need to delete composer.json and composer.lock before running these commands

    >> Just run composer install inside PHPMailer dir.

    NOTE: Requires PHP 5.5 or later.

    /** Configure an OAuth2 app =================================================== */
    >> Login to google account for email addr that will be used for SMTP relay.
    >> Go to developer console. (https://console.developers.google.com/apis/library)
    >> Click "Create Project" under the Project pull-down at the top of the page where
       the "Google APIs" logo is.
    >> Give the Project a name, can be anything, i.e. PHPMailer. Then click Create.
    >> Go to Library and select 'Gmail API' and Enable it.
    >> Select 'Create Credentials'
    >> Google will try to ask questions to figure out what you need, but skip that
       and select 'client ID'.
    >> Google will ask you to set a product name on the consent screen. Select
       'Configure consent screen'.
    >> Should auto-fill your Gmail addr. All fields are optional except the Product
       Name field, which can be set to sorcmon, or whatever. Does not have to be
       PHPMailer or sorcmon. Click 'Save'.
    >> Go to Dashboard and select Gmail API under your APIs at the bottom of the
       screen and then select 'Create Credentials'.
    >> Select client ID again. Choose 'Web application' for Application Type.
    >> Name = sorcmon (or whatever). Leave the Authorized JavaScript origins blank.
    >> Add URL for sorcmon to Authorized redirect URIs
       http://localhost/sorcmon/get_oauth_token.php -> click 'Create'.
    >> Google will show you your generated 'client ID' and 'client secret'.

    NOTE: Next step will need to be updated for sorcmon to use scratch/config.json.

    >> Copy and paste the credentials into get_auth_token.php
        $redirectUri = 'http://localhost/phpmailer/get_oauth_token.php';
        $clientId = '237644427849-g8d0pnkd1jh3idcjdbopvkse2hvj0tdp.apps.googleusercontent.com';
        $clientSecret = 'mklHhrns6eF-qjwuiLpSB4DL';

    /** Fetch the token =========================================================== */
    >> Paste the script URL into a web browser and select Google ID.
    >> Not able to do this since I am running in a terminal!
    >> sudo apt-get install w3m w3m-img (this was already installed on scotch-box)
    >> w3m <url>
    NOTE: w3m does not support JS so this doesn't help me.
    >> sudo apt-get install lynx
    >> sudo apt-get install links
    >> lynx http://localhost/PHPMailer/get_oauth_token.php
    >> stuck at getting a refresh token. cannot get with lynx or w3m!

    NOTE: May be able to gain OAUTH creds via an API client tool
    https://developers.google.com/identity/protocols/OAuth2WebServer

    NOTE: None of the existing cli browsers that I have tested support JS.
          Google is disabling the Submit button so that a browser is needed.
          For this reason, I will have to use Ubuntu on a VM for testing and
          hopefully can port over to Rasbian on an rPi Mail Server.

    NOTE: Works with Ubuntu desktop, got refresh token, also used convenient php -S localhost:8000

    NOTE: NEED TO REMOVE COMPOSER.JSON AND COMPOSER.LOCK FILES. THESE NEED TO BE GENERATED AT INSTALL
          THE COMPOSTER INSTALL COMMAND DOES NOT WORK IT SEEMS. NEED TO REQUIRE STUFF WITHOUT ALREADY
          HAVING THE CONFIGS IN REPO ALREADY.

    /** Configure email script ==================================================== */
    >> Basically all that has to be done now is plug in config.json stuff to the
       examples/gmail_xoauth.phps script and of course re-name it. I had to comment
       out the require ../PHPMailerAutoload in favor of the vendor/autoload.php.
       Also, I made sure to change any relative filepaths as needed when I moved
       the example script into the PHPMailer root directory. I didn't even need to
       have a webserver running at this point after getting the refresh token.
</pre>