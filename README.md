# Casa Horizonte - Laboratorio I

CRUD nativo en PHP para administrar habitaciones de un hospedaje. El proyecto usa la tabla `rooms` como entidad principal y conserva `reservations`, `users`, `positions` y `org_units` para extender el sistema en siguientes laboratorios.

## Equipo

**Nombre:** Equipo Casa Horizonte

**Integrantes:**
- Allison Gabriela Garcia Ponce **GP-64074-23**
- Brandon Misael Rodriguez Ayala **RA-60677-21**
- Joseline Abigail Torres Jurado **TJ-64893-23**
- Maria de los Angeles Acosta Ardon **AA-64964-23**
- Oscar Alexander Cerón Hernandez **CH-64069-23**

## Requisitos

- PHP 8.1 o superior con las extensiones `pdo` y `pdo_mysql`.
- MySQL 8 o MariaDB.
- Composer 2.

## Instalacion

1. Clonar el repositorio y entrar a su carpeta.
2. Crear la base de datos ejecutando `database/create_full_schema.sql` en MySQL.
3. Instalar el autoload PSR-4:

```bash
composer install
```

4. Configurar las variables de entorno usando `.env.example` como referencia:

```text
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=org_chart
DB_USER=root
DB_PASS=
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-correo@gmail.com
MAIL_PASSWORD=tu-contrasena-de-aplicacion
MAIL_FROM=tu-correo@gmail.com
APP_URL=http://localhost:8000
APP_KEY=cambia-esta-clave-secreta
```

En Windows PowerShell, por ejemplo:

```powershell
$env:DB_HOST="127.0.0.1"
$env:DB_PORT="3306"
$env:DB_NAME="org_chart"
$env:DB_USER="root"
$env:DB_PASS=""
$env:MAIL_FROM="reservas@tudominio.com"
$env:MAIL_HOST="smtp.gmail.com"
$env:MAIL_PORT="587"
$env:MAIL_USERNAME="tu-correo@gmail.com"
$env:MAIL_PASSWORD="tu-contrasena-de-aplicacion"
$env:MAIL_FROM="tu-correo@gmail.com"
$env:APP_URL="http://localhost:8000"
$env:APP_KEY="cambia-esta-clave-secreta"
```

5. Iniciar el servidor local:

```bash
php -S localhost:8000 -t public
```

Abrir `http://localhost:8000`.

## Estructura

- `public/`: punto de entrada HTML/PHP y estilos.
- `src/Conexion/`: conexión PDO con excepciones y consultas nativas.
- `src/Controladores/`: validación y flujo de solicitudes.
- `src/Modelos/`: clases del dominio; `Room` hereda de `AbstractEntity`.
- `src/Repositorios/`: CRUD con consultas preparadas.
- `src/Contratos/`: interfaz `CrudRepository` implementada por el repositorio.
- `database/`: esquema completo y datos iniciales.

## Evidencia técnica para Demo Day



### Respuestas para la defensa técnica



### Configuración del correo



## Uso de IA



## Proceso Kanban

Registrar en el tablero las tareas de base de datos, conexión PDO, modelo, CRUD, interfaz, pruebas y documentación. Mover las tarjetas entre columnas durante el periodo de trabajo y adjuntar el enlace de este repositorio a la tarjeta de Laboratorio I.

> Las preguntas sobre una tarjeta bloqueada y el trabajo individual de los cuatro integrantes deben responderse con el historial real del tablero y los commits del equipo; no deben inventarse dentro del código.
