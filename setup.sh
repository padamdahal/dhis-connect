#!/bin/bash

# check if php is installed
if ! [ -x "$(command -v php)" ]; then
        echo 'Error: php is not installed, install php first and try again.'
        exit 1
fi

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
scheduler_schedule="00 00 * * 0-5"
sms_schedule="*/01 * * * 0-5"

# add a cron job for scheduler
rm -f /etc/cron.d/dhis-automation
touch /etc/cron.d/dhis-automation

# Printing to file
echo "#!/bin/sh" >> /etc/cron.d/dhis-automation
echo "" >> /etc/cron.d/dhis-automation

#echo "00 00 * * 0-5 root php ${DIR}/index.php scheduler" >> /etc/cron.d/dhis-automation
#echo "*/01 * * * 0-5 root php ${DIR}/index.php sms" >> /etc/cron.d/dhis-automation


echo "${scheduler_schedule} root php ${DIR}/index.php scheduler" >> /etc/cron.d/dhis-automation
echo "${sms_schedule} root php ${DIR}/index.php sms" >> /etc/cron.d/dhis-automation
