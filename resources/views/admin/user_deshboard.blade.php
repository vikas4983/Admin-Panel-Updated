 @extends('layouts.auth')
 <!DOCTYPE html>

 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
 </head>
 <body>


     <div class="row">
         <div class="card card-default">
         </div>
     </div>
     @section('widgets')
     <div class="row">
         <!-- Frist box -->
         <div class="col-xl-3 col-md-6">

             <div class="card card-default">
                 <a href="{{ route('countries.index') }}" style="color: inherit">


                     <div class="d-flex p-5">
                         <div class="icon-md bg-secondary rounded-circle mr-3">
                             <i class="mdi mdi-earth"></i>
                         </div>
                         <div class=" text-left">
                             <span class="h2 d-block">{{$countries}}</span>
                             <p>Countries</p>
                         </div>
                     </div>
                 </a>
             </div>
         </div>

         <!-- Second box -->
         <div class="col-xl-3 col-md-6">
             <div class="card card-default">
                 <a href="{{ route('states.index') }}" style="color: inherit">

                     <div class="d-flex p-5">
                         <div class="icon-md bg-success rounded-circle mr-3">
                             <i class="mdi mdi-map-marker-radius

\f444"></i>
                         </div>
                         <div class=" text-left">
                             <span class="h2 d-block">{{ $states }}</span>


                             <p>States</p>
                         </div>
                     </div>
                 </a>

             </div>
         </div>

         <!-- Third box -->
         <div class="col-xl-3 col-md-6">
             <div class="card card-default">
                 <a href="{{ route('cities.index') }}" style="color: inherit">
                     <div class="d-flex p-5">
                         <div class="icon-md bg-primary rounded-circle mr-3">
                             <i class="mdi mdi-city"></i>
                         </div>
                         <div class="text-left">
                             <span class="h2 d-block">{{ $cities }}</span>
                             <p>Cities</p>
                         </div>
                     </div>
                 </a>

             </div>
         </div>

         <!-- Fourth box -->
         <div class="col-xl-3 col-md-6">
             <div class="card card-default">
                 <a href="{{ route('educations.index') }}" style="color: inherit">

                     <div class="d-flex p-5">
                         <div class="icon-md bg-info rounded-circle mr-3">
                             <i class="mdi mdi-collage"></i>
                         </div>
                         <div class="text-left">
                             <span class="h2 d-block">{{ $educations}}</span>
                             <p>Educations</p>
                         </div>
                     </div>
             </div>
             </a>

         </div>
     </div>

     <div class="row">
         <!-- Frist box -->
         <div class="col-xl-3 col-md-6">

             <div class="card card-default">
                 <a href="{{ route('religions.index') }}" style="color: inherit">


                     <div class="d-flex p-5">
                         <div class="icon-md bg-secondary rounded-circle mr-3">
                             <i class="mdi mdi-hinduism"></i>




                         </div>
                         <div class=" text-left">
                             <span class="h2 d-block">{{$religions}}</span>
                             <p>Religions</p>
                         </div>
                     </div>
                 </a>
             </div>
         </div>
         <!-- Second box -->
         <div class="col-xl-3 col-md-6">
             <div class="card card-default">
                 <a href="{{ route('castes.index') }}" style="color: inherit">

                     <div class="d-flex p-5">
                         <div class="icon-md bg-success rounded-circle mr-3">
                             <i class="mdi mdi-human-female-female"></i>


                         </div>
                         <div class=" text-left">
                             <span class="h2 d-block">{{ $castes }}</span>
                             <p>Castes</p>
                         </div>
                     </div>
                 </a>

             </div>
         </div>

         <!-- Third box -->
         <div class="col-xl-3 col-md-6">
             <div class="card card-default">
                 <a href="{{ route('incomes.index') }}" style="color: inherit">

                     <div class="d-flex p-5">
                         <div class="icon-md bg-primary rounded-circle mr-3">
                             <i class="mdi mdi-currency-inr"></i>

                         </div>
                         <div class="text-left">
                             <span class="h2 d-block">{{ $incomes }}</span>



                             <p>Incomes</p>
                         </div>
                     </div>
                 </a>

             </div>
         </div>

         <!-- Fourth box -->
         <div class="col-xl-3 col-md-6">
             <div class="card card-default">
                 <a href="{{ route('occupations.index') }}" style="color: inherit">

                     <div class="d-flex p-5">
                         <div class="icon-md bg-info rounded-circle mr-3">
                             <i class="mdi mdi-briefcase"></i>






                         </div>
                         <div class="text-left">
                             <span class="h2 d-block">{{ $occupations }}</span>
                             <p>Occupations</p>
                         </div>
                     </div>
             </div>
             </a>
         </div>
     </div>
     <div class="row">
         <!-- Frist box -->
         <div class="col-xl-3 col-md-6">

             <div class="card card-default">
                 <a href="{{ route('religions.index') }}" style="color: inherit">


                     <div class="d-flex p-5">
                         <div class="icon-md bg-secondary rounded-circle mr-3">
                             <i class="mdi mdi-security"></i>


                         </div>
                         <div class=" text-left">
                             <span class="h2 d-block">{{$admins}}</span>
                             <p>Admins</p>
                         </div>
                     </div>
                 </a>
             </div>
         </div>
         <!-- Second box -->
         {{-- <div class="col-xl-3 col-md-6">
             <div class="card card-default">
                 <a href="{{ route('castes.index') }}" style="color: inherit">

         <div class="d-flex p-5">
             <div class="icon-md bg-success rounded-circle mr-3">
                 <i class="mdi mdi-map-marker-radius
\f444"></i>
             </div>
             <div class=" text-left">
                 <span class="h2 d-block">{{ $castes }}</span>



                 <p>Castes</p>
             </div>
         </div>
         </a>

     </div>
     </div>

     <!-- Third box -->
     <div class="col-xl-3 col-md-6">
         <div class="card card-default">
             <a href="{{ route('incomes.index') }}" style="color: inherit">

                 <div class="d-flex p-5">
                     <div class="icon-md bg-primary rounded-circle mr-3">
                         <i class="mdi mdi-map"></i>
                     </div>
                     <div class="text-left">
                         <span class="h2 d-block">{{ $incomes }}</span>



                         <p>Incomes</p>
                     </div>
                 </div>
             </a>

         </div>
     </div>

     <!-- Fourth box -->
     <div class="col-xl-3 col-md-6">
         <div class="card card-default">
             <a href="{{ route('occupations.index') }}" style="color: inherit">

                 <div class="d-flex p-5">
                     <div class="icon-md bg-info rounded-circle mr-3">
                         <i class="mdi mdi-bell"></i>
                     </div>
                     <div class="text-left">
                         <span class="h2 d-block">{{ $occupations }}</span>
                         <p>Occupations</p>
                     </div>
                 </div>
         </div>
         </a>
     </div> --}}

     </div>







     @endsection

 </body>
 </html>
