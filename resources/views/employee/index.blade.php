<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel 9 CRUD Tutorial Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Employee</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('employee.create') }}"> Create Employee</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Employee First Name</th>
                    <th>Employee Last Name</th>
                    <th>Employee Phone</th>
                    <th>Employee Email</th>
                    <th>Employee Company</th>
                   <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employee as $employees)
                    <tr>
                        <td>{{ $employees->id }}</td>
                        <td>{{ $employees->first_name }}</td>
                        <td>{{ $employees->last_name }}</td>
                        <td>{{ $employees->phone }}</td>
                        <td>{{ $employees->email }}</td>
                        <td>{{ $employees->name }}</td>
                        
                        <td>
                            <form action="{{ route('employee.destroy',$employees->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('employee.edit',$employees->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $employee->links() !!}
    </div>
</body>
</html>