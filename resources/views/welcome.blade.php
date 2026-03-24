<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Oscar Rogelio Caloca - Landing Page</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .nav-scrolled {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
    </style>
    @livewireStyles
</head>
<body class="bg-slate-50 text-slate-900 overflow-x-hidden">

    <!-- Navegación -->
    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300 py-6 bg-transparent">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="font-bold text-xl tracking-tight text-indigo-900">
                Dr. Oscar Rogelio Caloca
            </div>
            <div class="hidden md:flex space-x-8">
                <a href="#inicio" class="text-sm font-medium hover:text-indigo-600 transition-colors">Inicio</a>
                <a href="#trayectoria" class="text-sm font-medium hover:text-indigo-600 transition-colors">Trayectoria</a>
                <a href="#investigacion" class="text-sm font-medium hover:text-indigo-600 transition-colors">Investigación</a>
                <a href="#proyectos" class="text-sm font-medium hover:text-indigo-600 transition-colors">Proyectos</a>
                @auth
                    <a href="/admin" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors">Panel Control</a>
                @else
                    <a href="/admin/login" class="text-sm font-medium hover:text-indigo-600 transition-colors">Acceso</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Sección Hero -->
    <section id="inicio" class="relative pt-32 pb-20 md:pt-48 md:pb-32 overflow-hidden">
        <div class="absolute top-0 right-0 -z-10 w-1/2 h-full bg-indigo-50/50 rounded-bl-[100px]"></div>
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <div class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold">
                    Académico e Investigador - UAM Azcapotzalco
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 leading-tight">
                    Oscar Rogelio <br/>
                    <span class="text-indigo-600">Caloca Osorio</span>
                </h1>
                <p class="text-lg text-slate-600 leading-relaxed max-w-xl">
                    Dedicado a la enseñanza y la investigación desde 1999. Especialista en Teoría de Juegos aplicada a la realidad política y social de México.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#proyectos" class="px-8 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200 flex items-center gap-2">
                        Ver Proyectos <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                    <a href="https://hub.axiacorehub.com" target="_blank" class="px-8 py-3 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold hover:bg-slate-50 transition-all flex items-center gap-2">
                        App Teoría de Juegos <i data-lucide="external-link" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="w-full h-full aspect-square bg-white rounded-3xl shadow-2xl p-4 relative overflow-hidden">
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-indigo-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
                    <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse delay-700"></div>
                    
                    <img id="profile-img" 
                         src="img\oscar.jpeg" 
                         alt="Dr. Oscar Rogelio Caloca Osorio"
                         class="w-full h-top rounded-2xl object-cover border-2 border-white relative z-10"
                         onerror="handleImageError()">
                    
                    <div id="image-fallback" class="hidden w-full h-full rounded-2xl bg-slate-100 flex flex-col items-center justify-center border-2 border-dashed border-slate-200 relative z-10">
                        <i data-lucide="user" class="w-32 h-32 text-slate-300"></i>
                        <p class="text-xs text-slate-400 mt-2">Imagen no disponible</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Estadísticas -->
    <section class="py-12 bg-indigo-900 text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center space-y-2">
                    <div class="flex justify-center text-indigo-300 mb-2"><i data-lucide="award" class="w-6 h-6"></i></div>
                    <div class="text-3xl font-bold">27+</div>
                    <div class="text-sm text-indigo-200 font-medium uppercase tracking-wider">Años de Experiencia</div>
                </div>
                <div class="text-center space-y-2">
                    <div class="flex justify-center text-indigo-300 mb-2"><i data-lucide="library" class="w-6 h-6"></i></div>
                    <div class="text-3xl font-bold">135</div>
                    <div class="text-sm text-indigo-200 font-medium uppercase tracking-wider">Artículos Publicados</div>
                </div>
                <div class="text-center space-y-2">
                    <div class="flex justify-center text-indigo-300 mb-2"><i data-lucide="graduation-cap" class="w-6 h-6"></i></div>
                    <div class="text-3xl font-bold">UAM Azc</div>
                    <div class="text-sm text-indigo-200 font-medium uppercase tracking-wider">Institución</div>
                </div>
                <div class="text-center space-y-2">
                    <div class="flex justify-center text-indigo-300 mb-2"><i data-lucide="user" class="w-6 h-6"></i></div>
                    <div class="text-3xl font-bold">1999</div>
                    <div class="text-sm text-indigo-200 font-medium uppercase tracking-wider">Desde</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trayectoria y Experiencia -->
    <section id="trayectoria" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-start">
                <div class="space-y-6">
                    <h2 class="text-3xl font-bold text-slate-900">Pasión por la Enseñanza y la Ciencia</h2>
                    <p class="text-slate-600 leading-relaxed">
                        Desde 1999, mi labor en la <strong>UAM Azcapotzalco</strong> se ha centrado en cerrar la brecha entre la teoría matemática abstracta y la praxis política y social. Creo firmemente que la educación es la herramienta más poderosa para comprender y transformar nuestro entorno.
                    </p>
                    <div class="space-y-4">
                        <h3 class="font-bold text-indigo-900">Áreas de Dominio:</h3>
                        <div id="expertise-list" class="flex flex-wrap gap-2">
                            <!-- JS insertará elementos aquí -->
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-indigo-600 rounded-2xl text-white">
                            <i data-lucide="pie-chart" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-bold">Enfoque Académico</h3>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex gap-3 text-slate-700">
                            <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-indigo-600 flex-shrink-0"></div>
                            <span>Aplicación de Juegos No Cooperativos.</span>
                        </li>
                        <li class="flex gap-3 text-slate-700">
                            <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-indigo-600 flex-shrink-0"></div>
                            <span>Análisis político de México (Sexenios Echeverría - AMLO).</span>
                        </li>
                        <li class="flex gap-3 text-slate-700">
                            <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-indigo-600 flex-shrink-0"></div>
                            <span>Divulgación científica desde niveles básicos.</span>
                        </li>
                        <li class="flex gap-3 text-slate-700">
                            <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-indigo-600 flex-shrink-0"></div>
                            <span>Modelado matemático de comportamiento social.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Investigación -->
    <section id="investigacion" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Investigación y Publicaciones</h2>
            <p class="text-slate-600 max-w-2xl mx-auto mb-12">
                Con más de 130 artículos publicados, mi investigación explora la intersección entre las matemáticas y las ciencias sociales.
            </p>
            <div class="grid md:grid-cols-3 gap-8 text-left">
                <div class="p-8 bg-white rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <i data-lucide="flask-conical" class="w-10 h-10 text-indigo-600 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Multidisciplinariedad</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Artículos que integran economía, sociología y filosofía para una visión holística de los problemas actuales.</p>
                </div>
                <div class="p-8 bg-white rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <i data-lucide="target" class="w-10 h-10 text-indigo-600 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Teoría de Juegos</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Desarrollo de modelos no cooperativos aplicados a la toma de decisiones estratégicas en política.</p>
                </div>
                <div class="p-8 bg-white rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <i data-lucide="book-open" class="w-10 h-10 text-indigo-600 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Publicaciones</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Más de 135 artículos arbitrados y contribuciones académicas en diversos foros nacionales e internacionales.</p>
                </div>
            </div>
        </div>
    </section>

    <livewire:featured-projects />

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-12 pb-12 border-b border-slate-800">
                <div class="space-y-4">
                    <h4 class="text-white font-bold text-xl">Oscar Rogelio Caloca</h4>
                    <p class="text-sm">Académico de la UAM Azcapotzalco desde 1999.</p>
                    <div class="flex gap-4">
                        <a href="#" class="hover:text-indigo-400 transition-colors"><i data-lucide="mail" class="w-5 h-5"></i></a>
                        <a href="#" class="hover:text-indigo-400 transition-colors"><i data-lucide="globe" class="w-5 h-5"></i></a>
                    </div>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-4 uppercase text-xs tracking-widest">Secciones</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#inicio" class="hover:text-white transition-colors">Inicio</a></li>
                        <li><a href="#trayectoria" class="hover:text-white transition-colors">Trayectoria</a></li>
                        <li><a href="#investigacion" class="hover:text-white transition-colors">Investigación</a></li>
                        <li><a href="#proyectos" class="hover:text-white transition-colors">Proyectos</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-4 uppercase text-xs tracking-widest">Contacto Directo</h5>
                    <p class="text-sm mb-4">UAM Unidad Azcapotzalco. Ciudad de México.</p>
                    <button class="text-indigo-400 font-bold hover:text-indigo-300">Descargar CV Académico</button>
                </div>
            </div>
            <div class="pt-12 text-xs text-center">
                © <span id="year"></span> Dr. Oscar Rogelio Caloca Osorio. Desarrollado para la difusión de la Teoría de Juegos.
            </div>
        </div>
    </footer>

    @livewireScripts
    <script>
        // Inicializar iconos de Lucide
        lucide.createIcons();

        // Controlar el efecto de scroll en la barra de navegación
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('nav-scrolled');
            } else {
                nav.classList.remove('nav-scrolled');
            }
        });

        // Manejar error de carga de imagen
        function handleImageError() {
            document.getElementById('profile-img').classList.add('hidden');
            document.getElementById('image-fallback').classList.remove('hidden');
        }

        // Poblar áreas de dominio
        const expertise = ["Economía", "Sociología", "Educación", "Política", "Filosofía", "Matemáticas", "Teoría de Juegos"];
        const expertiseContainer = document.getElementById('expertise-list');
        
        expertise.forEach(item => {
            const span = document.createElement('span');
            span.className = "px-3 py-1 bg-slate-100 text-slate-600 text-sm font-medium rounded-lg";
            span.textContent = item;
            expertiseContainer.appendChild(span);
        });

        // Actualizar año en el footer
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>
</html>