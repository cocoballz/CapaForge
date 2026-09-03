# Arquitectura

`capa-media` es un proyecto de Docker Compose, no un contenedor único. Cada componente se ejecuta aislado:

```text
Navegador
  └─ Apache o Nginx
       └─ PHP-FPM de la versión seleccionada
            └─ código montado desde Windows

Postgres, MySQL y Redis usan volúmenes Docker separados para conservar sus datos.
```

Apache y Nginx reciben las solicitudes HTTP. PHP-FPM ejecuta el código PHP; no se publica directamente al navegador. Las bases de datos quedan disponibles en `localhost` para herramientas locales, sin quedar expuestas a la red externa.

La carpeta de código se monta mediante un *bind mount*: Docker ve los archivos de Windows, pero no los copia a una imagen. Por eso un cambio de código se refleja inmediatamente.
