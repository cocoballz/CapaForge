# Proyectos, rutas y puertos

## Carpeta de código

La variable `PROJECTS_ROOT` de `.env` es dinámica. Puede apuntar a cualquier ruta local, por ejemplo:

```env
PROJECTS_ROOT=D:/Develop/projects
```

Cada subcarpeta representa un proyecto. Esa carpeta se monta como `/var/www` en los contenedores.

```text
D:\Develop\projects\
├── ci-php\
│   └── index.php
└── portal-moderno\
    └── public\
        └── index.php
```

CapaForge busca primero `<proyecto>/index.php`; si no existe, busca `<proyecto>/public/index.php`. Los cambios que haga en Windows se ven inmediatamente: no hay que copiar ni reconstruir el proyecto PHP.

## El puerto selecciona PHP

No se usan subdominios. El puerto selecciona la versión de PHP y el primer segmento de la URL selecciona el proyecto.

| PHP | Nginx | Apache |
|---|---|---|
| 5.3 | `http://localhost:8500` | `http://localhost:8510` |
| 5.6 | `http://localhost:8501` | `http://localhost:8511` |
| 7.1 | `http://localhost:8502` | `http://localhost:8512` |
| 7.4 | `http://localhost:8503` | `http://localhost:8513` |
| 8.1 | `http://localhost:8504` | `http://localhost:8514` |
| 8.5 | `http://localhost:8505` | `http://localhost:8515` |

Ejemplos para un proyecto `ci-php`:

```text
http://localhost:8501/ci-php  → Nginx + PHP 5.6
http://localhost:8505/ci-php  → Nginx + PHP 8.5
http://localhost:8511/ci-php  → Apache + PHP 5.6
```

Antes de abrir una URL, inicie el perfil PHP correspondiente. Por ejemplo, para PHP 5.6 con Nginx:

```powershell
docker compose --profile web --profile php56 up -d
```
