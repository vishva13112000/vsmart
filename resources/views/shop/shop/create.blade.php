@extends('shop.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <br>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                   Profile
                                </h3>
                            </div>

                        </div>
                        <form class="shopFrm">
                            @method('POST')
                            @csrf
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label>Shop Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$shop->name}}">

                                        </div>
                                        <div class="form-group col-4">
                                            <label>OwnerName </label>
                                            <input type="text" class="form-control" id="ownername" name="ownername"  value="{{$shop->ownername}}">
                                        </div>

                                         <div class=" form-group col-4">
                                            <label>Email </label>
                                            <input type="email" class="form-control" id="email" name="email"  value="{{$shop->email}}">
                                        </div>

                                          <div class="col-4 form-group">
                                            <label>Contact </label>
                                            <input type="text" class="form-control" id="contact" name="contact"  value="{{$shop->contact}}">
                                        </div>

                                          <div class="col-4 form-group">
                                            <label>Address </label>
                                            <textarea type="text" class="form-control" id="address" name="address" >
                                                 {{$shop->address}}
                                            </textarea>
                                        </div>

                                        <div class="form-group col-4">
                                        <label for="title">Password </label>
                                        <input type="text" class="form-control" id="password" name="password">
                                    </div>

                                        <div class="form-group col-4">
                                        <label for="title">Password </label>
                                        <input type="text" class="form-control" id="password"  value="{{$shop->viewpassword}}">
                                    </div>




                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12  text-center form-group">
                                        <button type="submit" class="btn btn-primary submit">Update</button>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Subscription Detail
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <table class="table shop table-striped- table-bordered table-hover table-checkable datatable"
                               id="shop">
                            @csrf
                            <thead>
                            <tr>
                             <th>ID</th>
                                <th>Subscription</th>
                                <th>Price</th>
                                <th>Start Date</th>
                                <th>End Date</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subscriptions as $subscription)
                                <tr>
                                    <td>{{$subscription->id}}</td>
                                    <td>{{$subscription->subscription->name}}</td>
                                    <td>{{$subscription->price}}</td>
                                    <td>{{Carbon\Carbon::parse($subscription->start_date)->format('d-m-Y')}}</td>
                                    <td>{{Carbon\Carbon::parse($subscription->end_date)->format('d-m-Y')}}</td>



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

        $(document).ready(function () {
            $('#shop').DataTable({
                "dom": '<"top"if>rt<"bottom"lp><"clear">',
                "columnDefs": [ {
                    "targets": -1,
                    "orderable": false
                } ]
            });
            $(".shopFrm").validate({
                rules:
                    {
                        name:
                            {
                                required: true
                            },
                        email:
                            {
                                required: true
                            },
                            ownername:
                            {
                                required:true
                            },
                            contact:
                            {
                                required:true
                            },
                            address:
                            {
                                required:true
                            },

                    },
                messages:
                    {
                        name:
                            {
                                required: "Nmae is required"
                            },
                        email:
                            {
                                required: "Email is required"
                            },
                        ownername:
                            {
                                required: "OwnerName is required"
                            },

                          contact:
                            {
                                required: "contact is required"
                            },
                            address:
                            {
                                required: "address is required"
                            },

                    },
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error');
                    $('.help-block').css('color', 'red');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $(".submit").click(function (event) {
                // alert('he');
                event.preventDefault();
                if ($(".shopFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('shop.update')}}",
                        data: new FormData($('.shopFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "Shop Created Successfully",
                                    type: "success"
                                }, function () {
                                    location.reload();
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
                } else {
                    event.preventDefault();
                }
            });

        });
    </script>
@stop

