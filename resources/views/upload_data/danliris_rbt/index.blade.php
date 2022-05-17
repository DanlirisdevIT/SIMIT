@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">RBT</h2>

                            
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                {{Session::get('success')}}
                                </div>
                            @endif

                           

                            <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importPdf">
                                Upload PDF
                            </button>

                            {{-- <div class="col-md-6">
                                <a href="{{ route('danliris_rbt.create') }}" class="btn btn-info">
                                Preview</a>
                            </div> --}}

                            {{-- <div class="col-md-6">
                                <a href="{{ route('danliris_rbt.create') }}" class="btn btn-info">
                                    Preview
                                </a>
                            </div> --}}

                            <br><br>
                            @csrf
                                <table class="table table-bordered datatables">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama File</th>
                                            <th>Dokumen</th>
                                            <th>Tanggal Upload</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                     
                            <!-- Import Excel -->
                            <div class="modal fade" id="importPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('danliris_rbt.index') }}" enctype="multipart/form-data">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Upload RBT</h5>
                                            </div>
                                            <div class="modal-body">
                     
                                                {{ csrf_field() }}

                                                @if(Session::has('error'))
                                                <div class="alert alert-danger">
                                                {{Session::get('error')}}
                                                </div>
                                            @endif
                     
                                                <label>Pilih file pdf</label>
                                                <form method="POST" action="{{ route('danliris_rbt.index') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <input type="file" name="datafile" required>
                                                        </div>
                                                    </div>

                                            <p class="fw-normal fs-6">Acceptable file types are PDF.
                                            </p>
                                            <p class="fw-normal fs-6">Maks file size 10MB.</p>
                                            
                                            <div class="form-group">
                                                <label name="document_name" class="col-sm-4 control-label"> Nama Dokumen </label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="document_name" name="document_name" placeholder="Masukkan nama dokumen..." maxlength="50" >
                                                </div>
                                            </div>
                                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                                {{-- <button type="button" class="btn btn-primary create">Upload</button> --}}
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                     
                            

    <script type="text/javascript">
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
                ajax: "{{ route('danliris_rbt.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'datafile', name: 'datafile', width: '15%'},
                    {data: 'document_name', name: 'document_name', width: '15%'},
                    {data: 'created_at', name: 'created_at', width: '15%'},
                    {data: 'action', name: 'Action', width: '5%'}
                ],
                order: [
                    [0, 'desc'],
                ],
            });

            $(document).on('click', '.previewPdf', function (e){

                e.preventDefault();

                // var path = $(this).data('name');
                var id = $(this).data('id');
                // console.log(path);
                console.log(id);

                $.ajax({
                    type: "GET",
                    // type: "POST",
                    // url: "{{ route('danliris_rbt.create') }}" + '?fileName='+path+"'",
                    url: "{{ route('danliris_rbt.create') }}" + "/" + id,
                    success: function(response){
                        console.log(response);
                        if(respone.status == 404) {
                            $('#updateForm_errList').addClass('alert alert-success');
                            $('#updateForm_errList').text(response.message);
                            // $('previewPdf').modal('hide')
                        }
                        else
                        {
                            $('#datafile').val(response.danliris_rbts.datafile);
                        }
                    }
                })
            })

            // $('#previewPdf').click(function(){
            //     $.ajax({

            //     })
            // })
        });
        
    </script>

@endsection