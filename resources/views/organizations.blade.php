@include('header')
@include('search_bar')
<!-- Center Container-->
<div class="row center-container">
    <table role="grid" style="width: 100%;">
        <tr>
            <th>#</th>
            <th>Organization Name </th>
            <th>Admin Name </th>
            <th width="160">Contact Infomation</th>
            <th>Address </th>
            <th width="100"> </th>
        </tr>
        <?php $orgcount=1; ?>
        @foreach($orgs as $org)
                <tr>
                    <td>{{$orgcount}}</td>
                    <td>{{$org->name}}</td>
                    <td>{{$org->admin_name}}</td>
                    <td>@if($org->phone != NULL)
                            {!! HTML::image('includes/txt2img.php?txt='.base64_encode($org->phone))!!}
                        @endif
                        @if($org->mobile != NULL)
                            {!! HTML::image('includes/txt2img.php?txt='.base64_encode($org->mobile))!!}
                        @endif
                    </td>
                    <td>{{$org->address}}</td>
                    <td><a href="{{url('/organization/'.$org->id)}}">Join </a></td>
                </tr>
                <?php $orgcount+=1; ?>
        @endforeach
    </table>
    <?php echo $orgs->render(); ?>
</div>
@include('footer')