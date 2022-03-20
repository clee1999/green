LY Céline
PIEDAGNEL Bérenger
PIONNER Mathieu
TON Nathalie


### Getting started

```bash
cd docker/ && docker-compose up --build
```

Pour update la bdd :

```bash
docker-compose exec php-fpm bin/console d:s:u --force
```

To access directly from local host the PostgreSQL database container

```bash
psql postgresql://postgres:password@127.0.0.1:15432/dbtest
```
