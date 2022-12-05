@extends('layouts_admin.master')
@section('css')
    @toastr_css
    @section('title')
        @lang('home.packages')
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        @lang('home.packages')
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <button type="button" class="button x-small" data-toggle="modal"
                                            data-target="#addModal">
                                        @lang('home.add_package')
                                    </button>
                                    <br><br>

                                    <div class="table-responsive">
                                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                               data-page-length="50"
                                               style="text-align: center">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('home.name') }}</th>
                                                <th>{{ trans('home.package_type') }}</th>
                                                <th>{{ trans('home.start') }}</th>
                                                <th>{{ trans('home.expiry_date') }}</th>
                                                <th>{{ trans('home.actions') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0; ?>

                                            @foreach ($packages as $package)
                                                @if($package->status == 'show')
                                                    <tr>
                                                            <?php $i++; ?>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ lang() == 'ar' ? $package->name_ar : $package->name_en  }}</td>
                                                        <td>{{ $package->type  }}</td>
                                                        <td>{{ $package->start->format('Y-m-d')  }}</td>
                                                        <td>{{ $package->end->format('Y-m-d')  }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#delete{{ $package->id }}"
                                                                    title="{{ trans('home.delete') }}"><i
                                                                    class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>

                                                    <!-- show_modal_Grade -->
                                                    <div class="modal fade" id="update{{-- $admin->id --}}"
                                                         tabindex="-1"
                                                         role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                        class="modal-title"
                                                                        id="exampleModalLabel">
                                                                        {{ trans('home.show_admin') }}
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    {{--                                                                    {{ method_field('patch') }}--}}
                                                                    @csrf
                                                                    <input type="text" hidden name="role_id" value="1">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <label for="Name"
                                                                                   class="mr-sm-2">{{ trans('home.name') }}
                                                                                :</label>
                                                                            <input id="name" type="text" name="name"
                                                                                   class="form-control"
                                                                                   value="{{-- $admin->name --}}"
                                                                                   disabled>
                                                                            <input id="id" type="hidden" name="id"
                                                                                   class="form-control"
                                                                                   value="{{-- $admin->id --}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label for="email"
                                                                                   class="mr-sm-2">{{ trans('home.email') }}
                                                                                :</label>
                                                                            <input type="email" class="form-control"
                                                                                   value="{{-- $admin->email --}}"
                                                                                   name="email" disabled>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label for="password"
                                                                                   class="mr-sm-2">{{ trans('home.password') }}
                                                                                :</label>
                                                                            <input type="password" class="form-control"
                                                                                   placeholder="(optional)"
                                                                                   name="password" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <br><br>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ trans('home.close') }}</button>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- edit_modal_Grade -->
                                                    <div class="modal fade" id="edit{{-- $admin->id --}}" tabindex="-1"
                                                         role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                        class="modal-title"
                                                                        id="exampleModalLabel">
                                                                        {{ trans('home.edit_admin') }}
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- add_form -->
                                                                    <form action="{{ route('admin.update') }}"
                                                                          method="post">
                                                                        {{--                                                                    {{ method_field('patch') }}--}}
                                                                        @csrf
                                                                        <input type="text" hidden name="role_id"
                                                                               value="1">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <label for="Name"
                                                                                       class="mr-sm-2">{{ trans('home.name') }}
                                                                                    :</label>
                                                                                <input id="name" type="text" name="name"
                                                                                       class="form-control"
                                                                                       value="{{-- $admin->name --}}"
                                                                                       required>
                                                                                <input id="id" type="hidden" name="id"
                                                                                       class="form-control"
                                                                                       value="{{-- $admin->id --}}">
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <label for="Name_en"
                                                                                       class="mr-sm-2">{{ trans('home.email') }}
                                                                                    :</label>
                                                                                <input type="email" class="form-control"
                                                                                       value="{{-- $admin->email --}}"
                                                                                       name="email" required>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label for="Name_en"
                                                                                       class="mr-sm-2">{{ trans('home.password') }}
                                                                                    :</label>
                                                                                <input type="password"
                                                                                       class="form-control"
                                                                                       placeholder="(optional)"
                                                                                       name="password">
                                                                            </div>
                                                                        </div>

                                                                        <br><br>

                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">{{ trans('home.close') }}</button>
                                                                            <button type="submit"
                                                                                    class="btn btn-success">{{ trans('home.update') }}</button>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- delete_modal_Grade -->
                                                    <div class="modal fade" id="delete{{ $package->id }}" tabindex="-1"
                                                         role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                        class="modal-title"
                                                                        id="exampleModalLabel">
                                                                        {{ trans('home.delete_package') }}
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('package.delete') }}"
                                                                          method="post">
                                                                        {{--                                                                    {{ method_field('Delete') }}--}}
                                                                        @csrf
                                                                        <h6>{{ trans('home.warning_delete') }}</h6>
                                                                        <input id="id" type="hidden" name="id"
                                                                               class="form-control"
                                                                               value="{{ $package->id }}">
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">{{ trans('home.close') }}</button>
                                                                            <button type="submit"
                                                                                    class="btn btn-danger">{{ trans('home.delete_package') }}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                            @endif
                                            @endforeach

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- add_modal_Grade -->
                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <v class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                            id="exampleModalLabel">
                                            {{ trans('home.add_package') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- add_form -->
                                        <form action="{{ route('package.store') }}" method="POST" id="addForm">
                                            @csrf

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="name"
                                                           class="mr-sm-2">{{ trans('home.package_name_ar') }}
                                                        :</label>
                                                    <input id="name_ar" type="text" name="name_ar" class="form-control"
                                                           required>
                                                    <label for="details_ar"
                                                           class="mr-sm-2">{{ trans('home.details_ar') }}
                                                        :</label>
                                                    <textarea id="details_ar" name="details_ar" class="form-control"
                                                              required></textarea>
                                                    <label for="start"
                                                           class="mr-sm-2">{{ trans('home.start')}}
                                                        :</label>
                                                    <input id="start" type="date" name="start" class="form-control"
                                                           required>
                                                    <label for="currency_ar"
                                                           class="mr-sm-2">{{ trans('home.currency') }}
                                                        :</label>
                                                    <select class="form-control" style="height: 4rem"
                                                            name="currency_en">
                                                        <option value="" disabled
                                                                selected>{{ trans('home.currency') }}</option>
                                                        @foreach($currencies as $currency)
                                                            <option value="{{ $currency->name_en  }}">
                                                                {{ lang() == 'ar' ? $currency->name_ar : $currency->name_en }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    {{--                                                    <label for="status"--}}
                                                    {{--                                                           class="mr-sm-2">{{ trans('home.payment') }}--}}
                                                    {{--                                                        :</label>--}}
                                                    {{--                                                    <select class="form-control" style="height: 4rem" name="payment_method" required>--}}
                                                    {{--                                                        <option value="" disabled--}}
                                                    {{--                                                                selected>{{ trans('home.payment') }}</option>--}}
                                                    {{--                                                        <option value="visa">{{ trans('home.visa') }}</option>--}}
                                                    {{--                                                        <option value="cash">{{ trans('home.cash') }}</option>--}}
                                                    {{--                                                        <option value="wallet">{{ trans('home.wallet') }}</option>--}}
                                                    {{--                                                    </select>--}}
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="name"
                                                           class="mr-sm-2">{{ trans('home.package_name_en') }}
                                                        :</label>
                                                    <input id="name_en" type="text" name="name_en" class="form-control"
                                                           required>
                                                    <label for="details_en"
                                                           class="mr-sm-2">{{ trans('home.details_en') }}
                                                        :</label>
                                                    <textarea id="details_en" name="details_en" class="form-control"
                                                              required></textarea>
                                                    <label for="end"
                                                           class="mr-sm-2">{{ trans('home.end') }}
                                                        :</label>
                                                    <input id="end" type="date" name="end" class="form-control"
                                                           required>
                                                    <label for="price"
                                                           class="mr-sm-2">{{ trans('home.price') }}
                                                        :</label>
                                                    <input id="price" type="number" name="price" class="form-control"
                                                           required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="type"
                                                           class="mr-sm-2">{{ trans('home.type_package') }}
                                                        :</label>
                                                    <select class="form-control" style="height: 4rem" name="type">
                                                        <option value="" disabled
                                                                selected>{{ trans('home.type_package') }}</option>
                                                        <option
                                                            value="basic">{{ trans('home.normal_package') }}</option>
                                                        <option
                                                            value="special">{{ trans('home.private_package') }}</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <br><br>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('home.close') }}</button>
                                                <button type="submit" class="btn btn-success"
                                                        id="addBtn">{{ trans('home.add') }}</button>
                                            </div>
                                        </form>
                                    </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render

@endsection