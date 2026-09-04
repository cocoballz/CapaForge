# Operación diaria

## Inicio

```powershell
# Servicios de datos
docker compose --profile data up -d

# Servidor web y PHP 8.5
docker compose --profile web up -d

# Perfiles de compatibilidad cuando se necesiten
docker compose --profile php53 --profile php71 --profile php81 up -d

# PHP 5.6 con una aplicación que conserva localhost:3306 y MySQL de XAMPP
# Primero inicie MySQL en XAMPP.
docker compose --profile web --profile php56 --profile xampp-db up -d --build
```

El perfil `xampp-db` no inicia ni modifica MySQL de Docker. Crea un puente privado desde el `localhost:3306` del contenedor PHP 5.6 hacia `host.docker.internal:3306`, que corresponde a la máquina Windows. Es útil para aplicaciones legadas que tienen esa conexión escrita en el código.

## Registros

```powershell
docker compose logs -f nginx
docker compose logs -f apache
docker compose logs -f php-fpm-8.5
```

## Detención

```powershell
docker compose down
```

Este comando no borra los datos de las bases. `docker compose down -v` sí borra sus volúmenes y es destructivo.

## Bases de datos desde Windows

| Servicio | Host | Puerto |
|---|---|---:|
| Postgres | `localhost` | 8520 |
| MySQL | `localhost` | 8521 |
| Redis | `localhost` | 8522 |

Use las credenciales definidas en `.env`. Las contraseñas no deben versionarse en Git.
