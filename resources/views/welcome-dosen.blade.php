@extends('layout.master')
@section('konten')
    

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    @if (auth()->user()->level == 'dosen')
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" style="color: black">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="table-dark">Jenis Surat</th>
                                                    <th class="table-dark">Tanggal Request</th>
                                                    <th class="table-dark">Status</th>
                                                    <th class="table-dark">Berkas</th>
                                                    <th class="table-dark">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               @foreach ($datas as $item)
                                                   <tr>
                                                       <td>@if ($item->jenis_surat == 1)
                                                           Surat Tugas
                                                       @elseif ($item->jenis_surat == 2)
                                                           Surat Keterangan
                                                       @endif</td>
                                                       <td>{{ $item->tanggal_request }}</td>
                                                       <td>@if ($item->status == 1)
                                                           Sedang Di Proses
                                                       @elseif ($item->status == 2)
                                                           Di Acc
                                                        @elseif ($item->status == 3)
                                                            Di Kaprogdi
                                                        @elseif ($item->status == 4)
                                                            Sudah Di tanda tangan
                                                        @elseif ($item->status == 5)
                                                            Di Tolak
                                                       @endif</td>
                                                       <td>{{ $item->berkas }}</td>
                                                       <td>
                                                           @if ($item->berkas == 'None')
                                                           <button class="btn btn-success solid" disabled>Download</button>
                                                           @else
                                                           <button class="btn btn-success solid">Download</button>
                                                           @endif
                                                       </td>
                                                   </tr>
                                               @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2>Request Surat</h2>
                                    @if (session()->has('success'))
                                        <div class="alert alert-success solid">
                                            {{ session('success') }}
                                        </div>
                                    @elseif (session()->has('failed'))
                                        <div class="alert alert-danger solid">
                                            {{ session('failed') }}
                                        </div>
                                    @endif
                                    <form action="{{ route('request_dosen') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                                            <select name="jenis" id="jenis" class="form-control @error('jenis')
                                                is-invalid
                                            @enderror">
                                                <option>Pilih Jenis Surat</option>
                                                <option value="1">Surat Tugas</option>
                                                <option value="2">Surat Keterangan</option>
                                            </select>
                                            @error('jenis')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control @error('keterangan')
                                                is-invalid
                                            @enderror" placeholder="Keterangan" value="{{ old('keterangan') }}"></textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-lg solid">Request</button>
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
