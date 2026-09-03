# Versiones de PHP y php.ini

Cada versión debe tener su propio `php.ini`. No conviene compartir uno entre PHP 5.3, 7.1, 8.1 y 8.5: varias directivas, extensiones y valores válidos cambian entre versiones.

La configuración debe partir de una base común, pero cada servicio puede tener su archivo propio:

```text
docker/php/5.3/php.ini
docker/php/7.1/php.ini
docker/php/8.1/php.ini
docker/php/8.5/php.ini
```

Recomendaciones para desarrollo local:

- `display_errors=On`: útil localmente; nunca para producción.
- `error_reporting=E_ALL`: permite detectar incompatibilidades al migrar.
- `log_errors=On`: conserva errores en registros del servicio.
- Xdebug: habilitarlo solo en la versión y proyecto que se esté depurando, porque añade consumo y latencia.

PHP 5.3, PHP 5.6 y PHP 7.1 son perfiles de compatibilidad. Deben mantenerse aislados y no usarse para un despliegue productivo nuevo.

## Añadir una versión

Para incorporar una versión se crea un servicio nuevo en `compose.yaml`, una carpeta `docker/php/php-fpm-X.Y/` con su `php.ini`, y un VirtualHost de Apache/Nginx si se requiere acceso HTTP.

PHP 5.6 se incluye como referencia con el perfil `php56` y la imagen definida por `PHP56_IMAGE` en `.env`.
