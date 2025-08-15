<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();

 function toggleTheme() {
  const html = document.documentElement;
  const currentTheme = html.getAttribute("data-theme");
  const newTheme = currentTheme === "lightTema" ? "darkTema" : "lightTema";
  
  // Cambiar tema
  html.setAttribute("data-theme", newTheme);
  localStorage.setItem("theme", newTheme); // Opcional: Guardar preferencia
  
  // Cambiar ícono
  const icon = document.getElementById("icon");
  icon.setAttribute("data-lucide", newTheme === "lightTema" ? "moon" : "sun");
  
  // Actualizar el ícono (requiere reinicializar Lucide)
  if (window.lucide) {
    lucide.createIcons();
  }
}

// Inicializar ícono según el tema al cargar la página
document.addEventListener("DOMContentLoaded", () => {
  const savedTheme = localStorage.getItem("theme") || "lightTema";
  document.documentElement.setAttribute("data-theme", savedTheme);
  
  const icon = document.getElementById("icon");
  icon.setAttribute("data-lucide", savedTheme === "lightTema" ? "moon" : "sun");
  
  // Asegurar que Lucide esté cargado
  if (window.lucide) {
    lucide.createIcons();
  }
});
</script>

</main>
</body>

</html>