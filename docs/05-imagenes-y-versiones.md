# Imágenes, sistemas operativos y versiones

Docker no instala un sistema operativo completo por servicio; cada contenedor usa una imagen Linux base con solo las bibliotecas necesarias.

| Servicio | Imagen actual | Base Linux esperada | Estado |
|---|---|---|---|
| PHP 5.3 | `devilbox/php-fpm-5.3:latest` | Imagen comunitaria heredada | Solo compatibilidad local |
| PHP 5.6 | `devilbox/php-fpm:5.6-prod` | Imagen comunitaria heredada | Solo compatibilidad local |
| PHP 7.1 | `php:7.1-fpm-alpine` | Alpine Linux | Legado |
| PHP 7.4 | `php:7.4-fpm-alpine` | Alpine Linux | Legado |
| PHP 8.1 | `php:8.1-fpm-alpine` | Alpine Linux | Compatibilidad |
| PHP 8.5 | `php:8.5-fpm-alpine` | Alpine Linux | Actual |
| Nginx | `nginx:1.27-alpine` | Alpine Linux | Web |
| Apache | `httpd:2.4-alpine` | Alpine Linux | Web |
| Postgres | `postgres:16-alpine` | Alpine Linux | Datos |
| Redis | `redis:7-alpine` | Alpine Linux | Datos |
| MySQL | `mysql:8.4` | Linux, variante mantenida por MySQL | Datos |
| WildFly | `quay.io/wildfly/wildfly:35.0.1.Final-jdk17` | Linux con JDK 17 | Java moderno |

## Datos creados al iniciar

Al crear el entorno no se copian proyectos ni datos reales. Docker crea:

- Un volumen para Postgres.
- Un volumen para MySQL.
- Un volumen para Redis.
- Una red privada del proyecto para que los servicios se comuniquen por nombre.
- Usuarios y bases locales definidos en `.env`.

Las imágenes contienen el software; los volúmenes contienen los datos que sobreviven al reinicio. Los archivos fuente se leen desde `PROJECTS_ROOT` y siguen siendo propiedad de Windows.

## Fijar versiones de datos

Las variables `POSTGRES_IMAGE`, `MYSQL_IMAGE` y `REDIS_IMAGE` en `.env` determinan qué imagen usa el entorno. Para pruebas iniciales se usan versiones mayores mantenidas. Cuando un equipo haya validado una combinación, puede reemplazar la etiqueta por una versión menor exacta o por un digest de Docker para obtener una ejecución idéntica entre máquinas.

No cambie una versión mayor de Postgres o MySQL sobre el mismo volumen. Para una actualización mayor cree un volumen nuevo y migre mediante respaldo y restauración.
