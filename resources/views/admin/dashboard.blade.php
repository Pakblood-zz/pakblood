@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
   <div class="page_wrapper">
       <div class="row"><h3 class="page_heading">Dashboard </h3><div class="bg_icon"><li class="fi-graph-trend size-72"></li></div></div>
       <div class="row">
           <div class="small-7 columns left panel_div">
               <div class="panel panel_blue">
                   <div class="panel_heading">
                       <div class="row">
                           <div class="small-5 columns">Users </div>
                           <div class="small-10 columns" style="text-align: right;:;font-size: 45px;">{{$total_user}} </div>
                       </div>
                   </div>
                   <div class="panel_footer">
                       <a href="{{url('/admin/users')}}" class="">Show List <li class="fi-arrow-right size-12"></li> </a>
                       <div class="right add panel_blue"><a>Add </a></div>
                   </div>
               </div>
           </div>
           <div class="small-7 columns left panel_div">
               <div class="panel panel_green">
                   <div class="panel_heading">
                       <div class="row">
                           <div class="small-5 columns">Organizations </div>
                           <div class="small-10 columns" style="text-align: right;:;font-size: 45px;">{{$total_org}} </div>
                       </div>
                   </div>
                   <div class="panel_footer">
                       <a href="{{url('/admin/organizations')}}" class="">Show List <li class="fi-arrow-right size-12"></li> </a>
                       <div class="right add panel_green"><a>Add </a></div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</section>

@include('admin.footer')