<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Dynamic Form</title>

    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" data-type="keditor-style" />
    <link rel="stylesheet" type="text/css" href=" https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" data-type="keditor-style" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" data-type="keditor-style" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" data-type="keditor-style" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css" data-type="keditor-style" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />



    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        <?php
        echo html_entity_decode($style);
        ?>
    </style>
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>


    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
            <?php $user_id = auth()->user()->id; ?>
            <input type="hidden" id="user_id" value="<?php echo $user_id; ?>" />
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            @else
            <a href="{{ url('/register') }}">Register</a>
            <a href="{{ url('/login') }}">Login</a>
            @endif
        </div>
        @endif
        <div class='container-fluid'>
            <?php
            if ($content == '0') {
            ?><div class="callout callout-success">

                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="callout callout-info">
                                        <h5><i class="fas fa-info"></i> Note:</h5>
                                        Please Contact Admin For Form Creation
                                    </div>                                    
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </section>
                </div>
            <?php
            } else {
                echo  $content . "\n";
            }

            ?>
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script>
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }
        var submitted_count = 0;
        $(".form").submit(function(event) {
            submitted_count++;
            event.preventDefault();
            var resultArray = [];
            var labelArray = [];
            $(this).find('div.form-group').each(function() {
                var rowData = {};
                rowData['label'] = $(this).find('.label').text();
                if (rowData['label']) {
                    labelArray.push(rowData['label']);
                    $('#dropDownId').val();
                    rowData['checkbox'] = $(this).find('input[type=checkbox]').val();
                    rowData['textboxtext'] = $(this).find('input[type=text]').val();
                    rowData['textboxnumber'] = $(this).find('input[type=number]').val();
                    rowData['textarea'] = $(this).find('textarea').val();
                    rowData['dropdown'] = $(this).find('select[type=text]').val();
                    rowData['email'] = $(this).find('input[type=email]').val();
                    rowData['email'] = $(this).find('input[type=email]').val();


                    if (rowData['checkbox']) {
                        resultArray.push(rowData['checkbox']);
                    }
                    if (rowData['textboxtext']) {
                        resultArray.push(rowData['textboxtext']);
                    }
                    if (rowData['textboxnumber']) {
                        resultArray.push(rowData['textboxnumber']);
                    }
                    if (rowData['textarea']) {
                        resultArray.push(rowData['textarea']);
                    }
                    if (rowData['dropdown']) {
                        resultArray.push(rowData['dropdown']);
                    }
                    if (rowData['email']) {
                        resultArray.push(rowData['email']);
                    }

                }
            });
            console.log(resultArray);
            console.log(labelArray);
            var user_id = $('#user_id').val();
            //alert(user_id)
            let _token = $('meta[name="csrf-token"]').attr('content');


            $.ajax({
                url: "/submit-form",
                type: 'post',
                data: {
                    user_id: user_id,
                    values: resultArray,
                    labels: labelArray,
                    submitted_count: submitted_count,
                    open_count: labelArray,
                    _token: _token
                }
            }).done(function(rsp) {
                console.log(rsp.msg)
                if (rsp.msg == 0) {
                    toastr.warning("Already Submitted");
                } else {
                    toastr.success("Form Submitted Successfully");
                }

                $(".form")[0].reset();
            });

        });
    </script>

</body>

</html>