<?php

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public $viewMode = 'cards'; // 'cards' or 'list'
    public $sortBy = 'created_at';
    public $filterType = 'all';

    public function toggleViewMode()
    {
        $this->viewMode = $this->viewMode === 'cards' ? 'list' : 'cards';
    }

    public function with(): array
    {
        $query = Project::query();

        if ($this->filterType !== 'all') {
            $query->where('type', $this->filterType);
        }

        $query->orderBy($this->sortBy, $this->sortBy === 'created_at' ? 'desc' : 'asc');

        return [
            'projects' => $query->get(),
        ];
    }
};
?>

<section id="proyectos" class="py-24 bg-white" x-data>
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h2 class="text-3xl font-bold mb-2 text-indigo-900">Proyectos Destacados</h2>
                <p class="text-slate-600">Innovación educativa y herramientas digitales para el aprendizaje.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-4 bg-slate-50 p-2 rounded-2xl border border-slate-100">
                <!-- Filtro por Tipo -->
                <select wire:model.live="filterType" class="bg-white border-0 text-sm font-medium rounded-xl focus:ring-2 focus:ring-indigo-500 py-2 pl-3 pr-8">
                    <option value="all">Todos los tipos</option>
                    <option value="app">Aplicaciones</option>
                    <option value="research">Investigación</option>
                    <option value="course">Cursos</option>
                    <option value="project">Proyectos</option>
                </select>

                <!-- Ordenar -->
                <select wire:model.live="sortBy" class="bg-white border-0 text-sm font-medium rounded-xl focus:ring-2 focus:ring-indigo-500 py-2 pl-3 pr-8">
                    <option value="created_at">Más recientes</option>
                    <option value="title">Nombre (A-Z)</option>
                </select>

                <!-- Toggle Vista -->
                <div class="flex bg-white rounded-xl p-1 border border-slate-200">
                    <button wire:click="toggleViewMode" 
                            class="p-2 rounded-lg transition-all {{ $viewMode === 'cards' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:text-slate-600' }}"
                            title="Vista de Cuadrícula">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    </button>
                    <button wire:click="toggleViewMode" 
                            class="p-2 rounded-lg transition-all {{ $viewMode === 'list' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:text-slate-600' }}"
                            title="Vista de Lista">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                    </button>
                </div>
            </div>
        </div>

        @if($projects->isEmpty())
            <div class="text-center py-20 bg-slate-50 rounded-[40px] border border-dashed border-slate-200">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-sm mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">No se encontraron proyectos</h3>
                <p class="text-slate-500">Intenta con otros filtros o vuelve pronto.</p>
            </div>
        @else
            @if($viewMode === 'cards')
                <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-12" wire:loading.class="opacity-50" x-init="lucide.createIcons()">
                    @foreach($projects as $project)
                        <div class="group relative overflow-hidden rounded-[40px] {{ $loop->index % 2 == 0 ? 'bg-slate-900 text-white' : 'bg-indigo-50 border border-indigo-100 text-slate-900' }} p-8 md:p-12 transition-all hover:shadow-2xl hover:-translate-y-1">
                            <div class="relative z-10 space-y-6">
                                <span class="{{ $loop->index % 2 == 0 ? 'text-indigo-400' : 'text-indigo-600' }} font-bold uppercase tracking-wider text-xs">
                                    {{ match($project->type) { 'app' => 'Aplicación', 'research' => 'Investigación', 'course' => 'Curso', default => 'Proyecto' } }}
                                </span>
                                <h3 class="text-3xl font-bold">{{ $project->title }}</h3>
                                <div class="prose {{ $loop->index % 2 == 0 ? 'prose-invert text-slate-400' : 'text-slate-600' }} line-clamp-3">
                                    {!! $project->description !!}
                                </div>
                                <div class="pt-4">
                                    @if($project->url)
                                        <a href="{{ $project->url }}" target="_blank" class="inline-flex items-center gap-2 {{ $loop->index % 2 == 0 ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-indigo-600 hover:bg-indigo-700' }} text-white px-6 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-200">
                                            Ver más <i data-lucide="external-link" class="w-5 h-5 ml-1"></i>
                                        </a>
                                    @else
                                        <span class="inline-flex items-center gap-2 font-bold cursor-default">
                                            Próximamente <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($project->image_path)
                                <div class="absolute top-0 right-0 opacity-20 group-hover:opacity-30 transition-opacity">
                                    <img src="{{ asset('storage/' . $project->image_path) }}" class="w-64 h-64 object-cover rounded-full -translate-y-1/4 translate-x-1/4 rotate-12" alt="">
                                </div>
                            @else
                                <div class="absolute top-0 right-0 opacity-10 {{ $loop->index % 2 == 0 ? '-rotate-12' : 'rotate-12' }} translate-x-1/4 -translate-y-1/4">
                                    @php $icon = match($project->type) { 'app' => 'globe', 'research' => 'pie-chart', 'course' => 'book-open', default => 'layers' }; @endphp
                                    <i data-lucide="{{ $icon }}" style="width: 300px; height: 300px;"></i>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="space-y-6" wire:loading.class="opacity-50" x-init="lucide.createIcons()">
                    @foreach($projects as $project)
                        <div class="flex flex-col md:flex-row items-center gap-8 bg-slate-50 p-8 rounded-[30px] border border-slate-100 hover:bg-white hover:shadow-xl transition-all">
                            <div class="w-full md:w-32 h-32 flex-shrink-0 bg-indigo-100 rounded-2xl flex items-center justify-center overflow-hidden">
                                @if($project->image_path)
                                   <img src="{{ asset('storage/' . $project->image_path) }}" class="w-full h-full object-cover" alt="">
                                @else
                                    @php $icon = match($project->type) { 'app' => 'globe', 'research' => 'pie-chart', 'course' => 'book-open', default => 'layers' }; @endphp
                                    <i data-lucide="{{ $icon }}" class="w-12 h-12 text-indigo-600"></i>
                                @endif
                            </div>
                            <div class="flex-grow space-y-2 text-center md:text-left">
                                <div class="flex flex-wrap justify-center md:justify-start items-center gap-2">
                                    <span class="px-3 py-1 bg-white text-indigo-600 text-[10px] font-bold uppercase rounded-lg border border-indigo-100">
                                        {{ match($project->type) { 'app' => 'Aplicación', 'research' => 'Investigación', 'course' => 'Curso', default => 'Proyecto' } }}
                                    </span>
                                    <span class="px-3 py-1 bg-white text-slate-500 text-[10px] font-bold uppercase rounded-lg border border-slate-200">
                                        {{ match($project->status) { 'ongoing' => 'En curso', 'completed' => 'Completado', default => 'Archivado' } }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900">{{ $project->title }}</h3>
                                <div class="text-slate-600 line-clamp-2 text-sm">
                                    {!! $project->description !!}
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                @if($project->url)
                                    <a href="{{ $project->url }}" target="_blank" class="flex items-center justify-center w-12 h-12 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>

    @script
    <script>
        $wire.on('viewModeToggled', () => {
            setTimeout(() => {
                lucide.createIcons();
            }, 50);
        });

        Livewire.hook('request', ({ respond }) => {
            respond(() => {
                setTimeout(() => {
                    lucide.createIcons();
                }, 50);
            });
        });
    </script>
    @endscript
</section>