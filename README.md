### Developer Test Task
1. Install laravel with Vue.js from scratch.
2. Create entity and migration for users (id, username, password, first_name, last_name)
3. Create console command to add user in by entering first_name, last_name.
* Username and password should be generated automatically.
4. Create controller with actions and view pages (login, create) with forms and validation. CSS just default bootstrap styles.
5. Create controller, action and view for page list users with filter search by name and username
6. Create action delete at user list page with the help of async Job
7. All pages should have routes and user list page should be visible only for authorised (logined) users
8. create git repository and send link for checking

### HOWTO RUN PROJECT
docker-compose up
composer install inside php container
node ^16.0 required to run npm install & npm run dev
run migrations inside php container