<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export Opened</title>
</head>
<body>    
    <table>
        <tr>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Email</td>
            <td>Number</td>
        </tr>
        @if(count($showOpened) > 0)
            @foreach($showOpened as $show)
                <tr>
                    <td>{{$show->fname}}</td>
                    <td>{{$show->lname}}</td>
                    <td>{{$show->email}}</td>
                    <td>{{$show->number}}</td>
                </tr>
            @endforeach
        @endif     
    </table>   

</body>
</html>