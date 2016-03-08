@include('header')
@include('search_bar')
        <!-- Center Container-->
<style>
    #countriesRegForm_chosen, #citiesRegForm_chosen {
        margin: 0;
    }
</style>
<div class="row center-container">
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
    {!! Form::open(['url' => '/helplines','class'=>'row']) !!}
    <div class="small-20 medium-7 large-7 columns" style="margin-bottom: 10px;">
        <select name="country" id="countriesRegForm" data-placeholder="Choose a country..."
                class="chosen-select">
            <option value=""></option>
            @foreach($countries as $row)
                <option value="{{ $row->id }}" {{ (isset($hCountry) && $hCountry== $row->id)?"selected":"" }}>{{ $row->short_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="small-20 medium-7 large-7 columns" style="margin-bottom: 10px;">
        <select name="city" id="citiesRegForm" data-placeholder="Choose a city..."
                class="chosen-select" {{ (isset($hCity))?"":"disabled" }}>
            <option value=""></option>
            @if(isset($hCities))
                @foreach($hCities as $row)
                    <option value="{{ $row->id }}" {{ (isset($hCity) && $hCity== $row->id)?"selected":"" }}>{{ $row->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="small-20 medium-6 large-6 columns text-center" style="margin-bottom: 10px;">
        <input type="submit" class="small button radius" name="submit" value="Search">
    </div>
    {!! Form::close() !!}
    <table role="grid" style="width: 100%;">
        <tr>
            <th width="5%" class="hide-for-small-down">#</th>
            <th width="50%">Name</th>
            <th width="35%">Contact Info</th>
            <th width="10%" class="hide-for-small-down">Type</th>
        </tr>
        <?php $count = 1; ?>
        @foreach($dirs as $dir)
            <tr>
                <td class="hide-for-small-down">{{$count}}</td>
                <td>{{$dir->name}}</td>
                <td>
                    {!! $dir->phone !!}
                </td>
                <td class="hide-for-small-down"><?php echo $dir->type == 'h' ? "Hospital" : "Blood Bank"; ?></td>
            </tr>
            <?php $count += 1; ?>
        @endforeach
    </table>
    <?php echo $dirs->appends(Request::all())->render(); ?>
</div>
<script>
    //ID of select containing countries and ID of select containing cities.
    countryAndCitySelect('countriesRegForm', 'citiesRegForm');
</script>
@include('footer')