<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Contact us form Message</h2>
        <div>
            <table>
                <tbody>
                    <tr>
                        <td><strong><small>FirstName: </small></strong></td>
                        <td><small>{{ $input['f_name'] }}</small></td>
                    </tr>
                    <tr>
                        <td><strong><small>LastName: </small></strong></td>
                        <td><small>{{ $input['l_name'] }}</small></td>
                    </tr>
                    <tr>
                        <td><strong><small>Email: </small></strong></td>
                        <td><small>{{ $input['email'] }}</small></td>
                    </tr>
                    <tr>
                        <td><strong><small>Phone Number: </small></strong></td>
                        <td><small>{{ $input['phone_number'] }}</small></td>
                    </tr>
                    <tr>
                        <td><strong><small>Message: </small></strong></td>
                        <td><small>{{ $input['message'] }}</small></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </body>
</html>