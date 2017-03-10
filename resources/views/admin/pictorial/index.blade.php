@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
    <div class="page_wrapper">
        <div class="row">
            <h3 class="page_heading">Pictorials </h3>

            <div class="bg_icon">
                <li class="fi-torsos-all size-72"></li>
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

            <table role="grid" style="width: 100%;">
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Comment</th>
                    <th>Image</th>
                    <th width="90">Options</th>
                </tr>
                <?php $count = $data->firstitem(); ?>
                @foreach($data as $row)
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->comment}}</td>
                        <td>
                            @if($row->image != '')<img src="{{$row->image}}" style="height: 100px;width: auto;">@endif
                        </td>
                        <td class="options_btn">
                            <a data-tooltip aria-haspopup="true" class="has-tip" title="View"
                               href="{{url('admin/pictorial/'.$row->id).'/approve'}}">
                                <li class="fi-checkbox size-25"></li>
                            </a>
                            {{--<a data-tooltip aria-haspopup="true" class="has-tip" title="Edit"--}}
                               {{--href="{{url('admin/pictorial/'.$row->id.'/edit')}}">--}}
                                {{--<li class="fi-page-edit size-25"></li>--}}
                            {{--</a>--}}
                            {{--<a data-tooltip aria-haspopup="true" class="tip-left" title="Undo"--}}
                               {{--href="{{url('/admin/pictorial/'.$row->id.'/delete')}}">--}}
                                {{--<li class="fi-trash size-25"></li>--}}
                            </a>
                        </td>
                    </tr>
                    <?php $count += 1; ?>
                @endforeach
            </table>
            <?php echo $data->appends(Request::all())->render(); ?>
        </div>
    </div>
</section>

@include('admin.footer')