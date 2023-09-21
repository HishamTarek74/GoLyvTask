
## GoLyv Task
- The goal of this project is to implement a building a fleet-management system (bus-booking)


### Docker Installation
- run following commands to build docker and run app
```
docker-compose up --build
```
```
docker-compose exec php php artisan migrate --seed
```
- visit : http://localhost:8000
- - email : demo@test.com
- - password : password

- for phpmyadmin credentials :
- visit : http://localhost:8001
- - username : your DB_USERNAME in .env file
- - password : your DB_PASSWORD in .env file
- - database name after login : your DB_DATABASE in .env file

``note: all data in db will be keept after down container``
```
docker-compose down
```

- you can see test cases by unit tests

```
RUN php artisan test 
```

### Apis EndPoints
- http://localhost:8000/api/bus/available-seats => Get Request to get available-seats
- http://localhost:8000/api/bus/book-seat => POST Request to book-seat 




