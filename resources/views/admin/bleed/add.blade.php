@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
    <div class="page_wrapper">
        <div class="row"><h3 class="page_heading">{{$user->name}} </h3>
            <div class="bg_icon">
                <li @if($user->gender == ('male')||('Male')) class="fi-torso size-72"
                    @else class="fi-torso-female size-72" @endif></li>
            </div>
        </div>
        <div class="row">
            @if(Session::get('message') != NULL)
                @if((Session::has('type')) && (Session::get('type')=='success'))
                    <div data-alert class="alert-box success radius  small-20 medium-14 large-20 columns round"
                         style="text-align: center;font-weight: bold;">
                        {{ Session::get('message') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                @endif
                @if((Session::has('type')) && (Session::get('type')=='error'))
                    <div data-alert class="alert-box alert radius  small-20 medium-14 large-20 columns round"
                         style="text-align: center;font-weight: bold;">
                        {{ Session::get('message') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                @endif
            @endif
            @if (count($errors) > 0)
                <div>
                    @foreach ($errors->all() as $error)
                        <small class="error">{{ $error }}</small>
                    @endforeach
                </div>
            @endif
            {!! Form::open(['url' => '/add/user/bleed', 'id'=>'bleedForm']) !!}
            {{--{!! Form::open(array('url' => '/admin/add/user/bleed')) !!}--}}
            @include('admin.bleed._form', ['submitButtonText' => 'Add', 'readOnly' => false])
            {!! Form::close() !!}
        </div>
    </div>
</section>

@include('admin.footer')