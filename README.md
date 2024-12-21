
[Jira Planification](https://amineyoucode.atlassian.net/jira/software/projects/MNFCBCKND/boards/6?atlOrigin=eyJpIjoiMjYxOGI0Yzk0NmNlNDllOWIxNDM1NGFmZGE0N2JjOGQiLCJwIjoiaiJ9)

[Presentation](https://www.canva.com/design/DAGZ78QDrJU/1QZ--G15UZrSI7urWkmx5Q/edit?utm_content=DAGZ78QDrJU&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton)

# FUT Team Builder Backend

Welcome to the backend of the FUT Team Builder application. This backend is written in native PHP and manages players, clubs, and nationalities for building your ultimate football team.


# Installation

Clone the GitHub repository to your local machine:


```
git clone  https://github.com/your-username/fut-team-builder-backend.git
```

## Navigate to the project directory:
```
cd fut-team-builder-backend
```
## Composer to get Envirement variables library

```
composer install
```

## Import the database using the provided SQL file:

Locate the database.sql file in the database/ directory.

Import it into your MySQL database using phpMyAdmin or the command line:
```
mysql -u database user -p database name < database/database.sql
```


## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`HOST` `USERNAME` `PASSWORD` `DBNAME` `PORT`

On 

```
src/
├── public/index.php        # main file for displatch requests   
├── src/
│   ├── config/             # DIR Object Manage db connection
│   ├── Models/             # All classes OBJECTS .
│   ├── Router/             # All router api support
│   ├── Cntroller/          # All CRUD db manipilation daat
│   .env                	# Envirement variables for Database acces (dba) .
│   composer.yaml      		# Docker compoer config file
└── README.md               # Project documentation.
```



