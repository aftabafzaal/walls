<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Congratulations!</h2>
        <div>
            <p> <strong>{{ ucfirst($user->firstName) }} {{$user->middleName}} {{$user->lastName}}</strong> has been registered as @if($user->role_id == '3') <strong>Ambassador</strong> @else <strong>General User</strong> @endif in your system.</p>
        </div>
    </body>
</html>