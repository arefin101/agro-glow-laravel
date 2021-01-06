<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
    <h2 style="text-align: center; color:blue">Agro Glow</h2>
    <table class="table table-bordered">
    <thead>
      <tr>
        <td><b>Name</b></td>
        <td><b>Category</b></td>
        <td><b>Product Name</b></td> 
        <td><b>Price</b></td>
        <td><b>Tasks</b></td>    
      </tr>
      </thead>
      <tbody>
        @for($i = 0; $i < count($show); $i++)
        <tr>
            <td>{{$show[$i]['user']}}</td>
            <td>{{$show[$i]['category']}}</td>
            <td>{{$show[$i]['productName']}}</td>
            <td>{{$show[$i]['price']}}</td>
            <td>{{$show[$i]['approval']}}</td> 
        </tr>
    @endfor
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td><b>Total Benifit</b></td>
          <td><b>Task Completed</b></td>
          <td><b>$pendingRequests</b></td> 
        </tr>
        </thead>
        <tbody>
          <tr>
              <td>{{$total}}</td>
              <td>{{$tasks}}</td>
              <td>{{$pendingRequests}}</td>
          </tr>
        </tbody>
      </table>
      <br>
      <h style="text-align: left">------------------</h>
      <h5 style="text-align: left">Signature</h5>
  </body>
</html>