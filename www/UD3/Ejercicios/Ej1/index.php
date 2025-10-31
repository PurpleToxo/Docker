<html>
    <head>
        <title>Tienda ej 1</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
    <hi>Formulario para inscripción de usuarios</hi>
    <form>
        <p>Nombre</p><br>
        <input type="text" name="nombre" required><br>
        <p>Apellidos</p><br>
        <input type="text" name="apellidos" required><br>
        <p>Edad</p><br>
        <input type="number" name="edad" required><br>
        <p>Provincia</p><br>
        <select name="provincia" required>
            <option value="Corunha">A Coruña>/option>
            <option value="Pontevedra">Pontevedra</option>
            <option value="Lugo">Lugo</option>
            <option value="Ourense">Ourense</option>
    </form>
    </body>
</html>