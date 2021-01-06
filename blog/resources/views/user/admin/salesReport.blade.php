@extends('layouts/admin_layout')


@section('page1')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h1 class="m-0 font-weight-bold text-primary">Sales Report</h1>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div id="dataTable_filter" class="dataTables_filter">
                        <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $total=0; 
        ?>  
        @for($i = 0; $i < count($productRequest); $i++)
            <?php
            $total += (float)$productRequest[$i]['price'] ;
            ?>                        
        @endfor


        <div class="form-group col-sm-offset-10 col-sm-20">
            <button onclick="window.print();" class="btn btn-primary">Print Report</button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 93px;">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 31px;">Quantity</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 65px;">Per Product Price</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1"></th>
                                        <th rowspan="1" colspan="1">Total Price</th>
                                        <th rowspan="1" colspan="1">{{$total}}</th>
                                    </tr>
                                </tfoot>
                                <tbody>     
                                    @for($i = 0; $i < count($productRequest); $i++)
                                        <tr>
                                            <td>{{$productRequest[$i]['productName']}}</td>
                                            <td>{{$productRequest[$i]['quantity']}}</td>   
                                            <td>{{$productRequest[$i]['price']}}</td>                                                      
                                        </tr>
                                    @endfor

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection