# PrivateGranja

Aplicación web para administrar una finca agrícola: parcelas, cultivos, mantenimientos y cosechas, con control de acceso por roles y permisos.

Cada usuario tiene un rol, y cada rol define qué módulos puede ver y qué acciones puede hacer en ellos.

## Funcionalidades

- Inicio de sesión, cierre de sesión y recuperación de contraseña por correo.
- Edición del perfil y cambio de contraseña.
- Registro de parcelas con tamaño, ubicación, estado y responsable. Al crear una parcela se le asignan uno o varios cultivos.
- Registro de cultivos con tipo, fechas de siembra y de cosecha, y estado.
- Consulta de los cultivos asignados a cada parcela.
- Registro de mantenimientos de cada parcela.
- Registro de cosechas de cada cultivo, con cantidad y unidad de medida.
- Gestión de roles y de los permisos de cada rol.
- Búsqueda y paginación en todos los listados.
- Menú lateral que muestra solo los módulos permitidos para el rol del usuario.

## Tecnologías

| Tecnología | Uso |
|---|---|
| PHP 8.2 | Lenguaje del backend |
| Laravel 12 | Framework |
| Blade | Vistas |
| Bootstrap 5 y plantilla NiceAdmin (BootstrapMade) | Interfaz del panel administrativo |
| Bootstrap Icons y Boxicons | Íconos |
| jQuery y SweetAlert2 | Mensajes de confirmación y de error |
| SQLite o MySQL | Base de datos |
| Mailtrap (opcional) | Envío de los correos de recuperación de contraseña |

Los archivos de la interfaz ya están incluidos en `public/assets`, así que no es necesario compilar nada con Node.

## Roles y permisos

- Cada usuario tiene un único rol.
- Cada rol tiene permisos por módulo: ver, crear, actualizar y eliminar.
- El rol **Administrador** tiene acceso a todos los módulos, sin importar sus permisos.
- Los permisos se revisan en cada ruta y también en el menú lateral, que oculta los módulos no permitidos.
- Los roles se crean y editan desde el módulo **Roles**.

La aplicación no tiene registro público de usuarios: las cuentas se crean con los seeders. 
## Módulos

| Módulo | Ruta | Qué registra |
|---|---|---|
| Parcelas | `/parcelas` | Tamaño, ubicación, estado y usuario responsable |
| Cultivos | `/cultivos` | Tipo, fecha de siembra, fecha de cosecha y estado |
| Cultivos por parcela | `/cultivoparcelas` | Cultivos asignados a cada parcela (solo consulta) |
| Mantenimientos | `/mantenimientos` | Trabajos hechos en una parcela, con descripción y fecha |
| Cosechas | `/cosechas` | Cantidad recolectada de un cultivo, unidad y fecha |
| Roles | `/rols` | Roles y sus permisos |

Cada módulo sigue la misma estructura de rutas: listado en `/modulo`, formulario de creación en `/modulo/create`, edición en `/modulo/edit/{id}`, y las acciones `store`, `update` y `delete/{id}`.

Rutas de la cuenta:

| Ruta | Pantalla |
|---|---|
| `/login` | Inicio de sesión |
| `/forgot_password` | Recuperación de contraseña |
| `/profile/edit` | Edición del perfil |
| `/profile/change-password` | Cambio de contraseña |

## Requisitos

- PHP 8.2 o superior, con la extensión `pdo_sqlite` (o `pdo_mysql` si se usa MySQL)
- Composer
- MySQL o MariaDB, solo si no se usa SQLite

## Instalación

1. Clonar el repositorio y entrar a la carpeta:

   ```bash
   git clone https://github.com/JesusEfrenGomezU/PrivateGranjaLaravel.git
   cd PrivateGranjaLaravel
   ```

2. Instalar las dependencias de PHP:

   ```bash
   composer install
   ```

3. Crear el archivo de variables de entorno a partir de la plantilla:

   ```bash
   cp .env.example .env
   ```

   En Windows (CMD): `copy .env.example .env`

4. Generar la clave de la aplicación:

   ```bash
   php artisan key:generate
   ```

5. Configurar la base de datos. La plantilla viene lista para **SQLite**, que no necesita servidor.

   Para usar **MySQL**, crear una base de datos vacía (por ejemplo, desde phpMyAdmin o con `CREATE DATABASE private_granja;`) y cambiar en `.env` la línea `DB_CONNECTION=sqlite` por:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=private_granja
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Crear las tablas y cargar los datos iniciales:

   ```bash
   php artisan migrate --seed
   ```

   Con SQLite, el comando pregunta si crear el archivo `database/database.sqlite`. Responder `yes`.

