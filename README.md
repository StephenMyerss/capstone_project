# capstone_project

#02/29/2024

You can pull the changes from the origin main(remote repo) to the local main by:

git pull origin

If main has the most recent branch merged to it, you can go to Steps, else switch to the most recent remote branch from your IDE to verify most recent changes work properly.


Steps:

The database structure is constantly changing as we are in the initial phase, so we start by refreshing the database:

http://localhost/capstone_project/database/refresh_database.php

Then, in current structure, we generate Company table:

http://localhost/capstone_project/database/dummy_data.php 

Now, you can start the project:

http://localhost/capstone_project/


NOTE:

For now, company table is working as a lookup table and admin table uses some static values for Adminname field and random out of the existing company id for foreign constraints reasons
