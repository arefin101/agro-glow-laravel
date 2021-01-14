@extends('layouts/manager_layout')


@section('page1')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h1 class="m-0 font-weight-bold text-primary">Farmers</h1>
                </div>
                <div class="col-sm-12 col-md-6">
                    
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 100px;">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 250px;">Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 150px;">DOB</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 150px;">Mobile</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 150px;">User Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 100px;">Position</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="2" aria-label="Salary: activate to sort column ascending" style="width: 67px;">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Name</th>
                                        <th rowspan="1" colspan="1">Email</th>
                                        <th rowspan="1" colspan="1">DOB</th>
                                        <th rowspan="1" colspan="1">Mobile</th>
                                        <th rowspan="1" colspan="1">User Name</th>
                                        <th rowspan="1" colspan="1">Position</th>
                                        <th rowspan="1" colspan="2">Action</th>
                                    </tr>
                                </tfoot>
                                <form method="post">
                                    <tbody>     
                                        @for($i = 0; $i < count($farmer); $i++)
                                            <tr role="row" class="odd" id="validity{{$farmer[$i]['userId']}}">
                                                <td>{{$farmer[$i]['name']}}</td>
                                                <td>{{$farmer[$i]['email']}}</td>
                                                <td>{{$farmer[$i]['DOB']}}</td>
                                                <td>{{$farmer[$i]['contact']}}</td>
                                                <td>{{$farmer[$i]['userName']}}</td>
                                                <td>{{$farmer[$i]['userType']}}</td>    
                                                <td><a href="{{route('editFarmer',$farmer[$i]['userId'])}}" class="btn btn-primary">Edit</a>
                                                    <input type="button" value="Delete" class="btn btn-danger" data-id="{{$farmer[$i]['userId']}}" id="delete{{$farmer[$i]['userId']}}"> 
                                                    
                                                    @if( $farmer[$i]['validity'] == 'valid')
                                                        <button id="{{$farmer[$i]['userId']}}"  type="button" class="btn btn-warning" data-value="{{$farmer[$i]['userId']}}" >Block</button>
                                                    @else
                                                        <button id="{{$farmer[$i]['userId']}}"  type="button" class="btn btn-warning" data-value="{{$farmer[$i]['userId']}}" >Unblock</button></td>
                                                    @endif
                                                </td>                                     
                                            </tr>
                                        @endfor
                                    </tbody>
                                </form>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {


        $('button').click(function (e) {
                                var id =$(this).data("value") 
                                var elementId = `#${id}`;
                                       
                                        $.ajax({  
                                                url:'/validityFarmer',  
                                                method:'GET',  
                                                data:{'userId':id},
                                                dataType:'json',
                                                success:function(data){ 
                                                    
                                                    $(elementId).html(data.validity);
                                                    
                                                },  
                                                error:function(data){  
                                                    alert('server error occured')  
                                                }  
                                            });
                                        
                                    });
                

        $('input').click(function (e) {
                                var id =$(this).data("id") 
                                var elementId = `#validity${id}`;
                                       
                                        $.ajax({  
                                                url:'/deleteFarmer'+id,  
                                                method:'GET',  
                                                data:{'userId':id},
                                                success:function(data){ 
                                                    
                                                    $(elementId).remove();
                                                    
                                                },  
                                                error:function(data){  
                                                    alert('server error occured')  
                                                }  
                                            });
                                        
                                    });

                });
   
</script>

@endsection