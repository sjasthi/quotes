# Quotes Manager
Quotes Manager (QM)

## Login on Localhost Instructions

Use the following instructions to log in to this app for development purposes on localhost.
1. Open file 'authentication.php'
2. Set $development_environment = true;
3. Adjust other variables to see what Quotes looks like when logged in or not logged in.
   - To see what the app looks like when not logged in:
     - $logged_in = false;
   - To see what the app looks like when logged in as a regular user:
     - $logged_in = true;
     - $admin, $super_admin, $author, $sponsor = false;
   - To see what the app looks like when logged in as an admin:
     - $logged_in, $admin = true;
     - $super_admin = false;
   - To see what the app looks like when logged in as a super-admin:
     - $logged_in, $super_admin = true;
   - To see what the app looks like when logged in as an author:
     - $logged_in, $author = true;
     - $admin, $super_admin, $sponsor = false;
   - To see what the app looks like when logged in as a sponsor:
     - $logged_in, $sponsor = true;
     - $admin, $super_admin, $author = false;

Note: Do _not_ upload 'authentication.php' to the live hosted website with $development_environment set to true.