### Getting started

```bash
cd docker/ && docker-compose up --build
```

To access directly from local host the PostgreSQL database container

```bash
psql postgresql://postgres:password@127.0.0.1:15432/dbtest
```
