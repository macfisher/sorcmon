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

# IMAP must be enabled for gmail account
# sudo apt-get install sendmail
# sudo apt-get install php-pear
# sudo pear install Mail
# sudo pear install Net_SMTP
# turned this on: enabled less secure apps for from@gmail.com
# https://www.google.com/settings/security/lesssecureapps

### Enabling less secure apps is only an issues since Google
### may then receive emails from mail servers over un-enctrypted
### channels. Follow the instructions below to force SMTP to use
### TLS enctrypted traffic via /etc/mail/cert and sendmail.mc
### config file.

# mkdir /etc/mail/cert
# cd /etc/mail/cert

# openssl genrsa -des3 -out server.key 1024
# openssl rsa -in server.key -out server.key.open

# openssl req -new -x509 -days 3650 -key server.key.open -out server.crt

# chmod 600 server.*

#modify /etc/mail/sendmail.mc after line "MAILER_DEFINITIONS"

dnl #
define(`confCACERT_PATH', `/etc/mail/cert')dnl
define(`confCACERT', `/etc/mail/cert/server.crt')dnl
define(`confSERVER_CERT', `/etc/mail/cert/server.crt')dnl
define(`confSERVER_KEY', `/etc/mail/cert/server.key.open')dnl
define(`confCLIENT_KEY', `/etc/mail/cert/server.crt')dnl
dnl#

# /etc/init.d/sendmail restart
</pre>