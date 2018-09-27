<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export</title>
</head>
<body>
    <table>
        <tr>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Email</td>
            <td>Number</td>
            <td>List Name</td>
            <td>Sent</td>
            <td>Received</td>
            <td>Opened</td>
            <td>Date Added</td>
            <td>Date Updated</td>
        </tr>
        @if(count($contacts) > 0)
            @foreach($contacts as $contact)
                <tr>
                    <td>{{$contact->fname}}</td>
                    <td>{{$contact->lname}}</td>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->number}}</td>
                    <td>{{$contact->list_id}}</td>
                    <td>{{$contact->sent}}</td>
                    <td>{{$contact->received}}</td>
                    <td>{{$contact->opened}}</td>
                    <td>{{$contact->created_at}}</td>
                    <td>{{$contact->updated_at}}</td>
                </tr>
            @endforeach
        @endif
    </table>    
</body>
</html>