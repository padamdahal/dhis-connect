#!/bin/bash

# check if php is installed
if ! [ -x "$(command -v php)" ]; then
	echo 'Error: php is not installed, install php first and try again.'
	exit 1
fi

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# add a cron job for scheduler
touch /etc/cron.d/dhis-automation

# Printing to file
echo "#!/bin/sh" >> /etc/cron.d/dhis-automation
echo "" >> /etc/cron.d/dhis-automation

echo "00 00 * * 0-5 php ${DIR}/dhis-tracker-automation/index.php scheduler" >> /etc/cron.d/dhis-automation
echo "*/30 * * * 0-5 php ${DIR}/dhis-tracker-automation/index.php sms" >> /etc/cron.d/dhis-automation