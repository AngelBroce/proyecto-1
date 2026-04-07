# Proyecto organizado en PHP

## Qué se hizo
- Se convirtieron las pantallas HTML a PHP.
- Se mantuvo la carpeta `css` y las páginas ahora llaman sus estilos desde ahí.
- Se agregó la carpeta `funciones` para separar funciones reutilizables.
- Se ordenó la indentación del código para que sea más legible.
- Se dejaron las pantallas dentro de `pages/` y la principal en `index.php`.

## Estructura
- `index.php`
- `pages/`
  - `carrito.php`
  - `cat_logo.php`
  - `dashboard.php`
  - `detalle_producto.php`
  - `login.php`
- `css/`
  - `styles.css`
  - `login.css`
- `js/`
- `funciones/`
  - `general.php`
  - `auth.php`
  - `carrito.php`
  - `dashboard.php`
  - `productos.php`

## Nota
Estas funciones están separadas para que luego puedas conectar la lógica real de base de datos sin mezclarla con el diseño de cada pantalla.
