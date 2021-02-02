## Prueba tecnica Evertec
<b>Nombre:</b> Oscar Navas

## Instalacion

1. Descargue los archivos.

2. Extraiga los archivos en la carpeta <b>htdocs</b> o la carpeta correspondiente segun la version de apache.

3. Cree una base de datos vacia con el nombre <b>prueba_evertec</b>

4. Para la conexion a la base de datos, modifique el archivo <b>.env.example</b> cambiando el usuario o la contraseña segun sea el caso y guardandolo como <b>.env</b>.

5. Ejecute las migraciones.
<code><pre>php artisan migrate</pre></code>

6. Desde la carpeta de <b>prueba-tecnica-evertec</b>, abra un terminal y corra el programa:
<code><pre>php artisan serve</pre></code>

7. Visualice el programa en un navegador en la siguiente direccion: <b>127.0.0.1:8000</b>.