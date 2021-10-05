@extends('layout.master')
@section('konten')
    

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    @if (auth()->user()->level == 'tu')
                       <div class="col-lg-12 col-sm-12 col-md-12">
                           <div class="card">
                               <div class="card-body">
                                   <div class="table-responsive">
                                       @if (session()->has('success'))
                                           <div class="alert alert-success solid">
                                                {{ session('success') }}
                                           </div>
                                        @elseif (session()->has('failed'))
                                            <div class="alert alert-failed solid">
                                                {{ session('failed') }}
                                        </div>
                                       @endif
                                       <table class="table table-dark">
                                           <thead>
                                                <tr>
                                                    <th class="table-dark">Jenis Surat</th>
                                                    <th class="table-dark">Tanggal Request</th>
                                                    <th class="table-dark">Tempat Magang</th>
                                                    <th class="table-dark">Nama Requester</th>
                                                    <th class="table-dark">Berkas</th>
                                                    <th class="table-dark">Keterangan</th>
                                                    <th class="table-dark">Status</th>
                                                    <th class="table-dark">Terakhir Update</th>
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
                                                        @elseif ($item->jenis_surat == 3)                                                        
                                                            Surat Penelitian
                                                        @elseif ($item->jenis_surat == 4)
                                                            Surat Kerja Praktek
                                                        @endif
                                                        </td>
                                                        <td>{{ $item->tanggal_request }}</td>
                                                        <td>{{ $item->tempat_kp }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->berkas }}</td>
                                                        <td>{{ $item->keterangan }}</td>
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
                                                        @endif
                                                        </td>
                                                        <td>{{ $item->tanggal_update }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                                Upload Berkas
                                                            </button>
                                                            <a href="/download-berkas/{{ $item->berkas }}">
                                                                <button class="btn btn-success">Download Berkas</button>
                                                            </a>
                                                        </td>
                                                   </tr>
                                               @endforeach
                                           </tbody>
                                       </table>
                                   </div>
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
        {{-- Modal --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Upload Berkas {{ $datas[0]->name }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('upload-tu') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id_user" value="{{ $datas[0]->id_user }}">
                            <input type="file" class="form-control-file @error('berkas')
                                is-invalid
                            @enderror" name="berkas" id="berkas">
                            @error('berkas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select name="status" id="status" class="form-control">
                                <option>Pilih Status baru</option>
                                <option value="2">Acc By Admin</option>
                                <option value="3">Diproses Di Kaprogdi</option>
                                <option value="4">Sudah Tanda tangan Kaprogdi</option>
                                <option value="5">Di Tolak</option>
                            </select>
                        </div>
                        <div class="form-gorup">
                            <button class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        <script>
               
        </script>

@endsection
