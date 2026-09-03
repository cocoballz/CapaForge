# CapaForge

CapaForge es una plataforma local de capa media para ejecutar aplicaciones PHP y Java con servicios web y datos aislados. Docker Compose agrupa los componentes en un único proyecto, pero cada servicio se ejecuta en su propio contenedor.

El código de las aplicaciones sigue estando en Windows; Docker lo monta como una carpeta compartida. Esto permite cambiar archivos sin reconstruir imágenes.

## Contenido

- [Inicio rápido](#inicio-rápido)
- [Dónde colocar el código](#dónde-colocar-el-código)
- [Servicios disponibles](#servicios-disponibles)
- [Documentación detallada](#documentación-detallada)
- [Operación](#operación)
- [Seguridad y datos](#seguridad-y-datos)

## Inicio rápido

1. Instale Docker Desktop.
2. Cree su archivo local de variables:

   ```powershell
   Copy-Item .env.example .env
   ```

3. Defina la ruta raíz de sus aplicaciones y cambie las contraseñas locales en `.env`:

   ```env
   PROJECTS_ROOT=C:/Trabajo/proyectos
   ```

4. Inicie servicios de datos y PHP 8.5 con Nginx:

   ```powershell
   docker compose --profile data --profile web up -d
   ```

5. Consulte el estado:

   ```powershell
   docker compose ps
   ```

## Dónde colocar el código

`PROJECTS_ROOT` es dinámico. Puede apuntar a cualquier carpeta de Windows y no requiere editar `compose.yaml`.

```text
C:\Trabajo\proyectos\
├── sistema-legado\
│   └── index.php
├── portal-moderno\
│   └── public\
│       └── index.php
└── java\
    └── deployments\
```

Dentro de los contenedores, esa carpeta se ve como `/var/www`. La carpeta `projects/` incluida en este repositorio contiene ejemplos y puede conservarse como referencia; no es obligatorio almacenar allí los proyectos reales.

Consulte [Proyectos y rutas](docs/02-proyectos-y-rutas.md) para la convención `index.php` / `public/index.php` y el diseño por puertos.

## Servicios disponibles

| Grupo | Servicios | Perfil de Compose |
|---|---|---|
| Web | Nginx, Apache | `web`, `apache` |
| PHP | PHP-FPM 5.3, 5.6, 7.1, 7.4, 8.1 y 8.5 | `php53`, `php56`, `php71`, `php7`, `php81`, `php8` |
| Datos | Postgres 16, MySQL 8.4, Redis 7 | `data` |
| Herramientas | Workspace Alpine | `workspace` |
| Java moderno | WildFly 35 con JDK 17 | `java` |
| Java legado | JBoss AS 7.1.1.Final | pendiente de empaquetar con la distribución autorizada |

Ejemplos:

```powershell
# PHP heredado
docker compose --profile php53 up -d

# PHP 8.1
docker compose --profile php81 up -d

# PHP 5.6 heredado
docker compose --profile php56 up -d

# Apache con PHP 8.5
docker compose --profile apache up -d --build

# Consola sobre la carpeta de proyectos montada
docker compose --profile workspace up -d
docker compose exec workspace sh
```

## Documentación detallada

| Documento | Qué explica |
|---|---|
| [Arquitectura](docs/01-arquitectura.md) | Contenedores, redes, montajes y responsabilidades de cada capa. |
| [Proyectos y rutas](docs/02-proyectos-y-rutas.md) | `PROJECTS_ROOT`, estructura de aplicaciones, resolución de `index.php` y puertos por PHP. |
| [Versiones de PHP](docs/03-versiones-php.md) | Perfiles PHP, `php.ini` separado, depuración y compatibilidad. |
| [Operación diaria](docs/04-operacion.md) | Inicio, detención, registros y conexión desde Windows. |
| [Imágenes y versiones](docs/05-imagenes-y-versiones.md) | Imágenes usadas, base Linux, persistencia y datos creados. |
| [Java/JBoss legado](docker/java/jboss-as-7.1.1/README.md) | Requisitos para contenerizar JBoss AS 7.1.1.Final de forma segura. |
| [WildFly moderno](docker/java/wildfly/README.md) | Alcance del perfil Java actual. |
| [Datos persistentes](docker/data/README.md) | Volúmenes, credenciales y persistencia. |

## Operación

```powershell
# Registros
docker compose logs -f nginx
docker compose logs -f apache

# Detener sin eliminar datos
docker compose down

# Eliminar también datos de Postgres, MySQL y Redis (destructivo)
docker compose down -v
```

Las instrucciones completas están en [Operación diaria](docs/04-operacion.md).

## Seguridad y datos

- `.env` contiene valores locales y no se versiona.
- Use cuentas de aplicación para Postgres y MySQL; no use root desde las aplicaciones.
- Los puertos de datos se exponen solo en `localhost`.
- PHP 5.3 y PHP 7.1 son perfiles de compatibilidad local, no bases para producción.
- No copie aplicaciones, controladores propietarios, dominios corporativos ni credenciales dentro del repositorio.

## Versionado

```powershell
git init
git add .
git commit -m "Initial CapaForge environment"
```
