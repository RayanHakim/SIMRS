<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pemeriksaan Pasien: {{ $pendaftaran->pasien->nama }} ({{ $pendaftaran->no_reg }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('pemeriksaan.store', $pendaftaran->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <x-input-label for="keluhan" :value="__('Keluhan Pasien')" />
                            <textarea name="keluhan" class="w-full border-gray-300 rounded-md shadow-sm" rows="3" required></textarea>
                        </div>

                        <div>
                            <x-input-label for="pemeriksaan" :value="__('Hasil Pemeriksaan Fisik (Tensi, Suhu, dll)')" />
                            <textarea name="pemeriksaan" class="w-full border-gray-300 rounded-md shadow-sm" rows="3" required></textarea>
                        </div>

                        <div>
                            <x-input-label for="diagnosa" :value="__('Diagnosa Dokter')" />
                            <input name="diagnosa" type="text" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <x-input-label for="tindakan" :value="__('Tindakan / Prosedur')" />
                            <input name="tindakan" type="text" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-primary-button>Simpan Rekam Medis & Selesai</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>