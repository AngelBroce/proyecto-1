@echo off
echo Inicializando repositorio local Git...
git init
echo node_modules/ > .gitignore
git add .
git commit -m "Initial commit: Organized TechVision files with offline Tailwind CSS"
echo.
echo Creando repositorio 'proyecto-1' en GitHub y subiendo los archivos...
gh repo create "proyecto-1" --public --source=. --remote=origin --push
echo.
echo Si ves un mensaje de error arriba sobre autenticacion, por favor escribe 'gh auth login' primero.
echo Si todo salio bien, los archivos ya estan en tu GitHub!
pause
