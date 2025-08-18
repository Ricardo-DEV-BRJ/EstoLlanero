<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });
  lucide.createIcons();

  function toggleTheme() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute("data-bs-theme");
    const newTheme = currentTheme === "light" ? "dark" : "light";

    // Cambiar tema
    html.setAttribute("data-bs-theme", newTheme);
    localStorage.setItem("theme", newTheme); // Opcional: Guardar preferencia

    // Cambiar ícono
    const icon = document.getElementById("icon");
    icon.setAttribute("data-lucide", newTheme === "light" ? "moon" : "sun");

    // Actualizar el ícono (requiere reinicializar Lucide)
    if (window.lucide) {
      lucide.createIcons();
    }
  }

  // Inicializar ícono según el tema al cargar la página
  document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem("theme") || "light";
    document.documentElement.setAttribute("data-bs-theme", savedTheme);

    const icon = document.getElementById("icon");
    icon.setAttribute("data-lucide", savedTheme === "light" ? "moon" : "sun");

    // Asegurar que Lucide esté cargado
    if (window.lucide) {
      lucide.createIcons();
    }

    const elemento = document.getElementById("menuNav");

    // Cuando el mouse entra en el elemento
    elemento.addEventListener("mouseenter", () => {
      const navegacion = document.querySelectorAll('.contenido');
      elemento.classList.add('activo')
      elemento.classList.remove('inActivo')
      setTimeout(() => {
        navegacion.forEach(item => {
          item.classList.remove('d-none')
        })
      }, 100)

    });

    elemento.addEventListener("mouseleave", () => {
      const navegacion = document.querySelectorAll('.contenido');
      elemento.classList.remove('activo')
      elemento.classList.add('inActivo')
      setTimeout(() => {
        navegacion.forEach(item => {
          item.classList.add('d-none')
        })
      }, 100)

    })

  });

  let menuAct = false

  function togleMenu() {
    const menu = document.getElementById('menuRes')
    if (!menuAct) {
      menu.classList.remove('menuResIn')
      menu.classList.add('menuResAct')
      menu.classList.remove('d-none')
      const navegacion = document.querySelectorAll('.contenido');
      setTimeout(() => {
        navegacion.forEach(item => {
          item.classList.remove('d-none')
        })
      }, 100)
      menuAct = true
    } else {
      menu.classList.remove('menuResAct')
      menu.classList.add('menuResIn')
      setTimeout(() => {
        menu.classList.add('d-none')
      }, 200)
      const navegacion = document.querySelectorAll('.contenido');
      setTimeout(() => {
        navegacion.forEach(item => {
          item.classList.add('d-none')
        })
      }, 100)
      menuAct = false
    }
  }

  const showPass = () => {
    const contraseña = document.getElementById('contrasena')
    contraseña.setAttribute('type', 'text')
  }

  const hiddenPass = () => {
    const contraseña = document.getElementById('contrasena')
    contraseña.setAttribute('type', 'password')
  }
</script>
</section>

</main>
</body>

</html>