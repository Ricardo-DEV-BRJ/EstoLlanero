<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../public/css/main.css">
  <title><?= $titulo ?></title>
</head>

<body>
  <main class="flex flex-col justify-center items-center w-12/12 fondo">
    <header class="flex justify-between items-center w-12/12 p-4">
      <div>
        <img src="../public/Media/Logo.png" alt="" width="100">
      </div>
      <ul class="flex gap-2">
        <li>
          <a href="<?= base_url('usuarios') ?>" class="btn rounded-full hover:bg-blue-400 bg-blue-500 text-white"> <i data-lucide="users"></i> Usuario</a>
        </li>
        <li>
          <a href="<?= base_url('crear') ?>" class="btn rounded-full hover:bg-blue-400 bg-blue-500 text-white"><i data-lucide="user-round-plus"></i> Crear Usuario</a>
        </li>
          <li>
          <a href="<?= base_url('/') ?>" class="btn rounded-full hover:bg-blue-400 bg-blue-500 text-white"><i data-lucide="home"></i> Inicio</a>
        </li>
      </ul>
    </header>