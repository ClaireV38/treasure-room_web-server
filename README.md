# checkpoint4_treasure_room 

this is the inventory of the treasure room that repertories all assets discovered by each adventurer of the kingdom

each adventurer has the possibility to :
- see last 3 items deposited on the home page
- see the details of each item
- acces to the list of all items
- filter them by category or by owner
- login to see the list of his own items
- add / edit and delete its own items (with photo upload)
- vote for its favorites assets among the possession of the other adventurers
- access to the ranking of the votes

#to set up :

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





