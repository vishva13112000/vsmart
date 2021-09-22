@extends('admin.main')
@section('content')
{{--    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>--}}
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <br>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">

                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <a href="{{route('admin.producttype.create')}}"
                                   class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    Add Product Type
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-6">
                                <button class="btn btn-danger delete-all" data-token="{{csrf_token()}}">Delete</button>
                        </div>

                    </div>
                    <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <table class="table shopcategory table-striped- table-bordered table-hover table-checkable datatable"
                               id="producttype">
                            @csrf
                            <thead>
                            <tr>
                                <th><input type="checkbox" name="selectall" class="form-control custom-checkbox selectall" style="height: 15px;"></th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($producttypes as $producttype)
                                        @php
                                        $productvalue=App\Models\ProductTypeValue::where('producttypeid',$producttype->id)->get('value');
                                        $product_values=[];
                                        foreach($productvalue as $value){
                                            
                                                    array_push($product_values,$value->value);
                                        }
                                      

                                        @endphp
                                <tr>
                                    <td><input type="checkbox" name="single[{{$producttype->id}}]" data-id="{{$producttype->id}}" class="form-control custom-checkbox singleselect" style="height: 15px;"></td>
                                    <td>{{$producttype->id}}</td>
                                    <td>{{$producttype->name}}</td>
                                    <td>{{implode(', ',$product_values)}}</td>
                                  
                                    <td>
                                        @if($producttype->active == 1)
                                            <div class="btn-group-horizontal" id="assign_remove_{{$producttype->id }}" >
                                                <button class="btn btn-success unassign ladda-button" data-style="slide-left" id="remove" url="{{route('admin.producttype.unassigned')}}" ruid="{{ $producttype->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                            </div>
                                            <div class="btn-group-horizontal" id="assign_add_{{ $producttype->id }}"  style="display: none"  >
                                                <button class="btn btn-danger assign ladda-button" data-style="slide-left" id="assign" uid="{{ $producttype->id }}" url="{{route('admin.producttype.assign')}}" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                            </div>
                                        @endif
                                        @if($producttype->active == 0)
                                            <div class="btn-group-horizontal" id="assign_add_{{ $producttype->id }}" >
                                                <button class="btn btn-danger assign ladda-button" id="assign" data-style="slide-left" uid="{{ $producttype->id }}" url="{{route('admin.producttype.assign')}}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                            </div>
                                            <div class="btn-group-horizontal" id="assign_remove_{{ $producttype->id }}" style="display: none" >
                                                <button class="btn  btn-success unassign ladda-button" id="remove" ruid="{{ $producttype->id }}" data-style="slide-left" url="{{route('admin.producttype.unassigned')}}" type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span></button>
                                            </div>
                                        @endif
                                    </td>

                                    <td><a class="btn waves-effect waves-light btn-primary" href="{{route('admin.producttype.edit',$producttype->id)}}"><i class="fa fa-pen   "></i></a>

                                        {{--                                            <button data-id="{{ $category->id }}"--}}
                                        {{--                                                    data-token="{{ csrf_token() }}" class="btn waves-effect waves-light btn-danger"><i class="fa fa-trash"></i></button>--}}
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

        var producttype_id = $(this).attr('uid');
        var url = $(this).attr('url');

        $.ajax({
            url: url,
            type: "POST",
            data: {
                id: producttype_id,
                _token: '{{ csrf_token() }}'
            },
            cache: false,
            dataType: 'json',
            success: function (data) {
                $('#assign_remove_' + producttype_id).show();
                $('#assign_add_' + producttype_id).hide();
            }
        });
    });
    $('.unassign').click(function () {
        var shopcategory_id = $(this).attr('ruid');
        var url = $(this).attr('url');


        $.ajax({
            url: url,
            type: "PUT",
            data: {
                id: producttype_id,
                _token: '{{ csrf_token() }}'
            },
            cache: false,
            dataType: 'json',
            success: function (data) {
                $('#assign_remove_' + producttype_id).hide();
                $('#assign_add_' + producttype_id).show();
            }
        });
    });


    $(document).ready(function () {

        $('#producttype').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        $(document).on('click','.selectall',function () {

            if($(this).prop("checked") == true){
                console.log("Checkbox is checked.");
                $('.singleselect').prop("checked",true);
            }
            else if($(this).prop("checked") == false){
                $('.singleselect').prop("checked",false);
            }
        });
        $('.delete-all').on('click', function(e) {
            var idsArr = [];
            $(".singleselect:checked").each(function() {
                idsArr.push($(this).attr('data-id'));

            });
            var strIds = idsArr.join(",");
            // alert($(this).data('token'))
            $.ajax({
                type: "POST",
                url: "{{route('admin.producttype.deleteall')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: 'ids='+strIds,

                success: function (data) {
                    if (data.status === 'success') {
                        swal({
                            title: "Success",
                            text: "Product Type Deleted Successfully",
                            type: "success"
                        }, function () {
                            window.location = "{{route('admin.producttype.index')}}"
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
@stop



@push('custom-scripts')

@endpush
