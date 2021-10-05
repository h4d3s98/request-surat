@extends('layout.master')
@section('konten')
    

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    @if (auth()->user()->level == 'kaprogdi')
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2>Akun Profile</h2>
                                    @if (session()->has('success'))
                                        <div class="alert alert-success solid">
                                            {{ session('success') }}
                                        </div>
                                    @elseif (session()->has('failed'))
                                        <div class="alert alert-danger">
                                            {{ session('failed') }}
                                        </div>
                                    @endif
                                    <form action="{{ route('akun') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama: </label>
                                            <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                                            <input type="text" name="nama" id="nama" class="form-control @error('nama')
                                                is-invalid
                                            @enderror" value="{{ $datas[0]->name }}">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Username: </label>
                                            <input type="text" name="username" id="username" class="form-control @error('username')
                                                is-invalid
                                            @enderror" value="{{ $datas[0]->username }}">
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Progdi: </label>
                                            <select name="progdi" id="progdi" class="form-control @error('progdi')
                                                is-invalid
                                            @enderror">
                                                <option>Pilih Progdi</option>
                                                <option value="1" @if ($datas[0]->progdi == 1)
                                                    selected
                                                @endif>TI</option>
                                                <option value="2" @if ($datas[0]->progdi == 2)
                                                    selected
                                                @endif>SI</option>
                                                <option value="3" @if ($datas[0]->progdi == 3)
                                                    selected
                                                @endif>DKV</option>
                                            </select>
                                            @error('progdi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email: </label>
                                            <input type="email" name="email" id="email" class="form-control @error('email')
                                                is-invalid
                                            @enderror" value="{{ $datas[0]->email }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">NIM: </label>
                                            <input type="text" name="nim" id="nim" class="form-control @error('nim')
                                                is-invalid
                                            @enderror" value="{{ $datas[0]->nim }}">
                                            @error('nim')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">New Password: </label>
                                            <input type="text" name="new_password" id="new_password" class="form-control @error('new_password')
                                                is-invalid
                                            @enderror">
                                            @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        <script>
               
        </script>

@endsection
