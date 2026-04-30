<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ auth()->user()->hasRole('pasien') ? __('Pendaftaran Online Mandiri') : __('Input Pendaftaran Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Alert Error jika ada --}}
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('pendaftaran.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Pilih Pasien --}}
                            <div>
                                <x-input-label for="pasien_id" :value="__('Data Pasien')" />
                                <select name="pasien_id" id="pasien_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    {{-- Jika admin, tampilkan opsi pilih. Jika pasien login, otomatis select --}}
                                    @if(!auth()->user()->hasRole('pasien'))
                                        <option value="">-- Pilih Pasien --</option>
                                    @endif

                                    @foreach($pasiens as $pasien)
                                        <option value="{{ $pasien->id }}" {{ count($pasiens) == 1 ? 'selected' : '' }}>
                                            {{ $pasien->no_rm }} - {{ $pasien->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('pasien_id')" class="mt-2" />
                            </div>

                            {{-- Pilih Dokter --}}
                            <div>
                                <x-input-label for="dokter_id" :value="__('Dokter Tujuan (Poliklinik)')" />
                                <select name="dokter_id" id="dokter_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">-- Pilih Dokter --</option>
                                    @foreach($dokters as $dokter)
                                        <option value="{{ $dokter->id }}" {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>
                                            {{ $dokter->user->name }} ({{ $dokter->poli->nama_poli }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('dokter_id')" class="mt-2" />
                            </div>

                            {{-- Metode Pembayaran --}}
                            <div>
                                <x-input-label for="cara_bayar" :value="__('Metode Pembayaran')" />
                                <select name="cara_bayar" id="cara_bayar" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="umum" {{ old('cara_bayar') == 'umum' ? 'selected' : '' }}>Umum (Mandiri)</option>
                                    <option value="bpjs" {{ old('cara_bayar') == 'bpjs' ? 'selected' : '' }}>BPJS Kesehatan</option>
                                </select>
                                <x-input-error :messages="$errors->get('cara_bayar')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end">
                            <a href="{{ route('pendaftaran.index') }}" class="text-sm text-gray-600 underline hover:text-gray-900 mr-4">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button>
                                {{ auth()->user()->hasRole('pasien') ? __('Konfirmasi Pendaftaran') : __('Daftarkan Pasien') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>