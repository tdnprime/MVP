# Boxeon

Boxeon is a subscription box platform for content creators to offer subscription boxes to their most loyal fans.


# Installation

1. Download the project onto your local server.
2. Name your local server as "localhost".
3. Ensure your gmail address was added to the project in Google Developer Console.
4. Get the /config directory and place it in the peoject's root directory
5. Go to /config/app.ini to update any variables that might be needed for the site to work with your server
6. Set your local server to listen to Port 80. Google Sign-In will redirect to Port 80.
7. Install the MySql database. Find it on Dropbox at https://www.dropbox.com/s/46h4g54stqa72tp/boxeon.sql?dl=0 

# Signin

1. Load project in your browser using Port 80.
2. Use your gmail associated with the project in Google Developer Console to sign in.

# know

1. Signin - Users must be identified by the app prior to them starting some important processes.
For example, sometimes a user might set out to subscribe to a box. They are first asked
to sign in.  Once they sign in, they will be redirected to the page they signed in from to continue the process in question. 
This redirect occurs afer Google Sign in has redirected them to the home page. See /signin/create-url.php to see the redirect logic.

