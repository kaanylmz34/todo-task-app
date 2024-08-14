<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kullanıcı Detayları
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">Hata!</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <div class="font-semibold text-lg">Ad Soyad:</div>
                        <div>{{ $user->name }}</div>
                    </div>
                    <div class="mb-4">
                        <div class="font-semibold text-lg">E-Posta:</div>
                        <div>{{ $user->email }}</div>
                    </div>
                    <div class="mb-4">
                        <div class="font-semibold text-lg">Rolleri:</div>
                        <div>
                            @foreach ($user->roles as $role)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-4 flex gap-4">
                        @can ('user.edit')
                            <a href="{{ route('user.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900">Düzenle</a>
                        @endcan
                        @can ('user.destroy')
                            <form method="POST" action="{{ route('user.destroy', $user) }}" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Sil</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>