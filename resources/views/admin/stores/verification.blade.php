<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verifikasi Pengajuan Toko') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($unverifiedStores->isEmpty())
                    <p>Tidak ada pengajuan toko yang perlu diverifikasi.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Toko</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemilik</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon Toko</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($unverifiedStores as $store)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $store->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $store->user->name ?? 'N/A' }} ({{ $store->user->email ?? 'N/A' }})</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $store->phone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form method="POST" action="{{ route('admin.stores.verify', $store) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900 mr-2">Verifikasi</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.stores.reject', $store) }}" class="inline" onsubmit="return confirm('Yakin menolak dan menghapus toko ini?')">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-900">Tolak</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $unverifiedStores->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>