@extends('layouts/manager_layout')


@section('page1')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary">Check Notifications</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 93px;">Id</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 143px;">User Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 143px;">Category</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 65px;">Product Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 31px;">Quantity</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 31px;">Approval</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 69px;">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Id</th>
                                        <th rowspan="1" colspan="1">User Name</th>
                                        <th rowspan="1" colspan="1">Category</th>
                                        <th rowspan="1" colspan="1">Product Name</th>
                                        <th rowspan="1" colspan="1">Quantity</th>
                                        <th rowspan="1" colspan="1">Approval</th>
                                        <th rowspan="1" colspan="1">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>     
                                    @for($i = 0; $i < count($notification); $i++)
                                        <tr role="row" class="odd">
                                            <td>{{$notification[$i]['id']}}</td>
                                            <td>{{$notification[$i]['user']}}</td>
                                            <td>{{$notification[$i]['category']}}</td>
                                            <td>{{$notification[$i]['productName']}}</td>
                                            <td>{{$notification[$i]['quantity']}}</td> 
                                            <td id="notify{{$notification[$i]['id']}}">{{$notification[$i]['approval']}}</td>                                                
                                            <td><input type="button" value="Accept" class="btn btn-primary" data-id="{{$notification[$i]['id']}}" id="delete{{$notification[$i]['id']}}"> 
                                                <button id="{{$notification[$i]['id']}}"  type="button" class="btn btn-warning" data-value="{{$notification[$i]['id']}}" >Reject</button>
                                            </td>                                          
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        $('input').click(function (e) {
                                var id =$(this).data("id") 
                                var elementId = `#notify${id}`;
                                       
                                        $.ajax({  
                                                url:'/accepted'+id,  
                                                method:'GET',  
                                                data:{'requestId':id},
                                                success:function(data){ 
                                                    
                                                    $(elementId).html('served');
                                                    
                                                },  
                                                error:function(data){  
                                                    alert('server error occured')  
                                                }  
                                            });
                                        
                                    });

        $('button').click(function (e) {
                                var id =$(this).data("value") 
                                var elementId = `#notify${id}`;
                                       
                                        $.ajax({  
                                                url:'/rejected'+id,  
                                                method:'GET',  
                                                data:{'requestId':id},
                                                success:function(data){ 
                                                    
                                                    $(elementId).html('pending');
                                                    
                                                },  
                                                error:function(data){  
                                                    alert('server error occured')  
                                                }  
                                            });
                                        
                                    });                                    

                });

   
</script>

@endsection