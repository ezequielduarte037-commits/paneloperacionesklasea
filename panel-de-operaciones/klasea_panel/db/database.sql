-- MySQL schema for Klase A panel authentication
-- Tables: propietarios (owners)

CREATE TABLE IF NOT EXISTS propietarios (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  modelo_barco ENUM('85','64','52','43','42','37','34') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample user (replace on production). Password = "demo1234".
-- INSERT with password_hash example (run from PHP or generate hash separately):
-- INSERT INTO propietarios (nombre, email, password, modelo_barco) VALUES (
--   'Usuario Demo', 'demo@example.com', '$2y$10$REPLACE_WITH_PASSWORD_HASH', '85'
-- );
