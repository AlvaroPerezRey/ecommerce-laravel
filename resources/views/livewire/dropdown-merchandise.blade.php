{{-- Dropdown que nos muestra las subcategorias de la categoria Merchandise --}}
<div class="ml-3 relative">
    <x-jet-dropdown width="48">
        <x-slot name="trigger">
            <span class="relative inline-block cursor-pointer">
                <p class="text-principal">Merchandise</p>
            </span>
        </x-slot>
        <x-slot name="content">
            <div class="py-3 px-2">
                <a href="#" class="text-left text-principal">
                    Grupos Masculinos
                </a>
                <a href="#" class="text-left text-principal">
                    Grupos Femeninos
                </a>
                <a href="#" class="text-left text-principal">
                    Solistas
                </a>
            </div>
        </x-slot>
    </x-jet-dropdown>
</div>

<style>
    span p:hover,
    a:hover {
        text-decoration-line: underline
    }
</style>
