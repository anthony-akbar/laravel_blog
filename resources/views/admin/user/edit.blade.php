@extends('admin.layouts.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование пользователя</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                            <li class="breadcrumb-item active">Редактирование пользователя</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="w-25">
                            <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label>Имя пользователя</label>
                                    <input type="text" class="form-control" name="name" placeholder="Имя пользователя"
                                           value="{{ $user->name }}">
                                    @error('name')
                                    <div class="text-danger">Это поле необходимо для заполнения!</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Электронная почта</label>
                                    <input type="text" class="form-control" name="email" placeholder="Электронная почта"
                                           value="{{ $user->email }}">
                                    @error('email')
                                    <div class="text-danger">Это поле необходимо для заполнения!</div>
                                    @enderror
                                </div>
                                <div class="form-group w-50">
                                    <label>Выберите роль</label>
                                    <select name="role" class="form-control">
                                        @foreach($roles as $id => $role)
                                            <option
                                                {{ $id == $user->role ? ' selected' : '' }} value="{{$id}}">{{$role}}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="submit" class="btn btn-primary" value="Обновить">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
