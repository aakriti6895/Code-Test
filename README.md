# Code-Test

RUNNG THE SERVICE LOCALLY:

LOCAL SETUP:

The index.php file contains the code for PHP Webservice.
To run locally, follow the following steps:
1) Install XAMPP on your system.
2) Place the index.php file in the folder- htdocs.
3) Start the Apache Webserver in XAMPP.
4) Type localhost in the browser to run the service.

EXECUTION:

The service contains implements a REST API using PHP.
Initially, a form will be displayed where it would be asked to enter the type of the request- Ping/System_info/Img_details.

1) Ping: returns “pong”.
2) Sys_info: returns service version and system information.
3) Img_details: returns a JSON object with details about the image like- image filename, size, dimensions and image title etc.

Enter one of the above choices and press the Submit button. The results will be displayed accordingly. 
