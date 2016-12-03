<!DOCTYPE html>
<html>
    <head>
        <title>Category</title>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <form method="get" action="{{ url('convert') }}">
                    <input type="text" name="file_url" placeholder="File url">
                    <input type="submit" value="Convert">
                </form>
            </div>
        </div>
    </body>
</html>
