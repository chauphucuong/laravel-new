@extends('layout.index')
@section('content')
<div class="container">

    @include('layout.slide')

    <div class="space20"></div>


    <div class="row main-left">
        <div class="col-md-3 ">
            <ul class="list-group" id="menu">
                <li href="#" class="list-group-item menu1 active">
                    Menu
                </li>

                <li href="#" class="list-group-item menu1">
                    Level 1
                </li>
                <ul>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                </ul>

                <li href="#" class="list-group-item menu1">
                    <a href="#">Level 1</a>
                </li>
                <ul>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                </ul>


                <li href="#" class="list-group-item menu1">
                    <a href="#">Level 1</a>
                </li>

                <ul>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                </ul>


                <li href="#" class="list-group-item menu1">
                    <a href="#">Level 1</a>
                </li>
                <ul>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Level2</a>
                    </li>
                </ul>

                <li href="#" class="list-group-item menu1">
                    <a href="#">Level 1</a>
                </li>
                <li href="#" class="list-group-item menu1">
                    <a href="#">Level 1</a>
                </li>
            </ul>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">            
                <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                    <h2 style="margin-top:0px; margin-bottom:0px;">Giới thiệu</h2>
                </div>

                <div class="panel-body">
                    <!-- item -->
                    <p>
                    Lorem ipLorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.sum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.

                    
                    </p>

                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection