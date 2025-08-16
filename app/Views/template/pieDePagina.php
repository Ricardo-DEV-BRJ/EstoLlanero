<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
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
});
</script>

</main>
</body>

</html>