<!DOCTYPE html>
<html>

<head>
    <title>Method Not Allowed</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>Oops!</h1>
                    <h2>405 Method Not Allowed</h2>
                    <div class="error-details">
                        Sorry, the method you used is not allowed for this route.
                    </div>
                    <div class="error-actions">
                        <a href="{{ url()->previous() }}" class="btn btn-primary btn-lg"><span
                                class="glyphicon glyphicon-home"></span>
                            Take Me Home </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
