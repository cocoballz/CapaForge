# Operación diaria

## Inicio

```powershell
# Servicios de datos
docker compose --profile data up -d

# Servidor web y PHP 8.5
docker compose --profile web up -d

# Perfiles de compatibilidad cuando se necesiten
docker compose --profile php53 --profile php71 --profile php81 up -d
```

## Registros

```powershell
docker compose logs -f nginx
docker compose logs -f apache
docker compose logs -f php8
```

## Detención

```powershell
docker compose down
```

Este comando no borra los datos de las bases. `docker compose down -v` sí borra sus volúmenes y es destructivo.

## Bases de datos desde Windows

| Servicio | Host | Puerto |
|---|---|---:|
| Postgres | `localhost` | 5432 |
| MySQL | `localhost` | 3306 |
| Redis | `localhost` | 6379 |

Use las credenciales definidas en `.env`. Las contraseñas no deben versionarse en Git.
