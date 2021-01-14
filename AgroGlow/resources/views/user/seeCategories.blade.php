@extends('layouts/manager_layout')


@section('page1')

<div class="container-fluid">

        
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary">Seller</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 93px;">Name</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 93px;">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Name</th>
                                        <th rowspan="1" colspan="1">Actions</th>
                                    </tr>
                                </tfoot>
                            <form method="post">
                                <tbody>         
                                    @for($i = 0; $i < count($category); $i++)
                                        <tr role="row" class="odd" id="delete{{$category[$i]['id']}}">
                                            <td>{{$category[$i]['catName']}}</td> 
                                            <td><a href="{{route('editCategory', $category[$i]['id'])}}" class="btn btn-primary">Edit</a>
                                                <input type="button" value="Delete" class="btn btn-danger" data-id="{{$category[$i]['id']}}"> </td>                                      
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


    $('input').click(function (e) {
                                var id =$(this).data("id") 
                                var elementId = `#delete${id}`;
                                       
                                        $.ajax({  
                                                url:'/deleteCategory'+id,  
                                                method:'GET',  
                                                data:{'id':id},
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