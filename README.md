# checkpoint4_treasure_room 

this is a web service : inventory of the treasure room of the kingdom castle
it provides 3 services through 3 different routes :

- route /asset accessible with "GET" method that gives the list of all treasures stocked in the treasure room
- route /asset/{id} accessible with "GET" method that gives the details of one treasure from its id
- route /asset accessible with "POST" method that permits to add one treasure in the treasure room

# to set up :

- clone this repository : git clone https://github.com/ClaireV38/checkpoint4_treasure_room.git
- copy the follwing line : .env : DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name. 
paste it into an new ".env.local" file at the root of the project. replace following values as above :
db_user = usual user name for your database
db_password = usual password
db_name = database name (whichever)
- run composer install
- run yarn install
- run yarn encore dev
- run in that order :
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate
php bin/console doctrine:fixtures:load





