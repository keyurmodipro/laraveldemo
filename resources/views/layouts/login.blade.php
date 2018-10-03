<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Qflow </title>

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>


    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup">test</a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        {{ Form::open(array('url' => 'login')) }}
                        <h1>Login Form</h1>
                        <div>
                            {{ Form::text('email','',array('id'=>'','class'=>'form-control','placeholder' => 'Please Enter your Email')) }}
                        </div>
                        <div>
                            {{ Form::password('password',array('class'=>'form-control', 'placeholder' => 'Please Enter your Password')) }}
                        </div>
                        <div>
                            {{ Form::submit('Login', array('class'=>'send-btn')) }}
                        </div>

                        <div class="clearfix"></div>
                        <div class="separator">
                            <p class="change_link">New Registration ?
                                <a href="/register" class="to_register"> Register </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />


                        </div>

                        </form>
                    </section>
                </div>

                <div id="register" class="animate form registration_form">
                    <section class="login_content">
                        {{ Form::open(array('url' => 'signup')) }}
                        <h1>Login Form</h1>
                        <div>
                            {{ Form::text('name','',array('id'=>'','class'=>'form-control','placeholder' => 'Please Enter your Name')) }}
                        </div>
                        <div>
                            {{ Form::text('email','',array('id'=>'','class'=>'form-control','placeholder' => 'Please Enter your Email')) }}
                        </div>
                        <div>
                            {{ Form::password('password',array('class'=>'form-control', 'placeholder' => 'Please Enter your Password')) }}
                        </div>
                        <div>
                            {{ Form::textarea('address', '', array('class'=>'form-control', 'placeholder' => 'Please Enter your Password'))}}
                        </div>
                        <div>
                            {{ Form::submit('Signup', array('class'=>'send-btn')) }}
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Already a member ?
                                <a href="#signin" class="to_register"> Log in </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />


                        </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>


    </body>
</html>
