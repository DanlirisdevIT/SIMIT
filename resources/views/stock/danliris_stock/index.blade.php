@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">Saldo Awal</h2>

                            <div class="row input-daterange">
                                <div class="col-md-4">
                                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                                </div>
                                <div class="col-md-4">
                                    <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                                    <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                                </div>
                            </div>
                            <br><br>

                                <table class='table table-bordered datatables'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Saldo Awal</th>
                                            <th>Saldo Masuk</th>
                                            <th>Saldo Keluar</th>
                                            <th>Saldo Akhir</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    {{-- <tbody>
                                        @php $i=1 @endphp
                                        @foreach($danliris_movements as $movement)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $movement->asset_name }}</td>
                                            <td>{{ $movement->quantity }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $movement->status }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody> --}}
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            // $.ajaxSetup({
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.input-daterange').datepicker({
                todayBtn:'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            load_data();

            function load_data(from_date = '', to_date= '')
            {
                var DataTable = $('.datatables').DataTable({
                autowidth: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('danliris_stock.index') }}",
                    data: {from_date: from_date, to_date: to_date}
                },
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'asset_name', name: 'asset_name', width: '15%'},
                    {data: 'quantity', name: 'quantity', width: '15%'},
                    {data: 'stock_masuk', name: 'stock_masuk', width: '15%'},
                    {data: 'stock_keluar', name: 'stock_keluar', width: '15%'},
                    {data: 'stock_akhir', name: 'stock_akhir', width: '15%'},
                    {data: 'status', name: 'status', width: '15%'}
                ],
                order: [
                    [0, 'desc'],
                ],
            });
        }
        

        $(document).ready(function() {

            $('#filter').click(function(){
                    var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();
                    if(from_date != '' && to_date != '')
                    {
                        $('#datatables').DataTable().destroy();
                        load_data(from_date, to_date);
                    }
                    else
                    {
                        alert('date is required');
                    }
                });

                $('#refresh').click(function(){
                    $('#from_date').val('');
                    $('#to_date').val('');
                    $('#datatables').DataTable().destroy();
                    load_data();
                });
        });

        

    });

    </script>


@endsection