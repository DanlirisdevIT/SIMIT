@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">Form Upload Suhu</h2>

                            
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                {{Session::get('success')}}
                                </div>
                            @endif

                           

                            <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importPdf">
                                Upload File
                            </button>
                     
                            <!-- Import Excel -->
                            <div class="modal fade" id="importPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('temperature.index') }}" enctype="multipart/form-data">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Upload Suhu</h5>
                                            </div>
                                            <div class="modal-body">
                     
                                                {{ csrf_field() }}

                                                @if(Session::has('error'))
                                                <div class="alert alert-danger">
                                                {{Session::get('error')}}
                                                </div>
                                            @endif
                     
                                                <label>Pilih file pdf</label>
                                                {{-- <div class="form-group">
                                                    <input type="file" name="file" required="required">
                                                </div> --}}
                                                <form method="POST" action="{{ route('temperature.index') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <input type="file" name="filename" required>
                                                        </div>
                                                    </div>
                                            <label for="formFile" class="form-label fw-normal">Acceptable file types are PDF, XLSX, XLS</label>
                                            <div>
                                                <label for="formFile" class="form-label fw-normal">Maks file size 10MB</label>
                                            </div>
                                            
                                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                     
                            <br><br>


                            @csrf
                                <table class="table table-bordered">
                                    <thead class="text-center"></thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama File</th>
                                            <th>Tanggal Upload</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($temperatures as $temperature)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $temperature->datafile }}</td>
                                            <td>{{ $temperature->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.datatables').DataTable({
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('danliris_budget.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'datafile', name: 'datafile', width: '15%'},
                    {data: 'created_at', name: 'created_at', width: '15%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });
        });
    })
    </script> --}}
 

@endsection