@echo off
REM Obtén la fecha actual en formato AAAAMMDD
for /f "tokens=2-4 delims=/ " %%a in ('date /t') do (
    set today=%%c%%a%%b
)

REM Define el nombre del archivo con el prefijo "memo" y la fecha
set filename=memo%today%.txt

REM Ejecuta el comando git diff y guarda la salida en el archivo
git diff  --name-only  HEAD~1 > %filename%

REM Muestra un mensaje de éxito
echo Archivo %filename% generado con Exito.
