@extends('admin.layouts.admin')
@section('title', 'Role')
@push('style')
    <style>
        .custom-permission-label {
            font-weight: 400 !important;
        }
    </style>
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row no-gutters mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Role</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="card vCard">
                    <div class="card-header">
                        <h3 class="card-title float-left">All Role
                        </h3>
                        @can('create-role')
                            <button type="button" onclick="openCreateRoleModal()"
                                    class="btn float-right btn-sm vBtn">
                                <i class="fa fa-plus"></i> Add Role
                            </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table id="roleDatatable"
                               class="table table-bordered table-striped dataTable dtr-inline text-center">
                            <thead style="width: 100% !important;">
                            <tr>
                                <th style="width: 5%">SL</th>
                                <th style="width: 30%">Name</th>
                                <th style="width: 45%">Description</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @forelse($roles as $role)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->description}}</td>
                                    <td>
                                        @can('update-role')
                                            <button onclick="openEditRoleModal('{{$role->slug}}')" type="button"
                                                    class="btn btn-sm btn-secondary"  data-toggle="tooltip"
                                                    title="Edit role"><i class="fa fa-edit"></i></button>
                                        @endcan
{{--                                        @can('delete-role')--}}
{{--                                            <form id="deleteRole-{{$role->slug}}"--}}
{{--                                                  action="{{route('roles.destroy', $role->slug)}}" method="POST"--}}
{{--                                                  class="d-inline">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
{{--                                                <button type="button"--}}
{{--                                                        onclick="deleteBtn('{{$role->slug}}')"--}}
{{--                                                        class="btn btn-sm btn-danger">--}}
{{--                                                    <i class="fa fa-trash"></i>--}}
{{--                                                </button>--}}
{{--                                            </form>--}}
{{--                                        @endcan--}}
                                    </td>
                                </tr>
                            @empty
                                <p class="text-center">Not Assigned</p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modals -->
        @can('create-role')
            <div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl ">
                    <div class="modal-content">
                        <div class="modal-header vMHeader">
                            <h4 class="modal-title text-white">Create Role</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="{{route('roles.store')}}" method="POST" class="form-horizontal"
                              id="roleCreateForm">
                            @csrf
                            <div class="modal-body">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="name">Role Name</label>

                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{old('name')}}" id="name" placeholder="Enter role name">
                                    @error('name') <span
                                        class="text-danger float-right">{{$errors->first('name') }}</span> @enderror

                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>

                                    <textarea name="description" id="description" rows="3" class="form-control"
                                              placeholder="Enter description / optional"></textarea>

                                </div>
                                <div class="form-group">
                                    <h2>Permissions</h2>
                                    <div class="icheck-danger ">
                                        <input type="checkbox" id="checkAll">
                                        <label for="checkAll">Check All</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="createRolePermission">Role
                                        Permission</label>
                                    <div id="createRolePermission">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="createUserPermission">User
                                        Permission</label>
                                    <div id="createUserPermission">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-default float-right"
                                            data-dismiss="modal">Close
                                    </button>
                                    <button type="submit"
                                            class="btn btn-sm defaultBtn float-right ">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan
        @can('update-role')
            <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header vMHeader">
                            <h4 class="modal-title text-white">Edit Role</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="roleEditForm" method="POST" class="form-horizontal">
                            @csrf
                            @method('patch')
                            <div class="modal-body">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="editRoleName">Role Name</label>

                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="editRoleName" placeholder="Enter role name">
                                    <span
                                        class="text-danger">{{$errors->has('name') ? $errors->first('name') : ''}}</span>


                                </div>
                                <div class="form-group">
                                    <label for="editRoleDescription">Description</label>

                                    <textarea name="description" id="editRoleDescription" rows="3"
                                              class="form-control"
                                              placeholder="Enter description / optional"></textarea>

                                </div>


                                <div class="form-group row no-gutters">
                                    <h2>Permissions</h2>
                                    <div class="icheck-danger d-inline col-12 ">
                                        <input type="checkbox" id="checkAllUpdate">
                                        <label for="checkAllUpdate">Check All</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editRolePermission">Role
                                        Permission</label>
                                    <div id="editRolePermission">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editUserPermission">User
                                        Permission</label>
                                    <div id="editUserPermission">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-default float-right"
                                        data-dismiss="modal">Close
                                </button>
                                <button type="submit"
                                        class="btn btn-sm defaultBtn float-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan
    </section>
@endsection


@push('script')
    <script>


        $(document).ready(function () {
            //Jquery Validation
            $('#roleCreateForm').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 40,
                    },
                },
                messages: {
                    name: {
                        required: "The name field is required.",
                        maxlength: "The name field must be under 40 characters"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback error-right-msg');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('#roleEditForm').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 40,
                    },
                },
                messages: {
                    name: {
                        required: "The name field is required.",
                        maxlength: "The name field must be under 40 characters"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback error-right-msg');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });


        });
        // checked/unchecked all checkboxes
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#checkAllUpdate").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });


        $(function () {
            $("#roleDatatable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "columnDefs": [
                    {"orderable": false, "targets": [3]}
                ],
            });
        });

        // all permissions in json format
        let permissions = @json($permissions);

        // Functions
        // Delete a Post
        function deleteBtn(slug) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $('#deleteRole-' + slug).submit();
                }
            })
        }

        function openCreateRoleModal() {
            // Reset all
            $('#createRolePermission').html('');
            $('#createUserPermission').html('');

            $.each(permissions, function (index, permission) {

                if (permission.for === 'role') {
                    $('#createRolePermission').append(
                        "<div class='icheck-info d-inline mr-2'>" +
                        "<input type='checkbox' name='permission_id[]' value='" + permission.id + "' id='" + 'create' + permission.id + "'>" +
                        "<label class='custom-permission-label' for='" + 'create' + permission.id + "'>" + permission.name + "</label></div>");
                }

                if (permission.for === 'user') {
                    $('#createUserPermission').append(
                        "<div class='icheck-info d-inline mr-2'>" +
                        "<input type='checkbox' name='permission_id[]' value='" + permission.id + "' id='" + 'create' + permission.id + "'>" +
                        "<label class='custom-permission-label' for='" + 'create' + permission.id + "'>" + permission.name + "</label></div>");
                }

            });

            // Open modal
            $('#createRoleModal').modal('show');
        }


        function openEditRoleModal(slug) {
            let roles = @json($roles);
            let role = roles.find(x => x.slug === slug);
            // console.log(role);

            // Catch app Url
            const appUrl = $('meta[name="app-url"]').attr('content');
            // Set edit form action url
            $('#roleEditForm').attr('action', appUrl + 'roles/' + role.id);

            // Set update row value
            $('#editRoleName').val(role.name);
            $('#editRoleDescription').val(role.description);
            // role.for == 0 ? $('#editEmployeeRole').prop('checked', true) : $('#editAdminRole').prop('checked', true);


            // Reset all
            $('#editRolePermission').html('');
            $('#editUserPermission').html('');



            $.each(permissions, function (index, permission) {

                if (permission.for === 'role') {
                    $('#editRolePermission').append(
                        "<div class='icheck-info d-inline mr-2'>" +
                        "<input type='checkbox' name='permission_id[]' value='" + permission.id + "' id='" + 'edit' + permission.id + "'>" +
                        "<label class='custom-permission-label' for='" + 'edit' + permission.id + "'>" + permission.name + "</label></div>");
                }

                if (permission.for === 'user') {
                    $('#editUserPermission').append(
                        "<div class='icheck-info d-inline mr-2'>" +
                        "<input type='checkbox' name='permission_id[]' value='" + permission.id + "' id='" + 'edit' + permission.id + "'>" +
                        "<label class='custom-permission-label' for='" + 'edit' + permission.id + "'>" + permission.name + "</label></div>");
                }
            });

            // Checked all role permissions
            $.each(role.permissions, function (index, value) {
                $("#edit" + value.id).prop("checked", true);
            });

            // Open modal
            $('#editRoleModal').modal('show');
        }
    </script>
@endpush
