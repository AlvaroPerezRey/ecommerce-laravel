<div class="container py-12">
    {{-- Formulario para crear una nueva comunidad autonoma --}}
    <x-jet-form-section submit="save" class="mb-6">

        <x-slot name="title">
            Agregar una nueva comunidad autónoma
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder agregar una nueva comunidad autónoma
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Nombre
                </x-jet-label>

                <x-jet-input wire:model.defer="createForm.name" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.name" />
            </div>
        </x-slot>

        <x-slot name="actions">

            <x-jet-action-message class="mr-3" on="saved">
                Departamento agregado
            </x-jet-action-message>

            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    {{-- Mostrar lista de comunidades autónomas --}}
    <x-jet-action-section>
        <x-slot name="title">
            Lista de comunidades autónomas
        </x-slot>

        <x-slot name="description">
            Aquí encontrará todas las comunidades autónomas agregados
        </x-slot>

        <x-slot name="content">

            <table class="text-principal">
                <thead class="border-b border-fondo">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-fondo">
                    @foreach ($departments as $department)
                        <tr>
                            <td class="py-2">

                                <a href="{{ route('admin.departments.show', $department) }}"
                                    class="uppercase underline hover:text-blue-600">
                                    {{ $department->name }}
                                </a>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-fondo font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer"
                                        wire:click="edit({{ $department }})">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer"
                                        wire:click="$emit('deleteDepartment', {{ $department->id }})">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </x-slot>
    </x-jet-action-section>

    {{-- Modal con formulario para editar --}}
    <x-jet-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar comunidad autónoma
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3">

                <div>
                    <x-jet-label>
                        Nombre
                    </x-jet-label>

                    <x-jet-input wire:model="editForm.name" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="editForm.name" />
                </div>


            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('script')
        <script>
            Livewire.on('deleteDepartment', departmentId => {
                //Alert personalizado
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "¡No podras revertir el proceso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si, deseo borrar la Comunidad autonoma!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.department-component', 'delete', departmentId)
                        Swal.fire(
                            '¡Borrado!',
                            '¡Tu Comunidad autonoma ha sido eliminada!',
                            'Completado'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
