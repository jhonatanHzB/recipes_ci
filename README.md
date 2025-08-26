# Recetario en CodeIgniter 4

Aplicación web modular para gestión y publicación de recetas, con frontend público y panel de administración. Incluye calificaciones, categorías, etiquetas, carrusel de destacados, páginas informativas, y reportes en Excel.

## Características

- Front (público)
  - Página de inicio con carrusel y secciones de recetas.
  - Página de receta individual con ingredientes, instrucciones, tiempos por fase y dificultad.
  - Calificación de recetas (estrellas) y promedio histórico.
  - Listado y detalle por categorías y etiquetas.
  - Búsqueda de recetas.
  - Páginas: Video, Sobre mí, Contacto y Aviso de privacidad.
- Admin
  - Dashboard con métricas y reportes exportables a Excel.
  - CRUD de Recetas.
  - CRUD de Categorías con subida de imágenes y orden/posición.
- Backend
  - Módulos separados para la administración del Front y Administrador.
  - Envío de correos.
  - Autenticación basada en Shield.

## Tecnologías

- PHP 8.1+, CodeIgniter 4
- Autenticación: CodeIgniter Shield
- Reportes: PhpSpreadsheet
- Construcción de assets: Node.js + npm + esbuild
- Pruebas: PHPUnit

## Estructura

- app/Modules/Front
  - Controllers: Home, Recipe, Contact, Media, Menu, Carousel
  - Models: Recipe, Category, Tag, Menu, Media, Carousel, Sección, relaciones y puntuaciones
  - Views: páginas públicas y celdas/secciones
- app/Modules/Admin
  - Controllers: Dashboard, Recipes, Categories, Reports, Forms
  - Views: panel de administración
- app/Entities
  - Recipe: getters/setters avanzados (ingredientes, instrucciones, tiempos, dificultad, rating)
  
## Requisitos de servidor

- PHP 8.1 o superior con extensiones: intl, mbstring, json, mysqlnd (si usas MySQL), libcurl (para HTTP\CURLRequest).
- Base de datos compatible con CodeIgniter 4.
- Node.js y npm para construir assets.

## Instalación

1) Clonar e instalar dependencias
- Composer: `composer install`
- Node: `npm install`

2) Configuración de entorno
- Copiar `env` a `.env`
- Ajustar `app.baseURL`
- Configurar base de datos (DBDriver, hostname, database, username, password)

3) Migraciones y seeders
- Ejecutar migraciones: `php spark migrate`
- (Opcional) Ejecutar seeders si están disponibles: `php spark db:seed NombreDelSeeder`

4) Construcción de assets
- Desarrollo: `npm run dev` (o equivalente definido)
- Producción: `npm run build`

5) Servir la aplicación
- Servidor embebido: `php spark serve`
- O configurar virtual host apuntando a public/

## Uso

- Front:
  - Inicio con carrusel y secciones.
  - Exploración por categorías y etiquetas.
  - Búsqueda y detalle de recetas con calificación por estrellas.
- Admin:
  - Gestión de recetas y categorías (incluye subida de imagen en categorías).
  - Exportación de reportes a Excel.
  - Dashboard con estadísticas.

Nota: La aplicación expone endpoints JSON para ciertas secciones públicas (p. ej., carrusel y catálogos), útiles para cargar contenido dinámico en la UI.

## Pruebas

- Ejecutar suite: `vendor/bin/phpunit`

## Desarrollo

- Estándares: PHP 8.1+, PSR, CI4.
- Logs y depuración: usar las herramientas de CodeIgniter 4 (logger, barras de depuración).
- Los módulos Front y Admin facilitan el mantenimiento y escalabilidad.

## Despliegue

- Asegura que el servidor apunte a public/.
- Configura variables de entorno en `.env` apropiadas para producción.
- Ejecuta `composer install --no-dev`, `php spark migrate --all` y `npm run build` antes de subir cambios.
- Ajusta permisos de writable/ según tu entorno.

## Licencia

Distribuido bajo licencia open source incluida en el repositorio.
