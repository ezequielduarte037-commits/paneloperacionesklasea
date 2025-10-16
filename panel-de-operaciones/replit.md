# Klase A Panel - Replit Environment

## Overview
This is a PHP-based boat panel management system with authentication. The panel displays operational data for different boat models (Klase A) and provides owner-specific dashboards.

## Recent Changes (October 16, 2025)
- Migrated from MySQL to SQLite for database storage
- Configured PHP development server on port 5000
- Fixed URL paths to work without `/klasea_panel/` prefix
- Created demo user for testing
- Set up Replit environment for development

## Project Architecture
- **Frontend**: Static HTML with Tailwind CSS and Chart.js for data visualization
- **Backend**: PHP 8.2 with PDO for database operations
- **Database**: SQLite (file-based at `klasea_panel/db/klasea_panel.db`)
- **Authentication**: Session-based with password hashing

## File Structure
```
klasea_panel/
├── barcos/           # Panel pages for different boat models
│   ├── panel_34.php through panel_85.php
│   └── panel_base.php  # Base template that injects user data
├── db/
│   ├── config.php    # Database connection (SQLite)
│   ├── database.sql  # Original MySQL schema (reference)
│   └── klasea_panel.db  # SQLite database file (gitignored)
├── auth_guard.php    # Session authentication middleware
├── index.html        # Base panel template
├── login.php         # Login page
├── logout.php        # Logout handler
└── validate_login.php  # Login validation

init_demo_user.php    # CLI script to create demo user (at project root, not web-accessible)
```

## Demo Credentials
- **Email**: demo@example.com
- **Password**: demo1234
- **Boat Model**: 85

## Database Schema
Table: `propietarios` (owners)
- id (INTEGER PRIMARY KEY)
- nombre (VARCHAR 120)
- email (VARCHAR 160, UNIQUE)
- password (VARCHAR 255, hashed)
- modelo_barco (TEXT, one of: 85, 64, 52, 43, 42, 37, 34)
- created_at (DATETIME)

## Workflow
1. User accesses `/login.php`
2. Validates credentials against SQLite database
3. Redirects to model-specific panel (e.g., `/barcos/panel_85.php`)
4. Panel loads base `index.html` and injects user info + logout button
5. User can logout via the top bar

## Development Notes
- PHP server runs on `0.0.0.0:5000` (required for Replit)
- Database automatically initializes schema on first connection
- Session-based authentication with server-side validation
- Each boat model has its own panel page with access control

## Adding New Users
To add new users, you can use the `init_demo_user.php` script (located in project root for security) as reference or create a simple PHP script to hash passwords and insert into the database. 

To run the demo user initialization script:
```bash
php init_demo_user.php
```

Always run user creation scripts from the command line, never expose them in the webroot.
