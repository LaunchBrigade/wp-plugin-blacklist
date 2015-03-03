# WP Plugin Blacklist
A WordPress Must-Use Plugin for Blacklisting Other Plugins

WARNING: Must be installed as a Must-Use plugin, will not work when installed as a normal plugin. Will only stop the installation or activation of new plugins. Has no effect on previously installed plugins.

## Getting Started
0. Download and extract or clone to the `mu-plugins` directory inside of wp-content. Note: `blacklist.php` can't be in a sub-directory, unless you create a load/bootstrap file that requires `blacklist.php`.
0. Modify `assets/blacklist.json` to include any plugins you wish to not be installed. Note: Blacklist is based on plugin directory names.
0. Modify `assets/message.txt` to customize the blacklisted plugin message.
0. Refresh the site. Everything should be working.
