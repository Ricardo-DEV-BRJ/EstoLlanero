<?= view('Template/cabezera_dashboard') ?>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-bold text-primary mb-4">QUIÉNES SOMOS</h1>
                <div class="w-32 h-1 bg-accent mx-auto"></div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="md:w-1/3">
                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-64 flex items-center justify-center">
                            <i data-lucide="users" class="w-24 h-24 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="md:w-2/3">
                        <h2 class="text-2xl font-bold text-primary mb-4">Nuestra Historia</h2>
                        <p class="text-gray-700 mb-4">
                            TRIUNFOBET nació en 2020 con la visión de convertirse en la plataforma líder de noticias deportivas en español. 
                            Fundada por apasionados del deporte y la tecnología, nuestra misión es brindar cobertura de calidad 
                            sobre todos los eventos deportivos relevantes a nivel mundial.
                        </p>
                        <p class="text-gray-700">
                            Hoy contamos con un equipo de más de 50 periodistas deportivos distribuidos en 15 países, 
                            cubriendo más de 30 disciplinas deportivas diferentes.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="w-16 h-16 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="target" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-2">Misión</h3>
                    <p class="text-gray-600">
                        Informar con veracidad, rapidez y profundidad sobre todos los eventos deportivos relevantes, 
                        brindando a nuestros lectores la mejor experiencia informativa.
                    </p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="w-16 h-16 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="eye" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-2">Visión</h3>
                    <p class="text-gray-600">
                        Convertirnos en el medio de referencia para los amantes del deporte en habla hispana, 
                        innovando constantemente en nuestra forma de contar las historias deportivas.
                    </p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="w-16 h-16 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="heart" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-2">Valores</h3>
                    <p class="text-gray-600">
                        Pasión por el deporte, integridad periodística, innovación constante, 
                        respeto por la diversidad y compromiso con nuestra comunidad.
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-primary mb-6">Nuestro Equipo</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Miembro 1 -->
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="bg-gray-200 border-2 border-dashed rounded-full w-24 h-24 mx-auto mb-4"></div>
                        <h3 class="text-lg font-bold text-primary">Ricardo Briceño</h3>                   
                    </div>
                    
                    <!-- Miembro 2 -->
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="bg-gray-200 border-2 border-dashed rounded-full w-24 h-24 mx-auto mb-4"></div>
                        <h3 class="text-lg font-bold text-primary">Rhonny Jaimes</h3>
                    </div>
                    
                    <!-- Miembro 3 -->
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="bg-gray-200 border-2 border-dashed rounded-full w-24 h-24 mx-auto mb-4"></div>
                        <h3 class="text-lg font-bold text-primary">Sofia Rivera</h3>
                    </div>
                    
                    <!-- Miembro 4 -->
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="bg-gray-200 border-2 border-dashed rounded-full w-24 h-24 mx-auto mb-4"></div>
                        <h3 class="text-lg font-bold text-primary">Jesus Salazar</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= view('Template/piedepagina_dashboard') ?>