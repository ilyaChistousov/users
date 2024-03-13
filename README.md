### Installation:
1) Run docker services:
```
docker-compose up -d --build
```
2) Install dependencies
```
docker-compose exec app composer install
```
### Using
1) From console:
```
docker-compose exec app php/app/public.php -method -param
```

### Methods: all, getOne "id", delete "id", create "name"
