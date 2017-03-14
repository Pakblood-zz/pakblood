@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
    <div class="page_wrapper">
        <div class="row">
            <div class="bg_icon">
                <i class="fi-torsos-all size-72"></i>
            </div>
            <h3 class="page_heading">Pictorials </h3>
            {{--<a href="javascript:;" id="selectAll" style="float: right;margin: 35px 20px 10px 5px;"--}}
            {{--class="button radius small">Select All </a>--}}
            {{--<a href="javascript:;" id="unSelectAll" style="float: right;margin: 35px 20px 10px 5px;"--}}
            {{--class="button radius small">Unselect All </a>--}}
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
                    <th>
                        <input id="toggleSelect" type="checkbox" name="toggleSelect" style="margin: 0;">
                    </th>
                    <th>User Name</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th width="90">Options</th>
                </tr>
                <?php $count = $data->firstitem(); ?>
                @foreach($data as $row)
                    <tr id="{{$row->id}}">
                        <td>{{$count}}</td>
                        <td>
                            <input type="checkbox" name="selectedStatus[]" data-id="{{$row->id}}" style="margin: 0;">
                        </td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->comment}}</td>
                        <td>{{($row->is_approved)?"Approved":"Not Approved"}}</td>
                        <td>
                            @if($row->image != '')
                                <a href="{{$row->image}}" data-title="{{$count}} - {{$row->name}}"
                                   data-lightbox="img-{{$row->id}}">
                                    <img src="{{$row->image}}" style="height: 100px;width: auto;">
                                </a>
                            @endif
                        </td>
                        <td class="options_btn">

                            @if($row->is_approved == 1)
                                <a data-tooltip aria-haspopup="true" class="has-tip tip-left" title="Disapprove"
                                   href="javascript:;" onclick="updateApproval({{$row->id}}, 0)">
                                    <i class="fi-x-circle size-25"></i>
                                </a>
                            @else
                                <a data-tooltip aria-haspopup="true" class="has-tip  tip-left" title="Approve"
                                   href="javascript:;" onclick="updateApproval({{$row->id}}, 1)">
                                    <i class="fi-checkbox size-25"></i>
                                </a>
                            @endif

                            {{--<a data-tooltip aria-haspopup="true" class="has-tip" title="Edit"--}}
                            {{--href="{{url('admin/pictorial/'.$row->id.'/edit')}}">--}}
                            {{--<li class="fi-page-edit size-25"></li>--}}
                            {{--</a>--}}
                            {{--<a data-tooltip aria-haspopup="true" class="tip-left" title="Undo"--}}
                            {{--href="{{url('/admin/pictorial/'.$row->id.'/delete')}}">--}}
                            {{--<li class="fi-trash size-25"></li>--}}
                            {{--</a>--}}
                        </td>
                    </tr>
                    <?php $count += 1; ?>
                @endforeach
            </table>
            <?php echo $data->appends(Request::all())->render(); ?>
            <div class="row">
                <div class="column column text-right">
                    <a style="" href="javascript:;" id="approveSelected"
                       class="button radius small">Approve Selected</a>
                    <a style="" href="javascript:;" id="disapproveSelected"
                       class="button radius small alert">Disapprove Selected</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function () {
        $(document).on('click', '#toggleSelect', function () {
            var toggle = $(this).prop('checked');
            $('table input[name="selectedStatus[]"]').each(function () {
                $(this).prop('checked', toggle);
            });
        });

        $(document).on('click', '#unSelectAll', function () {
            $('table input[name="selectedStatus[]"]').each(function () {
                $(this).prop('checked', false);
            });
        });

        $(document).on('click', '#approveSelected', function () {
            var ids = [];
            $('table input[name="selectedStatus[]"]:checked').each(function () {
                ids.push($(this).data('id'));
            });
            updateApproval(ids, 1);
        });

        $(document).on('click', '#disapproveSelected', function () {
            var ids = [];
            $('table input[name="selectedStatus[]"]:checked').each(function () {
                ids.push($(this).data('id'));
            });
            updateApproval(ids, 0);
        });
    });

    function updateApproval(ids, isApproved) {
        if (ids.length == 0) {
            return false;
        } else {
            $.ajax({
                type: 'GET',
                url: '/admin/pictorial/updateApproval',
                data: {ids: ids, isApproved: isApproved},
                success: function (response) {
                    if ($.isArray(response.ids)) {
                        $(response.ids).each(function (key, value) {
                            updateRow(value, response.isApproved);
                        });
                    } else {
                        updateRow(ids, response.isApproved);
                    }
                }
            });
        }
    }

    function updateRow(id, isApproved) {
        var tr = $('table tr#' + id);
        if (isApproved == 1) {
            tr.find('a i').removeClass('fi-checkbox').addClass('fi-x-circle');
        }
        else {
            tr.find('a i').removeClass('fi-x-circle').addClass('fi-checkbox');
        }
    }
</script>
@include('admin.footer')