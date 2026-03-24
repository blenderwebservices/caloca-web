<?php

use App\Ai\Agents\ChatAgent;
use Livewire\Component;
use Laravel\Ai\Messages\Message;

new class extends Component {
    public $isOpen = false;
    public $message = '';
    public $messages = [];

    public function mount()
    {
        $this->messages[] = [
            'role' => 'assistant',
            'content' => '¡Hola! Soy el asistente virtual del Dr. Oscar Rogelio Caloca. ¿En qué puedo ayudarte hoy?',
            'time' => now()->format('H:i'),
        ];
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen) {
            $this->dispatch('chat-opened');
        }
    }

    public function sendMessage()
    {
        if (empty(trim($this->message))) {
            return;
        }

        $userMessage = $this->message;
        $this->messages[] = [
            'role' => 'user',
            'content' => $userMessage,
            'time' => now()->format('H:i'),
        ];
        $this->message = '';

        // Preparar historial para el agente
        $history = collect($this->messages)->map(function ($msg) {
            return new Message($msg['role'], $msg['content']);
        })->toArray();

        // Llamar al agente
        try {
            $agent = (new ChatAgent())->withHistory($history);
            $response = $agent->prompt($userMessage);
            
            $this->messages[] = [
                'role' => 'assistant',
                'content' => (string) $response,
                'time' => now()->format('H:i'),
            ];
        } catch (\Exception $e) {
            $this->messages[] = [
                'role' => 'assistant',
                'content' => 'Lo siento, hubo un error al procesar tu mensaje. Por favor intenta de nuevo más tarde.',
                'time' => now()->format('H:i'),
            ];
        }

        $this->dispatch('message-sent');
    }
};

?>

<div class="fixed bottom-6 right-6 z-[100] flex flex-col items-end" x-data="{ open: @entangle('isOpen') }">
    <!-- Chat Window -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-10 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-10 scale-95"
         class="mb-4 w-80 md:w-96 h-[500px] bg-white rounded-3xl shadow-2xl flex flex-col overflow-hidden border border-slate-100"
         x-cloak>
        
        <!-- Header (WhatsApp style) -->
        <div class="bg-[#075e54] p-4 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <img src="{{ asset('img/oscar.jpeg') }}" class="w-10 h-10 rounded-full object-cover border border-white/20" alt="Dr. Caloca">
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-[#075e54] rounded-full"></div>
                </div>
                <div>
                    <h4 class="font-bold text-sm">Dr. Oscar Rogelio Caloca</h4>
                    <span class="text-[10px] opacity-80">En línea (Asistente IA)</span>
                </div>
            </div>
            <button @click="open = false" class="hover:bg-white/10 p-1 rounded-full transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Chat Area -->
        <div class="flex-grow overflow-y-auto p-4 space-y-4 bg-[#e5ddd5]" id="chat-messages" x-init="$watch('messages', () => { $nextTick(() => { $el.scrollTop = $el.scrollHeight }) })">
            <div class="text-center">
                <span class="bg-white/60 text-[10px] px-2 py-1 rounded-lg text-slate-500 uppercase tracking-wider font-bold shadow-sm">Hoy</span>
            </div>

            @foreach($messages as $msg)
                <div class="flex {{ $msg['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[85%] rounded-2xl p-3 shadow-sm relative {{ $msg['role'] === 'user' ? 'bg-[#dcf8c6] rounded-tr-none' : 'bg-white rounded-tl-none' }}">
                        <p class="text-sm text-slate-800 leading-relaxed">{{ $msg['content'] }}</p>
                        <div class="flex justify-end gap-1 mt-1">
                            <span class="text-[9px] text-slate-400">{{ $msg['time'] }}</span>
                            @if($msg['role'] === 'user')
                                <i data-lucide="check-check" class="w-3 h-3 text-blue-500"></i>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Input Area -->
        <div class="p-3 bg-[#f0f2f5] flex items-center gap-2">
            <div class="flex-grow bg-white rounded-2xl flex items-center px-4 border border-slate-200 focus-within:ring-2 focus-within:ring-indigo-500 transition-all">
                <textarea wire:model="message" 
                          wire:keydown.enter.prevent="sendMessage"
                          placeholder="Escribe un mensaje..."
                          rows="1"
                          class="w-full bg-transparent border-0 focus:ring-0 py-2 text-sm resize-none"></textarea>
            </div>
            <button wire:click="sendMessage" 
                    class="w-10 h-10 bg-[#075e54] text-white rounded-full flex items-center justify-center hover:bg-[#128c7e] transition-all shadow-lg active:scale-95">
                <i data-lucide="send" class="w-5 h-5 ml-0.5"></i>
            </button>
        </div>
    </div>

    <!-- Floating Button -->
    <button @click="open = !open" 
            class="w-16 h-16 bg-[#25d366] text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-105 transition-all transform active:scale-90 group relative"
            id="chatbot-trigger">
        <span class="absolute -top-1 -right-1 flex h-4 w-4" x-show="!open">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-red-500"></span>
        </span>
        <i data-lucide="message-circle" class="w-8 h-8 group-hover:hidden" x-show="!open"></i>
        <i data-lucide="x" class="w-8 h-8 hidden group-hover:block" x-show="!open"></i>
        <i data-lucide="chevron-down" class="w-8 h-8" x-show="open"></i>
    </button>
</div>

@script
<script>
    $wire.on('message-sent', () => {
        setTimeout(() => {
            lucide.createIcons();
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 50);
    });

    $wire.on('chat-opened', () => {
        setTimeout(() => {
            lucide.createIcons();
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 50);
    });
</script>
@endscript
