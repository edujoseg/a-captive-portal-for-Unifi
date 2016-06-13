# a-captive-portal-for-Unifi
Another Captive Portal for Unifi connected to WuBook Zak

## Setting configuration

Complete values into `config.php` script.

### Scheduled cleaning of Database

Add line to your crontab:

01 13 * * * curl http://localhost/admin/clean.php > /dev/null 2>&1

All days at 1pm o'clock clean database of caducous register and wrong registers
