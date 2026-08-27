si responde el codifo las  preguntas  # Casa Horizonte - Laboratorio I

CRUD nativo en PHP para administrar habitaciones de un hospedaje. El proyecto usa la tabla `rooms` como entidad principal y conserva `reservations`, `users`, `positions` y `org_units` para extender el sistema en siguientes laboratorios.

## Equipo

- Nombre: Equipo Casa Horizonte
- Integrantes: completar con los 4 nombres y usuarios de GitHub antes de entregar.

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

- POO: `Room extends AbstractEntity`.
- Interfaz: `RoomRepository implements CrudRepository`.
- PDO: `RoomRepository` utiliza `prepare()` y parámetros nombrados en crear, editar y eliminar.
- CRUD: el formulario de `public/index.php` crea y actualiza; cada fila permite editar y eliminar.
- Namespaces: Composer carga automáticamente todo lo que está bajo `src/` con PSR-4.
- Validación: el controlador rechaza campos obligatorios vacíos, capacidades menores que uno y precios negativos.
- Correo: `src/Servicios/Mailer.php` envía la confirmación al correo del huésped mediante SMTP de Gmail y PHPMailer después de confirmar la reserva.
- Alerta: la página muestra una alerta JavaScript cuando la reserva se guardó correctamente.
- PDF y QR: el botón `PDF + QR` descarga un comprobante A4 con los datos de la reserva y un código QR de verificación. El enlace del correo usa `APP_URL`.
- Verificación web: el QR abre `verify.php`, valida una firma con `APP_KEY` y muestra los datos reales de la reserva desde MySQL. Para escanearlo desde cualquier lugar, `APP_URL` debe ser un dominio público o un túnel HTTPS, no `localhost`.

### Respuestas para la defensa técnica

- **¿Por qué una interfaz?** `CrudRepository` define las operaciones obligatorias sin imponer una clase padre. Así el controlador depende de un contrato y en el futuro se puede cambiar MySQL por otra implementación.
- **¿Qué cambiarían para agregar otro tipo de entidad?** Se crearía otra clase del dominio que extienda `AbstractEntity`, implementando `category()`. El repositorio nuevo implementaría `CrudRepository`; las clases actuales no tendrían que modificarse.
- **¿Qué método se sobrescribe?** `Room::category()` implementa el método abstracto de `AbstractEntity` y devuelve el tipo de habitación.
- **¿Qué riesgo evita `prepare()`?** Evita que valores enviados por el usuario se interpreten como SQL. Los parámetros nombrados se envían como datos separados de la consulta.
- **¿Cómo se maneja un error de conexión?** `Database` usa `PDO::ERRMODE_EXCEPTION`, captura `PDOException` y lanza un mensaje controlado. `public/index.php` captura el error y muestra una alerta.
- **¿Qué validaciones existen?** El controlador rechaza campos obligatorios vacíos, correos inválidos, fechas incorrectas, habitaciones inexistentes, conflictos de fechas, capacidades menores que uno y precios negativos.
- **¿Qué hace `composer.json`?** Declara dependencias y el mapeo PSR-4 `App\\` hacia `src/`. `composer install` instala librerías y genera `vendor/autoload.php`; sin él habría que cargar clases manualmente.
- **¿Por qué separar carpetas?** Cada namespace tiene una responsabilidad: modelos representan datos, controladores coordinan solicitudes, repositorios ejecutan persistencia, contratos definen interfaces y conexión administra PDO.

### Configuración del correo

Para Gmail, activa la verificación en dos pasos y crea una **contraseña de aplicación** en tu cuenta de Google. Colócala en `MAIL_PASSWORD`, sin espacios; no uses la contraseña normal de Gmail. Cambia `tu-correo@gmail.com` por la cuenta que enviará los mensajes. Después ejecuta `composer install` para instalar PHPMailer. Si Gmail rechaza el envío, la reserva ya guardada se conserva y la aplicación muestra la confirmación visual.

## Uso de IA

Se utilizó GitHub Copilot como apoyo para proponer la estructura inicial, revisar sintaxis y sugerir estilos de interfaz. El equipo validó y corrigió el resultado ejecutando el lint de PHP, revisando las consultas preparadas, probando manualmente el CRUD y verificando el diseño en navegador. Las decisiones finales y la explicación técnica deben ser comprendidas y defendidas por los cuatro integrantes.

## Proceso Kanban

Registrar en el tablero las tareas de base de datos, conexión PDO, modelo, CRUD, interfaz, pruebas y documentación. Mover las tarjetas entre columnas durante el periodo de trabajo y adjuntar el enlace de este repositorio a la tarjeta de Laboratorio I.

> Las preguntas sobre una tarjeta bloqueada y el trabajo individual de los cuatro integrantes deben responderse con el historial real del tablero y los commits del equipo; no deben inventarse dentro del código.