7. Iniciar el servidor:

   ```bash
   php artisan serve
   ```

   La aplicación queda disponible en `http://localhost:8000`.

Si en el paso 6 aparece el error `could not find driver`, habilitar la extensión correspondiente (`pdo_sqlite` o `pdo_mysql`) en el archivo `php.ini` y volver a ejecutar el comando.

## Usuarios de prueba

Los seeders crean los permisos, los roles y estas cuentas:

| Correo | Contraseña | Rol |
|---|---|---|
| manueld@yopmail.com | 1234 | Administrador |
| anad@yopmail.com | 1234 | Gestor de Cultivos |
| jhond@yopmail.com | 1234 | Gestor de Secciones |

Son cuentas de prueba para uso local. No deben usarse en un servidor público.

El rol Gestor de Secciones no tiene módulos asignados en esta versión, así que esa cuenta entra con el menú vacío.

## Correo

La recuperación de contraseña envía un enlace por correo. Con la configuración por defecto (`MAIL_MAILER=log`), los correos no se envían: se escriben en `storage/logs/laravel.log`, y el enlace se puede copiar desde ahí.

Para enviarlos de verdad, configurar un servicio SMTP, por ejemplo Mailtrap, en las variables `MAIL_*` del `.env`.

## Comandos útiles

| Comando | Descripción |
|---|---|
| `php artisan serve` | Inicia el servidor de desarrollo |
| `php artisan migrate --seed` | Crea las tablas y carga los datos iniciales |
| `php artisan migrate:fresh --seed` | Borra todas las tablas y las vuelve a crear con los datos iniciales |

## Estructura del proyecto

```
PrivateGranjaLaravel/
├── app/
│   ├── Helpers/
│   │   └── RolHelper.php                Verificación de roles y permisos
│   ├── Http/
│   │   ├── Controllers/                 Controladores de cada módulo y de la cuenta
│   │   ├── Middleware/
│   │   │   └── AuthorizedMiddleware.php Protección de rutas por permiso
│   │   └── Requests/                    Validación del inicio de sesión
│   └── Models/                          Modelos de las tablas
├── database/
│   ├── migrations/                      Estructura de la base de datos
│   └── seeders/                         Permisos, roles y usuarios de prueba
├── public/
│   └── assets/                          Plantilla NiceAdmin: estilos, scripts e imágenes
├── resources/
│   └── views/
│       ├── layouts/                     Plantilla general: encabezado, menú lateral y pie
│       ├── auth/                        Inicio de sesión, perfil y contraseñas
│       ├── home/                        Página de inicio
│       ├── parcelas/                    Listado, creación y edición de cada módulo
│       ├── cultivos/
│       ├── cultivoparcelas/
│       ├── mantenimientos/
│       ├── cosechas/
│       └── rols/
├── routes/
│   ├── web.php                          Rutas principales
│   ├── auth.php                         Rutas de la cuenta
│   └── web/                             Rutas de cada módulo
├── .env.example                         Plantilla de variables de entorno
└── composer.json
```

## Base de datos

| Tabla | Columnas principales | Relaciones |
|---|---|---|
| rols | id, name | — |
| users | id, first_name, last_name, document, email, password, rol_id | rol_id → rols |
| permissions | id, name, description, module | — |
| rol_permissions | rol_id, permission_id | rol_id → rols, permission_id → permissions |
| cultivos | id, tipo, siembra, cosecha, estado | — |
| parcelas | id, tamano, ubicacion, estado, users_id | users_id → users |
| cultivoparcelas | id, Descripcion, fecha_registro, parcela_id, cultivo_id | parcela_id → parcelas, cultivo_id → cultivos |
| mantenimientos | id, parcela_id, Descripcion, FechaMantenimiento | parcela_id → parcelas |
| cosechas | id, cultivo_id, Recolectado, Medida, FechaCosecha | cultivo_id → cultivos |

Todas las tablas tienen además las columnas `created_at` y `updated_at`. Laravel crea también sus tablas internas: `sessions`, `password_reset_tokens`, `cache`, `cache_locks`, `jobs`, `job_batches` y `failed_jobs`.

Comportamiento al borrar registros:

- Al borrar un rol se borran también los usuarios que lo tienen.
- Al borrar una parcela se borran sus mantenimientos y sus asignaciones de cultivos.
- Al borrar un cultivo se borran sus cosechas, pero no se puede borrar mientras esté asignado a una parcela.
