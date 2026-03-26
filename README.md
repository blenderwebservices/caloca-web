# Dr. Oscar Rogelio Caloca Osorio - Portfolio & Digital Presentation

Esta aplicación es una **presentación electrónica y portafolio profesional** dedicada a la trayectoria del **Dr. en Urbanismo, Oscar Rogelio Caloca Osorio**. El objetivo principal es centralizar y exhibir sus proyectos destacados, investigaciones y trayectoria académica de una manera dinámica, moderna e interactiva.

## 🚀 Propósito e Intención
El sistema funciona como una vitrina digital híbrida que permite:
- Gestionar proyectos y usuarios a través de un panel administrativo robusto.
- Visualizar proyectos en el frontend con formatos flexibles (Tarjetas o Lista) y herramientas de filtrado avanzado.
- Servir como una herramienta de presentación profesional para conferencias y redes académicas.

## 🛠️ Tecnologías Utilizadas

### Backend & Core
- **Laravel 13.x:** El framework de PHP para artesanos de la web, proporcionando la base sólida y segura.
- **Filament PHP v5.4:** Un panel administrativo elegante y potente para la gestión de contenidos (CRUD de proyectos y usuarios).
- **SQLite:** Una base de datos ligera y eficiente, ideal para despliegues rápidos y aplicaciones de portafolio.

### Frontend
- **Livewire:** Para una reactividad fluida en el frontend sin salir del ecosistema de Laravel.
- **Tailwind CSS:** Un framework de CSS de utilidad para un diseño premium, moderno y responsivo.
- **Lucide Icons:** Iconografía vectorial limpia y consistente.
- **Rich Editor:** Implementación de edición de texto enriquecido para descripciones detalladas.

### Inteligencia Artificial
- **Laravel AI SDK:** Integrado para potenciar la creación de contenido dentro del dashboard, permitiendo la generación automática de descripciones profesionales mediante modelos de lenguaje avanzados.

## 🤖 Chatbot de IA (Lanzado el 25 de Marzo de 2026)
¡El **Chatbot inteligente** especializado es ahora una realidad plenamente operativa en la web! Este asistente virtual está entrenado y ajustado para responder preguntas específicas sobre la obra, las investigaciones y los hitos profesionales del **Dr. Oscar Rogelio Caloca Osorio**, permitiendo a los visitantes interactuar de manera conversacional con su extensa trayectoria profesional.

### Características Frontend (Vista del Usuario)
* **Interfaz Conversacional Moderna:** Un botón de chat flotante minimalista que despliega una ventana estilo WhatsApp.
* **Soporte Académico Avanzado:** Capacidad renderizada en vivo del Markdown y notación matemática completa mediante LaTeX (MathML), crucial para fórmulas de teoría de juegos y sociología.
* **Retroalimentación en Vivo:** Indicador de carga estilo *"escribiendo..."* sincronizado con la comunicación en segundo plano para una experiencia más humana.
* **Persistencia Integrada:** Los usuarios no pierden su conversación al cerrar o contraer el modal mientras navegan por la página.

### Características Backend (Gestión Interna)
* **Catálogo de Proveedores Dinámico:** Panel administrativo (`Filament v3`) interconectado a una estructura de bases de datos relacional para gestionar motores clave sin tocar código fuente (OpenAI, Google Gemini, Anthropic, Ollama, etc.).
* **Gestor en Línea de Modelos:** Posibilidad de registrar, editar o cambiar al vuelo qué versión particular de modelo (Ej. `gemini-2.5-flash` o `gpt-4o`) interactúa con los visitantes.
* **System Prompt Modular:** El *"System Prompt"* general del agente y sus instrucciones clave ahora se controlan dinámicamente desde el Dashboard para moldear las capacidades e inyectar conocimientos sin un despliegue adicional.
* **Ecosistema Laravel AI:** Escalabilidad y estabilidad orquestadas de manera nativa mediante los contratos estandarizados del Laravel AI SDK.

## 🔮 Futuro Cercano: Fuentes de Conocimiento y RAG
Se prevé la expansión del ecosistema del Asistente Virtual para integrar un sistema de **Generación Aumentada por Recuperación (RAG)** o *Knowledge Bases*, permitiendo a los usuarios agregar recursos documentales para contextualizar al chatbot dinámicamente.

### ¿Cómo Funcionará?
Al interactuar con el bot, los usuarios autorizados o los administradores podrán cargar temporal o permanentemente archivos externos a la sesión. El agente pre-procesará este contenido, extraerá su texto fundamental y lo combinará con sus directrices nativas para formular respuestas ultra-precisas basadas *únicamente* en las referencias subidas.

### Formatos y Límites Previstos
Para asegurar un rendimiento estable y proteger la cuota de la API:
* **Formatos Admitidos:** Textos y documentos (`.pdf`, `.txt`, `.docx`, `.md`) así como procesamiento de imágenes y capturas gráficas (`.jpg`, `.png`, `.webp`) aprovechando los motores multimodales modernos.
* **Límites de Tamaño:** Máximo de **10 MB** por archivo, restringido a **3-5 archivos** en simultáneo por sesión.

### Consumo de Tokens e Implicaciones
Cargar recursos externos inyecta el contenido del documento directamente en la *ventana de contexto* del LLM. Por lo tanto:
* **Mayor Consumo:** Un archivo de varias páginas consumirá decenas de miles de *Tokens de Entrada* en cada consulta subsiguiente, incrementando drásticamente el costo por inferencia en plataformas como OpenAI o Anthropic.
* **Rendimiento:** Textos masivos pueden ralentizar ligeramente la tasa respuesta del modelo (Time to First Token).
* **Monitoreo Visual y Control:** Para mantener la transparencia, se incorporará un indicador en la interfaz del chat que permitirá conocer **visualmente el consumo de tokens** de cada consulta y llevar un seguimiento de manera dinámica del **resto de la cuota o límite disponible** de procesamiento.

> **💡 Ejemplo de Uso en Entorno Académico:**
> Un estudiante o colega del Dr. Caloca podrá subir el `PDF` de un artículo publicado sobre Teoría de Juegos o una *captura de pantalla* de una tabla de datos económicos complejos y preguntarle al Chatbot:
> *"Revisa esta tabla estadística del artículo adjunto e interprétame la correlación entre la inflación mostrada y el argumento principal del Autor en la Página 4."*
> El bot procesará el PDF cargado y responderá al instante con un análisis académico basado estrictamente en el recurso proporcionado.

---
Desarrollado con ❤️ usando el stack de Laravel.
