# CapaForge — English quick-start

CapaForge is a local middleware environment for PHP, Java, web servers, and data services. Each service runs in its own Docker container; source code stays on Windows and is mounted into containers.

## First run

1. Install and start Docker Desktop.
2. Create your local configuration:

   ```powershell
   Copy-Item .env.example .env
   ```

3. Set the source-code folder in `.env`:

   ```env
   PROJECTS_ROOT=D:/Develop/projects
   ```

4. Start the required web server and PHP runtime. For Nginx + PHP 5.6:

   ```powershell
   docker compose --profile web --profile php56 up -d
   ```

5. Verify the services:

   ```powershell
   docker compose ps
   ```

## Projects and URLs

Place projects below `PROJECTS_ROOT`. CapaForge first looks for `<project>/index.php`, then for `<project>/public/index.php`.

The **port selects PHP** and the **path selects the project**. No subdomains or `hosts` file configuration are needed.

| PHP | Nginx | Apache |
|---|---:|---:|
| 5.3 | 8500 | 8510 |
| 5.6 | 8501 | 8511 |
| 7.1 | 8502 | 8512 |
| 7.4 | 8503 | 8513 |
| 8.1 | 8504 | 8514 |
| 8.5 | 8505 | 8515 |

For a `ci-php` folder, use `http://localhost:8501/ci-php` to run it through Nginx with PHP 5.6. Use `http://localhost:8505/ci-php` for PHP 8.5.

## XAMPP MySQL compatibility bridge

For a legacy PHP 5.6 application that already uses `localhost:3306`, start MySQL in Windows XAMPP and use the optional bridge. It keeps application code and credentials unchanged:

```powershell
docker compose --profile web --profile php56 --profile xampp-db up -d --build
```

The `xampp-db` profile provides a private compatibility socket for legacy `localhost:3306` connections and proxies it to `host.docker.internal:3306` on Windows. It does not publish an additional Windows port and does not use CapaForge MySQL.

## Data services

Postgres, MySQL, and Redis use ports 8520, 8521, and 8522 respectively and are bound to `localhost`. Start them with:

```powershell
docker compose --profile data up -d
```

See the Spanish [full documentation](README.md) for architecture, legacy Java/JBoss scope, data persistence, versioning, and operational notes.
