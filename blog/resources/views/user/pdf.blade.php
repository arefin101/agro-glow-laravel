<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr>
        <td><b>Name</b></td>
        <td><b>Category</b></td>
        <td><b>Product Name</b></td> 
        <td><b>Price</b></td>    
      </tr>
      </thead>
      <tbody>
        @for($i = 0; $i < count($show); $i++)
        <tr>
            <td>{{$show[$i]['user']}}</td>
            <td>{{$show[$i]['category']}}</td>
            <td>{{$show[$i]['productName']}}</td>
            <td>{{$show[$i]['price']}}</td> 
        </tr>
    @endfor
      </tbody>
    </table>
  </body>
</html>