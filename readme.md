# DHIS Tracker Automation
## For National Tuberculosis Programme, Nepal
### Setup
1. Clone the repository in desired location
   - git clone https://github.com/padamdahal/dhis-tracker-automation.git
   
2. Set execute permission on setup.sh
   - chmod +x path/to/dhis-tracker-automation/setup.sh
   
3. Run setup.sh as root
   - sudo ./setup.sh (if you are on the same directory)
   - sudo path/to/dhis-tracker-automation/setup.sh (if your pwd is other than 'dhis-tracker-automation') 

### Configuration
Edit codeigniter config file

- DHIS API details
-- $config['dhis_url'] = 'http://localhost:8000/api/26/';  // Base DHIS2 API url
-- $config['dhis_username'] = 'admin';       // DHIS Username here
-- $config['dhis_password'] = 'district';    // DHIS password here

- SMS service provider details
-- $config['sms_get_url'] = '';
-- $config['sms_send_url'] = 'url';   								// SMS send API url as provided
-- $config['sms_token'] = 'abcdefghijkl';                          // Valid token to send SMS
-- $config['sms_number'] = '12345';                                // Number used by SMS provider to send SMS