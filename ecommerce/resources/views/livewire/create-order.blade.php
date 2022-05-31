<div class="container py-8 grid lg:grid-cols-2 xl:grid-cols-5 gap-6">

    <div class="order-2 lg:order-1 lg:col-span-1 xl:col-span-3">

        <div class="bg-fondo rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="Nombre de contacto" />
                <x-jet-input type="text"
                            wire:model.defer="contact"
                            placeholder="Ingrese el nombre de la persona que recibirá el producto"
                            class="w-full"/>
                <x-jet-input-error for="contact" />
            </div>

            <div>
                <x-jet-label value="Teléfono de contacto" />
                <x-jet-input type="text"
                            wire:model.defer="phone"
                            placeholder="Ingrese un número de telefono de contácto"
                            class="w-full"/>

                <x-jet-input-error for="phone" />
            </div>
        </div>

        <div x-data="{ shipping_type: @entangle('shipping_type') }">
            <p class="mt-6 mb-3 text-lg text-principal font-semibold">Envíos</p>

            <label class="bg-fondo rounded-lg shadow px-6 py-4 flex items-center mb-4 cursor-pointer">
                <input x-model="shipping_type" type="radio" value="1" name="shipping_type" class="text-principal">
                <span class="ml-2 text-titulo2">
                    Recojo en tienda (Calle Falsa 123)
                </span>

                <span class="font-semibold text-titulo2 ml-auto">
                    Gratis
                </span>
            </label>

            <div class="bg-fondo rounded-lg shadow">
                <label class="px-6 py-4 flex items-center cursor-pointer">
                    <input x-model="shipping_type" type="radio" value="2" name="shipping_type" class="text-principal">
                    <span class="ml-2 text-titulo2">
                        Envío a domicilio
                    </span>

                </label>

                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': shipping_type != 2 }">

                    {{-- Comunidades --}}
                    <div>
                        <x-jet-label value="Comunidad Autonoma" />

                        <select class="form-control w-full" wire:model="department_id">

                            <option value="" disabled selected>Seleccione una comunidad autonoma</option>

                            @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="department_id" />
                    </div>

                    {{-- Ciudades --}}
                    <div>
                        <x-jet-label value="Ciudad" />

                        <select class="form-control w-full" wire:model="city_id">

                            <option value="" disabled selected>Seleccione una ciudad</option>

                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="city_id" />
                    </div>


                    {{-- Provincias --}}
                    <div>
                        <x-jet-label value="Provincia" />

                        <select class="form-control w-full" wire:model="district_id">

                            <option value="" disabled selected>Seleccione una provincia</option>

                            @foreach ($districts as $district)
                                <option value="{{$district->id}}">{{$district->name}}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="district_id" />
                    </div>

                    <div>
                        <x-jet-label value="Dirección" />
                        <x-jet-input class="w-full" wire:model="address" type="text" />
                        <x-jet-input-error for="address" />
                    </div>

                    <div class="col-span-2">
                        <x-jet-label value="Referencia" />
                        <x-jet-input class="w-full" wire:model="references" type="text" />
                        <x-jet-input-error for="references" />
                    </div>

                </div>
            </div>

        </div>

        <div>
            <x-jet-button
                wire:loading.attr="disabled"
                wire:target="create_order"
                class="mt-6 mb-4" 
                wire:click="create_order">
                Continuar con la compra
            </x-jet-button>

            <hr>

            <p class="text-sm text-principal mt-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam atque quo, labore facere placeat illo consequatur hic ut sapiente exercitationem, architecto iure, consequuntur impedit ex iusto ipsa voluptas laudantium iste <a href="" class="font-semibold text-orange-500">Políticas y privacidad</a></p>
        </div>

    </div>

    <div class="order-1 lg:order-2 lg:col-span-1 xl:col-span-2">
        <div class="bg-fondo rounded-lg shadow p-6">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border-b-separador">
                        <img class="h-15 w-20 object-cover mr-4" src="{{$item->options->image}}" alt="">
                        <article class="flex-1">
                            <h1 class="font-bold">
                                {{$item->name}}
                            </h1>
                            <p>
                                Cant: {{$item->qty}}
                            </p>
                            <p>
                                {{$item->price}} €
                            </p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-principal">
                            No tiene agregado ningun item en el carrito
                        </p>
                    </li>
                @endforelse
            </ul>

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal
                    <span class="font-semibold">{{Cart::subtotal()}} €</span>
                </p>
                <p class="flex justify-between items-center">
                    Envío
                    <span class="font-semibold">
                        @if ($shipping_type == 1 || $shipping_cost == 0)
                            Gratis
                        @else
                            {{$shipping_cost}} €
                        @endif
                    </span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total</span>
                    @if ($shipping_type == 1)
                        {{Cart::subtotal()}} €
                    @else
                        {{Cart::subtotal() + $shipping_cost}} €
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>