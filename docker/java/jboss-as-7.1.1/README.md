# JBoss AS 7.1.1.Final (legado)

Este perfil está reservado para la instalación existente de JBoss AS 7.1.1.Final. La instalación local encontrada usa Java 7 y `standalone-full.xml`.

No se incluye la distribución de JBoss, aplicaciones EAR/WAR, drivers propietarios ni configuraciones corporativas en Git. Para contenerizarlo correctamente se debe preparar una copia revisada, sin credenciales, de la distribución y sus despliegues.

El objetivo será un contenedor Linux con usuario no-root y Java compatible, validado primero contra la aplicación real. WildFly moderno se mantiene separado; no es un reemplazo directo de JBoss AS 7.1.1.
