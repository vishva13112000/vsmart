@extends('admin.main')
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
                                    Add Shop Subscription
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        <a href="{{route('admin.subscription.index')}}"
                                           class="btn btn-success">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="subscriptionFrm">
                            @method('POST')
                            @csrf
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Subscription Name">
                                        </div>

                                        <div class="form-group col-4">
                                            <label>Duration</label>
                                            <input type="text" class="form-control numbersOnly" id="duration" name="duration" maxlength="10"
                                                   onkeypress="return isNumber(event)"/>
                                            @foreach($errors->get('duration') as $eroor)
                                                <span class="help-block">{{ $error}}</span>
                                            @endforeach
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>


                                        <div class="form-group col-4">
                                        <label for="title">Duration Type </label>
                                        <select class="form-control " name="durationtype">
                                        <option value="Months">Months</option>
                                        <option value="Years">Years</option>
                                         </select>
                                        </div>


                                         <div class="form-group col-4">
                                            <label>Price</label>
                                            <input type="text" class="form-control numbersOnly" id="price" name="price" maxlength="10"
                                                   onkeypress="return isNumber(event)"/>
                                            @foreach($errors->get('price') as $eroor)
                                                <span class="help-block">{{ $error}}</span>
                                            @endforeach
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>


                                     <div class="form-group col-4">
                                      <label for="title">Subscription Type </label>
                                      <select class="form-control " name="subscriptiontype">
                                        <option value="category">Category</option>
                                        <option value="ads">Ads</option>
                                        <option value="both">Both</option>
                                    </select>
                                </div>


                                </div>
                                <div class="row">
                                    <div class="col-12  text-center form-group">
                                        <button type="submit" class="btn btn-primary submit">Save</button>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script>

        $(document).ready(function () {
            $(".subscriptionFrm").validate({
                rules:
                    {
                        name:
                            {
                                required: true
                            },
                        duration:
                            {
                                required: true
                            },

                    },
                messages:
                    {
                        name:
                            {
                                required: "Name is required"
                            },
                        duration:
                            {
                                required: "Duration is required"
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
                if ($(".subscriptionFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.subscription.store')}}",
                        data: new FormData($('.subscriptionFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "Subscription Created Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('admin.subscription.index')}}"
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
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
   </script>
@stop

