@include('header')
@include('search_bar')
<!-- Center Container-->
<div class="row center-container">
    @if(Session::get('message') != NULL)
        @if((Session::has('type')) && (Session::get('type')=='success'))
            <div data-alert class="alert-box success radius  small-20 medium-14 large-20 columns round" style="text-align: center;font-weight: bold;">
                {{ Session::get('message') }}
                <a href="#" class="close">&times;</a>
            </div>
        @endif
        @if((Session::has('type')) && (Session::get('type')=='error'))
            <div data-alert class="alert-box alert radius  small-20 medium-14 large-20 columns round" style="text-align: center;font-weight: bold;">
                {{ Session::get('message') }}
                <a href="#" class="close">&times;</a>
            </div>
        @endif
    @endif
    <div class="row" style="margin: auto 20%;">
        {!! Form::open(array('url' => '/helplines')) !!}
        <div class="hide-for-small-only medium-4 large-4 columns">
            {!! Form::label('filter', 'Select City :' ,array('class' => 'inline')) !!}
        </div>
        <div class="small-20 medium-8 large-8 columns left">
            {!! Form::select('city_id', [
            '' => 'Select City', '208' => 'Lahore', '169' => 'Karachi', '130' => 'Islamabad', '1' => 'Abbotabad',
            '4' => 'Adda shaiwala', '9' => 'Arif wala', '10' => 'Arifwala', '13' => 'Badin', '15' => 'Bahawalpur',
            '18' => 'Barbar loi','25' => 'Bhawal nagar', '26' => 'Bhera', '28' => 'Bhirya road', '30' => 'Bhurewala',
            '41' => 'Chakwal', '42' => 'Charsada', '68' => 'Dera ghazi khan', '76' => 'Dina', '85' => 'Faisalabad',
            '90' => 'Feteh jhang', '103' => 'Ghotki', '111' => 'Gujranwala', '112' => 'Gujrat', '118' => 'Haroonabad',
            '125' => 'Hayatabad', '129' => 'Hyderabad', '132' => 'Jaccobabad', '141' => 'Jaranwala', '147' => 'Jhang',
            '149' => 'Jhelum', '174' => 'Kasur', '176' => 'Khair pur', '181' => 'Khanewal', '186' => 'Khewra',
            '193' => 'Kot addu', '202' => 'Kotli loharan', '203' => 'Kotri', '227' => 'Mandi bahauddin', '232' => 'Mangla',
            '249' => 'Mirpur khas', '256' => 'Multan', '262' => 'Muzaffarabad', '266' => 'Narowal', '275' => 'Nowshera',
            '278' => 'Okara', '285' => 'Patoki', '286' => 'Peshawar', '302' => 'Rahimyar khan', '304' => 'Raiwand',
            '311' => 'Rawalpindi', '316' => 'Sadiqabad', '318' => 'Sahiwal', '332' => 'Sargodha', '341' => 'Shaikhupura',
            '350' => 'Sialkot', '358' => 'Sohawa district jelum', '365' => 'Talhur', '374' => 'Taxila', '381' => 'Topi',
            '391' => 'Vehari', '392' => 'Wah cantt'], $city_id) !!}
        </div>
        <div  class="small-20 medium-8 large-8 columns">
            <input type="submit" class="small button radius" name="submit" value="Search">
        </div>
        {!! Form::close() !!}
    </div>
    <table role="grid" style="width: 100%;">
        <tr>
            <th># </th>
            <th>Name </th>
            <th>Contact Info </th>
            <th>Type </th>
        </tr>
        <?php $count = 1; ?>
        @foreach($dirs as $dir)
            <tr>
                <td>{{$count}}</td>
                <td>{{$dir->name}}</td>
                <td>
                    @if($dir->phone != NULL)
                        {!! HTML::image('includes/txt2img.php?txt='.base64_encode($dir->phone))!!}
                    @endif
                </td>
                <td><?php echo $dir->type == 'h' ? "Hospital" : "Blood Bank"; ?></td>
            </tr>
            <?php $count += 1; ?>
        @endforeach
    </table>
    <?php echo $dirs->appends(Request::all())->render(); ?>
</div>
@include('footer')