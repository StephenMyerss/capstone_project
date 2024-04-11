# capstone_project

#02/29/2024

You can pull the changes from the origin main(remote repo) to the local main by:

git pull origin

If main has the most recent branch merged to it, you can go to Steps, else switch to the most recent remote branch from your IDE to verify most recent changes work properly.


Steps to setup from Scratch:

http://localhost/capstone_project/database/refresh_database.php

Then, in current structure, we fill with random datasets:

http://localhost/capstone_project/database/dummy_data.php 

Now, you can start the project:


NOTE:

Super Admin login is accessible from url only
http://localhost/capstone_project/super_admin.php

Idea submission only appears when accessing with a valid company name in url
http://localhost/capstone_project/submit_idea.php?company=Apple
Here Apple can be replaced by any existing company

Gives an error for url wiithout company name or not existent company name
http://localhost/capstone_project/submit_idea.php?company=AppleSamsung
http://localhost/capstone_project/submit_idea.php

While submitting company name, it has to be unique regardless of case

The landing page has a link to access admin portal only

Extra Info:

submit_idea.php verifies the company info and redirects user to index page directly
Since session variables are used to set the company name in index.php and innovation_hub.php so for now user session can be reset/cleared by clicking the collaboration picture




