# Proyectos y rutas

## Carpeta raíz dinámica

La variable `PROJECTS_ROOT` del archivo `.env` indica dónde están todos los proyectos. Puede cambiarse sin editar `compose.yaml`.

```env
PROJECTS_ROOT=C:/Trabajo/proyectos
```

Esa ruta se monta dentro de los servicios web como `/var/www`.

```text
C:\Trabajo\proyectos\sistema1  ->  /var/www/sistema1
```

Después de cambiarla, recree los servicios que montan el código:

```powershell
docker compose --profile web --profile apache up -d
```

## Convención de punto de entrada

Para evitar configurar cada proyecto individualmente, todos deben usar una de estas dos formas:

```text
C:\Trabajo\proyectos\sistema1\index.php
```

o, para Laravel y aplicaciones similares:

```text
C:\Trabajo\proyectos\sistema1\public\index.php
```

El enrutador web puede resolver dinámicamente en este orden:

1. `sistema1/index.php`.
2. Si no existe, `sistema1/public/index.php`.

Esto permite usar la misma URL base, `http://localhost:PUERTO/sistema1`, sin crear un VirtualHost por aplicación. Los proyectos que no respeten una de esas convenciones sí requerirán una regla específica.

## Puertos por versión

La alternativa recomendada para comparar la misma aplicación es usar un puerto por PHP, no un puerto por proyecto:

| Puerto propuesto | PHP-FPM | Ejemplo |
|---:|---|---|
| 8080 | PHP 5.3 | `http://localhost:8080/sistema1` |
| 8081 | PHP 7.1 | `http://localhost:8081/sistema1` |
| 8085 | PHP 8.1 | `http://localhost:8085/sistema1` |
| 8089 | PHP 8.5 | `http://localhost:8089/sistema1` |

La ruta identifica el proyecto y el puerto escoge el intérprete. El mismo `sistema1` puede ejecutarse con dos versiones para apoyar una migración.
