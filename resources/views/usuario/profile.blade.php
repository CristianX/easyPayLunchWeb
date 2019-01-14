@extends('adminlte::page')


@section('title', 'Perfil de Usuario')


@section('content')
  <section class="content-header">
     <h1>
       Tablero
       <small>Perfil de {{ $user->name }}</small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
       <li class="active">Perfil de {{ $user->name }}</li>
     </ol>
   </section>

   <section class="content">
   </br></br>
     <div class="col-md-12" >
             <!-- Widget: user widget style 1 -->
             <div class="box box-widget widget-user">
               <!-- Add the bg color to the header using any of the bg-* classes -->
               <div class="widget-user-header bg-black" style="background: url('../dist/img/photo1.png') center center;">
                 <h3 class="widget-user-username">{{ $user->name }}</h3>
                 <h5 class="widget-user-desc">{{ $user->email }}</h5>
               </div>
               <div class="widget-user-image">
                 <img class="img-circle" src="../dist/img/{{ $user->avatar }}" alt="User Avatar">
               </div>
               <div class="box-footer">
                 <div class="row">
                   <div class="col-sm-6 border-right">
                     <form enctype="multipart/form-data" action="/perfil" method="POST">
                      <!-- <label>Subir Imagen de Perfil</label> -->
                       <input type="file" name="avatar">
                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       <input type="submit" class="pull-right btn btn-sm btn-primary" value="subir">
                     </form>
                     <!-- /.description-block -->

                   </div>
                   <!-- /.col -->
                   <div class="col-sm-6 border-left">
                     <div class="direct-chat-msg right">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-right">Easy Pay</span>
                        <span class="direct-chat-timestamp pull-left">23 Ene 2:05 pm</span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        Aquí puedes subir tu imagen de perfil!
                      </div>
                  <!-- /.direct-chat-text -->
                    </div>
                  </div>
                     <!-- /.description-block -->
                   </div>
                   <!-- /.col -->

                   <!-- /.col -->
                 </div>
                 <!-- /.row -->
               </div>
             </div>
             <!-- /.widget-user -->
           </div>

    </section>
@stop
