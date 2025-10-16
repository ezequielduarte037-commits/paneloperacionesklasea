# Klase A Panel - Guía rápida (XAMPP / Hosting)

## 1) Requisitos
- PHP 8.0+ con extensiones `pdo_mysql`
- MySQL 5.7+/8+
- Apache (o Nginx)

## 2) Crear base de datos
1. Crear DB:
```sql
CREATE DATABASE klasea_panel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
2. Importar esquema:
```sql
SOURCE ./db/database.sql; -- o copie el contenido en su cliente SQL
```

## 3) Usuario demo (contraseña con password_hash)
Genere un hash en PHP (puede usar una página temporal):
```php
<?php echo password_hash('demo1234', PASSWORD_DEFAULT); ?>
```
Luego inserte el usuario:
```sql
INSERT INTO propietarios (nombre, email, password, modelo_barco)
VALUES ('Usuario Demo', 'demo@example.com', 'PEGUE_AQUI_EL_HASH', '85');
```

## 4) Configurar credenciales
Edite `db/config.php` si sus credenciales no son las por defecto:
- `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`

## 5) Estructura de archivos a publicar
- Suba el directorio `klasea_panel/` completo a su hosting o a `htdocs/` (XAMPP)
- URL de acceso:
  - `http://localhost/klasea_panel/login.php`

## 6) Flujo
- Ir a `login.php` y autenticarse
- Redirige automáticamente a `barcos/panel_85.php` (o el que corresponda al modelo)
- Botón "Cerrar sesión" en la barra superior

## 7) Sobre el diseño
- El panel reutiliza el HTML original de `index.html` y añade una barra superior con el modelo y el propietario.
- Se mantiene Tailwind (CDN) y Font Awesome si estaban en el HTML.

## 8) Personalización por modelo
- Para cambiar detalles por modelo, edite `barcos/panel_XX.php` o modifique `panel_base.php` para inyectar variaciones según `window.KLASEA_MODELO`.

## 9) Troubleshooting
- Si ve "Database connection error": revise `db/config.php` y que el servidor MySQL esté activo.
- Si el login falla: asegúrese de que el email exista y que el hash coincida.
- Verifique que `session.save_path` sea escribible si la sesión no persiste.
