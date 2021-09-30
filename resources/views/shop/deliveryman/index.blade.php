@extends('shop.main')
@section('content')
    {{--    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>--}}
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <br>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            DeliveryMan
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <a href="{{route('shop.deliveryman.create')}}"
                                   class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    Add Deliveryman
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
{{--                    <div class="row">--}}
{{--                        <div class="col-6">--}}
{{--                            <button class="btn btn-danger delete-all" data-token="{{csrf_token()}}">Delete</button>--}}
{{--                        </div>--}}

{{--                    </div>--}}
                    <br/>
                    <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <table
                            class="table producttable table-striped- table-bordered table-hover table-checkable datatable"
                            id="deliveryman">
                            @csrf
                            <thead>
                            <tr>
{{--                                <th><input type="checkbox" name="selectall"--}}
{{--                                           class="form-control custom-checkbox selectall" style="height: 15px;"></th>--}}
                                <th>ID</th>
                                <th>Name</th>

                                <th>Address</th>
                                <th>Email</th>
                                <th>Contactno</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deliverymans as $deliveryman)
                                <tr>
{{--                                    <td><input type="checkbox" name="single[{{$deliveryman->id}}]"--}}
{{--                                               data-id="{{$deliveryman->id}}"--}}
{{--                                               class="form-control custom-checkbox singleselect" style="height: 15px;">--}}
{{--                                    </td>--}}
                                    <td>{{$deliveryman->id}}</td>
                                    <td>{{$deliveryman->name}}</td>

                                    <td>{{$deliveryman->address}}</td>
                                    <td>{{$deliveryman->email}}</td>
                                    <td>{{$deliveryman->contactno}}</td>


                                    <td>
                                        @if($deliveryman->active == 1)
                                            <div class="btn-group-horizontal" id="assign_remove_{{$deliveryman->id }}" >
                                                <button class="btn btn-info unassign ladda-button" data-style="slide-left" id="remove" url="{{route('shop.deliveryman.unassigned')}}" ruid="{{ $deliveryman->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                            </div>
                                            <div class="btn-group-horizontal" id="assign_add_{{ $deliveryman->id }}"  style="display: none"  >
                                                <button class="btn btn-warning assign ladda-button" data-style="slide-left" id="assign" uid="{{ $deliveryman->id }}" url="{{route('shop.deliveryman.assign')}}" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                            </div>
                                        @endif
                                        @if($deliveryman->active == 0)
                                            <div class="btn-group-horizontal" id="assign_add_{{ $deliveryman->id }}">
                                                <button class="btn btn-warning assign ladda-button" id="assign"
                                                        data-style="slide-left" uid="{{ $deliveryman->id }}"
                                                        url="{{route('shop.deliveryman.assign')}}" type="button"
                                                        style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span>
                                                </button>
                                            </div>
                                            <div class="btn-group-horizontal" id="assign_remove_{{ $deliveryman->id }}"
                                                 style="display: none">
                                                <button class="btn  btn-info unassign ladda-button" id="remove"
                                                        ruid="{{ $deliveryman->id }}" data-style="slide-left"
                                                        url="{{route('shop.deliveryman.unassigned')}}" type="button"
                                                        style="height:28px; padding:0 12px"><span class="ladda-label">Active</span>
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn waves-effect waves-light btn-primary"
                                           href="{{route('shop.deliveryman.edit',$deliveryman->id)}}"><i
                                                class="fa fa-pen   "></i></a>
                              </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

            <script>
                $('.assign').click(function () {

                    var deliveryman_id = $(this).attr('uid');
                    var url = $(this).attr('url');

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            id: deliveryman_id,
                            _token: '{{ csrf_token() }}'
                        },
                        cache: false,
                        dataType: 'json',
                        success: function (data) {
                            $('#assign_remove_' + deliveryman_id).show();
                            $('#assign_add_' + deliveryman_id).hide();
                        }
                    });
                });
                $('.unassign').click(function () {
                    var deliveryman = $(this).attr('ruid');
                    var url = $(this).attr('url');


                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: {
                            id: deliveryman,
                            _token: '{{ csrf_token() }}'
                        },
                        cache: false,
                        dataType: 'json',
                        success: function (data) {
                            $('#assign_remove_' + deliveryman).hide();
                            $('#assign_add_' + deliveryman).show();
                        }
                    });
                });


                $(document).ready(function () {


                    $('#deliveryman').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    });

                    // $(document).on('click', '.vishbaby', function () {
                    //     $('.modal').show()
                    // });

                    $(document).on('click', '.selectall', function () {

                        if ($(this).prop("checked") == true) {
                            console.log("Checkbox is checked.");
                            $('.singleselect').prop("checked", true);
                        } else if ($(this).prop("checked") == false) {
                            $('.singleselect').prop("checked", false);
                        }
                    });
                    $('.delete-all').on('click', function (e) {
                        var idsArr = [];
                        $(".singleselect:checked").each(function () {
                            idsArr.push($(this).attr('data-id'));

                        });
                        var strIds = idsArr.join(",");
                        // alert($(this).data('token'))
                        $.ajax({
                            type: "POST",
                            url: "{{route('shop.deliveryman.deleteall')}}",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + strIds,

                            success: function (data) {
                                if (data.status === 'success') {
                                    swal({
                                        title: "Success",
                                        text: "deliveryman Deleted Successfully",
                                        type: "success"
                                    }, function () {
                                        window.location = "{{route('shop.deliveryman.index')}}"
                                    });

                                } else if (data.status === 'error') {
                                    swal({
                                        title: "Error",
                                        text: "Opps..! Something Went to Wrong.",
                                        type: "error"
                                    });

                                }


                            }
                        });
                    });

                });
            </script>

<script>
        // $('.modalopen').click(function(){
        //     var id = $(this).data("id");
        //     $('.modal-body p').text("");
        //     $('.modal-body p').text(id);
        // });
        $('.assign').click(function(){

            var user_id = $(this).attr('uid');
            var url = $(this).attr('url');

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: user_id,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+user_id).show();
                    $('#assign_add_'+user_id).hide();
                }
            });
        });
        $('.unassign').click(function(){
            var user_id = $(this).attr('ruid');
            var url = $(this).attr('url');


            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    id: user_id,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+user_id).hide();
                    $('#assign_add_'+user_id).show();
                }
            });
        });
</script>
@stop



