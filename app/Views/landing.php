<?php


$personas = array(
  array("nombre" => "Juan", "apellido" => "Pérez", "edad" => 12, "sexo" => "Masculino"),
  array("nombre" => "María", "apellido" => "Gómez", "edad" => 25, "sexo" => "Femenino"),
  array("nombre" => "Carlos", "apellido" => "López", "edad" => 30, "sexo" => "Masculino"),
  array("nombre" => "Ana", "apellido" => "Martínez", "edad" => 18, "sexo" => "Femenino"),
  array("nombre" => "Luis", "apellido" => "Rodríguez", "edad" => 40, "sexo" => "Masculino"),
  array("nombre" => "Sofía", "apellido" => "Díaz", "edad" => 22, "sexo" => "Femenino"),
  array("nombre" => "Pedro", "apellido" => "Fernández", "edad" => 15, "sexo" => "Masculino"),
  array("nombre" => "Lucía", "apellido" => "Sánchez", "edad" => 28, "sexo" => "Femenino"),
  array("nombre" => "Miguel", "apellido" => "Ramírez", "edad" => 35, "sexo" => "Masculino"),
  array("nombre" => "Elena", "apellido" => "Torres", "edad" => 19, "sexo" => "Femenino")
);

function colorActivo($edad = null)
{
  if ($edad > 18) {
    return "bg-stone-200";
  }
};


function eliminar($persona)
{
 print_r($persona);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
  <title>Landing Page</title>
</head>

<body>
  <div class="card bg-blue-100 shadow-sm md:w-10/12 md:mx-auto w-12/12">
    <div class="card-body">
      <h2 class="card-title text-2xl">Lista de usuarios</h2>
      <table class="table rounded-md border-1 border-stone-300 w-12/12">
        <thead class="bg-blue-500 text-white text-bold text-center">
          <tr>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Edad</td>
            <td>Sexo</td>
            <td>Acción</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($personas as $persona): ?>
            <tr class="<?= colorActivo($persona['edad']) ?>">
              <td class="text-center"><?= $persona['nombre'] ?></td>
              <td class="text-center"><?= $persona['apellido'] ?></td>
              <td class="text-center"><?= $persona['edad'] ?></td>
              <td class="text-center"><?= $persona['sexo'] ?></td>
              <td class="text-center"> <button
                  onclick="<?= eliminar($persona)?>"
                  class="bg-red-500 text-white px-3 py-1 rounded">Eliminar </button></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
</body>

</html>