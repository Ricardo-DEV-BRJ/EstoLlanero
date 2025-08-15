   <footer class="bg-primary text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 text-white flex items-center">
                        <i data-lucide="trophy" class="w-6 h-6 mr-2 text-white"></i>
                        ESTOLLANOS
                    </h3>
                    <p class="text-gray-300">Tu destino principal para todas las actualizaciones deportivas y noticias de última hora de todo el mundo.</p>
                    <div class="flex space-x-4 mt-4">
                        <a  class="text-gray-300 hover:text-white transition-colors">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a  class="text-gray-300 hover:text-white transition-colors">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                        <a  class="text-gray-300 hover:text-white transition-colors">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                        <a  class="text-gray-300 hover:text-white transition-colors">
                            <i data-lucide="youtube" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">ENLACES RÁPIDOS</h4>
                    <ul class="space-y-2">
                        <li><a href="<?= base_url('/') ?>" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 text-accent"></i> Inicio</a></li>
                        <li><a href="noticias" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 text-accent"></i> Noticias</a></li>
                        <li><a href="quienessomos" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 text-accent"></i> Quienes Somos</a></li>
                   
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Nuestro Equipo</h4>
                    <ul class="space-y-2">
                        <li><a  class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 text-accent"></i> Ricardo Briceño</a></li>
                        <li><a  class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 text-accent"></i> Rhonny Jaimes</a></li>
                        <li><a  class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 text-accent"></i> Sofia Rivera</a></li>
                        <li><a  class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 text-accent"></i> Jesus Salazar</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">BOLETÍN INFORMATIVO</h4>
                    <p class="text-gray-300 mb-4">Suscríbete para recibir las últimas noticias deportivas</p>
                    <div class="flex">
                        <input type="email" placeholder="Tu correo electrónico" class="px-4 py-3 rounded-l-lg w-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-accent">
                        <button class="bg-accent hover:bg-[#2a1a61] px-4 py-3 rounded-r-lg transition-colors">
                            <i data-lucide="send" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-10 pt-6 text-center text-gray-400">
                <p>&copy; 2025 ESTOLLANOS. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>