# currency_exchange

## How to run

### Go to repository folder and run docker
```bash
cd currency_exchange && docker-compose up -d --build
```

### Go to src folder and install composer denpendencies
```bash
cd src && docker-compose run --rm composer install && cp .env.example .env
```

### Installation done, run test
```bash
docker-compose run --rm artisan test
```

### Clean up
```bash
docker-compose down
```
